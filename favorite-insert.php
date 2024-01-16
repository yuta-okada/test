<?php session_start(); ?>
<?php require 'menu.php'; ?>
<?php
if (isset($_SESSION['customer'])) {
    // データベースに接続
    $pdo = new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 'root', '');

    // レコードが既に存在するか確認
    $checkSql = $pdo->prepare('SELECT * FROM favorite WHERE customer_id = ? AND product_id = ?');
    $checkSql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
    $existingRecord = $checkSql->fetch();

    if (!$existingRecord) {
        // レコードが存在しない場合は挿入
        $insertSql = $pdo->prepare('INSERT INTO favorite (customer_id, product_id) VALUES (?, ?)');
        $insertSql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
        echo 'お気に入りに商品を追加しました。';
        echo '<hr>';
        require 'favorite.php';
    } else {
        // レコードが既に存在する場合のメッセージ
        echo 'お気に入りに商品は既に存在します。';
    }
} else {
    echo 'お気に入りに商品を追加するには、ログインしてください。';
}
?>
