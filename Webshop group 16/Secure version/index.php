<html>
<head>
  <title>Home</title>
</head>
<body>
  <?php
  require('connect.php');

  session_start();
  if(!isset($_SESSION["token"])) {

    $_SESSION["token"] = md5(uniqid(mt_rand(), TRUE));

  }

  if(isset($_SESSION['CurrentUser'])){

    echo 'Logged in as ' . $_SESSION['CurrentUser'];
    echo '<p><a href="logout.php?validation=' . $_SESSION["token"] . '">Click here to log out</a></p>';
    echo '<p><a href="orderhistory.php">Order history</a></p>';
    echo '<p><a href="store.php">Shop</a></p>';
    echo '<form action="index.php" method="post">
    <table>
    <tr><td colspan="2">Please leave a comment: </td></tr>
    <tr><td colspan="2"><textarea name="comment"></textarea></td></tr>
    <tr><td colspan="2"><input type="submit" name="submit" value="send" /></td></tr>
    </table>
    </form>';

  } else {

    echo '<p><a href="login.php">Click here to login</a>.</p>';
  }

  if(isset($_POST['submit'])){

    $stmt = $conn->prepare("INSERT INTO comment (name, text) VALUES (?,?)");
    $stmt->bind_param("ss",$_SESSION['CurrentUser'],$_POST['comment']);
    if ($stmt->execute() === TRUE) {
      header ("Location: index.php");

    } else {
      echo "Could not commit.";
    }
  }

  $sql = "SELECT * FROM comment ORDER BY id DESC";
  $result = $conn->query($sql);
  echo '<h2>Comment section</h2><hr>';

  while($rows = $result->fetch_assoc()){
    $cId = $rows['id'];
    $cName = $rows['name'];
    $comments = $rows['text'];
    echo '<table border="1"><tr><th>#' . $cId . ' ' . $cName . ': ' . htmlspecialchars($comments, ENT_QUOTES, 'UTF-8') . '</tr></th>' ;
  }

  ?>
</body>
</html>
