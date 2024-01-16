<?php
session_start();
require 'menu.php';

$id = $_REQUEST['id'];

if (!isset($_SESSION['product'])) {
    $_SESSION['product'] = [];
}

$_SESSION['product'][$id] = [
    'name' => $_REQUEST['name'],
    'price' => $_REQUEST['price'],
];

echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
?>
