/**
 * Portfolio Page - Firebase Firestore Integration
 * Loads portfolio data from Firestore and renders with category filtering
 */

// Import Firebase modules (using CDN)
import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js';
import { getFirestore, collection, getDocs, query, where, orderBy } from 'https://www.gstatic.com/firebasejs/10.7.0/firebase-firestore.js';

// Firebase configuration - will be loaded from firebase-config.js
let db = null;
let isFirebaseReady = false;

// Sample data for demo mode (when Firebase is not configured)
const samplePortfolioData = [
    {
        id: '1',
        title: '부산광역시 홍보 캠페인',
        description: '부산의 관광 명소와 문화를 알리는 통합 마케팅 캠페인',
        category: 'Marketing',
        thumbnail: '/hiveoffice/pboard/uploaded/thumbnail/부산광역시.png',
        client: '부산광역시',
        featured: true
    },
    {
        id: '2',
        title: '힐스테이터 선화 더 와이즈',
        description: '반응형 홈페이지 제작 및 분양 마케팅',
        category: 'Web',
        thumbnail: '/hiveoffice/pboard/uploaded/thumbnail/힐스테이터-선화-더와이즈.png',
        client: '힐스테이터',
        featured: true
    },
    {
        id: '3',
        title: '반고흐 전시회',
        description: '미디어아트 기반 몰입형 전시 기획',
        category: 'Exhibition',
        thumbnail: '/hiveoffice/pboard/uploaded/thumbnail/반고흐전.png',
        client: '하이브미디어',
        featured: true
    },
    {
        id: '4',
        title: '기업 홍보 영상',
        description: '브랜드 스토리를 담은 고퀄리티 홍보 영상 제작',
        category: 'Video',
        thumbnail: '/assets/img/portfolio_sample.jpg',
        client: '다수 기업',
        featured: false
    }
];

// Initialize Firebase
async function initFirebase() {
    try {
        // Load config
        const configScript = document.createElement('script');
        configScript.src = '/assets/js/firebase-config.js';
        document.head.appendChild(configScript);

        await new Promise(resolve => setTimeout(resolve, 100));

        if (typeof firebaseConfig !== 'undefined' && firebaseConfig.apiKey !== 'YOUR_API_KEY') {
            const app = initializeApp(firebaseConfig);
            db = getFirestore(app);
            isFirebaseReady = true;
            console.log('Firebase initialized successfully');
        } else {
            console.log('Firebase not configured - using demo mode');
            isFirebaseReady = false;
        }
    } catch (error) {
        console.error('Firebase initialization error:', error);
        isFirebaseReady = false;
    }
}

// Load portfolio data from Firestore
async function loadPortfolioFromFirestore(category = 'all') {
    if (!isFirebaseReady || !db) {
        return samplePortfolioData.filter(item =>
            category === 'all' || item.category === category
        );
    }

    try {
        const portfolioRef = collection(db, 'portfolio');
        let q;

        if (category === 'all') {
            q = query(portfolioRef, orderBy('createdAt', 'desc'));
        } else {
            q = query(portfolioRef, where('category', '==', category), orderBy('createdAt', 'desc'));
        }

        const snapshot = await getDocs(q);
        const items = [];

        snapshot.forEach(doc => {
            items.push({ id: doc.id, ...doc.data() });
        });

        return items.length > 0 ? items : samplePortfolioData;
    } catch (error) {
        console.error('Error loading portfolio:', error);
        return samplePortfolioData;
    }
}

// Render portfolio items
function renderPortfolio(items) {
    const container = document.getElementById('portfolio-grid');
    if (!container) return;

    container.innerHTML = '';

    if (items.length === 0) {
        container.innerHTML = '<p class="no-items">포트폴리오 항목이 없습니다.</p>';
        return;
    }

    items.forEach((item, index) => {
        const card = document.createElement('div');
        card.className = 'portfolio-card';
        card.setAttribute('data-aos', 'fade-up');
        card.setAttribute('data-aos-delay', (index * 100).toString());

        card.innerHTML = `
            <div class="portfolio-img">
                <img src="${item.thumbnail || '/assets/img/portfolio_placeholder.jpg'}" alt="${item.title}" onerror="this.src='/assets/img/portfolio_placeholder.jpg'">
                <div class="portfolio-overlay">
                    <span class="category-badge">${item.category}</span>
                </div>
            </div>
            <div class="portfolio-content">
                <h4>${item.title}</h4>
                <p>${item.description || ''}</p>
                ${item.client ? `<span class="client">Client: ${item.client}</span>` : ''}
            </div>
        `;

        container.appendChild(card);
    });

    // Re-initialize AOS for new elements
    if (typeof AOS !== 'undefined') {
        AOS.refresh();
    }
}

// Category filter handler
function setupCategoryFilter() {
    const filterButtons = document.querySelectorAll('.portfolio-filter button');

    filterButtons.forEach(button => {
        button.addEventListener('click', async () => {
            // Update active state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            // Load filtered data
            const category = button.getAttribute('data-category');
            const items = await loadPortfolioFromFirestore(category);
            renderPortfolio(items);
        });
    });
}

// Initialize portfolio page
async function initPortfolio() {
    await initFirebase();
    setupCategoryFilter();

    // Load initial data
    const items = await loadPortfolioFromFirestore('all');
    renderPortfolio(items);
}

// Run when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPortfolio);
} else {
    initPortfolio();
}

// Export for testing
export { loadPortfolioFromFirestore, renderPortfolio, initPortfolio };
