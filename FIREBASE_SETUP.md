# Firebase 서비스 계정 키 설정 가이드

## 단계별 안내

### 1. Firebase Console 접속
1. 브라우저에서 https://console.firebase.google.com 접속
2. `hivemedia-archive` 프로젝트 선택

### 2. 서비스 계정 키 생성
1. 좌측 메뉴에서 **⚙️ 프로젝트 설정** 클릭
2. **서비스 계정** 탭 선택
3. 페이지 하단의 **새 비공개 키 생성** 버튼 클릭
4. 확인 대화상자에서 **키 생성** 클릭
5. JSON 파일이 자동으로 다운로드됩니다

### 3. 파일 이름 변경 및 배치
1. 다운로드된 파일(예: `hivemedia-archive-xxxxx.json`)을 찾습니다
2. 파일 이름을 정확히 `firebase-service-account.json` 으로 변경
3. 이 파일을 다음 경로에 복사합니다:
   ```
   c:\xampp\htdocs\01_work\hivemedia_homepage\firebase-service-account.json
   ```

### 4. 보안 주의사항
⚠️ **중요**: 이 파일은 절대 Git 저장소에 커밋하지 마세요!
- 이미 `.gitignore`에 추가되어 있습니다
- 이 파일은 Firebase에 대한 전체 관리자 권한을 제공합니다

### 완료 후
파일을 배치한 후, 다음 명령어로 확인할 수 있습니다:
```powershell
Test-Path "c:\xampp\htdocs\01_work\hivemedia_homepage\firebase-service-account.json"
```

결과가 `True`가 나오면 정상적으로 설정된 것입니다.
