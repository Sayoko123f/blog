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
};

window.my = my;