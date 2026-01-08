# -*- coding: utf-8 -*-
"""
네이버 트렌드 기반 아티클 자동 생성기
- 네이버 DataLab API로 트렌드 키워드 조회
- Gemini API로 글 자동 생성
- Firebase Firestore에 저장
"""

import os
import json
import requests
from datetime import datetime, timedelta
from pathlib import Path

# Firebase Admin SDK
import firebase_admin
from firebase_admin import credentials, firestore

# Gemini API
import google.generativeai as genai

# ============================================================
# 설정
# ============================================================

# 네이버 API 설정
NAVER_CLIENT_ID = "EvH6w6EzcnGPuxS1NbnV"
NAVER_CLIENT_SECRET = "DdcoUaQUy_"

# Firebase 서비스 계정 키 경로
FIREBASE_CRED_PATH = Path(__file__).parent / "firebase-service-account.json"

# Gemini API 키 (환경변수에서 로드)
GEMINI_API_KEY = os.environ.get("GEMINI_API_KEY", "")

# 카테고리별 트렌드 검색 키워드 그룹
TREND_KEYWORD_GROUPS = [
    {
        "name": "마케팅",
        "keywords": ["마케팅", "광고", "브랜딩", "SNS마케팅", "디지털마케팅"]
    },
    {
        "name": "기술",
        "keywords": ["AI", "인공지능", "챗GPT", "자동화", "빅데이터"]
    },
    {
        "name": "트렌드",
        "keywords": ["MZ세대", "숏폼", "릴스", "틱톡", "인플루언서"]
    },
    {
        "name": "지역",
        "keywords": ["부산", "부산관광", "부산맛집", "해운대", "광안리"]
    }
]

# ============================================================
# 네이버 DataLab API
# ============================================================

def get_naver_trend(keywords: list, category_name: str) -> dict:
    """
    네이버 DataLab 검색어 트렌드 API 호출
    
    참고: https://developers.naver.com/docs/serviceapi/datalab/search/search.md
    """
    url = "https://openapi.naver.com/v1/datalab/search"
    
    headers = {
        "X-Naver-Client-Id": NAVER_CLIENT_ID,
        "X-Naver-Client-Secret": NAVER_CLIENT_SECRET,
        "Content-Type": "application/json"
    }
    
    # 최근 1개월 데이터 조회
    end_date = datetime.now()
    start_date = end_date - timedelta(days=30)
    
    # 키워드 그룹 구성 (최대 5개)
    keyword_groups = []
    for kw in keywords[:5]:
        keyword_groups.append({
            "groupName": kw,
            "keywords": [kw]
        })
    
    body = {
        "startDate": start_date.strftime("%Y-%m-%d"),
        "endDate": end_date.strftime("%Y-%m-%d"),
        "timeUnit": "week",
        "keywordGroups": keyword_groups
    }
    
    try:
        response = requests.post(url, headers=headers, json=body)
        response.raise_for_status()
        
        data = response.json()
        
        # 가장 인기있는 키워드 찾기 (평균 ratio 기준)
        results = []
        for result in data.get("results", []):
            group_name = result.get("title", "")
            ratios = [d.get("ratio", 0) for d in result.get("data", [])]
            avg_ratio = sum(ratios) / len(ratios) if ratios else 0
            results.append({
                "keyword": group_name,
                "avgRatio": avg_ratio,
                "category": category_name
            })
        
        # 인기도순 정렬
        results.sort(key=lambda x: x["avgRatio"], reverse=True)
        return {"success": True, "data": results}
        
    except requests.exceptions.RequestException as e:
        print(f"[ERROR] 네이버 API 호출 실패: {e}")
        return {"success": False, "error": str(e)}


def get_top_trends(limit: int = 5) -> list:
    """모든 카테고리에서 상위 트렌드 키워드 추출"""
    all_trends = []
    
    for group in TREND_KEYWORD_GROUPS:
        print(f"  📊 '{group['name']}' 카테고리 트렌드 조회 중...")
        result = get_naver_trend(group["keywords"], group["name"])
        
        if result["success"] and result["data"]:
            # 각 카테고리에서 상위 1개씩
            top = result["data"][0]
            all_trends.append({
                "keyword": top["keyword"],
                "category": top["category"],
                "ratio": top["avgRatio"]
            })
            print(f"    → 상위 키워드: {top['keyword']} (인기도: {top['avgRatio']:.1f})")
    
    # 전체에서 상위 N개 반환
    return all_trends[:limit]


# ============================================================
# Firebase 초기화
# ============================================================

def init_firebase():
    """Firebase Admin SDK 초기화"""
    if not FIREBASE_CRED_PATH.exists():
        print(f"[WARNING] Firebase 서비스 계정 키 파일이 없습니다.")
        print(f"  → 웹 Admin 페이지(admin.html)를 사용하세요.")
        return None
    
    try:
        if not firebase_admin._apps:
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
        print("[INFO] GEMINI_API_KEY 없음 → 템플릿 글 사용")
        return None
    
    try:
        genai.configure(api_key=GEMINI_API_KEY)
        return genai.GenerativeModel("gemini-2.0-flash")
    except Exception as e:
        print(f"[ERROR] Gemini 초기화 실패: {e}")
        return None


