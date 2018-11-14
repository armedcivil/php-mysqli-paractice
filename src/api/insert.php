<?php

  header("Content-Type: application/json; charset=utf-8");

  $result = array();

  $result["memo"] = $_POST["memo"];
  $result["user_name"] = $_POST["user_name"];

  $mysqli = new mysqli("mysql", $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DATABASE"]);
  if ($mysqli->connect_error) {
    exit();
  } else {
    $mysqli->set_charset("utf8");
  }

  $insert_query = "insert into memos set memo=?, user_name=?;";

  if($stmt = $mysqli->prepare($insert_query)){
    $stmt->bind_param("ss", $memo, $user_name);

    $memo = $_POST["memo"];
    $user_name = $_POST["user_name"];

    if($stmt->execute()){
      $result["result"] = "success";
      $result["id"] = $mysqli->insert_id;
    } else {
      $result["result"] = "failure";
    }

    $stmt->close();
  } else {
    $result["result"] = "failure";
  }

  print(json_encode($result)."\n");
  $mysqli->close();

?>