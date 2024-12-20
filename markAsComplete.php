<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo-list_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if($conn){
        $sql = "UPDATE `tasks` SET `status`='completed' WHERE id=".$id;
        $results = $conn->query($sql);
        if($results){
            header('Location: '.'index.php');        
        }
    }
}
?>