<!DOCTYPE html>
<html>
<head>
    <link href="css/index.css" rel="stylesheet">
</head>

<body>
    <p>
        <?php 
        // Server name must be localhost
        $servername = "localhost";
        
        // In my case, user name will be root
        $username = "cs4116";
        
        // Password is empty
        $password = "cs4116";
        
        // Creating a connection
        $conn = new mysqli("mysql", $username, $password);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failure: " . $conn->connect_error);
        } 
        
        // Creating a database named geekdata
        $sql = "SELECT * FROM app.users";
        if ($conn->query($sql) === TRUE) {
            echo $conn;
        } else {
            echo "Error: " . $conn->error;
        }
        
        // Closing connection
        $conn->close();
        ?>
    </p>
</body>

</html>