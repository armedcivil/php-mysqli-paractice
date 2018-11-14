<?php

  header("Content-Type: application/json; charset=utf-8");

  $result = array();

  $mysqli = new mysqli("mysql", $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DATABASE"]);
  if ($mysqli->connect_error) {
    exit();
  } else {
    $mysqli->set_charset("utf8");
  }

  $update_query = "update memos set memo=?, user_name=? where id=?";

  if($stmt = $mysqli->prepare($update_query)){
    $stmt->bind_param("ssi", $memo, $user_name, $id);

    $memo = $_POST["memo"];
    $user_name = $_POST["user_name"];
    $id = $_POST["id"];

    if($stmt->execute()){
      $result["result"] = "success";
      $result["id"] = $id;
      $result["memo"] = $memo;
      $result["user_name"] = $user_name;
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