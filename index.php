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
if(isset($_GET['submit'])){
    $task_name = $_GET['task_name'];
    $sql ="INSERT INTO `tasks`(`name`, `status`) VALUES ('$task_name','pending')";
    $results = $conn->query($sql);
}

$sql = "SELECT * FROM `tasks` WHERE 1";
$results = $conn->query($sql);

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `tasks` WHERE id=".$id;
    $results = $conn->query($sql);
    if($results){
        $conn->close();
        header('Location: '.'index.php');
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #5cb85c;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        ul li button {
            background: #d9534f;
            border: none;
            color: white;
            /* padding: 5px 10px; */
            border-radius: 4px;
            cursor: pointer;
        }
        ul li button:hover {
            background: #c9302c;
        }
        .completed{
            color: white;
            background: #4CAE4C;
            padding: 5px;
            border-radius: 6px;
        }
        .delete{ 
            color: white;
            background: red;
            padding: 5px;
            border-radius: 6px;
        }
        .delete-div{
            cursor: pointer;
            width: 60px ;
            height: 30px;
           margin-bottom: 10px;
        }
        .edit{
            color: white;
            background: skyblue;
            padding: 5px;
            border-radius: 6px;            
        }
        .edit-div{
            cursor: pointer;
            width: 40px ;
            height: 30px;
            margin-bottom: 10px;
            margin-left: 30px;
        }
        .tasks{
            width: 300px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <!-- Form for creating a task -->  
        <form method="GET" action="index.php">
            <input type="text" id="task-input" name="task_name" placeholder="Add a new task" required>
            <button type="submit" name="submit">Add</button>
        </form>
        <!-- For Task Listing Display -->  
        <ul id="todo-list">
           <?php foreach($results as $value){ ?> 
            
            <li><div class="tasks"><?php echo $value['name']; ?></div>
            <div class="edit-div">
            <a href="edit.php?id=<?php echo $value['id'] ?>"  class="edit">Edit</a>
            </div>
            <div class="delete-div">
            <a href="index.php?id=<?php echo $value['id'] ?>"  class="delete">Delete</a>
            </div>
            <?php if ($value['status']== 'pending'){ ?>
    
              <a href="markAsComplete.php?id=<?php echo $value['id'] ?>"  class="btn btn-danger">Mark As Complete</a> 
            <?php } else{ ?>
                    <p class="completed">Completed</p>  
                 <?php } ?>
        </li>
            
           <?php } ?>   
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
