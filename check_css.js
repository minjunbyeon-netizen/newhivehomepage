const https = require('https');
https.get('https://darkorchid-walrus-208793.hostingersite.com/assets/css/dark-theme.css?v=' + Date.now(), (res) => {
    let data = '';
    res.on('data', (chunk) => { data += chunk; });
    res.on('end', () => {
        console.log('--- dark-theme.css grep ---');
        const lines = data.split('\n');
        lines.forEach((line, i) => {
            if (line.includes('om-text-box') || line.includes('om-title') || line.includes('#979797') || line.includes('om-zone p')) {
                console.log(`[${i + 1}] ${line.trim()}`);
            }
        });
    });
});
