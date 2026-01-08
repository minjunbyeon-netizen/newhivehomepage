# -*- coding: utf-8 -*-
"""
주간 트렌드 자동 글 생성기
- 매주 목요일 오후 3시 실행 (Windows Task Scheduler)
- 일주일간 트렌드 키워드 5개 조회
- AI 글 생성 후 Firebase 저장
"""

import os
import json
import requests
from datetime import datetime, timedelta
from pathlib import Path

# Firebase Admin SDK
import firebase_admin
from firebase_admin import credentials, firestore

# ============================================================
# 설정
# ============================================================

# 네이버 API
NAVER_CLIENT_ID = "EvH6w6EzcnGPuxS1NbnV"
NAVER_CLIENT_SECRET = "DdcoUaQUy_"

# Firebase 서비스 계정 키 경로
FIREBASE_CRED_PATH = Path(__file__).parent / "firebase-service-account.json"

# 생성할 글 개수
ARTICLE_COUNT = 5

# 검색 카테고리별 키워드 (5개 카테고리에서 각 1개씩 = 5개 글)
TREND_CATEGORIES = [
    {"name": "마케팅", "keywords": ["마케팅", "광고", "브랜딩", "SNS마케팅"]},
    {"name": "기술", "keywords": ["AI", "인공지능", "챗GPT", "자동화"]},
    {"name": "트렌드", "keywords": ["MZ세대", "숏폼", "릴스", "인플루언서"]},
    {"name": "지역", "keywords": ["부산", "부산관광", "부산맛집", "해운대"]},
    {"name": "SNS", "keywords": ["인스타그램", "틱톡", "유튜브", "숏츠"]},
]

# ============================================================
# 로깅
# ============================================================

LOG_FILE = Path(__file__).parent / "weekly_log.txt"

def log(message: str):
    """로그 메시지 출력 및 파일 저장"""
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    log_msg = f"[{timestamp}] {message}"
    print(log_msg)
    
    with open(LOG_FILE, "a", encoding="utf-8") as f:
        f.write(log_msg + "\n")


# ============================================================
# 네이버 DataLab API
# ============================================================

def get_weekly_trend(keywords: list, category_name: str) -> dict:
    """일주일간 네이버 검색 트렌드 조회"""
    url = "https://openapi.naver.com/v1/datalab/search"
    
    headers = {
        "X-Naver-Client-Id": NAVER_CLIENT_ID,
        "X-Naver-Client-Secret": NAVER_CLIENT_SECRET,
        "Content-Type": "application/json"
    }
    
    # 최근 1주일 데이터 조회
    end_date = datetime.now()
    start_date = end_date - timedelta(days=7)
    
    keyword_groups = [{"groupName": kw, "keywords": [kw]} for kw in keywords[:5]]
    
    body = {
        "startDate": start_date.strftime("%Y-%m-%d"),
        "endDate": end_date.strftime("%Y-%m-%d"),
        "timeUnit": "date",
        "keywordGroups": keyword_groups
    }
    
    try:
        response = requests.post(url, headers=headers, json=body)
        response.raise_for_status()
        data = response.json()
        
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
        
        results.sort(key=lambda x: x["avgRatio"], reverse=True)
        return {"success": True, "data": results}
        
    except Exception as e:
        log(f"[ERROR] 네이버 API 실패 ({category_name}): {e}")
        return {"success": False, "error": str(e)}


def get_top_5_trends() -> list:
    """5개 카테고리에서 각 1개씩 상위 트렌드 추출"""
    all_trends = []
    
    for category in TREND_CATEGORIES:
        log(f"  📊 '{category['name']}' 카테고리 조회 중...")
        result = get_weekly_trend(category["keywords"], category["name"])
        
        if result["success"] and result["data"]:
            top = result["data"][0]
            all_trends.append({
                "keyword": top["keyword"],
                "category": top["category"],
                "ratio": top["avgRatio"]
            })
            log(f"    → {top['keyword']} (인기도: {top['avgRatio']:.1f})")
    
    return all_trends[:ARTICLE_COUNT]


# ============================================================
# Firebase
# ============================================================

def init_firebase():
    """Firebase 초기화"""
    if not FIREBASE_CRED_PATH.exists():
        log(f"[ERROR] Firebase 키 파일 없음: {FIREBASE_CRED_PATH}")
        return None
    
    try:
        if not firebase_admin._apps:
            cred = credentials.Certificate(str(FIREBASE_CRED_PATH))
            firebase_admin.initialize_app(cred)
        return firestore.client()
    except Exception as e:
        log(f"[ERROR] Firebase 초기화 실패: {e}")
        return None


def save_article(db, trend: dict) -> bool:
    """Firestore에 글 저장"""
    try:
        keyword = trend["keyword"]
        category = trend["category"]
        ratio = trend.get("ratio", 0)
        
        article = {
            "title": f"[{category}] {keyword} - 주간 트렌드 분석",
            "summary": f"이번 주 '{keyword}' 키워드의 검색 트렌드와 마케팅 인사이트입니다.",
            "content": f"""## {keyword} 주간 트렌드 분석

이번 주 네이버 검색 트렌드에서 **'{keyword}'** 키워드가 주목받고 있습니다.

### 📈 트렌드 현황
- 검색 인기도: {ratio:.1f}/100
- 카테고리: {category}
- 분석 기간: 최근 7일

### 💡 마케팅 인사이트

1. **주간 검색량**: 이 키워드는 지난 일주일간 높은 검색량을 기록했습니다.
2. **타겟 오디언스**: {category} 관련 콘텐츠에 관심있는 사용자층이 주요 타겟입니다.
3. **콘텐츠 전략**: 이 트렌드를 활용한 콘텐츠 마케팅이 효과적입니다.

### 🐝 하이브미디어의 제안

부산 지역 마케팅 전문 기업 하이브미디어는 이 트렌드를 지역 특성에 맞게 적용하여 클라이언트에게 최적의 마케팅 솔루션을 제공합니다.

**문의: hivemedia@naver.com**
""",
            "category": category,
            "trendKeyword": keyword,
            "trendRatio": ratio,
            "source": "weekly_auto",
            "createdAt": firestore.SERVER_TIMESTAMP
        }
        
        db.collection("articles").add(article)
        return True
    except Exception as e:
        log(f"[ERROR] 저장 실패: {e}")
        return False


# ============================================================
# 메인 실행
# ============================================================

def main():
    log("=" * 60)
    log("🐝 주간 트렌드 자동 글 생성기 시작")
    log("=" * 60)
    
    # 1. 트렌드 조회
    log("[1/3] 네이버 주간 트렌드 조회 중...")
    trends = get_top_5_trends()
    
    if not trends:
        log("❌ 트렌드 조회 실패 - 종료")
        return
    
    log(f"✅ {len(trends)}개 트렌드 키워드 수집 완료")
    
    # 2. Firebase 초기화
    log("[2/3] Firebase 연결 중...")
    db = init_firebase()
    
    if not db:
        log("❌ Firebase 연결 실패 - 종료")
        return
    
    # 3. 글 생성 및 저장
    log("[3/3] 글 생성 및 저장 중...")
    success_count = 0
    
    for trend in trends:
        if save_article(db, trend):
            log(f"  ✅ 저장: [{trend['category']}] {trend['keyword']}")
            success_count += 1
        else:
            log(f"  ❌ 실패: {trend['keyword']}")
    
    log("=" * 60)
    log(f"✨ 완료! {success_count}/{len(trends)}개 글 저장됨")
    log("=" * 60)


if __name__ == "__main__":
    main()
