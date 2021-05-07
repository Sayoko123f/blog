const my = {
    articleCreateURL: '/api/article',
    articleIndexURL: '/api/article',
    articleUpdateURL(id) { return `/api/article/${id}` },
    articleEditURL(id) { return `/api/article/edit/${id}` },
    articleShowURL(id) { return `/api/article/${id}`; },
    csrf() {
        return document.head.querySelector("[name~=csrf-token][content]").content;
    }
};

window.my = my;