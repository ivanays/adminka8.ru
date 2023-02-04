<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';
  
$oid = '';


if (isset($_POST['action_user']) and $_POST['action_user'] == 'РЕДАКТИРОВАТЬ')
{
	
  $uid = '';
  $ugid = '';
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

  if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	  $uid = $_POST['uid'] ?? false;
 	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'SELECT id , phone, surname, firstname, middle_name, operator, region, status  FROM useres WHERE id = :id';
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
  $action = 'editgroupform';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
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
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Обновить данные клиента';

  }

  elseif (isset($_POST['ugid']) && $_POST['ugid'] != '' && is_numeric($_POST['ugid']))
  {
	  $ugid = $_POST['ugid'] ?? false;
	  
 	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'SELECT id , phone, surname, firstname, middle_name, operator, region, status  FROM useres WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $ugid);
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
  $action = 'editgroupform';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
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
	  
	  
  }

  include 'form_user.html.php';
  exit();
}

if (isset($_GET['editgroupform']))
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

  

  header('Location: .');
  exit();
}

if (isset($_POST['action_user']) and $_POST['action_user'] == 'УДАЛИТЬ ИЗ ГРУППЫ')
{
	
	$ugid = '';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['ugid']) && $_POST['ugid'] != '' && is_numeric($_POST['ugid']))
  {
	$ugid = $_POST['ugid'] ?? false;

    try
    {
    $sql = 'DELETE FROM group_user WHERE user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':user_id', $ugid);
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

  
 if (isset($_POST['action_user']) and $_POST['action_user'] == 'ДОБАВИТЬ В ГРУППУ') 
 {
	 

  $pageTitle = 'Новый клиент в группе';
  $action = 'addformgroup';
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
  $status = array();


  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
  $select_operator = '';
  $select_region = '';
  $select_status = '';  
  $button = 'Добавить в группу нового клиента';

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $select_operator = '<option value="">Выберите оператора связи</option>';
  $select_region = '<option value="">Выберите регион</option>';
  $select_status = '<option value="">Выберите статус</option>';
  
  if (isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid']))
  {
	$uid = $_POST['uid'] ?? false;  
  } 
  
  include 'form_user.html.php';
  exit();
}
  
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


  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
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


  $selected_operator = '';
  $selected_region = '';
  $selected_status = '';
  $select_operator = '';
  $select_region = '';
  $select_status = '';
  $button = 'Добавить нового клиента';

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$status = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


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
		status = :status';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':surname', $surname);
    $s->bindValue(':firstname', $firstname);
    $s->bindValue(':middle_name', $middle_name);
    $s->bindValue(':time_reg', time());
    $s->bindValue(':operator', $operator);
    $s->bindValue(':region', $region);
    $s->bindValue(':status', $status);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $uid = $pdo->lastInsertId();

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
      $s->bindValue(':id', $uid);
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
    $s->bindValue(':group_id', $uid);
    $s->bindValue(':user_id', $uid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных8.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
  
	
    $state = '';
    
    $state = 'ОТКРЫТ';   
	$time = time();
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
 
  try
  {
    $sql = 'INSERT INTO orders SET
        time_in = :time_in,
        state = :state,
        user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':time_in', $time);
    $s->bindValue(':state', $state);
    $s->bindValue(':user_id', $uid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $oid = $pdo->lastInsertId();
  

  

   header('Location: .');
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
	
    $state = '';

    
    $state = 'ОТКРЫТ';   
	$time = time();
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
 
  try
  {
    $sql = 'INSERT INTO orders SET
        time_in = :time_in,
        state = :state,
        user_id = :user_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':time_in', $time);
    $s->bindValue(':state', $state);
    $s->bindValue(':user_id', $uid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $oid = $pdo->lastInsertId();

 
  header('Location: .');
  exit();
}

if (isset($_GET['addformgroup']))
{
	$userid = '';
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
		status = :status';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':surname', $surname);
    $s->bindValue(':firstname', $firstname);
    $s->bindValue(':middle_name', $middle_name);
    $s->bindValue(':time_reg', time());
    $s->bindValue(':operator', $operator);
    $s->bindValue(':region', $region);
    $s->bindValue(':status', $status);
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
    $s->bindValue(':group_id', $uid);
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

if (isset($_POST['action']) and $_POST['action'] == 'ДОБАВИТЬ НОВУЮ УСЛУГУ')
{
	
	$point_product_id = '';
	$point_service = '';
	$point_description = '';
	$point_price = '';
	$point_readiness = '';
	$point_oid = '';
	$point_trash = '';
	
	if ((isset($_POST['point_product_id']) && $_POST['point_product_id'] != '') && (isset($_POST['point_service']) && $_POST['point_service'] != '') && (isset($_POST['point_price']) && $_POST['point_price'] != '') && (isset($_POST['point_readiness']) && $_POST['point_readiness'] != '') && (isset($_POST['point_oid']) && $_POST['point_oid'] != '') || (isset($_POST['point_description']) && $_POST['point_description'] != ''))
	{
		
		$point_product_id = $_POST['point_product_id'] ?? false;
		$point_service = $_POST['point_service'] ?? false;
		$point_price = $_POST['point_price'] ?? false;
		$point_readiness = $_POST['point_readiness'] ?? false;
		$point_oid = $_POST['point_oid'] ?? false;
		
	}
		else
	{
		    $error = 'Введите данные. ';
			include 'error.html.php';
			exit();
	}
	
	if (isset($_POST['point_description']) && $_POST['point_description'] != '')
	{
		
		$point_description = $_POST['point_description'] ?? false;
				
	}
	
	
		$point_trash = 'АКТИВЕН';
		
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


  try
  {
    $sql = 'INSERT INTO points SET
        description = :description,
        po_price = :po_price,
        readiness = :readiness,
        serv_id = :serv_id,
        prod_id = :prod_id,
        order_id = :order_id,
		trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':description', $point_description);
    $s->bindValue(':po_price', $point_price);
    $s->bindValue(':readiness', $point_readiness);
    $s->bindValue(':serv_id', $point_service);
    $s->bindValue(':prod_id', $point_product_id);
    $s->bindValue(':order_id', $point_oid);
    $s->bindValue(':trash', $point_trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка обновления данных. ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
  
  
  
  header('Location: .');
  exit();  
			
		
}

if (isset($_POST['action_point']) and $_POST['action_point'] == 'РЕДАКТИРОВАТЬ')
{

	
	$poid = '';
	$prid = '';
	$oid = '';
	$point_service = '';
	$point_description = '';
	$point_price = '';
	$point_readiness = '';
	$point_trash = '';
	
	$pageTitle = '';
    $action = '';
	$product_id = '';
	$point_id = '';
	$point_oid = '';
	$selected_point_service_id = '';
	$selected_point_readiness = '';
	$point_description = '';
	$point_price = '';
	$selected_point_trash = '';
	$button = '';
	
	if ((isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])) && (isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])) && (isset($_POST['poid']) && $_POST['poid'] != '' && is_numeric($_POST['poid'])))
	{
		
		$poid = $_POST['poid'] ?? false;
		$prid = $_POST['prid'] ?? false;
		$oid = $_POST['oid'] ?? false;
		
	}
			
	
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
  
  
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';   
  
    try
    {
    $sql = 'SELECT services.id AS se_id, services.service, services.measurement, services.material AS se_mat, services.description AS se_desc, services.trash AS se_trash, points.id AS po_id, points.description AS po_desc, points.po_price, points.readiness AS po_read, points.serv_id, points.prod_id, points.order_id AS po_order_id, points.trash AS po_trash  
	FROM services INNER JOIN points
    ON services.id = points.serv_id 
	WHERE points.id = :po_id';
    $s = $pdo->prepare($sql);
	$s->bindValue(':po_id', $poid);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных2345.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	
	$row = $s->fetch();

    $action = 'editformpoint';
	$point_id = $row['po_id'];
	$product_id = $row['prod_id'];
	$point_oid = $row['po_order_id'];
	$selected_point_service_id = $row['serv_id'];
	$selected_point_readiness = $row['po_read'];
	$point_description = $row['po_desc'];
	$point_price = $row['po_price'];
	$selected_point_trash = $row['po_trash'];
    $pageTitle = 'Редактировать данные по услуге №' . $point_id . ' ' . 'изделия №' . $product_id . ' ' . 'счёт №' . $point_oid;
	$button = 'Обновить данные по услуге';
	
	
  include  'form_point.html.php';
  exit();  
	
}

if (isset($_GET['editformpoint']))
{
	
	$poid = '';
	$prid = '';
	$oid = '';
	$point_service = '';
	$point_description = '';
	$point_price = '';
	$point_readiness = '';
	$point_trash = '';
	
	
	if ((isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])) && (isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])) && (isset($_POST['poid']) && $_POST['poid'] != '' && is_numeric($_POST['poid'])) && (isset($_POST['point_product_id']) && $_POST['point_product_id'] != '' && is_numeric($_POST['point_product_id'])) && (isset($_POST['point_service']) && $_POST['point_service'] != '') && (isset($_POST['point_price']) && $_POST['point_price'] != '' && is_numeric($_POST['point_price'])) && (isset($_POST['point_readiness']) && $_POST['point_readiness'] != '') || (isset($_POST['point_description']) && $_POST['point_description'] != ''))
	{
		
		$oid = $_POST['oid'] ?? false;
		$poid = $_POST['poid'] ?? false;
		$pкid = $_POST['prid'] ?? false;
		$point_product_id = $_POST['point_product_id'] ?? false;
		$point_service = $_POST['point_service'] ?? false;
		$point_price = $_POST['point_price'] ?? false;
		$point_readiness = $_POST['point_readiness'] ?? false;
		$point_description = $_POST['point_description'] ?? false;
		
	}
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


  try
  {
    $sql = 'UPDATE points SET
        description = :description,
        po_price = :po_price,
        readiness = :readiness,
        serv_id = :serv_id,
        prod_id = :prod_id,
        order_id = :order_id
		WHERE points.id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $poid);
    $s->bindValue(':description', $point_description);
    $s->bindValue(':po_price', $point_price);
    $s->bindValue(':readiness', $point_readiness);
    $s->bindValue(':serv_id', $point_service);
    $s->bindValue(':prod_id', $point_product_id);
    $s->bindValue(':order_id', $oid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка обновления данных. ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
  

  
  header('Location: .');
  exit();  
				
}



if (isset($_POST['action']) and $_POST['action'] == 'ДОБАВИТЬ НОВОЕ ИЗДЕЛИЕ')
{
	
		$product_oid = '';
		$product_name = '';
		$product_readiness = '';
		$product_availability = '';
		$product_sex = '';
		$product_material = '';
		$product_color = '';
		$product_description = '';
		$product_trash = '';
	
		if ((isset($_POST['product_oid']) && $_POST['product_oid'] != '' && is_numeric($_POST['product_oid'])) && (isset($_POST['product_name']) && $_POST['product_name'] != '') && (isset($_POST['product_readiness']) && $_POST['product_readiness'] != '') && (isset($_POST['product_availability']) && $_POST['product_availability'] != ''))
	{
		$product_oid = $_POST['product_oid'] ?? false;
		$product_name = $_POST['product_name'] ?? false;
		$product_readiness = $_POST['product_readiness'] ?? false;
		$product_availability = $_POST['product_availability'] ?? false;
		
  	}
	else
	{
		    $error = 'Введите данные. ';
			include 'error.html.php';
			exit();
	}

		if ((isset($_POST['product_sex']) && $_POST['product_sex'] != '') || (isset($_POST['product_material']) && $_POST['product_material'] != '') || (isset($_POST['product_color']) && $_POST['product_color'] != '') || (isset($_POST['product_description']) && $_POST[''] != ''))
	{	
		
		$product_sex = $_POST['product_sex'] ?? false;
		$product_material = $_POST['product_material'] ?? false;
		$product_color = $_POST['product_color'] ?? false;
		$product_description = $_POST['product_description'] ?? false;
		

	}
		$product_trash = 'АКТИВЕН';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


  try
  {
    $sql = 'INSERT INTO products SET
        product = :product,
        sex = :sex,
        material = :material,
        color = :color,
        description = :description,
        readiness = :readiness,
        availability = :availability,
        order_id = :oder_id,
		trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':product', $product_name);
    $s->bindValue(':sex', $product_sex);
    $s->bindValue(':material', $product_material);
    $s->bindValue(':color', $product_color);
    $s->bindValue(':description', $product_description);
    $s->bindValue(':readiness', $product_readiness);
    $s->bindValue(':availability', $product_availability);
    $s->bindValue(':oder_id', $product_oid);
    $s->bindValue(':trash', $product_trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных. ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  
  header('Location: .');
  exit();  
	
}

if (isset($_POST['action_product']) and $_POST['action_product'] == 'РЕДАКТИРОВАТЬ')
{
	
		$product_oid = '';
		$product_id = '';
		$selected_product_name = '';
		$selected_product_readiness = '';
		$selected_product_availability = '';
		$selected_product_sex = '';
		$selected_product_material = '';
		$selected_product_color = '';
		$product_description = '';
		$selected_product_trash = '';
		$button = '';
	
		if ((isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])) && (isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])))
	{
		$product_oid = $_POST['oid'] ?? false;
		$product_id = $_POST['prid'] ?? false;
			
	}

	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'SELECT products.id AS pr_id, products.product, products.sex, products.material AS pr_mat, products.color, products.description AS pr_desc, products.readiness AS pr_read, products.availability, products.order_id AS pr_order_id, products.trash AS pr_trash  
	FROM products
	WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $product_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	
	  $row = $s->fetch();

    $pageTitle = 'Редактировать данные по изделию №' . $product_id . ' ' . 'счёт №' . $product_oid;
    $action = 'editformproduct';
	$product_id = $row['pr_id'];
	$product_oid = $row['pr_order_id'];
	$selected_product_name = $row['product'];
	$selected_product_readiness = $row['pr_read'];
	$selected_product_availability = $row['availability'];
	$selected_product_sex = $row['sex'];
	$selected_product_material = $row['pr_mat'];
	$selected_product_color = $row['color'];
	$product_description = $row['pr_desc'];
	$selected_product_trash = $row['pr_trash'];
	$button = 'Обновить данные по изделию';


	$product_names = array();
	$product_sexes = array();
	$product_materials = array();
	$product_colors = array();


	$product_readinesses = array();
	$product_availabilities = array();

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
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$product_materials = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$product_colors = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


	$product_readinesses = array('НЕ ГОТОВО', 'ГОТОВО');
	$product_availabilities = array('ПРИНЯТО', 'ВЫДАНО');
		
	
  include  'form_product.html.php';
  exit();  
	
}

