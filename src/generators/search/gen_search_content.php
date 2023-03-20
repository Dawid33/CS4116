<div class="card search-options">
  <div class="card-body">
    <h5 class="card-title">Search Parameters</h5>
    <div>
      <span class="card-text"> Type: </span>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn ">
          <input type="radio" name="options" id="vacancies" autocomplete="off" checked> Vacancies
        </label>
        <label class="btn ">
          <input type="radio" name="options" id="organisations" autocomplete="off"> Organisations
        </label>
        <label class="btn ">
          <input type="radio" name="options" id="users" autocomplete="off"> Users
        </label>
      </div>
    </div>

    <div>
      <form class="d-flex" role="search" action="search.php">
        <input class="form-control me-2" id="search-field" type="search" placeholder="Search" aria-label="Search" name="search-term" value="<?php print $_GET['search-term'] ?>">
        <a class="btn btn-outline-success" id="search-submit-button">Search</a>
      </form>
    </div>
  </div>
</div>


<div id="results-pane">
  <?php
  if (!$_GET['search-term']) {
    $_GET['search-term'] = '';
  }
  if (!$_GET['search-type']) {
    $_GET['search-type'] = 'vacancies';
  }
  include("search_api.php");
  ?>
</div>