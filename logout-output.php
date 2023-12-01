<?php require 'menu.php'; ?>
<?php 
session_start(); 
if (isset($_SESSION['customer'])) {
    unset($_SESSION['customer']);
    echo 'ログアウトしました。';
} else {
    echo 'すでにログアウトしています。';
}
var_dump($_SESSION);
?>