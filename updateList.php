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

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['task_name'];
    if($conn){
        $sql = "UPDATE `tasks` SET `name`='$name' WHERE id=".$id;
        $results = $conn->query($sql);
        if($results){
            header('Location: '.'index.php');        
        }
    }

}
?>    