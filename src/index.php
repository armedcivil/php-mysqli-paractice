<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/stylesheet/index.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="/js/index.js"></script>
  </head>
  <body>
    <table rules="all">
      <thead>
        <th>ID</th>
        <th>メモ</th>
        <th>登録者名</th>
        <th>Action</th>
      </thead>
      <tbody>
        <?php 
          $mysqli = new mysqli("mysql", $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DATABASE"]);
          if ($mysqli->connect_error) {
            exit();
          } else {
            $mysqli->set_charset("utf8");
          }

          $select_query = "select id, memo, user_name from memos";

          if(isset($_POST["user_name"]) && $_POST["user_name"] != ""){
            $select_query.=" where user_name = ?";
          }

          if($stmt = $mysqli->prepare($select_query)){
            if(isset($_POST["user_name"]) && $_POST["user_name"] != ""){
              $stmt->bind_param("s", $user_name);
              $user_name = $_POST['user_name'];
            }

            $stmt->execute();

            $stmt->bind_result($id, $memo, $user_name);
            while ($stmt->fetch()) {
              echo '<tr><td>'.$id.'</td><td>'.$memo.'</td><td>'.$user_name.'</td><td><a href="/edit.php?id='.$id.'">編集</a><a href="/delete_comfirm.php?id='.$id.'">削除</a></td></tr>';
            }
            $stmt->close();
          }

          $mysqli->close();
        ?>
      </tbody>
    </table>
    <form action="/index.php" method="post">
      <label>
        検索
      </label>
      <p>
        登録者名: <input type="text" name="user_name">
      </p>
      <p>
        <input type="submit" value="検索">
      </p>
    </form>

    <form action="/api/insert.php" method="post">
      <label>
        登録
      </label>
      <p>
        メモ内容: <input id="regist_memo" type="text" name="memo">
      </p>
      <p>
        名前: <input id="regist_user_name" type="text" name="user_name">
      </p>
      <p>
        <input id="regist_submit" type="submit" value="登録">
      </p>
    </form>
  </body>
</html>
