# -*- coding: utf-8 -*-
"""
데모 아티클 생성기
- 임시 트렌드 데이터 사용
- Gemini API로 글 생성
- Firebase Firestore에 저장
"""

import os
import json
from datetime import datetime
from pathlib import Path

# Firebase Admin SDK
import firebase_admin
from firebase_admin import credentials, firestore

# Gemini API
import google.generativeai as genai

# ============================================================
# 설정
# ============================================================

# Firebase 서비스 계정 키 경로 (아래에서 다운로드 필요)
FIREBASE_CRED_PATH = Path(__file__).parent / "firebase-service-account.json"

# Gemini API 키
GEMINI_API_KEY = os.environ.get("GEMINI_API_KEY", "")

# 데모용 트렌드 키워드 (네이버 API 대신 사용)
DEMO_TRENDS = [
    {"keyword": "2026년 마케팅 트렌드", "category": "트렌드"},
    {"keyword": "AI 광고 자동화", "category": "기술"},
    {"keyword": "부산 관광 마케팅", "category": "지역"},
    {"keyword": "SNS 숏폼 콘텐츠", "category": "SNS"},
    {"keyword": "브랜드 스토리텔링", "category": "브랜딩"},
]

# ============================================================
# Firebase 초기화
# ============================================================

def init_firebase():
    """Firebase Admin SDK 초기화"""
    if not FIREBASE_CRED_PATH.exists():
        print(f"[ERROR] Firebase 서비스 계정 키 파일이 없습니다: {FIREBASE_CRED_PATH}")
        print("\n[안내] Firebase Console에서 서비스 계정 키를 다운로드하세요:")
        print("  1. https://console.firebase.google.com/project/hivemedia-archive/settings/serviceaccounts/adminsdk")
        print("  2. '새 비공개 키 생성' 클릭")
        print(f"  3. 다운로드한 JSON 파일을 {FIREBASE_CRED_PATH}로 저장")
        return None
    
    try:
        cred = credentials.Certificate(str(FIREBASE_CRED_PATH))
        firebase_admin.initialize_app(cred)
        return firestore.client()
    except Exception as e:
        print(f"[ERROR] Firebase 초기화 실패: {e}")
        return None


# ============================================================
# Gemini 글 생성
# ============================================================

def init_gemini():
    """Gemini API 초기화"""
    if not GEMINI_API_KEY:
        print("[WARNING] GEMINI_API_KEY 환경변수가 설정되지 않았습니다.")
        print("  → 데모 글로 대체합니다.")
        return None
    
    try:
        genai.configure(api_key=GEMINI_API_KEY)
        return genai.GenerativeModel("gemini-2.0-flash")
    except Exception as e:
        print(f"[ERROR] Gemini 초기화 실패: {e}")
        return None


def generate_article_content(model, keyword: str, category: str) -> dict:
    """트렌드 키워드로 아티클 생성"""
    
    # Gemini API가 없으면 데모 콘텐츠 반환
    if model is None:
        return {
            "title": f"[{category}] {keyword}",
            "summary": f"{keyword}에 대한 하이브미디어의 인사이트입니다.",
            "content": f"""
## {keyword}

마케팅 업계에서 '{keyword}'가 주목받고 있습니다.

### 핵심 포인트

1. **트렌드 분석**: 최근 검색량이 급증하고 있는 키워드입니다.
2. **실무 적용**: 하이브미디어는 이 트렌드를 활용한 다양한 프로젝트를 진행하고 있습니다.
3. **향후 전망**: 앞으로도 지속적인 성장이 예상됩니다.

### 하이브미디어의 제안

부산 지역 광고 전문 기업으로서, 저희는 이 트렌드를 지역 특성에 맞게 적용하여 
클라이언트에게 최적의 마케팅 솔루션을 제공합니다.

문의사항이 있으시면 언제든 연락주세요!
            """.strip(),
            "category": category,
        }
    
    # Gemini로 실제 글 생성
    prompt = f"""
당신은 부산의 마케팅 전문 기업 '하이브미디어'의 콘텐츠 작가입니다.

다음 트렌드 키워드에 대한 짧은 블로그 글을 작성해주세요:
- 키워드: {keyword}
- 카테고리: {category}

요구사항:
1. 제목 (50자 이내)
2. 요약 (100자 이내)  
3. 본문 (마크다운 형식, 500자 내외)
4. 전문적이면서도 친근한 톤

JSON 형식으로 응답해주세요:
{{"title": "...", "summary": "...", "content": "..."}}
"""
    
    try:
        response = model.generate_content(prompt)
        text = response.text.strip()
        
        # JSON 파싱 시도
        if text.startswith("```"):
            text = text.split("```")[1]
            if text.startswith("json"):
                text = text[4:]
        
        result = json.loads(text)
        result["category"] = category
        return result
    except Exception as e:
        print(f"[ERROR] Gemini 생성 실패: {e}")
        return generate_article_content(None, keyword, category)  # 폴백


# ============================================================
# Firebase에 저장
# ============================================================

def save_to_firestore(db, article: dict) -> str:
    """Firestore에 아티클 저장"""
    try:
        doc_ref = db.collection("articles").document()
        
        doc_data = {
            "title": article["title"],
            "summary": article.get("summary", ""),
            "content": article.get("content", ""),
            "category": article.get("category", "기타"),
            "createdAt": firestore.SERVER_TIMESTAMP,
            "source": "auto_generated",
            "trendKeyword": article.get("keyword", ""),
        }
        
        doc_ref.set(doc_data)
        print(f"  ✅ 저장 완료: {article['title'][:30]}... (ID: {doc_ref.id})")
        return doc_ref.id
    except Exception as e:
        print(f"  ❌ 저장 실패: {e}")
        return None


# ============================================================
# 메인 실행
# ============================================================

def main():
    print("=" * 60)
    print("🐝 Hivemedia Archive - 데모 아티클 생성기")
    print("=" * 60)
    print()
    
    # 1. Firebase 초기화
    print("[1/3] Firebase 초기화 중...")
    db = init_firebase()
    if db is None:
        print("\n⚠️  Firebase 없이 데모 모드로 실행합니다.")
        print("   (글은 생성되지만 저장되지 않습니다)\n")
    
    # 2. Gemini 초기화
    print("[2/3] Gemini API 초기화 중...")
    model = init_gemini()
    
    # 3. 트렌드별 글 생성
    print("[3/3] 아티클 생성 중...")
    print()
    
    generated = []
    for i, trend in enumerate(DEMO_TRENDS, 1):
        print(f"  [{i}/{len(DEMO_TRENDS)}] 키워드: {trend['keyword']}")
        
        article = generate_article_content(model, trend["keyword"], trend["category"])
        article["keyword"] = trend["keyword"]
        
        if db:
            doc_id = save_to_firestore(db, article)
            if doc_id:
                article["id"] = doc_id
                generated.append(article)
        else:
            print(f"    → 생성됨 (저장 안됨): {article['title'][:40]}...")
            generated.append(article)
    
    print()
    print("=" * 60)
    print(f"✨ 완료! 총 {len(generated)}개 아티클 처리됨")
    print("=" * 60)
    
    if db:
        print("\n👉 archive.php 페이지에서 확인하세요!")
    
    return generated


if __name__ == "__main__":
    main()
