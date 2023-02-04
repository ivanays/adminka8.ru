<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';
	
if (isset($_POST['action']) and $_POST['action'] == 'new')
{
		
  $uid = '';
  $phone = '';
  $number = '8';
  $number1 = '';
  $number2 = ''; 
  $number3 = '';
  $number4 = '';
  $password = '';
  $surname = '';
  $firstname = '';
  $middle_name = '';


  $operators = array();
  $regions = array();
  $status =array();


  $trashes =array();
  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
  $selected_trash = '';
  $select_operator = '';
  $select_region = '';
  $select_status = '';
	
	
	if (isset($_POST['number1']) && $_POST['number1'] != '' && is_numeric($_POST['number1']) && isset($_POST['number2']) && $_POST['number2'] != '' && is_numeric($_POST['number2']) && isset($_POST['number3']) && $_POST['number3'] != '' && is_numeric($_POST['number3']) && isset($_POST['number4']) && $_POST['number4'] != '' && is_numeric($_POST['number4']))
    {
	  
	$number = '8';
    $number1 = $_POST['number1'] ?? false;
	$number2 = $_POST['number2'] ?? false;
	$number3 = $_POST['number3'] ?? false;
	$number4 = $_POST['number4'] ?? false;
	  	  
	$phone = $number . $number1 .  $number2 . $number3 . $number4 ;
			
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'SELECT COUNT(*)  FROM useres WHERE phone = :phone';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	$row1 = $s->fetch();

	if ($row1[0] > 0)
	{
    
    try
    {
    $sql = 'SELECT  id , phone, surname, firstname, middle_name, operator, region, status, trash  FROM useres WHERE phone = :phone';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных2.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $row = $s->fetch();

  $pageTitle = 'Редактировать данные клиента';
  $action = 'editform';
  $uid = $row['id'];
  $phone = $row['phone'];
  $number = '8';
  $number1 = substr($phone, 1,3);
  $number2 = substr($phone, 4,3);
  $number3 = substr($phone, 7, 2);
  $number4 = substr($phone, 9,2);
  $surname = $row['surname'];
  $firstname = $row['firstname'];
  $middle_name = $row['middle_name'];

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе1.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе2.';
        include 'error.html.php';
	exit();
	}



  $trashes = array('АКТИВЕН', 'УДАЛЁН');
  $selected_operator = $row['operator'];
  $selected_region = $row['region'];
  $selected_status = $row['status'];
  $selected_trash = $row['trash'];
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Обновить данные клиента';


  include 'form_user.html.php';
  exit();
	}
	else
	{
    
	 $pageTitle = 'Новый клиент';
  $action = 'addform';
  $uid = '';
  $number = '8';
  $password = '';
  $surname = '';
  $firstname = '';
  $middle_name = '';


  $operators = array();
  $regions = array();
  $status =array();


  $trashes =array();
  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
  $selected_trash = '';
  $selected_trash = 'АКТИВЕН';
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Добавить нового клиента';

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе3.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе4.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе5.';
        include 'error.html.php';
	exit();
	}



  $trashes = array('АКТИВЕН', 'УДАЛЁН');
  $select_operator = '<option value="">Выберите оператора связи</option>';
  $select_region = '<option value="">Выберите регион</option>';
  $select_status = '<option value="">Выберите статус</option>';
 
  include 'form_user.html.php';
  exit();
	
	}
	
    }
	else 
	{
		$error = 'Номер введён не корректно.';
    include 'error.html.php';
	exit();
	}	
}	
	

