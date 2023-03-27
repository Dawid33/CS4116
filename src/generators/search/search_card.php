<?php  
    $search_type = $_GET["search-type"];

    // if($search_type=="users"){
    //     session_start();
    //     $already_connected=false;
    //     $current_user_id = $_SESSION["user"];
    //     $connecting_user_id;

    //     $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");

    //     $friend_search = "SELECT * FROM connections WHERE '$current_user_id' = user_id_first";
    //     $result = mysqli_query($conn, $friend_search);
    //     $row = mysqli_fetch_array($result);

    //     while($row = $result->fetch_assoc()){
    //         print($row);
    //     }

    //     $conn->close();
        
    // }

?>

<div class="card feed-item search-card">
    <div class="card-body d-flex justify-content-between">
        <div>
            <h5 class="card-title"><?php echo $title ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $org_name ?></h6>
            <p class="card-text"><?php echo $description ?></p>
        </div>
        <?php if($search_type == "users") print "<a href='' type='button' class='btn btn-submit btn-sm btn-primary'>Add Connection</a>"; ?>

    </div>
</div>
            
