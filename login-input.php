<!DOCTYPE html>
<html>
<head>
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>
    <form action="login_pdo.php" method="post">
        <label for="login">ログイン名:</label>
        <input type="text" name="login" id="login" required><br><br>
        
        <label for="password">パスワード:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" value="ログイン"><br>
    </form>
</body>
</html>
