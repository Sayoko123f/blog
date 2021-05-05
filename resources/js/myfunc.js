const my = {
    articleCreateURL: '/api/article',
    articleIndexURL: '/api/article',
    articleShowURL(id) { return `/api/article/${id}`; },
    csrf() {
        return document.head.querySelector("[name~=csrf-token][content]").content;
    }
};

window.my = my;