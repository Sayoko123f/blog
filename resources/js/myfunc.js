const my = {
    articleCreateURL: '/api/article',
    csrf() {
        return document.head.querySelector("[name~=csrf-token][content]").content;
    }
};

window.my = my;