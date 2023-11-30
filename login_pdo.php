<?php
// データベース接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=clothes;charset=utf8', 'root', '');

    if (isset($_POST['login']) && isset($_POST['password'])) {
        // ログイン処理
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        $params = [
            ':login' => $login,
            ':password' => $password
        ];
        
        $sql = $pdo->prepare('SELECT * FROM customer WHERE login = :login AND password = :password');
        $sql->execute($params);
               
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            // 認証成功
            session_start();
            $_SESSION['customer'] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'address' => $row['address'],
                'login' => $row['login'],
                'password' => $row['password']
            ];
            echo 'いらっしゃいませ、', $_SESSION['customer']['name'], 'さん。';
            echo '<br>';
            echo '<a href="product.php">商品一覧へ</a>';
        } else {
            // ログイン失敗
            echo 'ログイン名またはパスワードが違います。';
        }
    }

    if (isset($_POST['new_login']) && isset($_POST['name']) && isset($_POST['address'])) {
        // ユーザー登録処理
        $new_login = $_POST['new_login'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        
        // ログイン名の重複チェック
        $checkSql = $pdo->prepare('SELECT COUNT(*) FROM customer WHERE login = :new_login');
        $checkSql->bindParam(':new_login', $new_login, PDO::PARAM_STR);
        $checkSql->execute();
        
        if ($checkSql->fetchColumn() > 0) {
            // 重複がある場合、エラーメッセージを表示
            echo 'ログイン名がすでに使用されていますので、変更してください。';
        } else {
            // ユーザーをデータベースに追加
            $insertSql = $pdo->prepare('INSERT INTO customer (id, login, name, address) VALUES (NULL, :new_login, :name, :address)');
            $insertSql->bindParam(':new_login', $new_login, PDO::PARAM_STR);
            $insertSql->bindParam(':name', $name, PDO::PARAM_STR);
            $insertSql->bindParam(':address', $address, PDO::PARAM_STR);
            
            if ($insertSql->execute()) {
                // 登録が成功した場合、成功メッセージを表示
                echo 'ログインID、名前、住所を登録完了しました。';
            } else {
                // 登録に失敗した場合のエラーメッセージ
                echo 'ユーザーの登録に失敗しました。';
            }
        }
    }
} catch (PDOException $e) {
    // データベースエラーの場合のエラーメッセージ
    echo 'データベースエラー: ' . $e->getMessage();
}
?>
