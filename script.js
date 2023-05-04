document.querySelector('#reset').addEventListener('click', function(e) {
    e.preventDefault();
    location.search = '';//Azzera queryString
})