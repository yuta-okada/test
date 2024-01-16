<?php require 'menu.php'; ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffcc;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    p {
        font-size: 18px;
        font-weight: bold;
    }

    a.logout-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #FF6347; /* 赤色 */
        color: white;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    a.logout-link:hover {
        background-color: #CC4A3C; /* ホバー時の色 */
    }
</style>

<p>ログアウトしますか？</p>
<a class="logout-link" href="logout-output.php">ログアウト</a>
