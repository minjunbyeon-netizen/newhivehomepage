"""
Portfolio Migration Script
Migrates portfolio data from legacy MySQL JSON export to Firebase Firestore
"""

import json
import os
import re
from datetime import datetime

# Firebase Admin SDK
import firebase_admin
from firebase_admin import credentials, firestore

# Firebase configuration
FIREBASE_PROJECT_ID = "hivemedia-archive"

# Paths
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
PROJECT_ROOT = os.path.dirname(SCRIPT_DIR)
JSON_PATH = os.path.join(PROJECT_ROOT, "assets", "uploaded", "app", "portfolio.json")
THUMBNAIL_DIR = os.path.join(PROJECT_ROOT, "assets", "uploaded", "thumbnail")

# Category mapping
CATEGORY_MAP = {
    "Homepage": "홈페이지",
    "Video": "영상",
    "U": "기타",
    "V": "영상",
    None: "기타",
    "": "기타"
}

def clean_html(html_string):
    """Remove HTML tags from string"""
    if not html_string:
        return ""
    clean = re.compile('<.*?>')
    return re.sub(clean, '', html_string).strip()

def parse_date(date_string):
    """Parse date string to datetime object"""
    if not date_string:
        return None
    try:
        # Try "YYYY-MM-DD" format
        return datetime.strptime(date_string.split()[0], "%Y-%m-%d")
    except:
        return None

def check_image_exists(filename):
    """Check if thumbnail image exists"""
    if not filename:
        return False
    image_path = os.path.join(THUMBNAIL_DIR, filename)
    return os.path.exists(image_path)

def transform_portfolio_item(item):
    """Transform legacy JSON item to Firebase format"""
    
    # Extract fields
    pk_no = item.get("pk_no")
    client = item.get("hiveboad000001", "")  # 광고주
    project_name = item.get("hiveboad000031", client)  # 프로젝트명 (없으면 광고주명)
    description_html = item.get("hiveboad000007", "")  # 설명 (HTML)
    summary = item.get("hiveboad000020", "")  # 요약
    date_str = item.get("hiveboad000021", "")  # 날짜
    category_code = item.get("hiveboad000023", "")  # 카테고리 코드
    thumbnail = item.get("hiveboad000011", "")  # 섬네일
    sub_image1 = item.get("hiveboad000026", "")  # 서브이미지1
    sub_image2 = item.get("hiveboad000029", "")  # 서브이미지2
    is_active = item.get("hiveboad000017", "N")  # 활성여부
    
    # 광고주명이나 프로젝트명이 없으면 스킵
    if not client or client.strip() == "":
        return None
    
    # 프로젝트명이 없으면 광고주명 사용
    if not project_name:
        project_name = client
    
    # 설명 정리
    description = clean_html(description_html)
    
    # 카테고리 변환
    category = CATEGORY_MAP.get(category_code, "기타")
    
    # 날짜 파싱
    parsed_date = parse_date(date_str)
    
    # 이미지 경로 생성
    thumbnail_path = f"./assets/uploaded/thumbnail/{thumbnail}" if thumbnail else ""
    sub_image1_path = f"./assets/uploaded/thumbnail/{sub_image1}" if sub_image1 else ""
    sub_image2_path = f"./assets/uploaded/thumbnail/{sub_image2}" if sub_image2 else ""
    
    # 이미지 존재 여부 확인
    thumbnail_exists = check_image_exists(thumbnail)
    
    return {
        "id": str(pk_no),
        "client": client.strip(),
        "projectName": project_name.strip(),
        "description": description,
        "summary": summary.strip() if summary else "",
        "category": category,
        "date": date_str,
        "createdAt": parsed_date,
        "thumbnail": thumbnail_path,
        "thumbnailExists": thumbnail_exists,
        "subImage1": sub_image1_path,
        "subImage2": sub_image2_path,
        "isActive": is_active == "Y",
        "approved": True,  # 기존 데이터는 승인된 것으로 처리
        "migratedAt": datetime.now()
    }

