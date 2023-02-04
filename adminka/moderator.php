<?php
//include_once $_SERVER['DOCUMENT_ROOT'] .
    //'/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] .
//    '/admin/index.php';
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>АдминКА</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1>ЭТО АДМИНКА ДЛЯ МОДЕРАТОРА!</h1>
	<h3>Система Управления</h3>
    <ul>
      <li><a href="order/">Счета</a></li>
    </ul>	
<form action="" method="post">
  <div>
    <input type="hidden" name="action" value="logout">
    <input type="hidden" name="goto" value="../admin.php">
    <input type="submit" value="ВЫХОД">
  </div>
</form>	
</body>
</html>