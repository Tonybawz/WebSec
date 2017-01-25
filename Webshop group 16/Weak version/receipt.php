<html>
<head>
  <title>Receipt</title>
</head>
<body>
  <?php
  session_start();
  require_once("connect.php");



  echo '<p align"center">Order completed.</p>';
  echo 'Buyer: ' . $_SESSION['CurrentUser'];
  if($_SESSION['counterBanana']>0){
    echo '<p>' . $_SESSION['counterBanana'] . 'x bananas</p>';
  }
  if($_SESSION['counterCookie']>0){
    echo '<p>' . $_SESSION['counterCookie'] . 'x cookies</p>';
  }
  echo 'Total: ' . $_SESSION['sumTotal'] . ' kr';
  echo '<p><form method="post" action="receipt.php"><input type="submit" value="Finish" name="finish"/></form></p>';


  if(isset($_POST['finish'])){
    $stmt = $conn->prepare("INSERT INTO orderhistory (name, nbrBanana, nbrCookie, sumTotal) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss",$_SESSION['CurrentUser'],$_SESSION['counterBanana'], $_SESSION['counterCookie'],$_SESSION['sumTotal'] );

    if ($stmt->execute() === TRUE) {
      $_SESSION['counterBanana']=0;
      $_SESSION['counterCookie']=0;
      header ("Location: index.php");
    } else {
      echo "Could not store order.";
    }
  }
  ?>
</body>
</head>
</html>
