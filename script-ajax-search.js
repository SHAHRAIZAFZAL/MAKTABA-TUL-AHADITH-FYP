document.addEventListener('DOMContentLoaded', () => {

    let searchInput = document.getElementById('hero-book-search-input');
    let resultDiv = document.getElementById('ajax-search-results');

    searchInput.addEventListener('keyup', () => {
        let searchTerm = searchInput.value;
        if (searchTerm.length == 0) {
            resultDiv.classList.add('hide');
            resultDiv.innerHTML = ""
            return;
        } else {
            resultDiv.classList.remove('hide');
            let xhr;
            if (xhr && xhr.readyState !== 4) {
                return;
            }
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resultDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.open("GET", "get-search-data.php?ajax=true&q=" + searchTerm, true);
            xhr.send();
        }
    });

    document.body.addEventListener('click', (event) => {
        if (!resultDiv.contains(event.target) && event.target !== searchInput) {
            resultDiv.classList.add('hide');
        }
    });
});