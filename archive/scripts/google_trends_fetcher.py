# -*- coding: utf-8 -*-
"""
Google Trends 트렌드 키워드 조회
- pytrends 라이브러리 사용
- 해외 마케팅 사례 / 국내 기술 이슈 2개 카테고리
- JSON 형식으로 출력 (PHP에서 호출용)
"""

import json
import sys
from datetime import datetime, timedelta

try:
    from pytrends.request import TrendReq
except ImportError:
    print(json.dumps({
        "success": False,
        "error": "pytrends가 설치되지 않았습니다. pip install pytrends"
    }, ensure_ascii=False))
    sys.exit(1)


def get_trending_searches(geo='KR'):
    """
    실시간 인기 검색어 가져오기
    """
    try:
        pytrends = TrendReq(hl='ko-KR', tz=540)
        
        # 실시간 인기 검색어 (한국)
        trending = pytrends.trending_searches(pn='south_korea')
        keywords = trending[0].tolist()[:10]  # 상위 10개
        
        return {"success": True, "keywords": keywords}
    except Exception as e:
        return {"success": False, "error": str(e)}


def get_related_trends(keyword, category_name, geo='KR'):
    """
    특정 키워드의 관련 인기 검색어 가져오기
    """
    try:
        pytrends = TrendReq(hl='ko-KR', tz=540)
        
        # 최근 7일 데이터
        pytrends.build_payload([keyword], cat=0, timeframe='now 7-d', geo=geo)
        
        # 관련 검색어
        related = pytrends.related_queries()
        
        rising = []
        top = []
        
        if keyword in related and related[keyword]['rising'] is not None:
            rising = related[keyword]['rising']['query'].head(5).tolist()
        
        if keyword in related and related[keyword]['top'] is not None:
            top = related[keyword]['top']['query'].head(5).tolist()
        
        return {
            "success": True,
            "keyword": keyword,
            "category": category_name,
            "rising": rising,  # 급상승 검색어
            "top": top         # 인기 검색어
        }
    except Exception as e:
        return {"success": False, "keyword": keyword, "error": str(e)}


def get_category_trends():
    """
    2개 카테고리별 트렌드 가져오기
    """
    categories = [
        {
            "name": "해외마케팅",
            "base_keywords": ["글로벌 마케팅", "해외 광고", "브랜드 캠페인"]
        },
        {
            "name": "기술이슈", 
            "base_keywords": ["AI", "챗GPT", "딥러닝"]
        }
    ]
    
    all_trends = []
    
    try:
        pytrends = TrendReq(hl='ko-KR', tz=540, timeout=(10, 25))
        
        for category in categories:
            category_keywords = []
            
            for base_keyword in category["base_keywords"]:
                try:
                    # 키워드별 관련 검색어 조회
                    pytrends.build_payload([base_keyword], timeframe='now 7-d', geo='KR')
                    related = pytrends.related_queries()
                    
                    if base_keyword in related:
                        # 급상승 검색어
                        if related[base_keyword]['rising'] is not None:
                            rising = related[base_keyword]['rising']['query'].head(3).tolist()
                            category_keywords.extend(rising)
                        
                        # 인기 검색어
                        if related[base_keyword]['top'] is not None:
                            top_kw = related[base_keyword]['top']['query'].head(2).tolist()
                            category_keywords.extend(top_kw)
                except Exception:
                    continue
            
            # 중복 제거 후 상위 5개
            unique_keywords = list(dict.fromkeys(category_keywords))[:5]
            
            if unique_keywords:
                all_trends.append({
                    "category": category["name"],
                    "keywords": unique_keywords,
                    "topKeyword": unique_keywords[0] if unique_keywords else ""
                })
        
        # 실시간 인기 검색어도 추가
        try:
            trending = pytrends.trending_searches(pn='south_korea')
            realtime = trending[0].tolist()[:5]
            all_trends.append({
                "category": "실시간인기",
                "keywords": realtime,
                "topKeyword": realtime[0] if realtime else ""
            })
        except Exception:
            pass
        
        return {
            "success": True,
            "trends": all_trends,
            "fetchedAt": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        }
        
    except Exception as e:
        return {
            "success": False,
            "error": str(e)
        }


def main():
    """메인 실행 - JSON 출력"""
    result = get_category_trends()
    print(json.dumps(result, ensure_ascii=False, indent=2))


if __name__ == "__main__":
    main()
