<content>

<div class="row row-cols-2">
<div class="card feed-item col org-name-card">
<div class="card-header d-flex justify-content-between">
                                <h5>Name</h5> 
                                <?php
                                $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                                if ($conn->connect_error) {
                                    die("Connection failure: " . $conn->connect_error);
                                }
                        
                                $isOwner = 0;
                                $userSql = "SELECT user_id FROM organisation WHERE org_id = '" . $_GET['id'] . "';";
                                $userResult = $conn->query($userSql);

                                while($row = $userResult->fetch_assoc())
                                {
                                   if ($row["user_id"] == $current_user_id) {
                                    $isOwner = 1;
                                   }
                                 }
                                
                                $isAdmin = 0;
                                $adminSql = "SELECT is_admin FROM users WHERE user_id = '" . $current_user_id . "';";
                                $adminResult = $conn->query($adminSql);

                                while($row = $adminResult->fetch_assoc())
                                {
                                   if ($row["is_admin"] == 1) {
                                    $isAdmin = 1;
                                   }
                                 }
                                if($isOwner == 1 || $isAdmin == 1) print '<a href="edit_org_name.php" type="button" class="btn btn-submit btn-sm btn-primary">Edit</a>' 
                                ?>
                            </div>
    <div class="card-body">
        <h5 class="card-title text-center">
    <?php
$conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $sql = "SELECT name FROM organisation WHERE org_id = '" . $_GET['id'] . "';";
        $result = $conn->query($sql);

 while($row = $result->fetch_assoc())
 {
    print "{$row["name"]}";
  }
  ?>
   </h5>
</div>
</div>
<div class="card feed-item col org-description-card">
<div class="card-header d-flex justify-content-between">
                                <h5>Description</h5> 
                                <?php
                                $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                                if ($conn->connect_error) {
                                    die("Connection failure: " . $conn->connect_error);
                                }
                        
                                $isOwner = 0;
                                $userSql = "SELECT user_id FROM organisation WHERE org_id = '" . $_GET['id'] . "';";
                                $userResult = $conn->query($userSql);

                                while($row = $userResult->fetch_assoc())
                                {
                                   if ($row["user_id"] == $current_user_id) {
                                    $isOwner = 1;
                                   }
                                 }
                                
                                $isAdmin = 0;
                                $adminSql = "SELECT is_admin FROM users WHERE user_id = '" . $current_user_id . "';";
                                $adminResult = $conn->query($adminSql);

                                while($row = $adminResult->fetch_assoc())
                                {
                                   if ($row["is_admin"] == 1) {
                                    $isAdmin = 1;
                                   }
                                 }
                                if($isOwner == 1 || $isAdmin == 1) print '<a href="edit_org_description.php" type="button" class="btn btn-submit btn-sm btn-primary">Edit</a>' 
                                ?>
                            </div>
    <div class="card-body">
    <p class="card-text">
    <?php
$conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $sql = "SELECT description FROM organisation WHERE org_id = '" . $_GET['id'] . "';";
        $result = $conn->query($sql);

 while($row = $result->fetch_assoc())
 {
    print "{$row["description"]}";
}
  ?>
    </p>
    </div>
</div>

<div class="col org-vacancies-card">
    <h5>Vacancies:</h5>
</div>
    <div class="col text-center">
    <?php
                                $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                                if ($conn->connect_error) {
                                    die("Connection failure: " . $conn->connect_error);
                                }
                        
                                $isOwner = 0;
                                $userSql = "SELECT user_id FROM organisation WHERE org_id = '" . $_GET['id'] . "';";
                                $userResult = $conn->query($userSql);

                                while($row = $userResult->fetch_assoc())
                                {
                                   if ($row["user_id"] == $current_user_id) {
                                    $isOwner = 1;
                                   }
                                 }
                                
                                $isAdmin = 0;
                                $adminSql = "SELECT is_admin FROM users WHERE user_id = '" . $current_user_id . "';";
                                $adminResult = $conn->query($adminSql);

                                while($row = $adminResult->fetch_assoc())
                                {
                                   if ($row["is_admin"] == 1) {
                                    $isAdmin = 1;
                                   }
                                 }
                                if($isOwner == 1 || $isAdmin == 1) print '<a class="btn btn-primary" href="/create_vacancy.php" role="button" data-bs-toggle="button">Create vacancy</a>' 
                                ?>
</div>
</div>

 <div class="vacancies">
        <?php
$conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM vacancies WHERE org_id = '" . $_GET['id'] . "' ORDER BY creation_date";
        $result = $conn->query($sql);

 while($row = $result->fetch_assoc()) {
    $title = '<a href="/vacancy.php?id=' . $row['vacancy_id'] . '">' . $row['title'] . '</a>';
    $description = $row['description'];

    $sql = "SELECT name FROM organisation WHERE org_id = '" . $row['org_id'] . "';";

    $org_name_result = mysqli_query($conn, $sql);

                if ($org_name_result) {
                    $org_name = '<a href="/company.php?id=' . $row['vacancy_id'] . '">' . $org_name_result->fetch_assoc()['name'] . '</a>';
                    include('index/vacancy_card.php');
                }
  }
  ?>
</div>

</content>