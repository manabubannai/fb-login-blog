<?php
session_start();
session_destroy();

echo "<p>ログアウトしました。</p>";
echo "<a href='index.php'>トップページに戻る</a>";