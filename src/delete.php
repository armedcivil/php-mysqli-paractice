<?php
  if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])){    
    $mysqli = new mysqli("mysql", $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DATABASE"]);
    if ($mysqli->connect_error) {
      exit();
    } else {
      $mysqli->set_charset("utf8");
    }

    $delete_query = "delete from memos where id = ?";

    if($stmt = $mysqli->prepare($delete_query)){
      $stmt->bind_param("i", $id);
      $id = $_POST["id"];
      $stmt->execute();
    }
  }
  header("Location: /index.php");
?>