def load_portfolio_json():
    """Load and parse portfolio JSON file"""
    print(f"📁 Loading JSON from: {JSON_PATH}")
    
    with open(JSON_PATH, 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    rows = data.get("rows", [])
    print(f"✅ Found {len(rows)} portfolio items in JSON")
    
    return rows

def initialize_firebase():
    """Initialize Firebase Admin SDK"""
    # Check if already initialized
    if len(firebase_admin._apps) > 0:
        return firestore.client()
    
    # Try to find service account key
    service_account_paths = [
        os.path.join(PROJECT_ROOT, "firebase-service-account.json"),
        os.path.join(PROJECT_ROOT, "serviceAccountKey.json"),
        os.path.join(SCRIPT_DIR, "firebase-service-account.json"),
    ]
    
    cred_path = None
    for path in service_account_paths:
        if os.path.exists(path):
            cred_path = path
            break
    
    if cred_path:
        print(f"🔑 Using service account: {cred_path}")
        cred = credentials.Certificate(cred_path)
        firebase_admin.initialize_app(cred)
    else:
        print("⚠️ No service account found, using application default credentials")
        firebase_admin.initialize_app(options={
            'projectId': FIREBASE_PROJECT_ID
        })
    
    return firestore.client()

def migrate_to_firebase(items, dry_run=True):
    """Migrate portfolio items to Firebase Firestore"""
    
    if dry_run:
        print("\n🧪 DRY RUN MODE - No data will be written to Firebase")
        print("=" * 60)
        
        # Statistics
        categories = {}
        active_count = 0
        with_thumbnail = 0
        
        for item in items:
            transformed = transform_portfolio_item(item)
            if transformed:
                cat = transformed['category']
                categories[cat] = categories.get(cat, 0) + 1
                if transformed['isActive']:
                    active_count += 1
                if transformed['thumbnailExists']:
                    with_thumbnail += 1
        
        print(f"\n📊 Statistics:")
        print(f"   Total items to migrate: {len(items)}")
        print(f"   Active items: {active_count}")
        print(f"   Items with thumbnails: {with_thumbnail}")
        print(f"\n📂 Categories:")
        for cat, count in sorted(categories.items()):
            print(f"   {cat}: {count}")
        
        print("\n✅ Sample transformed items (first 3):")
        for i, item in enumerate(items[:3]):
            transformed = transform_portfolio_item(item)
            if transformed:
                print(f"\n   [{i+1}] {transformed['client']}")
                print(f"       Project: {transformed['projectName']}")
                print(f"       Category: {transformed['category']}")
                print(f"       Date: {transformed['date']}")
                print(f"       Thumbnail: {'✅' if transformed['thumbnailExists'] else '❌'}")
        
        return
    
    # Real migration
    print("\n🚀 STARTING MIGRATION TO FIREBASE")
    print("=" * 60)
    
    db = initialize_firebase()
    collection_ref = db.collection('portfolios')
    
    success_count = 0
    error_count = 0
    
    for i, item in enumerate(items):
        transformed = transform_portfolio_item(item)
        
        if not transformed:
            continue
        
        try:
            # Use pk_no as document ID to avoid duplicates
            doc_id = transformed['id']
            collection_ref.document(doc_id).set(transformed)
            success_count += 1
            
            if (i + 1) % 10 == 0:
                print(f"   Progress: {i + 1}/{len(items)} items processed")
                
        except Exception as e:
            print(f"   ❌ Error migrating item {transformed['id']}: {e}")
            error_count += 1
    
    print(f"\n✅ Migration complete!")
    print(f"   Successful: {success_count}")
    print(f"   Errors: {error_count}")

def main():
    print("=" * 60)
    print("🔄 Portfolio Migration Tool")
    print("   From: MySQL JSON Export")
    print("   To: Firebase Firestore")
    print("=" * 60)
    
    # Load JSON
    items = load_portfolio_json()
    
    if not items:
        print("❌ No items found in JSON file")
        return
    
    # Ask for migration mode
    print("\n" + "=" * 60)
    print("Select mode:")
    print("  1. Dry run (preview only, no data written)")
    print("  2. Real migration (writes to Firebase)")
    print("=" * 60)
    
    choice = input("Enter choice (1 or 2): ").strip()
    
    if choice == "2":
        confirm = input("⚠️ This will write data to Firebase. Type 'yes' to confirm: ").strip()
        if confirm.lower() == 'yes':
            migrate_to_firebase(items, dry_run=False)
        else:
            print("❌ Migration cancelled")
    else:
        migrate_to_firebase(items, dry_run=True)
        print("\n💡 To run actual migration, run again and choose option 2")

if __name__ == "__main__":
    main()
