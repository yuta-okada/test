<?php
if (isset($_SESSION['customer'])) {
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
        </style>';

    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th>';
    echo '<th>価格</th><th></th></tr>';

    $pdo = new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 'root', '');
    $sql = $pdo->prepare(
        'SELECT * FROM favorite
        JOIN product ON favorite.product_id = product.id
        WHERE favorite.customer_id = ?'
    );
    $sql->execute([$_SESSION['customer']['id']]);
    
    foreach ($sql as $row) {
        $id = $row['id'];
        echo '<tr>';
        echo '<td>', $id, '</td>';
        echo '<td><a href="detail.php?name=' . $row['genre'] . '">', $row['name'], '</a></td>';
        echo '<td>', $row['price'], '</td>';
        echo '<td><a class="delete-link" href="favorite-delete.php?id=', $id, '">削除</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'お気に入りを表示するには、ログインしてください。';
}
?>
