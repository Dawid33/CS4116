<content>

<div class="row">
<div class="card feed-item col">
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
<div class="card feed-item col">
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