if (isset($_GET['addform']))
{
	
	$number = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';	
	$phone = '';
	$surname = '';
	$firstname = '';
	$middle_name = '';
	$operator = '';
	$region = '';
	$status = '';
	$trash = '';
	$password = '';
	
		
    if (isset($_POST['number1']) && $_POST['number1'] != '' && is_numeric($_POST['number1']) && isset($_POST['number2']) && $_POST['number2'] != '' && is_numeric($_POST['number2']) && isset($_POST['number3']) && $_POST['number3'] != '' && is_numeric($_POST['number3']) && isset($_POST['number4']) && $_POST['number4'] != '' && is_numeric($_POST['number4']))
  {
	  $number = '8';
	  $number1 = $_POST['number1'] ?? false;
	  $number2 = $_POST['number2'] ?? false;
	  $number3 = $_POST['number3'] ?? false;
	  $number4 = $_POST['number4'] ?? false;
	  
	  
	  $phone = $number . $number1 .  $number2 . $number3 . $number4 ;
  }
	else 
	{
		$error = 'Номер введён не корректно.';
    include 'error.html.php';
	exit();
	}	
	
    if ((isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != '') || (isset($_POST['trash']) && $_POST['trash'] != ''))
	{
	   $surname = $_POST['surname'] ?? false;
	   $firstname = $_POST['firstname'] ?? false;
	   $middle_name = $_POST['middle_name'] ?? false;
	   $operator = $_POST['operator'] ?? false;
	   $region = $_POST['region'] ?? false;
	   $status = $_POST['status'] ?? false;
	   $trash = $_POST['trash'] ?? false;		
	}		
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'INSERT INTO useres SET
        phone = :phone,
        surname = :surname,
        firstname = :firstname,
        middle_name = :middle_name,
        time_reg = :time_reg,
		operator = :operator,
		region = :region,
		status = :status,
		trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':surname', $surname);
    $s->bindValue(':firstname', $firstname);
    $s->bindValue(':middle_name', $middle_name);
    $s->bindValue(':time_reg', time());
    $s->bindValue(':operator', $operator);
    $s->bindValue(':region', $region);
    $s->bindValue(':status', $status);
    $s->bindValue(':trash', $trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $userid = $pdo->lastInsertId();

  if (isset($_POST['password']) && $_POST['password'] != '')
  {
	$password = $_POST['password'] ?? false;  
    $password = md5($password . 'adminka');

    try
    {
      $sql = 'UPDATE useres SET
          pswd = :pswd
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':pswd', $password);
      $s->bindValue(':id', $userid);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка ввода пароля.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
  }
  
   try
  {
    $sql = 'INSERT INTO group_user SET
        group_id = :group_id,
        user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':group_id', $userid);
    $s->bindValue(':user_id', $userid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных8.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

    try
    {
    $sql = 'SELECT UID.id AS uid, UID.phone, UID.surname, UID.firstname, UID.middle_name, UID.time_reg, UID.operator, UID.region, UID.status, UID.trash
        	FROM useres AS GID INNER JOIN group_user
			ON GID.id = group_user.group_id
			INNER JOIN useres AS UID
			ON  group_user.user_id = UID.id 
			WHERE GID.id = :uid';
    $s = $pdo->prepare($sql);
   $s->bindValue(':uid', $userid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных23.' . $e->getMessage();
    include 'error.html.php';
    exit();
    } 

  $pageTitle = '';
  $input_edit = '';
  $input_group = '';
  $input_addgroup = '';
  $input_intrash = '';
  $input_outtrash = '';
  $input_devnull = '';
  $trash_out = '';
  $trash_in = '';
  
  $pageTitle = 'ОФОРМЛЕНИЕ ЗАКАЗА';
  $input_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $input_group = '<input type="submit" name="action" value="ГРУППА">';
  $input_addgroup = '<input type="submit" name="action" value="ДОБАВИТЬ В ГРУППУ">';
  $input_intrash = '<input type="submit" name="action" value="УДАЛИТЬ В КОРЗИНУ">';
  $input_outtrash = '<input type="submit" name="action" value="ВОССТАНОВЛЕНИЕ">';
  $input_devnull = '<input type="submit" name="action" value="ПОЛНОЕ УДАЛЕНИЕ">';  
  $trash_out = 'АКТИВЕН';
  $trash_in = 'УДАЛЁН';
	
  $useres = array();

 foreach ($s as $row)
{
  $useres[] = array('uid' => $row['uid'], 'number' => '8', 'number1' => substr($row['phone'], 1, 3), 'number2' => substr($row['phone'], 4, 3), 'number3' => substr($row['phone'], 7, 2), 'number4' => substr($row['phone'], 9, 2), 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name'], 'time_reg' => date('d.m.Y H:i:s', $row['time_reg']), 'operator' => $row['operator'], 'region' => $row['region'], 'status' => $row['status'], 'trash' => $row['trash']);
}
  
  include 'form_order.html.php'; 

  exit();
}

if (isset($_GET['editform']))
{
	$uid = '';
	$oid = '';
	$number = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';	
	$phone = '';
	$surname = '';
	$firstname = '';
	$middle_name = '';
	$operator = '';
	$region = '';
	$status = '';
	$u_trash = '';
	$password = '';


	
		
  if (isset($_POST['number1']) && $_POST['number1'] != '' && is_numeric($_POST['number1']) && isset($_POST['number2']) && $_POST['number2'] != '' && is_numeric($_POST['number2']) && isset($_POST['number3']) && $_POST['number3'] != '' && is_numeric($_POST['number3']) && isset($_POST['number4']) && $_POST['number4'] != '' && is_numeric($_POST['number4']))
  {
	  $number = '8';
	  $number1 = $_POST['number1'] ?? false;
	  $number2 = $_POST['number2'] ?? false;
	  $number3 = $_POST['number3'] ?? false;
	  $number4 = $_POST['number4'] ?? false;
	  
	  
	  $phone = $number . $number1 .  $number2 . $number3 . $number4 ;
  }
	else 
	{
		$error = 'Номер введён не корректно.';
    include 'error.html.php';
	exit();
	}	
	
    if ((isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid'])) || (isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != '') || (isset($_POST['trash']) && $_POST['trash'] != ''))
	{
	   $uid = $_POST['uid'] ?? false;
	   $surname = $_POST['surname'] ?? false;
	   $firstname = $_POST['firstname'] ?? false;
	   $middle_name = $_POST['middle_name'] ?? false;
	   $operator = $_POST['operator'] ?? false;
	   $region = $_POST['region'] ?? false;
	   $status = $_POST['status'] ?? false;
	   $u_trash = $_POST['trash'] ?? false;		
	}		
	

	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'UPDATE useres SET
        phone = :phone,
        surname = :surname,
        firstname = :firstname,
        middle_name = :middle_name,
        operator = :operator,
        region = :region,
        status = :status,
        trash = :trash
        WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $uid);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':surname', $surname);
    $s->bindValue(':firstname', $firstname);
    $s->bindValue(':middle_name', $middle_name);
    $s->bindValue(':operator', $operator);
    $s->bindValue(':region', $region);
    $s->bindValue(':status', $status);
    $s->bindValue(':trash', $u_trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка обновления данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  if (isset($_POST['password']) && $_POST['password'] != '')
  {
	$password = $_POST['password'] ?? false;
    $password = md5($password . 'adminka');

    try
    {
      $sql = 'UPDATE useres SET
          pswd = :pswd
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':id', $uid);
      $s->bindValue(':pswd', $password);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка обновления пароля.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
  }
 
   $state = '';
   $o_trash = '';
   
   $state = 'ОТКРЫТ';   
   $o_trash = 'АКТИВЕН';
 
  try
  {
    $sql = 'INSERT INTO orders SET
        time_in = :time_in,
        state = :state,
        user_id = :user_id,
		trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':time_in', time());
    $s->bindValue(':state', $state);
    $s->bindValue(':user_id', $uid);
    $s->bindValue(':trash', $o_trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $oid = $pdo->lastInsertId();

 
    try
    {
    $sql = 'SELECT id, time_in, state, user_id, trash FROM orders  
			WHERE id = :oid';
    $s = $pdo->prepare($sql);
   $s->bindValue(':oid', $oid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }   
  
  $oid = '';
  $time_in = '';
  $state = '';
  $uid = '';
  $o_trash = '';
    
  $order_states = array();
  
    $row = $s->fetch();
	
	$oid = $row['id'];  
	$time_in = $row['time_in'];  
	$state = $row['state'];  
	$uid = $row['user_id'];  
	$o_trash = $row['trash'];  

    $order_states = array('ОТКРЫТ', 'ЗАКРЫТ');
 
 
    try
    {
    $sql = 'SELECT UID.id AS uid, UID.phone, UID.surname, UID.firstname, UID.middle_name, UID.time_reg, UID.operator, UID.region, UID.status, UID.trash
        	FROM useres AS GID INNER JOIN group_user
			ON GID.id = group_user.group_id
			INNER JOIN useres AS UID
			ON  group_user.user_id = UID.id 
			WHERE GID.id = :uid';
    $s = $pdo->prepare($sql);
   $s->bindValue(':uid', $uid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных23.' . $e->getMessage();
    include 'error.html.php';
    exit();
    } 

  $pageTitle = '';
  $input_edit = '';
  $input_group = '';
  $input_addgroup = '';
  $input_intrash = '';
  $input_outtrash = '';
  $input_devnull = '';
  $trash_out = '';
  $trash_in = '';
  
  $pageTitle = 'ОФОРМЛЕНИЕ ЗАКАЗА';
  $input_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $input_group = '<input type="submit" name="action" value="ГРУППА">';
  $input_addgroup = '<input type="submit" name="action" value="ДОБАВИТЬ В ГРУППУ">';
  $input_intrash = '<input type="submit" name="action" value="УДАЛИТЬ В КОРЗИНУ">';
  $input_outtrash = '<input type="submit" name="action" value="ВОССТАНОВЛЕНИЕ">';
  $input_devnull = '<input type="submit" name="action" value="ПОЛНОЕ УДАЛЕНИЕ">';  
  $trash_out = 'АКТИВЕН';
  $trash_in = 'УДАЛЁН';
	
  $useres = array();

 foreach ($s as $row)
{
  $useres[] = array('uid' => $row['uid'], 'number' => '8', 'number1' => substr($row['phone'], 1, 3), 'number2' => substr($row['phone'], 4, 3), 'number3' => substr($row['phone'], 7, 2), 'number4' => substr($row['phone'], 9, 2), 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name'], 'time_reg' => date('d.m.Y H:i:s', $row['time_reg']), 'operator' => $row['operator'], 'region' => $row['region'], 'status' => $row['status'], 'trash' => $row['trash']);
}	
  
  include 'form_order.html.php';

  exit();
}


if (isset($_POST['action_order']) and $_POST['action_order'] == 'РЕДАКТИРОВАТЬ СЧЁТ')
{
	
 
  $button1 = '';
  $button2 = '';
  $button3 = '';
  $button4 = '';
  
  $order_price = '';
  $order_plus_add = '';
  $order_plus = '';
  $order_sale_add = '';
  $order_sale = '';
  $order_description = '';
  $order_all_price = '';
  $selected_state = '';	
  $time_in = '';
  $state = '';
  $o_id = '';
  $oid = '';
  $uid = '';
  $o_trash = '';
  $select_order_state = '';

  $order_states = array();	
  $order = array();
  $cash_type = array();
  $selected_cash_type = '';  
  

  $button1 = 'ДОБАВИТЬ НОВОЕ ИЗДЕЛИЕ';
  $button2 = 'ДОБАВИТЬ НОВУЮ УСЛУГУ';
  $button3 = 'ПРОВЕСТИ ТРАНЗАКЦИЮ';
  $button4 = 'ОФОРМИТЬ СЧЁТ'; 

	if (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid']))
	{
		$o_id = $_POST['oid'] ?? false;
		
	}
    else
    {
    $error = 'Ошибка 234.';
    include 'error.html.php';
    exit();
    }		

  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
 
	
    try
    {
    $sql = 'SELECT * FROM orders  
			WHERE id = :id';
    $s = $pdo->prepare($sql);
   $s->bindValue(':id', $o_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
    $row = $s->fetch();
	
	$oid = $row['id'];
	$order_plus = $row['plus'];	
	$order_sale = $row['sale'];		
	$time_in = $row['time_in'];  
	$time_out = $row['time_out'];	
	$order_description = $row['description'];	
	$selected_state = $row['state'];  
	$uid = $row['user_id'];  
	$o_trash = $row['trash'];  

    $order_states = array('ОТКРЫТ', 'ЗАКРЫТ');
 
    try
    {
    $sql = 'SELECT UID.id AS uid, UID.phone, UID.surname, UID.firstname, UID.middle_name, UID.time_reg, UID.operator, UID.region, UID.status, UID.trash, group_user.group_id
        	FROM useres AS GID INNER JOIN group_user
			ON GID.id = group_user.group_id
			INNER JOIN useres AS UID
			ON  group_user.user_id = UID.id 
			WHERE GID.id = :uid';
    $s = $pdo->prepare($sql);
   $s->bindValue(':uid', $uid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных23.' . $e->getMessage();
    include 'error.html.php';
    exit();
    } 

  $pageTitle = '';
  $input_edit_user = '';
  $input_group_user = '';
  $input_addgroup_user = '';
  $input_devgroup_user = '';
  $input_intrash = '';
  $input_outtrash = '';
  $input_devnull = '';
  $trash_out = '';
  $trash_in = '';
  $input_edit_product = '';
  $input_intrash_product = '';
  $input_edit_point = '';
  $input_intrash_point = '';
  $input_edit_cash = '';
  $input_intrash_cash = '';
  
  $pageTitle = 'ОФОРМЛЕНИЕ ЗАКАЗА';
  $input_edit_user = '<input type="submit" name="action_user" value="РЕДАКТИРОВАТЬ">';
  $input_group_user = '<input type="submit" name="action_user" value="ГРУППА">';
  $input_addgroup_user = '<input type="submit" name="action_user" value="ДОБАВИТЬ В ГРУППУ">';
  $input_devgroup_user = '<input type="submit" name="action_user" value="УДАЛИТЬ ИЗ ГРУППЫ">';
  
  $input_intrash = '<input type="submit" name="action" value="УДАЛИТЬ В КОРЗИНУ">';
  $input_outtrash = '<input type="submit" name="action" value="ВОССТАНОВЛЕНИЕ">';
  $input_devnull = '<input type="submit" name="action" value="ПОЛНОЕ УДАЛЕНИЕ">';
  
  $input_edit_cash = '<input type="submit" name="action_cash" value="РЕДАКТИРОВАТЬ">';
  $input_intrash_cash = '<input type="submit" name="action_cash" value="УДАЛИТЬ">';
  
  $trash_out = 'АКТИВЕН';
  $trash_in = 'УДАЛЁН';
  
  $input_edit_product = '<input type="submit" name="action_product" value="РЕДАКТИРОВАТЬ">';
  $input_intrash_product = '<input type="submit" name="action_product" value="УДАЛИТЬ">';

  $input_edit_point = '<input type="submit" name="action_point" value="РЕДАКТИРОВАТЬ">';
  $input_intrash_point = '<input type="submit" name="action_point" value="УДАЛИТЬ">';
	
  $useres = array();

 foreach ($s as $row)
{
  $useres[] = array('uid' => $row['uid'], 'number' => '8', 'number1' => substr($row['phone'], 1, 3), 'number2' => substr($row['phone'], 4, 3), 'number3' => substr($row['phone'], 7, 2), 'number4' => substr($row['phone'], 9, 2), 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name'], 'time_reg' => date('d.m.Y H:i:s', $row['time_reg']), 'operator' => $row['operator'], 'region' => $row['region'], 'status' => $row['status'], 'trash' => $row['trash'], 'group_id' => $row['group_id']);
}

	$product_names = array();
	$product_sexes = array();
	$product_materials = array();
	$product_colors = array();


	$product_readinesses = array();
	$product_availabilities = array();

	$selected_product_readiness = '';
	$selected_product_availability = '';
	$select_product_readiness = '';
	$select_product_availability = '';

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini"))
	{
	$product_names = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini"))
	{
	$product_sexes = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini", false);	
	} else

        {
	$error = 'Отказано в доступе6.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$product_materials = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе7.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$product_colors = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе8.';
        include 'error.html.php';
	exit();
	}


	$product_readinesses = array('НЕ ГОТОВО', 'ГОТОВО');
	$product_availabilities = array('ПРИНЯТО', 'ВЫДАНО');

	$selected_product_readiness = 'НЕ ГОТОВО';
    $selected_product_availability = 'ПРИНЯТО';
	
	
	function product_price ($prod_id)
	{
		
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'SELECT SUM(po_price) AS prod_price FROM points
	       WHERE prod_id = :prod_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':prod_id', $prod_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
   
    $row = $s->fetch();
	
	$prod_price = $row['prod_price'];

    return $prod_price;	
		
	}
	
	function points_all ($prod_id)
	{
		
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

 $placeholders = array();
 $placeholders[':prod_id'] = $prod_id;  
    try
    {
    $sql = 'SELECT services.id AS se_id, services.service, services.measurement, services.material AS se_mat, services.description AS se_desc, services.trash AS se_trash, points.id AS po_id, points.description AS po_desc, points.po_price, points.readiness AS po_read, points.serv_id, points.prod_id, points.order_id AS po_order_id, points.trash AS po_trash  
	FROM services INNER JOIN points
    ON services.id = points.serv_id 
	WHERE points.prod_id = :prod_id';
    $s = $pdo->prepare($sql);
    $s->execute($placeholders);
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных2345.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $points_all_out = array();

   foreach ($s as $row)
   {
	   $points_all_out[] = array('se_id' => $row['se_id'], 'service' => $row['service'], 'measurement' => $row['measurement'], 'se_mat' => $row['se_mat'], 'se_desc' => $row['se_desc'], 'se_trash' => $row['se_trash'], 'po_id' => $row['po_id'], 'po_desc' => $row['po_desc'], 'po_price' => $row['po_price'], 'po_read' => $row['po_read'], 'serv_id' => $row['serv_id'], 'prod_id' => $row['prod_id'], 'po_order_id' => $row['po_order_id'], 'po_trash' => $row['po_trash']);
   }	
	
	return $points_all_out;
	
	}	

   $pr_id = '';
   $points_all_in = array();

   

  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT products.id AS pr_id, products.product, products.sex, products.material AS pr_mat, products.color, products.description AS pr_desc, products.readiness AS pr_read, products.availability, products.order_id AS pr_order_id, products.trash AS pr_trash  
	FROM products
	WHERE order_id = :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $oid);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $products_all = array();

   foreach ($s as $row)
   {
	   $products_all[] = array('pr_id' => $row['pr_id'], 'product' => $row['product'], 'sex' => $row['sex'], 'pr_mat' => $row['pr_mat'], 'color' => $row['color'], 'pr_desc' => $row['pr_desc'], 'pr_read' => $row['pr_read'], 'availability' => $row['availability'], 'pr_order_id' => $row['pr_order_id'], 'pr_trash' => $row['pr_trash']);
   }  
  

  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
    $selected_point_readiness = '';
    $select_point_readiness = '';	
  
	$selected_point_readiness = 'НЕ ГОТОВО';
	
	
    try
    {
    $sql = 'SELECT SUM(po_price) AS order_price FROM points
	       WHERE order_id = :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $oid);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
   
    $row = $s->fetch();
	
	$order_price = $row['order_price'];
	
    $order_all_price = $order_price + $order_plus - $order_sale;	
		  
    try
    {
    $sql = 'SELECT * FROM services';
    $s = $pdo->query($sql);
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
 
  $point_services = array();

   foreach ($s as $row)
   {
	   $point_services[] = array('id' => $row['id'], 'service' => $row['service'], 'measurement' => $row['measurement'], 'material' => $row['material'], 'min_price' => $row['min_price'], 'description' => $row['description'], 'trash' => $row['trash']);
   }
   
   $point_readinesses = array();
   
   $point_readinesses = array('НЕ ГОТОВО', 'ГОТОВО');
   
   
    $cash_type = array('НАЛ', 'БЕЗНАЛ');
    $selected_cash_type = 'НАЛ';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT cash.id AS ca_id, cash.cash_in, cash.cash_out, cash.cash_type, cash.time AS ca_time, cash.description AS ca_desc, cash.order_id AS ca_order_id, cash.trash AS ca_trash 
	FROM cash
	WHERE order_id = :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $oid);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $cashes = array();

   foreach ($s as $row)
   {
	   $cashes[] = array('ca_id' => $row['ca_id'], 'cash_in' => $row['cash_in'], 'cash_out' => $row['cash_out'], 'cash_type' => $row['cash_type'], 'ca_time' => date('d.m.Y H:i:s', $row['ca_time']), 'ca_desc' => $row['ca_desc'], 'ca_order_id' => $row['ca_order_id'], 'ca_trash' => $row['ca_trash']);
   }  
  	   

include  'form_order.html.php';
exit();
	
}


if (isset($_POST['action']) and $_POST['action'] == 'search')
{
	$uid = '';
	$number = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';
	$phone = '';
    $status = '';
    $operator = '';
    $region = '';
    $surname = '';
    $firstname = '';
    $middle_name = '';
    $u_trash = '';
    	
	$oid = '';
	$plus = '';
	$sale = '';
	$all_price = '';
	$date_in = '';
	$date_out = '';
	$o_description = '';
	$state = '';
	$o_trash = '';
	
    $lost = '';	
    $placeholders = array();
	$name = '';
	$order_in = '';
	
	
	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

$select = 'SELECT useres.id AS uid, useres.phone, useres.surname, useres.firstname, useres.middle_name, useres.time_reg, useres.operator, useres.region, useres.status, useres.trash AS u_trash, orders.id AS oid, orders.plus, orders.sale, orders.time_in, orders.time_out, orders.description, orders.state, orders.user_id, orders.trash AS o_trash';
$from = ' FROM useres INNER JOIN orders
        ON useres.id = orders.user_id';
$where  = ' WHERE TRUE';		
$order = '	ORDER BY time_in DESC';
$limit = '';	

  if (isset($_POST['number1']) && $_POST['number1'] != '' && is_numeric($_POST['number1']) && isset($_POST['number2']) && $_POST['number2'] != '' && is_numeric($_POST['number2']) && isset($_POST['number3']) && $_POST['number3'] != '' && is_numeric($_POST['number3']) && isset($_POST['number4']) && $_POST['number4'] != '' && is_numeric($_POST['number4']))
  {
	  
	$number = '8';
    $number1 = $_POST['number1'] ?? false;
	$number2 = $_POST['number2'] ?? false;
	$number3 = $_POST['number3'] ?? false;
	$number4 = $_POST['number4'] ?? false;
	  	  
	$phone = $number . $number1 .  $number2 . $number3 . $number4 ;
	
    $where .= " AND phone LIKE :phone";
    $placeholders[':phone'] = $phone;	
	
  }
  
  if (isset($_POST['name']) && $_POST['name'] != '') 
  {
	$name = $_POST['name'] ?? false;
	$where .= " AND CONCAT(surname, firstname, middle_name) LIKE :name";	
    $placeholders[':name'] = '%' . $name . '%';
  }  

  if (isset($_POST['order']) && $_POST['order'] != '') 
  {
    $order_in = $_POST['order'] ?? false;
	$where .= " AND orders.id = :oid";	
    $placeholders[':oid'] = $order_in;
  }

  if (isset($_POST['date_in']) && $_POST['date_in'] != '') 
  {
	$date_in = $_POST['date_in'] ?? false;
	$where .= " AND FROM_UNIXTIME(time_in) LIKE :date_in";	
    $placeholders[':date_in'] = '%' . $date_in . '%';
  }

  if (isset($_POST['date_out']) && $_POST['date_out'] != '') 
  {
	$date_out = $_POST['date_out'] ?? false;
	$where .= " AND FROM_UNIXTIME(time_out) LIKE :date_out";	
    $placeholders[':date_out'] = '%' . $date_out . '%';
  }

  if (isset($_POST['lost']) && $_POST['lost'] != '') 
   {
	$lost = $_POST['lost'] ?? false;   
    $limit = " LIMIT " . $lost;
    }
	
  if (isset($_POST['state']) && $_POST['state'] != '') 
  {
	$state = $_POST['state'] ?? false;
	$where .= " AND state = :state";	
    $placeholders[':state'] = $state;
  }	

  if (isset($_POST['o_trash']) && $_POST['o_trash'] != '') 
  {
	$o_trash = $_POST['o_trash'] ?? false;
	$where .= " AND orders.trash = :o_trash";	
    $placeholders[':o_trash'] = $o_trash;
  }

  try
  {
    $sql = $select . $from . $where . $order . $limit;
    $s = $pdo->prepare($sql);
    $s->execute($placeholders);
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка поиска данных.' . $e -> getMessage();
    include 'error.html.php';
    exit();
  }
  
    $orders = array();

 foreach ($s as $row)
{

$orders[] = array('oid' => $row['oid'], 'plus' => $row['plus'], 'sale' => $row['sale'], 'time_in' => $row['time_in'], 'time_out' => $row['time_out'], 'description' => $row['description'], 'state' => $row['state'], 'o_trash' => $row['o_trash'], 'uid' => $row['uid'], 'number' => '8', 'number1' => substr($row['phone'], 1, 3), 'number2' => substr($row['phone'], 4, 3), 'number3' => substr($row['phone'], 7, 2), 'number4' => substr($row['phone'], 9, 2), 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name'], 'time_reg' => $row['time_reg'], 'operator' => $row['operator'], 'region' => $row['region'], 'status' => $row['status'], 'u_trash' => $row['u_trash']);
  
}


	function order_price ($order_id)
	{
		
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'SELECT SUM(po_price) AS order_price FROM points
	       WHERE order_id = :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $order_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
   
    $row = $s->fetch();
	
	$order_price = $row['order_price'];

    return $order_price;	
		
	}
	
	function order_price_all ($order_price_in, $order_plus, $order_sale)
	{
			
	$order_price_all = $order_price_in + $order_plus - $order_sale;

    return $order_price_all;	
		
	}
	
	function order_group_user ($uid)
	{
		
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		
    try
    {
    $sql = 'SELECT UID.id AS uid, UID.phone, UID.surname, UID.firstname, UID.middle_name, UID.time_reg, UID.operator, UID.region, UID.status, UID.trash, group_user.group_id
        	FROM useres AS GID INNER JOIN group_user
			ON GID.id = group_user.group_id
			INNER JOIN useres AS UID
			ON  group_user.user_id = UID.id 
			WHERE GID.id = :uid';
    $s = $pdo->prepare($sql);
   $s->bindValue(':uid', $uid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных23.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }

    $order_group_user = array();	

 foreach ($s as $row)
{
  $order_group_user[] = array('uid' => $row['uid'], 'number' => '8', 'number1' => substr($row['phone'], 1, 3), 'number2' => substr($row['phone'], 4, 3), 'number3' => substr($row['phone'], 7, 2), 'number4' => substr($row['phone'], 9, 2), 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name'], 'time_reg' => date('d.m.Y H:i:s', $row['time_reg']), 'operator' => $row['operator'], 'region' => $row['region'], 'status' => $row['status'], 'trash' => $row['trash'], 'group_id' => $row['group_id']);
}
	

    return $order_group_user;	
		
	}

	function product_price ($prod_id)
	{
		
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'SELECT SUM(po_price) AS prod_price FROM points
	       WHERE prod_id = :prod_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':prod_id', $prod_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
   
    $row = $s->fetch();
	
	$prod_price = $row['prod_price'];

    return $prod_price;	
		
	}
	
	function order_product ($order_id)
	{
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT products.id AS pr_id, products.product, products.sex, products.material AS pr_mat, products.color, products.description AS pr_desc, products.readiness AS pr_read, products.availability, products.order_id AS pr_order_id, products.trash AS pr_trash  
	FROM products
	WHERE order_id = :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $order_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $products_all = array();

   foreach ($s as $row)
   {
	   $products_all[] = array('pr_id' => $row['pr_id'], 'product' => $row['product'], 'sex' => $row['sex'], 'pr_mat' => $row['pr_mat'], 'color' => $row['color'], 'pr_desc' => $row['pr_desc'], 'pr_read' => $row['pr_read'], 'availability' => $row['availability'], 'pr_order_id' => $row['pr_order_id'], 'pr_trash' => $row['pr_trash']);
   }

    return $products_all;   
		
	}
	
	$order_product_in = array();
	$order_cash_in = array();

	function points_all ($prod_id)
	{
		
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

 $placeholders = array();
 $placeholders[':prod_id'] = $prod_id;  
    try
    {
    $sql = 'SELECT services.id AS se_id, services.service, services.measurement, services.material AS se_mat, services.description AS se_desc, services.trash AS se_trash, points.id AS po_id, points.description AS po_desc, points.po_price, points.readiness AS po_read, points.serv_id, points.prod_id, points.order_id AS po_order_id, points.trash AS po_trash  
	FROM services INNER JOIN points
    ON services.id = points.serv_id 
	WHERE points.prod_id = :prod_id';
    $s = $pdo->prepare($sql);
    $s->execute($placeholders);
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных2345.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $points_all_out = array();

   foreach ($s as $row)
   {
	   $points_all_out[] = array('se_id' => $row['se_id'], 'service' => $row['service'], 'measurement' => $row['measurement'], 'se_mat' => $row['se_mat'], 'se_desc' => $row['se_desc'], 'se_trash' => $row['se_trash'], 'po_id' => $row['po_id'], 'po_desc' => $row['po_desc'], 'po_price' => $row['po_price'], 'po_read' => $row['po_read'], 'serv_id' => $row['serv_id'], 'prod_id' => $row['prod_id'], 'po_order_id' => $row['po_order_id'], 'po_trash' => $row['po_trash']);
   }	
	
	return $points_all_out;
	
	}

	function order_cash ($order_id)
	{
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT cash.id AS ca_id, cash.cash_in, cash.cash_out, cash.cash_type, cash.time AS ca_time, cash.description AS ca_desc, cash.order_id AS ca_order_id, cash.trash AS ca_trash 
	FROM cash
	WHERE order_id = :order_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $order_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	  $cash_all_out = array();

   foreach ($s as $row)
   {
	   $cash_all_out[] = array('ca_id' => $row['ca_id'], 'cash_in' => $row['cash_in'], 'cash_out' => $row['cash_out'], 'cash_type' => $row['cash_type'], 'ca_time' => date('d.m.Y H:i:s', $row['ca_time']), 'ca_desc' => $row['ca_desc'], 'ca_order_id' => $row['ca_order_id'], 'ca_trash' => $row['ca_trash']);
   }		
	
	return $cash_all_out;
	
	}

	function order_cash_in_all ($order_id)
	{
	$order_cash_in_all = '';
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT SUM(cash.cash_in) AS order_cash_in_all
	FROM cash
	WHERE order_id = :order_id AND trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $order_id);
    $s->bindValue(':trash', 'АКТИВЕН');
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
   
    $row = $s->fetch();
	
	$order_cash_in_all = $row['order_cash_in_all'];
		
	
	return $order_cash_in_all;
	
	}

	function order_cash_out_all ($order_id)
	{
	$order_cash_out_all = '';
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT SUM(cash.cash_out) AS order_cash_out_all
	FROM cash
	WHERE order_id = :order_id AND trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $order_id);
    $s->bindValue(':trash', 'АКТИВЕН');
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
   
    $row = $s->fetch();
	
	$order_cash_out_all = $row['order_cash_out_all'];
		
	
	return $order_cash_out_all;
	
	}

   $pr_id = '';
   $points_all_in = array();	

  $input_edit_order = '';
  $input_vew_order = '';
  $input_intrash_order = '';
  $input_outtrash_order = '';
  $input_devnull_order = '';
  $trash_out = '';
  $trash_in = '';

  $input_vew_order = '<input type="submit" name="action_order" value="ПРОСМОТР СЧЁТА">';
  $input_edit_order = '<input type="submit" name="action_order" value="РЕДАКТИРОВАТЬ СЧЁТ">';
  $input_intrash_order = '<input type="submit" name="action_order" value="УДАЛИТЬ СЧЁТ В КОРЗИНУ">';
  $input_outtrash_order = '<input type="submit" name="action_order" value="ВОССТАНОВЛЕНИЕ">';
  $input_devnull_order = '<input type="submit" name="action_order" value="ПОЛНОЕ УДАЛЕНИЕ">';    
  $trash_out = 'АКТИВЕН';
  $trash_in = 'УДАЛЁН';	

$number = '8';

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе9.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе10.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе11.';
        include 'error.html.php';
	exit();
	}


$trashes = array('АКТИВЕН', 'УДАЛЁН');
$selected_trash = 'АКТИВЕН';
$states =array('ОТКРЫТ', 'ЗАКРЫТ');

try
{
  $result = $pdo->query('SELECT useres.id, useres.surname, useres.firstname, useres.middle_name FROM useres');
}
catch (PDOException $e)
{
  $error = 'Ошибка выборки данных клиентов.' . $e->getMessage();
  include 'error.html.php';
  exit();
}

foreach ($result as $row)
{
  $names[] = array('id' => $row['id'], 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name']);
}


}
else
{

  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';  

$number = '';
$names = array();
$operators = array();
$regions = array();
$status =array();
$trashes =array();
$states =array();
$orders =array();

$selected_trash = '';


$number = '8';

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе12.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе13.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе14.';
        include 'error.html.php';
	exit();
	}


$trashes = array('АКТИВЕН', 'УДАЛЁН');
$selected_trash = 'АКТИВЕН';
$states =array('ОТКРЫТ', 'ЗАКРЫТ');

try
{
  $result = $pdo->query('SELECT useres.id, useres.surname, useres.firstname, useres.middle_name FROM useres');
}
catch (PDOException $e)
{
  $error = 'Ошибка выборки данных клиентов.' . $e->getMessage();
  include 'error.html.php';
  exit();
}

foreach ($result as $row)
{
  $names[] = array('id' => $row['id'], 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name']);
}

}

include  'orders.html.php';
