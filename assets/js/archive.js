/**
 * Archive Page - Firebase Firestore Integration
 * Loads archive/news data from Firestore
 */

// Import Firebase modules
import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js';
import { getFirestore, collection, getDocs, getDoc, doc, query, orderBy, limit, startAfter } from 'https://www.gstatic.com/firebasejs/10.7.0/firebase-firestore.js';

let db = null;
let isFirebaseReady = false;
let lastDoc = null;
const ITEMS_PER_PAGE = 9;

// Sample archive data for demo mode
const sampleArchiveData = [
    {
        id: '1',
        title: '하이브미디어, 2024 부산 광고대행사 TOP10 선정',
        content: '하이브미디어가 부산광역시 선정 2024년 우수 광고대행사 TOP10에 이름을 올렸습니다. 약 15년간 쌓아온 디지털 마케팅 노하우와 고객 만족도가 높은 평가를 받았습니다.',
        category: '공지사항',
        thumbnail: '/assets/img/archive_sample1.jpg',
        createdAt: new Date('2024-03-15'),
        author: '하이브미디어'
    },
    {
        id: '2',
        title: '신규 서비스 런칭 - AI 기반 광고 최적화 솔루션',
        content: '하이브미디어가 AI 기술을 활용한 새로운 광고 최적화 솔루션을 선보입니다. 머신러닝 기반의 타겟팅으로 광고 효율을 극대화합니다.',
        category: '뉴스',
        thumbnail: '/assets/img/archive_sample2.jpg',
        createdAt: new Date('2024-02-28'),
        author: '하이브미디어'
    },
    {
        id: '3',
        title: '2024 상반기 포트폴리오 업데이트',
        content: '2024년 상반기에 진행한 다양한 프로젝트들을 포트폴리오에 추가했습니다. 마케팅, 웹 제작, 영상 제작 분야의 최신 작업물을 확인해보세요.',
        category: '업데이트',
        thumbnail: '/assets/img/archive_sample3.jpg',
        createdAt: new Date('2024-02-15'),
        author: '하이브미디어'
    },
    {
        id: '4',
        title: '연말연시 휴무 안내',
        content: '2023년 12월 30일부터 2024년 1월 2일까지 연말연시 휴무입니다. 긴급 문의는 이메일로 부탁드립니다.',
        category: '공지사항',
        thumbnail: '/assets/img/archive_sample4.jpg',
        createdAt: new Date('2023-12-28'),
        author: '하이브미디어'
    }
];

// Initialize Firebase
async function initFirebase() {
    try {
        if (typeof firebaseConfig !== 'undefined' && firebaseConfig.apiKey !== 'YOUR_API_KEY') {
            const app = initializeApp(firebaseConfig);
            db = getFirestore(app);
            isFirebaseReady = true;
            console.log('Archive: Firebase initialized');
        } else {
            console.log('Archive: Demo mode - Firebase not configured');
            isFirebaseReady = false;
        }
    } catch (error) {
        console.error('Archive: Firebase error:', error);
        isFirebaseReady = false;
    }
}

// Load archive list from Firestore
async function loadArchiveList(loadMore = false) {
    if (!isFirebaseReady || !db) {
        return sampleArchiveData;
    }

    try {
        const archiveRef = collection(db, 'archive');
        let q;

        if (loadMore && lastDoc) {
            q = query(archiveRef, orderBy('createdAt', 'desc'), startAfter(lastDoc), limit(ITEMS_PER_PAGE));
        } else {
            q = query(archiveRef, orderBy('createdAt', 'desc'), limit(ITEMS_PER_PAGE));
        }

        const snapshot = await getDocs(q);
        const items = [];

        snapshot.forEach(doc => {
            items.push({ id: doc.id, ...doc.data() });
            lastDoc = doc;
        });

        return items.length > 0 ? items : sampleArchiveData;
    } catch (error) {
        console.error('Error loading archive:', error);
        return sampleArchiveData;
    }
}

// Load single archive item
async function loadArchiveItem(id) {
    if (!isFirebaseReady || !db) {
        return sampleArchiveData.find(item => item.id === id) || sampleArchiveData[0];
    }

    try {
        const docRef = doc(db, 'archive', id);
        const docSnap = await getDoc(docRef);

        if (docSnap.exists()) {
            return { id: docSnap.id, ...docSnap.data() };
        }
        return sampleArchiveData[0];
    } catch (error) {
        console.error('Error loading archive item:', error);
        return sampleArchiveData[0];
    }
}

// Format date
function formatDate(date) {
    if (!date) return '';
    const d = date.toDate ? date.toDate() : new Date(date);
    return d.toLocaleDateString('ko-KR', { year: 'numeric', month: 'long', day: 'numeric' });
}

// Render archive list
function renderArchiveList(items, append = false) {
    const container = document.getElementById('archive-list');
    if (!container) return;

    if (!append) {
        container.innerHTML = '';
    }

    if (items.length === 0 && !append) {
        container.innerHTML = '<p class="no-items">아카이브 항목이 없습니다.</p>';
        return;
    }

    items.forEach((item, index) => {
        const card = document.createElement('a');
        card.href = `/archive/view.html?id=${item.id}`;
        card.className = 'archive-card';
        card.setAttribute('data-aos', 'fade-up');
        card.setAttribute('data-aos-delay', (index * 100).toString());

        card.innerHTML = `
            <div class="archive-img">
                <img src="${item.thumbnail || '/assets/img/archive_placeholder.jpg'}" alt="${item.title}" onerror="this.src='/assets/img/archive_placeholder.jpg'">
            </div>
            <div class="archive-content">
                <span class="archive-category">${item.category}</span>
                <h4>${item.title}</h4>
                <p>${item.content ? item.content.substring(0, 100) + '...' : ''}</p>
                <span class="archive-date">${formatDate(item.createdAt)}</span>
            </div>
        `;

        container.appendChild(card);
    });

    if (typeof AOS !== 'undefined') {
        AOS.refresh();
    }
}

// Render single archive item
function renderArchiveItem(item) {
    const container = document.getElementById('archive-detail');
    if (!container) return;

    container.innerHTML = `
        <div class="archive-header">
            <span class="archive-category">${item.category}</span>
            <h1>${item.title}</h1>
            <div class="archive-meta">
                <span class="author">By ${item.author || '하이브미디어'}</span>
                <span class="date">${formatDate(item.createdAt)}</span>
            </div>
        </div>
        ${item.thumbnail ? `<div class="archive-hero"><img src="${item.thumbnail}" alt="${item.title}"></div>` : ''}
        <div class="archive-body">
            ${item.content || ''}
        </div>
        <div class="archive-footer">
            <a href="/archive/" class="btn-back">목록으로</a>
        </div>
    `;
}

// Initialize archive list page
async function initArchiveList() {
    await initFirebase();

    const items = await loadArchiveList();
    renderArchiveList(items);

    // Load more button
    const loadMoreBtn = document.getElementById('load-more');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', async () => {
            const moreItems = await loadArchiveList(true);
            if (moreItems.length > 0 && moreItems.length >= ITEMS_PER_PAGE) {
                renderArchiveList(moreItems, true);
            } else {
                loadMoreBtn.style.display = 'none';
            }
        });
    }
}

// Initialize archive detail page
async function initArchiveDetail() {
    await initFirebase();

    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (id) {
        const item = await loadArchiveItem(id);
        renderArchiveItem(item);
    } else {
        window.location.href = '/archive/';
    }
}

// Export functions
export { initArchiveList, initArchiveDetail, loadArchiveList, loadArchiveItem };
