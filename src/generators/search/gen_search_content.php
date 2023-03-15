
<h2> Results </h2>

<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="vacancies" autocomplete="off" checked> Vacancies
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="organisations" autocomplete="off"> Organisations
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="options" id="users" autocomplete="off"> Users
  </label>
  <form class="d-flex" role="search" action="search.php" >
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search-term" value="<?php print $_GET['search-term'] ?>">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>
</div>

<div id="results-pane">
</div>