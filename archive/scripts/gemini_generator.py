# -*- coding: utf-8 -*-
"""
Gemini API 글 생성기 (CLI용)
명령줄에서 호출하여 트렌드 키워드 기반 글 생성
"""

import sys
import os
import json

# Gemini API
try:
    import google.generativeai as genai
except ImportError:
    print(json.dumps({"error": "google-generativeai 패키지가 필요합니다"}))
    sys.exit(1)

# API 키 설정
GEMINI_API_KEY = os.environ.get("GEMINI_API_KEY", "")

# 프롬프트 템플릿 (여기서 수정 가능)
PROMPT_TEMPLATE = """당신은 부산의 마케팅 전문 기업 '하이브미디어'의 콘텐츠 작가입니다.

다음 트렌드 키워드에 대한 마케팅 인사이트 글을 작성해주세요:
- 키워드: {keyword}
- 카테고리: {category}

[작성 규칙]
1. 제목: 50자 이내, 간결하고 명확하게
2. 요약: 2줄 이내
3. 본문: 400-600자
4. 마크다운/이모지 사용 금지
5. 섹션은 대괄호로 구분 (예: [트렌드 분석])
6. 전문적이면서 친근한 톤

[필수 섹션]
- 트렌드 현황
- 마케팅 인사이트
- 하이브미디어 제안

반드시 아래 JSON 형식으로만 응답:
{{"title": "제목", "summary": "요약", "content": "본문"}}
"""

def generate_article(keyword: str, category: str) -> dict:
    """Gemini로 글 생성"""
    if not GEMINI_API_KEY:
        return {
            "error": "GEMINI_API_KEY 환경변수가 설정되지 않았습니다",
            "fallback": True,
            "title": f"[{category}] {keyword}",
            "summary": f"{keyword}에 대한 마케팅 인사이트입니다.",
            "content": f"""{keyword}

마케팅 업계에서 '{keyword}'가 주목받고 있습니다.

[트렌드 현황]
- 최근 이 키워드의 검색량이 증가하고 있습니다.
- 카테고리: {category}

[마케팅 인사이트]
1. 트렌드 분석: 최근 검색량이 급증하고 있습니다.
2. 타겟 오디언스: {category} 관심 사용자층이 주요 타겟입니다.
3. 콘텐츠 전략: 이 트렌드를 활용한 콘텐츠가 효과적입니다.

[하이브미디어 제안]
부산 지역 마케팅 전문 기업으로서 최적의 솔루션을 제공합니다.

문의: hivemedia@naver.com"""
        }
    
    try:
        genai.configure(api_key=GEMINI_API_KEY)
        model = genai.GenerativeModel("gemini-2.0-flash")
        
        prompt = PROMPT_TEMPLATE.format(keyword=keyword, category=category)
        response = model.generate_content(prompt)
        text = response.text.strip()
        
        # JSON 파싱
        if text.startswith("```"):
            text = text.split("```")[1]
            if text.startswith("json"):
                text = text[4:]
        
        result = json.loads(text.strip())
        result["success"] = True
        return result
        
    except json.JSONDecodeError as e:
        return {"error": f"JSON 파싱 실패: {str(e)}", "raw": text[:500]}
    except Exception as e:
        return {"error": f"생성 실패: {str(e)}"}


def main():
    if len(sys.argv) < 3:
        print(json.dumps({"error": "Usage: python gemini_generator.py <keyword> <category>"}))
        sys.exit(1)
    
    keyword = sys.argv[1]
    category = sys.argv[2]
    
    result = generate_article(keyword, category)
    print(json.dumps(result, ensure_ascii=False))


if __name__ == "__main__":
    main()
