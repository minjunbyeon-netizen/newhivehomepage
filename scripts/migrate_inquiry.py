"""
Inquiry Migration Script
Migrates inquiry data from legacy MySQL JSON export to Firebase Firestore
"""

import json
import os
from datetime import datetime

# Firebase Admin SDK
import firebase_admin
from firebase_admin import credentials, firestore

# Firebase configuration
FIREBASE_PROJECT_ID = "hivemedia-archive"

# Paths
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))
PROJECT_ROOT = os.path.dirname(SCRIPT_DIR)
JSON_PATH = os.path.join(PROJECT_ROOT, "assets", "uploaded", "app", "inquery.json")

def parse_date(date_string):
    """Parse date string to datetime object"""
    if not date_string:
        return datetime.now()
    try:
        # Try "YYYY-MM-DD HH:MM:SS" format
        return datetime.strptime(date_string, "%Y-%m-%d %H:%M:%S")
    except:
        return datetime.now()

def transform_inquiry_item(item):
    """Transform legacy JSON item to Firebase format"""
    
    # Mapping hivecolm fields
    # hivecolm000001: category
    # hivecolm000003: company
    # hivecolm000004: name
    # hivecolm000005: phone
    # hivecolm000011: email
    # hivecolm000013: timestamp
    # hivecolm000015: message
    
    pk_no = item.get("pk_no")
    category = item.get("hivecolm000001", "기타")
    company = item.get("hivecolm000003", "")
    name = item.get("hivecolm000004", "")
    phone = item.get("hivecolm000005", "")
    email = item.get("hivecolm000011", "")
    date_str = item.get("hivecolm000013", "")
    message = item.get("hivecolm000015", "")
    
    # Validation
    if not name and not company:
        return None
    
    parsed_date = parse_date(date_str)
    
    return {
        "legacyId": pk_no,
        "name": name.strip() if name else "",
        "company": company.strip() if company else "",
        "phone": phone.strip() if phone else "",
        "email": email.strip() if email else "",
        "category": category,
        "message": message.strip() if message else "",
        "status": "read", # Mark legacy as read
        "createdAt": parsed_date,
        "migratedAt": datetime.now()
    }

def initialize_firebase():
    """Initialize Firebase Admin SDK"""
    if len(firebase_admin._apps) > 0:
        return firestore.client()
    
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
        cred = credentials.Certificate(cred_path)
        firebase_admin.initialize_app(cred)
    else:
        firebase_admin.initialize_app(options={'projectId': FIREBASE_PROJECT_ID})
    
    return firestore.client()

def migrate(dry_run=True):
    print(f"Loading JSON from: {JSON_PATH}")
    if not os.path.exists(JSON_PATH):
        print(f"File not found: {JSON_PATH}")
        return

    with open(JSON_PATH, 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    rows = data.get("rows", [])
    print(f"Found {len(rows)} items")

    if dry_run:
        print("\nDRY RUN MODE")
        for i, item in enumerate(rows[:3]):
            transformed = transform_inquiry_item(item)
            if transformed:
                print(f"\n   [{i+1}] {transformed['name']} / {transformed['company']}")
                print(f"       Category: {transformed['category']}")
                print(f"       Date: {transformed['createdAt']}")
        return

    db = initialize_firebase()
    collection_ref = db.collection('inquiries')
    
    success_count = 0
    for i, item in enumerate(rows):
        transformed = transform_inquiry_item(item)
        if not transformed: continue
        
        try:
            collection_ref.add(transformed)
            success_count += 1
            if (i + 1) % 10 == 0:
                print(f"   Progress: {i + 1}/{len(rows)}")
        except Exception as e:
            print(f"   Error: {e}")
            
    print(f"\nDone! Success: {success_count}")

if __name__ == "__main__":
    migrate(dry_run=False)