if (isset($_GET['editformproduct']))
{
	
	
		$oid = '';
		$prid = '';
		$product_name = '';
		$product_readiness = '';
		$product_availability = '';
		$product_sex = '';
		$product_material = '';
		$product_color = '';
		$product_description = '';
		$product_trash = '';
	
		if ((isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])) && (isset($_POST['product_name']) && $_POST['product_name'] != '') && (isset($_POST['product_readiness']) && $_POST['product_readiness']) && (isset($_POST['product_availability']) && $_POST['product_availability']) || (isset($_POST['product_sex']) && $_POST['product_sex'] != '') || (isset($_POST['product_material']) && $_POST['product_material'] != '') || (isset($_POST['product_color']) && $_POST['product_color'] != '') || (isset($_POST['product_description']) && $_POST[''] != ''))
	{
		$oid = $_POST['oid'] ?? false;
		$prid = $_POST['prid'] ?? false;
		$product_name = $_POST['product_name'] ?? false;
		$product_readiness = $_POST['product_readiness'] ?? false;
		$product_availability = $_POST['product_availability'] ?? false;
		$product_sex = $_POST['product_sex'] ?? false;
		$product_material = $_POST['product_material'] ?? false;
		$product_color = $_POST['product_color'] ?? false;
		$product_description = $_POST['product_description'] ?? false;
		
	}
	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


  try
  {
    $sql = 'UPDATE products SET
        product = :product,
        sex = :sex,
        material = :material,
        color = :color,
        description = :description,
        readiness = :readiness,
        availability = :availability,
        order_id = :oder_id
		WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $prid);
    $s->bindValue(':product', $product_name);
    $s->bindValue(':sex', $product_sex);
    $s->bindValue(':material', $product_material);
    $s->bindValue(':color', $product_color);
    $s->bindValue(':description', $product_description);
    $s->bindValue(':readiness', $product_readiness);
    $s->bindValue(':availability', $product_availability);
    $s->bindValue(':oder_id', $oid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных. ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
  
  header('Location: .');
  exit();  
		
	
}

