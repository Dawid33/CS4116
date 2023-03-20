
const queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);

var changed = false;
var search_term = urlParams.get('search-term');
if (search_term == null) {
    urlParams.set('search-term', "");
    changed = true;
}
var search_type = urlParams.get('search-type');
if (search_type == null) {
    urlParams.set('search-type', "vacancies");
    changed = true;
}

if (changed) {
    window.location.search = urlParams;
}

let vacancies = document.getElementById("vacancies");
let organisations = document.getElementById("organisations");
let users = document.getElementById("users");
let results_pane = document.getElementById("results-pane");

function replace_results_with_api_call(url) {
    fetch(url).then((result) => {
        result.text().then((text) => {
            // if (text == "") {
            //     results_pane.innerText = "No results.";
            // } else {
                results_pane.innerHTML = text;
            // }
        });
    });
}



// replace_results_with_api_call(`http://localhost/generators/search/search_api.php?search-type=vacancies&search-term=${search_term}`);

function with_search_type(type) {
    search_type = type;
    const new_url = `/search.php?search-type=${search_type}&search-term=${search_term}`;
    window.history.pushState("", search_type, new_url);
    replace_results_with_api_call(`http://${window.location.host}/generators/search/search_api.php?search-type=${search_type}&search-term=${search_term}`);
}

let submit_button = document.getElementById('search-submit-button');
let submit_field = document.getElementById('search-field');

submit_button.addEventListener("click", (e) => {
    search_term = submit_field.value;
    replace_results_with_api_call(`http://${window.location.host}/generators/search/search_api.php?search-type=${search_type}&search-term=${search_term}`);
});

vacancies.addEventListener("click", ((e) => { with_search_type("vacancies")}));
users.addEventListener("click", ((e) => { with_search_type("users")}));
organisations.addEventListener("click", ((e) => { with_search_type("organisations")}));

