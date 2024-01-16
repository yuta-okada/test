<?php
session_start();

// ここで他の必要な処理を行う（例: データベースへの書き込みなど）

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 購入確定ボタンが押された場合
    if (isset($_POST['confirm_purchase'])) {
        // ここで購入確定の処理を行う
        // 例: データベースに注文情報を保存するなど
        $pdo = new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 'root', '');
        $sql = $pdo->prepare(
            'SELECT * FROM purchase
            JOIN customer ON purchase.id = customer.id
            WHERE purchase.customer_id = ?'
        );
        $sql->execute([$_SESSION['customer']['id']]);
        // カートを空にするなどの追加の処理が必要な場合はここで行う
        unset($_SESSION['product']);
        
        // 別のファイルにリダイレクト
        header('Location: purchase_confirmation.php');
        exit();
    }

    // 商品選択へ戻るボタンが押された場合
    elseif (isset($_POST['back_to_shop'])) {
        // ここで商品選択へ戻る処理を行う
        header('Location: product.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入手続き</title>
</head>
<body>

<h2>購入手続き</h2>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        td a:hover {
            color: #007BFF;
        }

        p {
            font-size: 18px;
            font-weight: bold;
        }

        form {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
        }

        button[name="confirm_purchase"] {
            background-color: #FF6347; /* 赤色 */
            color: white;
        }

        button[name="back_to_shop"] {
            background-color: #4CAF50; /* 緑色 */
            color: white;
        }
</style>
<!-- 注文内容の表示 -->
<?php
if (!empty($_SESSION['product'])) {
    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>';
    $total = 0;
    foreach ($_SESSION['product'] as $id => $product) {
        echo '<tr>';
        echo '<td>', $id, '</td>';
        echo '<td>', $product['name'], '</td>';
        echo '<td>', $product['price'], '</td>';
        echo '</tr>';
        $total += (int)$product['price'];
    }
    echo '</table>';
    echo '<p>合計金額: ', $total, '</p>';
} else {
    echo 'カートに商品がありません。';
}
?>

<!-- フォーム -->
<form method="post" action="">
    <button type="submit" name="confirm_purchase">購入確定</button>
    <button type="submit" name="back_to_shop">商品選択へ戻る</button>
</form>

</body>
</html>
