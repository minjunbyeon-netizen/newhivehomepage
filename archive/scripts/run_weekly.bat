@echo off
chcp 65001 > nul
echo ========================================
echo 🐝 주간 트렌드 자동 글 생성기
echo 매주 목요일 오후 3시 실행
echo ========================================

cd /d %~dp0

echo Python 스크립트 실행 중...
python weekly_auto_generator.py

echo.
echo 실행 완료!
pause
