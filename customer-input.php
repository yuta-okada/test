<!DOCTYPE html>
<html>
<head>
    <title>ユーザー登録</title>
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
<body>
    <h1>新規登録</h1>
    <form action="login_pdo.php" method="post">
        <label for="new_login">ユーザー名:</label>
        <input type="text" name="new_login" id="new_login" required><br><br>
        
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="address">住所:</label>
        <input type="text" name="address" id="address" required><br><br>

        <label for="password">パスワード:</label>
        <input type="text" name="password" id="password" required><br><br>
        
        <input type="submit" value="登録">
    </form>
</body>
</html
