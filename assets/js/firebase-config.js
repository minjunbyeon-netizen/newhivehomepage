const firebaseConfig = {
    apiKey: "AIzaSyBeZGgTw8zJoYz26PUfk3xoU-83oMD3v_M",
    authDomain: "hivemedia-archive.firebaseapp.com",
    projectId: "hivemedia-archive",
    storageBucket: "hivemedia-archive.firebasestorage.app",
    messagingSenderId: "105246116532",
    appId: "1:105246116532:web:18aad82490a11b7d4ea5e1"
};

const isFirebaseConfigured = firebaseConfig.apiKey !== "YOUR_API_KEY";

// Export for module usage or global accessibility
if (typeof window !== 'undefined') {
    window.firebaseConfig = firebaseConfig;
    window.isFirebaseConfigured = isFirebaseConfigured;
}

if (typeof module !== 'undefined' && module.exports) {
    module.exports = { firebaseConfig, isFirebaseConfigured };
}
