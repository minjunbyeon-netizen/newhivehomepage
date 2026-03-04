const https = require('https');
https.get('https://darkorchid-walrus-208793.hostingersite.com/assets/css/dark-theme.css?v=' + Date.now(), (res) => {
    let data = '';
    res.on('data', (chunk) => { data += chunk; });
    res.on('end', () => {
        console.log('--- dark-theme.css check ---');
        console.log('.om-working-items p contains #979797: ' + data.includes('.om-working-items p {\\n    color: #979797 !important;\\n}'));
        console.log('Any #979797 in file: ' + data.includes('#979797'));
    });
});
https.get('https://darkorchid-walrus-208793.hostingersite.com/index.html?v=' + Date.now(), (res) => {
    let data = '';
    res.on('data', (chunk) => { data += chunk; });
    res.on('end', () => {
        console.log('--- index.html check ---');
        console.log('무료 상담 신청 button contains #0084ff: ' + data.includes('background: #0084ff; color: #000; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px; transition: all 0.3s;">무료'));
    });
});
