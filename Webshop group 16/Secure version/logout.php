<?php
session_start();

if (isset($_GET["validation"]) && $_GET["validation"] == $_SESSION["token"]) {
  session_unset();
  session_destroy();
}
header("Location: index.php");
?>
