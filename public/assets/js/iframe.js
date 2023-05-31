function ready(fn) {
    if (document.readyState !== 'loading') {
        fn();
        return;
    }
    document.addEventListener('DOMContentLoaded', fn);
}

ready(function () {
    let iframe = document.getElementById('displayMail');
    let editMail = document.getElementById('editMail');
    
    iframe.onload = function(){
        let height = iframe.contentWindow.document.body.scrollHeight + 'px';
        iframe.style.height = height;
        editMail.style.height = height;
    }
});