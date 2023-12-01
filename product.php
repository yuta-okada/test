<?php require 'menu.php'; ?>
<form action="product.php" method="post">
商品検索
<input type="text" name="keyword">
<input type="submit" value="検索">
</form>
<hr>
<?php
echo '<table>';
echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>カテゴリー</th><th>サイズ</th></th>カラー</th><th>在庫</th></tr>';
$pdo=new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 
    'root', '');
if (isset($_REQUEST['keyword'])) {
    $sql=$pdo->prepare('select * from product where name like ?');
    $sql->execute(['%'.$_REQUEST['keyword'].'%']);
} else {
    $sql=$pdo->query('select * from product');
}
foreach ($sql as $row) {
    $id=$row['id'];
    echo '<tr>';
    echo '<td>', $id, '</td>';
    echo '<td>';
    echo '<a href="detail.php?id=', $id, '">', $row['name'], '</a>';
    echo '</td>';
    echo '<td>', $row['price'], '</td>';
    echo '</tr>';
}
echo '</table>';
?>