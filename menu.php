<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #ffffcc; /* Set a light yellow background for the entire body */
        }

        nav {
            background-color: #ffffcc; /* Set a light yellow background for the navigation bar */
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            color: #333333;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 10px;
            display: inline-block;
            border-radius: 5px;
            transition: background-color 0.3s;
            background-color: #ffffcc; /* Set a light yellow background for each link */
            font-weight: bold; /* Set font weight to bold */
        }

        nav a:hover {
            background-color: #ddd;
            color: #000;
        }
    </style>
</head>
<body>
    <nav>
        <a href="product.php">商品</a>
        <a href="favorite-show.php">お気に入り</a>
        <a href="history.php">購入履歴</a>
        <a href="cart-show.php">カート</a>
        <a href="checkout.php">購入</a>
        <a href="login-input.php">ログイン</a>
        <a href="logout-input.php">ログアウト</a>
        <a href="customer-input.php">会員登録</a>
    </nav>
    <hr>
</body>
</html>
