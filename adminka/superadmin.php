<?php
//include_once $_SERVER['DOCUMENT_ROOT'] .
    //'/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php';
//include_once $_SERVER['DOCUMENT_ROOT'] .
//    '/admin/index.php';
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>АдминКА</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1>ЭТО АДМИНКА ДЛЯ СУПЕРАДМИНИСТРАТОРА!</h1>
	<h3>Система Управления</h3>
    <ul>
      <li><a href="admin/">Администраторы админки</a></li>
      <li><a href="useres/">Управление клиентами</a></li>
      <li><a href="operators/">Управление операторами связи</a></li>
      <li><a href="regions/">Управление списком регионов</a></li>
      <li><a href="status/">Управление списком статусов</a></li>
      <li><a href="products/">Управление списком изделий</a></li>
      <li><a href="sexes/">Управление списком полов</a></li>
      <li><a href="materials/">Управление списком материалов</a></li>
      <li><a href="colors/">Управление списком цветов</a></li>
      <li><a href="measurements/">Управление списком ед. измерения</a></li>
      <li><a href="services/">Услуги</a></li>
      <li><a href="order/">Счета</a></li>
    </ul>
<form action="" method="post">
  <div>
    <input type="hidden" name="action" value="logout">
    <input type="hidden" name="goto" value="../index.php">
    <input type="submit" value="ВЫХОД">
  </div>
</form>	
</body>
</html>