<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';


if (isset($_GET['add']))
{
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  $pageTitle = 'Новый клиент';
  $action = 'addform';
  $uid = '';
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
  $selected_trash = 'АКТИВЕН';
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Добавить нового клиента';


        if (is_readable("/var/www/adminka2.ru/html/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("/var/www/adminka2.ru/html/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("/var/www/adminka2.ru/html/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("/var/www/adminka2.ru/html/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("/var/www/adminka2.ru/html/ini_files/status.ini"))
	{
	$status = parse_ini_file("/var/www/adminka2.ru/html/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

  $trashes = array('АКТИВЕН', 'УДАЛЁН');
  $select_operator = '<option value="">Выберите оператора связи</option>';
  $select_region = '<option value="">Выберите регион</option>';
  $select_status = '<option value="">Выберите статус</option>';
 
  include 'form.html.php';
  exit();
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
		
	
    if ((isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != ''))
	{
	   $surname = $_POST['surname'] ?? false;
	   $firstname = $_POST['firstname'] ?? false;
	   $middle_name = $_POST['middle_name'] ?? false;
	   $operator = $_POST['operator'] ?? false;
	   $region = $_POST['region'] ?? false;
	   $status = $_POST['status'] ?? false;
	}		
	
	   $trash = 'АКТИВЕН';
	   
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
  
 
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'РЕДАКТИРОВАТЬ')
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

  if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	  $uid = $_POST['uid'] ?? false;
  }	  
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'SELECT id , phone, surname, firstname, middle_name, operator, region, status, trash  FROM useres WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $uid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка выборки данных.' . $e->getMessage();
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

        if (is_readable("/var/www/adminka2.ru/html/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("/var/www/adminka2.ru/html/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("/var/www/adminka2.ru/html/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("/var/www/adminka2.ru/html/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("/var/www/adminka2.ru/html/ini_files/status.ini"))
	{
	$status = parse_ini_file("/var/www/adminka2.ru/html/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
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


  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
	$uid = '';
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
	
    if ((isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid'])) || (isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != ''))
	{
	   $uid = $_POST['uid'] ?? false;
	   $surname = $_POST['surname'] ?? false;
	   $firstname = $_POST['firstname'] ?? false;
	   $middle_name = $_POST['middle_name'] ?? false;
	   $operator = $_POST['operator'] ?? false;
	   $region = $_POST['region'] ?? false;
	   $status = $_POST['status'] ?? false;		
	}		
	
	$trash = 'АКТИВЕН';
	
	
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
    $s->bindValue(':trash', $trash);
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

  header('Location: .');
  exit();
}
  
 if (isset($_POST['action']) and $_POST['action'] == 'ДОБАВИТЬ В ГРУППУ') 
 {
	 

  $pageTitle1 = 'ВВЕДИТЕ НОМЕР ТЕЛЕФОНА';

  $guid = '';
  $uid = '';
  
  
  if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	$guid = $_POST['uid'] ?? false;  
  }

  $pageTitle = 'Новый клиент в группе №' . $guid . '.';

  include 'order_new.html.php';
  exit();	 
	 
 
}

if (isset($_POST['action']) and $_POST['action'] == 'new')
{
		
  $oid = '';
  $uid = '';
  $guid = '';
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


  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
  $select_operator = '';
  $select_region = '';
  $select_status = '';
	

  if (isset($_POST['guid']) && $_POST['guid'] != '' && is_numeric($_POST['guid']))
  {
	$guid = $_POST['guid'] ?? false;  
  }
	
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
    $sql = 'SELECT  id , phone, surname, firstname, middle_name, operator, region, status  FROM useres WHERE phone = :phone';
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

  $action = 'editgroupform';
  $uid = $row['id'];
  $pageTitle = 'Группа №' . $guid . '.' . ' ' . 'Редактировать данные клиента';
  $phone = $row['phone'];
  $number = '8';
  $number1 = substr($phone, 1,3);
  $number2 = substr($phone, 4,3);
  $number3 = substr($phone, 7, 2);
  $number4 = substr($phone, 9,2);
  $surname = $row['surname'];
  $firstname = $row['firstname'];
  $middle_name = $row['middle_name'];

        if (is_readable("/var/www/adminka2.ru/html/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("/var/www/adminka2.ru/html/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("/var/www/adminka2.ru/html/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("/var/www/adminka2.ru/html/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("/var/www/adminka2.ru/html/ini_files/status.ini"))
	{
	$status = parse_ini_file("/var/www/adminka2.ru/html/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $selected_operator = $row['operator'];
  $selected_region = $row['region'];
  $selected_status = $row['status'];
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Обновить данные клиента';


  include 'form.html.php';
  exit();
	}
	else
	{
    
  $action = 'addformgroup';
  $oid = '';
  $uid = '';
  $guid = '';
  $number = '8';
  $password = '';
  $surname = '';
  $firstname = '';
  $middle_name = '';


  $operators = array();
  $regions = array();
  $status =array();


  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Добавить нового клиента';

  
  if (isset($_POST['guid']) && $_POST['guid'] != '' && is_numeric($_POST['guid']))
  {
	$guid = $_POST['guid'] ?? false;  
  }  
	 $pageTitle = 'Группа №' . $guid . '.' . ' ' . 'Новый клиент';


        if (is_readable("/var/www/adminka2.ru/html/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("/var/www/adminka2.ru/html/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("/var/www/adminka2.ru/html/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("/var/www/adminka2.ru/html/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("/var/www/adminka2.ru/html/ini_files/status.ini"))
	{
	$status = parse_ini_file("/var/www/adminka2.ru/html/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $select_operator = '<option value="">Выберите оператора связи</option>';
  $select_region = '<option value="">Выберите регион</option>';
  $select_status = '<option value="">Выберите статус</option>';
	  
 
  include 'form.html.php';
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
	

if (isset($_GET['addformgroup']))
{
	$userid = '';
	$uid = '';	
	$guid = '';	
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
	
    if ((isset($_POST['guid']) && $_POST['guid'] != '' && is_numeric($_POST['guid'])) || (isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != '') || (isset($_POST['trash']) && $_POST['trash'] != ''))
	{
	   $guid = $_POST['guid'] ?? false;
	   $surname = $_POST['surname'] ?? false;
	   $firstname = $_POST['firstname'] ?? false;
	   $middle_name = $_POST['middle_name'] ?? false;
	   $operator = $_POST['operator'] ?? false;
	   $region = $_POST['region'] ?? false;
	   $status = $_POST['status'] ?? false;		
	}		
	
	$trash = 'АКТИВЕН';
	
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
    $sql = 'INSERT INTO group_user SET
        group_id = :group_id,
        user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':group_id', $guid);
    $s->bindValue(':user_id', $userid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных8.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}



if (isset($_GET['editgroupform']))
{

	$uid = '';
	$guid = '';
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
	
    if ((isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid'])) && (isset($_POST['guid']) && $_POST['guid'] != '' && is_numeric($_POST['guid'])) || (isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != ''))
	{
	   $uid = $_POST['uid'] ?? false;
	   $guid = $_POST['guid'] ?? false;
	   $surname = $_POST['surname'] ?? false;
	   $firstname = $_POST['firstname'] ?? false;
	   $middle_name = $_POST['middle_name'] ?? false;
	   $operator = $_POST['operator'] ?? false;
	   $region = $_POST['region'] ?? false;
	   $status = $_POST['status'] ?? false;		
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
        status = :status
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
  
   try
  {
    $sql = 'INSERT INTO group_user SET
        group_id = :group_id,
        user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':group_id', $guid);
    $s->bindValue(':user_id', $uid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных8.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

  

if (isset($_POST['action']) and $_POST['action'] == 'УДАЛИТЬ В КОРЗИНУ')
{
	
	$uid = '';
	$trash = '';
	$trash = 'УДАЛЁН';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	$uid = $_POST['uid'] ?? false;

    try
    {
      $sql = 'UPDATE useres SET
          trash = :trash
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':id', $uid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }

    try
    {
      $sql = 'UPDATE group_user SET
          trash = :trash
          WHERE group_id = :group_id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':group_id', $uid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }

    try
    {
      $sql = 'UPDATE group_user SET
          trash = :trash
          WHERE user_id = :user_id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':user_id', $uid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
	
  } 
  
  header('Location: .');
  exit();
}


if (isset($_POST['action']) and $_POST['action'] == 'ВОССТАНОВЛЕНИЕ')
{
	
	$uid = '';
	$trash = '';
	$trash = 'АКТИВЕН';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	$uid = $_POST['uid'] ?? false;

    try
    {
      $sql = 'UPDATE useres SET
          trash = :trash
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':id', $uid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }

    try
    {
      $sql = 'UPDATE group_user SET
          trash = :trash
          WHERE group_id = :group_id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':group_id', $uid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }

    try
    {
      $sql = 'UPDATE group_user SET
          trash = :trash
          WHERE user_id = :user_id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':user_id', $uid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
	
  } 
  
  header('Location: .');
  exit();
}


if (isset($_POST['action']) and $_POST['action'] == 'ПОЛНОЕ УДАЛЕНИЕ')
{
	
	$uid = '';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	$uid = $_POST['uid'] ?? false;
   	
    try
    {
    $sql = 'DELETE FROM group_user WHERE user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':user_id', $uid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка удаления данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	try
    {
    $sql = 'DELETE FROM group_user WHERE group_id = :group_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':group_id', $uid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка удаления данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	try
    {
    $sql = 'DELETE FROM useres WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $uid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка удаления данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
		
  } 
  
  header('Location: .');
  exit();
}


if (isset($_POST['action']) and $_POST['action'] == 'search')
{
	
	$number = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';
	$phone = '';
    $placeholders = array();
    $status = '';
    $operator = '';
    $region = '';
    $surname = '';
    $firstname = '';
    $middle_name = '';
    $name = '';
    $date = '';
    $lost = '';	
    $trash = '';	
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

$select = 'SELECT id AS uid, phone, surname, firstname, middle_name, time_reg, operator, region, status, trash';
$from = ' FROM useres';
$where  = ' WHERE TRUE';		
$order = '	ORDER BY time_reg DESC';
$limit = '';

  if (isset($_POST['status']) && $_POST['status'] != '') 
  {
    $status = $_POST['status'] ?? false;
	$where .= " AND status = :status";	
    $placeholders[':status'] = $status;
  }
  
  if (isset($_POST['operator']) && $_POST['operator'] != '') 
  {
    $operator = $_POST['operator'] ?? false;	  
	$where .= " AND operator = :operator";	
    $placeholders[':operator'] = $operator;
  }

  if (isset($_POST['region']) && $_POST['region'] != '') 
  {
	$region = $_POST['region'] ?? false;
	$where .= " AND region = :region";	
    $placeholders[':region'] = $region;
  }  

if (isset($_POST['name']) && $_POST['name'] != '') 
  {
	$name = $_POST['name'] ?? false;
	$where .= " AND CONCAT(surname, firstname, middle_name) LIKE :name";	
    $placeholders[':name'] = '%' . $name . '%';
  }  

if (isset($_POST['date']) && $_POST['date'] != '') 
  {
	$date = $_POST['date'] ?? false;
	$where .= " AND FROM_UNIXTIME(time_reg) LIKE :date";	
    $placeholders[':date'] = '%' . $date . '%';
  }  

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
	
  if (isset($_POST['lost']) && $_POST['lost'] != '' && is_numeric($_POST['lost'])) 
   {
	$lost = $_POST['lost'] ?? false;   
    $limit = " LIMIT " . $lost;
    }

  if (isset($_POST['trash']) && $_POST['trash'] != '') 
  {
	$trash = $_POST['trash'] ?? false;
	$where .= " AND trash = :trash";	
    $placeholders[':trash'] = $trash;
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
  
  $input_edit = '';
  $input_group = '';
  $input_addgroup = '';
  $input_intrash = '';
  $input_outtrash = '';
  $input_devnull = '';
  $trash_out = '';
  $trash_in = '';
  
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
 
}



   if (isset($_POST['action']) and $_POST['action'] == 'ГРУППА')
	{
    $uid = '';
	$number = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';
	$phone = '';
    $placeholders = array();
    $status = '';
    $operator = '';
    $region = '';
    $surname = '';
    $firstname = '';
    $middle_name = '';
    $name = '';
    $date = '';
    $lost = '';	
    $trash = '';	

  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid'])) 
  {
    $uid = $_POST['uid'] ?? false;
	
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

  
  $input_edit = '';
  $input_group = '';
  $input_addgroup = '';
  $input_intrash = '';
  $input_outtrash = '';
  $input_devnull = '';
  $trash_out = '';
  $trash_in = '';
  
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
}
}
	

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

$number = '';
$names = array();


$operators = array();
$regions = array();
$status =array();


$trashes =array();
$selected_trash = '';

$number = '8';

        if (is_readable("/var/www/adminka2.ru/html/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("/var/www/adminka2.ru/html/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("/var/www/adminka2.ru/html/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("/var/www/adminka2.ru/html/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("/var/www/adminka2.ru/html/ini_files/status.ini"))
	{
	$status = parse_ini_file("/var/www/adminka2.ru/html/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


$trashes = array('АКТИВЕН', 'УДАЛЁН');
$selected_trash = 'АКТИВЕН';

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

include  'useres.html.php';