if (isset($_POST['action']) and $_POST['action'] == 'ПРОВЕСТИ ТРАНЗАКЦИЮ')
{
    $oid = '';
	$ca_id = '';
	$cash_in = '';
	$cash_out = '';
	$cash_type = '';
	$ca_time = '';
	$cash_desc = '';
	$cash_trash	= '';

	
	if ((isset($_POST['oid']) && $_POST['oid'] && is_numeric($_POST['oid'])) || (isset($_POST['cash_in']) && $_POST['cash_in'] != '' && is_numeric($_POST['cash_in'])) || (isset($_POST['cash_out']) && $_POST['cash_out'] != '' && is_numeric($_POST['cash_out'])) || (isset($_POST['cash_description']) && $_POST['cash_description'] != '') || (isset($_POST['ca_type']) && $_POST['ca_type']) != '')	
	{
    $oid = $_POST['oid'] ?? false;
	$cash_in = $_POST['cash_in'] ?? false;
	$cash_out = $_POST['cash_out'] ?? false;
	$cash_type = $_POST['ca_type'] ?? false;
	$cash_desc = $_POST['cash_description'] ?? false;
	$cash_trash	= 'АКТИВЕН';
		
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


  try
  {
    $sql = 'INSERT INTO cash SET
        cash_in = :cash_in,
        cash_out = :cash_out,
        cash_type = :cash_type,
        time = :time,
        description = :description,
        order_id = :oder_id,
		trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':cash_in', $cash_in);
    $s->bindValue(':cash_out', $cash_out);
    $s->bindValue(':cash_type', $cash_type);
    $s->bindValue(':time', time());
    $s->bindValue(':description', $cash_desc);
    $s->bindValue(':oder_id', $oid);
    $s->bindValue(':trash', $cash_trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных45. ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

	}

  header('Location: .');
  exit();	
	
} 

if (isset($_POST['action_cash']) and $_POST['action_cash'] == 'РЕДАКТИРОВАТЬ')
{
	
	$ca_oid = '';
	$ca_id = '';
    $pageTitle = '';
	$action = '';
	$cash_id = '';
	$cash_oid = '';
	$cash_in = '';
	$cash_out = '';
	$selected_cash_type = '';
	$cash_description = '';
	$cash_order_id = '';
	$selected_cash_trash = '';		
	$button = '';
	
		if ((isset($_POST['ca_oid']) && $_POST['ca_oid'] != '' && is_numeric($_POST['ca_oid'])) && (isset($_POST['ca_id']) && $_POST['ca_id'] != '' && is_numeric($_POST['ca_id'])))
	{
		$ca_oid = $_POST['ca_oid'] ?? false;
		$ca_id = $_POST['ca_id'] ?? false;
			
	}

	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'SELECT cash.id AS ca_id, cash.cash_in, cash.cash_out, cash.cash_type, cash.time AS ca_time, cash.description AS ca_desc, cash.order_id AS ca_order_id, cash.trash AS ca_trash  
	FROM cash
	WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $ca_id);
    $s->execute();
    
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных234.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
	
	
	  $row = $s->fetch();

    $action = 'editformcash';
	$cash_id = $row['ca_id'];
	$cash_oid = $row['ca_order_id'];
	$cash_in = $row['cash_in'];
	$cash_out = $row['cash_out'];
	$selected_cash_type = $row['cash_type'];
	$cash_description = $row['ca_desc'];
	$cash_order_id = $row['ca_order_id'];
	$selected_cash_trash = $row['ca_trash'];
    $pageTitle = 'Редактировать данные по транзакции №' . $cash_id . ' ' . 'счёт №' . $cash_oid;
	$button = 'Обновить данные по транзакции';


	$cash_type = array();
	$cash_trash = array();
	
	$cash_type = array('НАЛ', 'БЕЗНАЛ');
	$cash_trash = array('АКТИВЕН', 'УДАЛЁН');
	
	
  include  'form_cash.html.php';
  exit();  
	
}

