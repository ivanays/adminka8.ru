<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (isset($_GET['add']))
{
	
  $action = 'editform';
  
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  $pageTitle = 'НОВЫЙ АДМИНИСТРАТОР';
  $action = 'addform';
  $number1 = '';
  $number2 = ''; 
  $number3 = '';
  $number4 = '';
  $password = '';
  $id = '';
  $button = 'ДОБАВИТЬ АДМИНИСТРАТОРА';

  //

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_admin.inc.php';

//  $roles = array();
//  $roles = array('superadmin', 'moderator', 'anonim');
 
  $selected = '';  

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	$password = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';	
	$role = '';
	$role = 'anonim';
	
		
  if ($_POST['number1'] != '' && is_numeric($_POST['number1']) && $_POST['number2'] != '' && is_numeric($_POST['number2']) && $_POST['number3'] != '' && is_numeric($_POST['number3']) && $_POST['number4'] != '' && is_numeric($_POST['number4']))
  {
	  $number1 = $_POST['number1'] ?? false;
	  $number2 = $_POST['number2'] ?? false;
	  $number3 = $_POST['number3'] ?? false;
	  $number4 = $_POST['number4'] ?? false;
	  
	  $phone = '';
	  $phone = $number1 .  $number2 . $number3 . $number4 ;
  }
	else 
	{
		$error = 'Номер введён не корректно.';
    include 'error.html.php';
	exit();
	}

	if (isset($_POST['role']) && $_POST['role'] != '')
	{
		$role = $_POST['role'] ?? false;	
	  }
	else 
	{
		$error = 'Заполните поля.';
    include 'error.html.php';
	exit();
	}
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'INSERT INTO admin SET
        phone = :phone,
		role = :role';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':role', $role);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Добавить администратора не удалось.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
	

  $adminid = $pdo->lastInsertId();

  if ($_POST['password'] != '') 
  {
	$password = $_POST['password'] ?? false;  
    $password = md5($password . 'adminka');

    try
    {
      $sql = 'UPDATE admin SET
          pswd = :pswd
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':pswd', $password);
      $s->bindValue(':id', $adminid);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка установки пароля.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'РЕДАКТИРОВАТЬ')
{
	
	
	if ($_POST['id'] != '')
	{
		
	$id = '';
	$phone = '';
	$role = '';
    $action = '';
	$selected = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';		
	
	$id = $_POST['id'] ?? false;
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'SELECT id, phone, role FROM admin WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $id);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка выборки данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  $pageTitle = 'РЕДАКТИРОВАТЬ ДАННЫЕ АДМИНИСТРАТОРА';
  $action = 'editform';
  $phone = $row['phone'];
  $role = $row['role'];
  $id = $row['id'];
  $button = 'ОБНОВИТЬ ДАННЫЕ АДМИНИСТРАТОРА';
  $number1 = substr($row['phone'], 0, 3);
  $number2 = substr($row['phone'], 3, 3);
  $number3 = substr($row['phone'], 6, 2);
  $number4 = substr($row['phone'], 8, 2);

    include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_admin.inc.php';

//  $roles = array();
//  $roles = array('superadmin', 'moderator', 'anonim');

  $selected = $role;
  }
  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
	
	$id = '';
	$phone = '';
	$role = '';
    $action = '';
	$selected = '';
	$number1 = '';
	$number2 = '';
	$number3 = '';
	$number4 = '';
	$password = '';
	
	if ($_POST['id'] != '' && $_POST['role'] != '' && $_POST['number1'] != '' && is_numeric($_POST['number1']) && $_POST['number2'] != '' && is_numeric($_POST['number2']) && $_POST['number3'] != '' && is_numeric($_POST['number3']) && $_POST['number4'] != '' && is_numeric($_POST['number4']))
	{
	
	$id = $_POST['id'] ?? false;
	$number1 = $_POST['number1'] ?? false;
	$number2 = $_POST['number2'] ?? false;
	$number3 = $_POST['number3'] ?? false;
	$number4 = $_POST['number4'] ?? false;	
	$role = $_POST['role'] ?? false;	
	
	$password = $_POST['password'] ?? false;	
	$password = md5($password . 'adminka');
    $phone = $number1 . $number2 . $number3 . $number4;
	
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
    $sql = 'UPDATE admin SET
        phone = :phone,
        pswd = :pswd,
        role = :role
        WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $id);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':pswd', $password);
    $s->bindValue(':role', $role);
    $s->execute();
   }
   catch (PDOException $e)
   {
    $error = 'Ошибка обновления данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
   }
   }

  header('Location: .');
  exit();
}

    if (isset($_POST['action']) and $_POST['action'] == 'УДАЛИТЬ')
    {
	
	$id = '';
	
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

   if ($_POST['id'] != '')
   {
	   
	   $id = $_POST['id'] ?? false;

    try
    {
    $sql = 'DELETE FROM admin WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $id);
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


    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    try
    {
	$sql = 'SELECT id, phone, pswd, role FROM admin';
						
    $result = $pdo->query($sql);
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка выборки данных!' . $e->getMessage();
    include 'error.html.php';
    exit();
    }

    foreach ($result as $row)
    {
    $administrators[] = array('id' => $row['id'], 'phone' => ($row['phone']), 'number' => '8', 'number1' => substr($row['phone'], 0, 3), 'number2' => substr($row['phone'], 3, 3), 'number3' => substr($row['phone'], 6, 2), 'number4' => substr($row['phone'], 8, 2), 'pswd' => $row['pswd'], 'role' => $row['role']);
    }

include 'administrators.html.php';
