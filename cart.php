<?php
if (!empty($_SESSION['product'])) {
    echo '<style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            a {
                text-decoration: none;
                color: #0066cc;
                font-weight: bold;
            }

            a:hover {
                text-decoration: underline;
            }

            .delete-link {
                color: #cc0000;
            }

            .delete-link:hover {
                text-decoration: underline;
            }

            .total {
                margin-top: 10px;
                font-weight: bold;
            }

            .button-container {
                margin-top: 20px;
            }

            .shop-button, .checkout-button {
                padding: 10px 20px;
                border: none;
                color: white;
                cursor: pointer;
            }

            .shop-button {
                background-color: #4CAF50; /* 緑色 */
            }

            .checkout-button {
                background-color: #008CBA; /* 青色 */
            }
          </style>';

    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th>';
    echo '<th>価格</th><th></th></tr>';
    $total = 0;
    foreach ($_SESSION['product'] as $id => $product) {
        echo '<tr>';
        echo '<td>', $id, '</td>';
        echo '<td>', $product['name'], '</td>';
        echo '<td>', $product['price'], '</td>';
        $subtotal = $product['price'];
        $total += (int)$subtotal;
        echo '<td><a class="delete-link" href="cart-delete.php?id=', $id, '">削除</a></td>';
        echo '</tr>';
    }
    echo '</table>';

    // 合計金額の表示
    echo '<p class="total">合計金額: ', $total, '</p>';

    // ボタンの配置
    echo '<div class="button-container">
            <button onclick="location.href=\'product.php\'" class="shop-button">お買い物を続ける</button>
            <button onclick="location.href=\'checkout.php\'" class="checkout-button">購入手続きへ</button>
          </div>';
} else {
    echo 'カートに商品がありません。';
}
?>
