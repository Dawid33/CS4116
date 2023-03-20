<div class="card search-options">
  <div class="card-body">
    <h5 class="card-title">Search Parameters</h5>
    <div>
      <span class="card-text"> Type: </span>
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn ">
          <input type="radio" name="options" id="vacancies" autocomplete="off" <?php if ($_GET['search-type'] === 'vacancies') { echo "checked"; } ?>> Vacancies
        </label>
        <label class="btn ">
          <input type="radio" name="options" id="organisations" autocomplete="off" <?php if ($_GET['search-type'] === 'organisations') { echo "checked"; } ?>> Organisations
        </label>
        <label class="btn ">
          <input type="radio" name="options" id="users" autocomplete="off" <?php if ($_GET['search-type'] === 'users') { echo "checked"; } ?>> Users
        </label>
      </div>
    </div>
    <div id=checkbox-container>
      <?php
      $user_id = $_GET["id"];
      $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

      if ($conn->connect_error) {
        die("Connection failure: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM skills";
      $skills = mysqli_query($conn, $sql);

      if ($skills == false) {
        echo "Database error.";
      } else {
        while ($skill = $skills->fetch_assoc()) {
          echo "<div class=checkbox-item><input type=\"checkbox\" name=\"skill_id\" value=\"" . $skill['skill_id'] . "\"> " . $skill['title'] . "</input></div>";
        }
      }
      ?>
    </div>
    <div id="search-bar-container">
      <input class="form-control me-2" id="search-field" type="search" placeholder="Search" aria-label="Search" name="search-term" value="<?php print $_GET['search-term'] ?>">
      <a class="btn btn-outline-success" id="search-submit-button">Search</a>
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