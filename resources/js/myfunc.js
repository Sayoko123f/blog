const my = {
    articleCreateURL: '/api/article',
    articleIndexURL: '/api/article',
    articleUpdateURL(id) { return `/api/article/${id}` },
    articleEditURL(id) { return `/api/article/edit/${id}` },
    articleShowURL(id) { return `/api/article/${id}`; },
    articleSearchURL: '/api/article',
    csrf() {
        return document.head.querySelector("[name~=csrf-token][content]").content;
    },
    uploadImageURL: '/api/upload/image',
    imageIndexURL: '/api/image',
    imageDestroyURL(id) { return `/api/image/${id}`; },
    importScript(url) {
        return new Promise((resolve, reject) => {
            if (document.head.querySelector(`script[src~="${url}"]`)) {
                resolve();
                return;
            }
            let s = document.createElement('script');
            s.onload = () => { resolve(); };
            s.onerror = (e) => { reject(e); };
            s.src = url;
            document.head.appendChild(s);
        })
    },
    importCSS(url) {
        return new Promise((resolve, reject) => {
            if (document.head.querySelector(`link[href~="${url}"]`)) {
                resolve();
                return;
            }
            let l = document.createElement('link');
            l.onload = () => { resolve(); };
            l.onerror = (e) => { reject(e); };
            l.rel = 'stylesheet';
            l.href = url;
            document.head.appendChild(l);
        })
    },
};

window.my = my;