<!DOCTYPE html>
<html>
<head>
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
    <p>
        <?php 
        // Creating a connection
        $conn = new mysqli("db", "cs4116", "cs4116", "cs4116");
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        }
        
        // Creating a database named geekdata
        $sql = "SELECT * FROM cs4116.users";
        if ($result = $conn-> query("SELECT * FROM users")) {
            echo "Returned rows are: " . $result -> num_rows . "</br>";
            // Free result set
            while($row = $result->fetch_assoc()) {
               echo $row["email"];
            } 
          }
        
        // Closing connection
        $conn->close();
        ?>
    </p>
</body>

</html>