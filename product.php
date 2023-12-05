<?php require 'menu.php'; ?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    td a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        display: block; /* Make the entire cell clickable */
        padding: 8px; /* Add padding for better clickability */
    }

    td a:hover {
        color: #0066cc;
        background-color: #f2f2f2; /* Highlight on hover */
    }
</style>
<form action="product.php" method="post">
商品検索
<input type="text" name="keyword">
<input type="submit" value="検索">
</form>
<hr>
<?php
echo '<table>';
echo '<tr><th>カテゴリー</th><th>商品名</th></tr>';
$pdo = new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 'root', '');

if (isset($_REQUEST['keyword'])) {
    $sql = $pdo->prepare('SELECT category, name, id FROM product WHERE name LIKE ?');
    $sql->execute(['%' . $_REQUEST['keyword'] . '%']);
} else {
    $sql = $pdo->query('SELECT category, name, id FROM product');
}

// カテゴリー別に商品名をグループ化
$groupedProducts = [];
foreach ($sql as $row) {
    $category = $row['category'];
    $productName = $row['name'];
    $productId = $row['id'];
    if (!isset($groupedProducts[$category][$productName])) {
        $groupedProducts[$category][$productName] = $productId;
    }
}

// グループ化された商品を表示
foreach ($groupedProducts as $category => $productNames) {
    echo '<tr>';
    echo '<td style="font-weight: bold;">', $category, '</td>';
    echo '<td>';
    foreach ($productNames as $productName => $productId) {
        echo '<a href="detail.php?id=', $productId, '">', $productName, '</a>';
    }
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>
