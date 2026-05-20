var staticCacheName = "pwa-v" + new Date().getTime();
var appBasePath = self.location.pathname.replace(/\/serviceworker\.js$/, '');
if (!appBasePath) {
    appBasePath = '';
}

function withBase(path) {
    return appBasePath + path;
}

var filesToCache = [
    withBase('/offline/'),
    withBase('/css/app.css'),
    withBase('/js/app.js'),
    withBase('/images/icons/icon-72x72.png'),
    withBase('/images/icons/icon-96x96.png'),
    withBase('/images/icons/icon-144x144.png')
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return Promise.all(
                    filesToCache.map(file => cache.add(file).catch(() => null))
                );
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match(withBase('/offline/'));
            })
    )
});
