<?php
  if(!isset($_GET["id"])){
    header("Location: /index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/stylesheet/delete_comfirm.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="/js/delete_comfirm.js"></script>
  </head>
  <body>
    <div>削除しますか？</div>
    <form action="/delete.php" method="post">
      <?php 
        $mysqli = new mysqli("mysql", $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DATABASE"]);
        if ($mysqli->connect_error) {
          exit();
        } else {
          $mysqli->set_charset("utf8");
        }

        $select_query = "select id, memo, user_name from memos where id=?";

        if($stmt = $mysqli->prepare($select_query)){
          $stmt->bind_param("s", $id);
          $id = $_GET["id"];

          $stmt->execute();

          $stmt->bind_result($id, $memo, $user_name);
          if($stmt->fetch()){
            echo '<p><label>ID:</label><span>'.$id.'</span><input name="id" type="hidden" value="'.$id.'"></p>';
            echo '<p><label>名前:</label><span>'.$user_name.'</span></p>';
            echo '<p><label>メモ:</label><div>'.$memo.'</div></p>';
          }

          $stmt->close();
        }

        $mysqli->close();
      ?>
      <input id="delete_submit" type="submit" value="削除">
      <a href="/index.php">キャンセル</a>
    </form>
  </body>
</html>
