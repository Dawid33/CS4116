<head>
    <link href="css/button.css" rel="stylesheet" type="text/css">
</head>

<content>
    <?php
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }

        class Pagination
        {
            public $cur_page;
            public $total;
            public $per_page;

            function __construct($cur_page, $total, $per_page)
            {
                $this->cur_page = $cur_page;
                $this->total = $total;
                $this->per_page = $per_page;
            }

            function getTotalPage(){
                return ceil($this->total / $this->per_page);
            }

            function hasPrevPage(){
                if($this->cur_page > 1){
                    return true;
                }
                else{
                    return false;
                }
            }

            function hasNextPage(){
                if($this->cur_page < $this->getTotalPage()){
                    return true;
                }
                else{
                    return false;
                }
            }

            function offSet(){
                return ($this->cur_page - 1) * $this->per_page;
            }
        }

        $query = "SELECT COUNT(*) FROM vacancies;";
        if ($_GET['recommended']) {
            $query = "SELECT COUNT(*) FROM vacancies 
            WHERE vacancy_id IN (SELECT a.vacancy_id FROM vacancy_skills a
                WHERE a.skill_id IN (SELECT skill_id FROM user_skills WHERE user_id = '$current_user_id'))	
            LIMIT 0, 5;";
        }

        $row_count_result = mysqli_query($conn, $query);
        
        $total = intval($row_count_result->fetch_assoc()["COUNT(*)"]);

        $per_page = 5;
        if ($_GET['page']) {
            $cur_page = $_GET['page'];
        } else {
            $cur_page = 1;    
        }
        

        $pagination = new Pagination($cur_page, $total, $per_page);
        $offset = $pagination->offSet();
    
        $query = "SELECT org_id, vacancy_id, title, creation_date, description FROM vacancies LIMIT $offset, $per_page";
        $recommended = false;
        if ($_GET['recommended']) {
            $recommended = true;
            $query = "SELECT org_id, vacancy_id, title, creation_date, description FROM vacancies 
            WHERE vacancy_id IN (SELECT a.vacancy_id FROM vacancy_skills a
                WHERE a.skill_id IN (SELECT skill_id FROM user_skills WHERE user_id = '$current_user_id'))	
            LIMIT 0, 5;";
        } else {
            $query = "SELECT org_id, vacancy_id, title, creation_date, description FROM vacancies LIMIT $offset, $per_page";
        }

        $result = mysqli_query($conn, $query);

        $failed = false;
        ?>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                    <?php 
                    ?>
                <h5>Vacancies </h5>
                <div>
                    <a class="mb-1 btn btn-sm btn-<?php if ($recommended) {print "outline-";} ?>primary" href="/index.php" name="options-outlined" autocomplete="off">Default</a>
                    <a class="mb-1 btn btn-sm btn-<?php if (!$recommended) {print "outline-";} ?>primary" href="/index.php?recommended=true" name="options-outlined" autocomplete="off">Recommended</a>
                </div>
            </div>
            <div class="card-body">
                <?php
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $title = '<a href="/vacancy.php?id=' . $row['vacancy_id'] . '">' . $row['title'] . '</a>';
                            $description = $row['description'];

                            $sql = "SELECT name, user_id FROM organisation WHERE org_id = '" . $row['org_id'] . "';";
                            $org_name_result = mysqli_query($conn, $sql);

                            if ($org_name_result) {
                                $org_name = '<a href="/company.php?id=' . $row['org_id'] . '">' . $org_name_result->fetch_assoc()['name'] . '</a>';
                                include('vacancy_card.php');
                            } else {
                                $failed = true;
                                break;
                            }
                        }
                    } else {
                        $failed = true;
                    }

                    if ($failed) {
                        echo "<div class='alert alert-danger'>Cannot fetch vacancies</div>";
                    }
                ?>
            </div>
        </div>

    <div id="page-button-container">
        <?php
            if ($cur_page > 1) {
                if ($recommended) {
                    print "<a href=/index.php?recommended=true&page=" . ($cur_page - 1) . "> Previous </a></span>";
                } else {
                    print "<a href=/index.php?page=" . ($cur_page - 1) . "> Previous </a></span>";
                }
            }
            print "<p> {$cur_page} </p>";

            if ($pagination->hasNextPage()) {
                if ($recommended) {
                    print "<a href=/index.php?recommended=true&page=" . ($cur_page + 1) . "> Next </a>";
                } else {
                    print "<a href=/index.php?page=" . ($cur_page + 1) . "> Next </a>";
                }
            }
        ?>
    </div>
</content>

<div id="nav-friends">
    <div class="card">
        <div class="card-header">
            <h5>Friends<h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <?php
                    $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failure: " . $conn->connect_error);
                    }
            
                    $sql = "SELECT user_id_second FROM connections WHERE user_id_first = '" . $current_user_id . "';";
                    $result = mysqli_query($conn, $sql);
                    $friend_count = 0;
                    if ($result) {
                        if (mysqli_num_rows($result) == 0) {
                            echo '<li class="list-group-item d-flex justify-content-between align-items-center">You have no friends :(</li>';
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                if ($friend_count >= 5) {
                                    $friend_name = '<a href="/user.php?id=' . $current_user_id . '"> ... </a>';
                                    include('friend.php');
                                    break;
                                }

                                $friend_count += 1;
                                $sql = "SELECT first_name, last_name FROM users WHERE user_id = '" . $row['user_id_second'] . "';";
                                $friend_name_result = mysqli_query($conn, $sql);
                
                                if ($friend_name_result) {
                                    $friend_row = $friend_name_result->fetch_assoc();
                                    $friend_name = '<a href="/user.php?id=' . $row['user_id_second'] . '">' . $friend_row['first_name'] . " " . $friend_row['last_name'] . '</a>';
                                    include('friend.php');
                                } else {
                                    echo "<div class='alert alert-danger'>Cannot fetch vacancies</div>";
                                }
                            }
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
