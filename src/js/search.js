
let vacancies = document.getElementById("vacancies");
let organisations = document.getElementById("organisations");
let users = document.getElementById("users");
let results_pane = document.getElementById("results-pane");

function replace_results_with_api_call(url) {
    fetch(url).then((result) => {
        result.text().then((text) => {
            results_pane.innerHTML = text;
        });
    });
}



const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const search_term = urlParams.get('search-term');
replace_results_with_api_call(`http://localhost/generators/search/search_api.php?search-type=vacancies&search-term=${search_term}`);

function with_search_type(type) {
    replace_results_with_api_call(`http://localhost/generators/search/search_api.php?search-type=${type}&search-term=${search_term}`);
}

vacancies.addEventListener("click", ((e) => { with_search_type("vacancies")}));
users.addEventListener("click", ((e) => { with_search_type("users")}));
organisations.addEventListener("click", ((e) => { with_search_type("organisations")}));