if (isset($_GET['editformcash']))
{
	
	
		$oid = '';
		$caid = '';
		$cash_in = '';
		$cash_out = '';
		$cash_type = '';
		$cash_description = '';
	
		if ((isset($_POST['caid']) && $_POST['caid'] != '' && is_numeric($_POST['caid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])) || (isset($_POST['cash_in']) && $_POST['cash_in'] != '' && is_numeric($_POST['cash_in'])) || (isset($_POST['cash_out']) && $_POST['cash_out'] != '' && is_numeric($_POST['cash_out'])) || (isset($_POST['cash_type']) && $_POST['cash_type'] != '') || (isset($_POST['cash_description']) && $_POST['cash_description'] != ''))
	{
		$oid = $_POST['oid'] ?? false;
		$caid = $_POST['caid'] ?? false;
		$cash_in = $_POST['cash_in'] ?? false;
		$cash_out = $_POST['cash_out'] ?? false;
		$cash_type = $_POST['cash_type'] ?? false;
		$cash_description = $_POST['cash_description'] ?? false;
		
	}
	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


  try
  {
    $sql = 'UPDATE cash SET
        cash_in = :cash_in,
        cash_out = :cash_out,
        cash_type = :cash_type,
        description = :description,
        order_id = :oder_id
		WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $caid);
    $s->bindValue(':cash_in', $cash_in);
    $s->bindValue(':cash_out', $cash_out);
    $s->bindValue(':cash_type', $cash_type);
    $s->bindValue(':description', $cash_description);
    $s->bindValue(':oder_id', $oid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1. ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
  
  header('Location: .');
  exit();  
		
	
}


if (isset($_POST['action']) and $_POST['action'] == 'ОФОРМИТЬ СЧЁТ')
{ 
    $oid = '';
	$order_plus_add = '';
	$order_sale_add = '';
	$order_description = '';
	$order_state = '';
	$order_all_price = '';
	
	if ((isset($_POST['oid']) && $_POST['oid'] && is_numeric($_POST['oid'])) || (isset($_POST['order_plus_add']) && $_POST['order_plus_add'] != '' && is_numeric($_POST['order_plus_add'])) || (isset($_POST['order_sale_add']) && $_POST['order_sale_add'] != '' && is_numeric($_POST['order_sale_add'])) || (isset($_POST['order_description']) && $_POST['order_description'] != '') || (isset($_POST['order_state']) && $_POST['order_state']) != '')
	{
		$oid = $_POST['oid'] ?? false;
		$order_plus_add = $_POST['order_plus_add'] ?? false;
	    $order_sale_add = $_POST['order_sale_add'] ?? false;
		$order_description = $_POST['order_description'] ?? false;
		$order_state = $_POST['order_state'] ?? false;
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	 
  try
  {
    $sql = 'UPDATE orders SET
        plus = :plus,
        sale = :sale,
        description = :description,
		state = :state
		WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $oid);
    $s->bindValue(':plus', $order_plus_add);
    $s->bindValue(':sale', $order_sale_add);
    $s->bindValue(':description', $order_description);
    $s->bindValue(':state', $order_state);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка ввода данных1.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }	
		
	}

  
  header('Location: .');
  exit();	
	
}


if (isset($_POST['action_product']) and $_POST['action_product'] == 'УДАЛИТЬ')
{
	
	$pageTitle = '';
	$action = '';
	$number = '';
	$caid = '';
	$poid = '';
	$prid = '';
	$oid = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗДЕЛИЯ';
	$action = 'action_product';

	if ((isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])))
	{
		$prid = $_POST['prid'] ?? false;
		$oid = $_POST['oid'] ?? false;
		
	    $number = ' ИЗДЕЛИЯ №' . $prid . ' СЧЁТ №' . $oid;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
	
}

if (isset($_POST['action_product']) && $_POST['action_product'] == 'ДА')
{
	
	$prid = '';
	$oid = '';
	$order_price = '';
	$order_plus = '';
	$order_sale = '';	
	
	if ((isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])))
	{
		$prid = $_POST['prid'] ?? false;
		$oid = $_POST['oid'] ?? false;
		
	}	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  try
  {
    $sql = 'DELETE FROM points WHERE prod_id = :prod_id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':prod_id', $prid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка удаления данных.';
    include 'error.html.php';
    exit();
  }  

  try
  {
    $sql = 'DELETE FROM products WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $prid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка удаления данных.';
    include 'error.html.php';
    exit();
  }
  
  header('Location: .');
  exit();  
		
	
}


if (isset($_POST['action_point']) and $_POST['action_point'] == 'УДАЛИТЬ')
{
		
	$pageTitle = '';
	$action = '';
	$number = '';
	$caid = '';
	$poid = '';
	$prid = '';
	$oid = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ УСЛУГИ';
	$action = 'action_point';

	if ((isset($_POST['poid']) && $_POST['poid'] != '' && is_numeric($_POST['poid'])) && (isset($_POST['prid']) && $_POST['prid'] != '' && is_numeric($_POST['prid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])))
	{
		$poid = $_POST['poid'] ?? false;
		$prid = $_POST['prid'] ?? false;
		$oid = $_POST['oid'] ?? false;
		
	    $number = ' УСЛУГИ №' . $poid . ' ИЗДЕЛИЕ №' . $prid . ' СЧЁТ №' . $oid;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}	

  include  'form_confirm.html.php';
  exit();
	
}

if (isset($_POST['action_point']) && $_POST['action_point'] == 'ДА')
{
	
	$poid = '';
	$oid = '';
	$order_price = '';
	$order_plus = '';
	$order_sale = '';	
	
	if ((isset($_POST['poid']) && $_POST['poid'] != '' && is_numeric($_POST['poid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])))
	{
		$poid = $_POST['poid'] ?? false;
		$oid = $_POST['oid'] ?? false;
		
	}

	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  try
  {
    $sql = 'DELETE FROM points WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $poid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка удаления данных.';
    include 'error.html.php';
    exit();
  }  
	 
  header('Location: .');
  exit();  
		
	
}


if (isset($_POST['action_cash']) and $_POST['action_cash'] == 'УДАЛИТЬ')
{
		
	$pageTitle = '';
	$action = '';
	$number = '';
	$caid = '';
	$poid = '';
	$prid = '';
	$oid = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ТРАНЗАКЦИИ';
	$action = 'action_cash';

	if ((isset($_POST['ca_id']) && $_POST['ca_id'] != '' && is_numeric($_POST['ca_id'])) && (isset($_POST['ca_oid']) && $_POST['ca_oid'] != '' && is_numeric($_POST['ca_oid'])))
	{
		$caid = $_POST['ca_id'] ?? false;
		$oid = $_POST['ca_oid'] ?? false;
		
	    $number = ' ТРАНЗАКЦИИ №' . $caid . ' СЧЁТ №' . $oid;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}	

  include  'form_confirm.html.php';
  exit();
	
}

if (isset($_POST['action_cash']) && $_POST['action_cash'] == 'ДА')
{
	
	$caid = '';
	$oid = '';	
	
	if ((isset($_POST['caid']) && $_POST['caid'] != '' && is_numeric($_POST['caid'])) && (isset($_POST['oid']) && $_POST['oid'] != '' && is_numeric($_POST['oid'])))
	{
		$caid = $_POST['caid'] ?? false;
		$oid = $_POST['oid'] ?? false;
		
	}	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'DELETE FROM cash WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $caid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка удаления данных.';
    include 'error.html.php';
    exit();
  }

  
  header('Location: .');
  exit();  
		
	
}


 
  $button1 = '';
  $button2 = '';
  $button3 = '';
  $button4 = '';
  

  $button1 = 'ДОБАВИТЬ НОВОЕ ИЗДЕЛИЕ';
  $button2 = 'ДОБАВИТЬ НОВУЮ УСЛУГУ';
  $button3 = 'ПРОВЕСТИ ТРАНЗАКЦИЮ';
  $button4 = 'ОФОРМИТЬ СЧЁТ';  

  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

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
  $oid = '';
  $uid = '';
  $o_trash = '';
  $select_order_state = '';

  $order_states = array();	
  $order = array();
  $cash_type = array();
  $selected_cash_type = '';
  $limit = ' 1';  
	
    try
    {
    $sql = 'SELECT * FROM orders  
			ORDER BY id DESC LIMIT 1';
    $s = $pdo->query($sql);
    
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
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$product_materials = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$product_colors = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе.';
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

	$order_cash_in_all = '';
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT SUM(cash.cash_in) AS order_cash_in_all
	FROM cash
	WHERE order_id = :order_id AND trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $oid);
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

	$order_cash_out_all = '';
		
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
  
    try
    {
    $sql = 'SELECT SUM(cash.cash_out) AS order_cash_out_all
	FROM cash
	WHERE order_id = :order_id AND trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':order_id', $oid);
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
   
  	
include  'form_order.html.php';
