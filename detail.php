<?php require 'menu.php'; ?>
<style>
    /* カートに追加ボタン */
    form {
        width: 300px;
        margin: 10px;
        border: 1px solid #ddd;
        padding: 10px;
        position: relative;
    }

    form input[type="submit"] {
        background-color: #3498db;
        color: #fff;
        border: 1px solid #2980b9;
        padding: 8px;
        cursor: pointer;
        width: 100%;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    form input[type="submit"]:hover {
        background-color: #2980b9;
    }

    /* お気に入りに追加ボタン */
    form p a {
        background-color: #CCFF99;
        color: #333;
        padding: 8px;
        text-decoration: none;
        display: inline-block;
        border: 1px solid #7f8c8d;
        border-radius: 5px;
        transition: background-color 0.3s;
        margin-top: 5px;
    }

    form p a:hover {
        background-color: #7f8c8d;
    }
    form img {
        width: 100%; /* 幅を100%に設定 */
        height: 200px; /* 固定の高さを設定 */
        object-fit: cover; /* アスペクト比を維持しつつ、画像が整形されるように設定 */
        margin-top: 10px; /* 上部のマージンを追加 */
    }
</style>
<?php
// データベース接続
$pdo = new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 'root', '');

// ジャンル名を取得
$genre = isset($_GET['name']) ? urldecode($_GET['name']) : '';

// ジャンル名に基づいて商品を取得
$sql = $pdo->prepare('SELECT * FROM product WHERE genre = ?');
$sql->execute([$genre]);
$products = $sql->fetchAll(PDO::FETCH_ASSOC);

// 商品が存在しない場合の処理
if (empty($products)) {
    echo '<p>商品が見つかりません。</p>';
} else {
    // 同じジャンルの商品を横に表示
    echo '<h2>', $genre, 'の商品一覧</h2>';
    echo '<div style="display: flex; flex-wrap: wrap;">'; // 横に表示するためのスタイル

    foreach ($products as $product) {
        echo '<form action="cart-insert.php" method="post">';
        echo '<div>';
        echo '<p><strong>', $product['name'], '</strong></p>';
        echo '<p><img alt="image" src="image/', $product['id'], '.jpg"></p>';
        echo '<p>カテゴリー: ', $product['category'], '</p>';
        echo '<p>価格: ', $product['price'], '</p>';
        
        echo '<input type="hidden" name="id" value="', $product['id'], '">';
        echo '<input type="hidden" name="name" value="', $product['name'], '">';
        echo '<input type="hidden" name="price" value="', $product['price'], '">';
        echo '<p><input type="submit" value="カートに追加"></p>';
        echo '</form>';
        echo '<p><a href="favorite-insert.php?id=', $product['id'], '">お気に入りに追加</a></p>';
        echo '</div>';
    }
}
?>