def generate_article_content(model, keyword: str, category: str, ratio: float = 0) -> dict:
    """트렌드 키워드로 아티클 생성"""
    
    if model is None:
        # 템플릿 콘텐츠 생성
        return {
            "title": f"[{category}] {keyword} 트렌드 분석",
            "summary": f"'{keyword}' 키워드의 최신 트렌드와 마케팅 인사이트를 분석합니다.",
            "content": f"""## {keyword} 트렌드 분석

최근 네이버 검색 트렌드에서 **'{keyword}'** 키워드가 주목받고 있습니다.

### 📈 트렌드 현황
- 검색 인기도: {ratio:.1f}/100
- 카테고리: {category}
- 분석 기간: 최근 1개월

### 💡 마케팅 인사이트

1. **검색량 증가**: 이 키워드는 최근 검색량이 꾸준히 증가하고 있습니다.
2. **타겟 오디언스**: {category} 관련 콘텐츠에 관심있는 사용자층이 주요 타겟입니다.
3. **콘텐츠 전략**: 이 트렌드를 활용한 콘텐츠 마케팅이 효과적입니다.

### 🐝 하이브미디어의 제안

부산 지역 마케팅 전문 기업으로서, 저희는 이 트렌드를 지역 특성에 맞게 적용하여 최적의 마케팅 솔루션을 제공합니다.

**문의: hivemedia@naver.com**
""",
            "category": category,
        }
    
    # Gemini로 실제 글 생성
    prompt = f"""
당신은 부산의 마케팅 전문 기업 '하이브미디어'의 콘텐츠 작가입니다.

다음 트렌드 키워드에 대한 블로그 글을 작성해주세요:
- 키워드: {keyword}
- 카테고리: {category}
- 네이버 검색 인기도: {ratio:.1f}/100

요구사항:
1. 제목 (50자 이내, 카테고리 포함)
2. 요약 (100자 이내)
3. 본문 (마크다운 형식, 500자 내외)
4. 전문적이면서도 친근한 톤
5. 마케팅 관점의 인사이트 포함

JSON 형식으로 응답:
{{"title": "...", "summary": "...", "content": "..."}}
"""
    
    try:
        response = model.generate_content(prompt)
        text = response.text.strip()
        
        if text.startswith("```"):
            text = text.split("```")[1]
            if text.startswith("json"):
                text = text[4:]
        
        result = json.loads(text)
        result["category"] = category
        return result
    except Exception as e:
        print(f"[ERROR] Gemini 생성 실패: {e}")
        return generate_article_content(None, keyword, category, ratio)


# ============================================================
# Firebase에 저장
# ============================================================

def save_to_firestore(db, article: dict, trend_data: dict) -> str:
    """Firestore에 아티클 저장"""
    try:
        doc_ref = db.collection("articles").document()
        
        doc_data = {
            "title": article["title"],
            "summary": article.get("summary", ""),
            "content": article.get("content", ""),
            "category": article.get("category", "기타"),
            "createdAt": firestore.SERVER_TIMESTAMP,
            "source": "naver_trend",
            "trendKeyword": trend_data.get("keyword", ""),
            "trendRatio": trend_data.get("ratio", 0),
        }
        
        doc_ref.set(doc_data)
        return doc_ref.id
    except Exception as e:
        print(f"  ❌ 저장 실패: {e}")
        return None


# ============================================================
# 메인 실행
# ============================================================

def main():
    print("=" * 60)
    print("🐝 Hivemedia Archive - 네이버 트렌드 기반 글 생성기")
    print("=" * 60)
    print()
    
    # 1. 네이버 트렌드 조회
    print("[1/4] 네이버 트렌드 키워드 조회 중...")
    trends = get_top_trends(limit=4)
    
    if not trends:
        print("❌ 트렌드 데이터를 가져올 수 없습니다.")
        return
    
    print(f"\n  ✅ {len(trends)}개 트렌드 키워드 수집 완료")
    print()
    
    # 2. Firebase 초기화
    print("[2/4] Firebase 초기화 중...")
    db = init_firebase()
    
    # 3. Gemini 초기화
    print("[3/4] Gemini API 초기화 중...")
    model = init_gemini()
    
    # 4. 글 생성 및 저장
    print("[4/4] 아티클 생성 중...")
    print()
    
    generated = []
    for i, trend in enumerate(trends, 1):
        print(f"  [{i}/{len(trends)}] {trend['keyword']} ({trend['category']})")
        
        article = generate_article_content(
            model, 
            trend["keyword"], 
            trend["category"],
            trend.get("ratio", 0)
        )
        
        if db:
            doc_id = save_to_firestore(db, article, trend)
            if doc_id:
                print(f"    ✅ 저장 완료 (ID: {doc_id[:8]}...)")
                generated.append(article)
        else:
            print(f"    📝 생성됨 (Firebase 미연결)")
            generated.append(article)
    
    print()
    print("=" * 60)
    print(f"✨ 완료! 총 {len(generated)}개 아티클 생성됨")
    print("=" * 60)
    
    if db:
        print("\n👉 archive.php 페이지에서 확인하세요!")
    else:
        print("\n⚠️  Firebase 미연결 - admin.html에서 수동 생성하세요.")
    
    return generated


if __name__ == "__main__":
    main()
