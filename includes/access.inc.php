<?php

function userIsLoggedIn()
{
  if (isset($_POST['action']) and $_POST['action'] == 'login')
  {
    if (!isset($_POST['number1']) or $_POST['number1'] == '' or !isset($_POST['number2']) or $_POST['number2'] == '' or !isset($_POST['number3']) or $_POST['number3'] == '' or !isset($_POST['number4']) or $_POST['number4'] == '' or !isset($_POST['password']) or $_POST['password'] == '')
    {		
    $error = 'Пожалуйста, заполните поля.';
    include 'error.html.php';
    exit();     
    }
	
	if (!is_numeric($_POST['number1']) or !is_numeric($_POST['number2']) or !is_numeric($_POST['number3']) or !is_numeric($_POST['number4']))
    {		
    $error = 'Номер телефна введён некорректно.';
    include 'error.html.php';
    exit();     
    }
	
	$number1 = $_POST['number1'] ?? false;
	$number2 = $_POST['number2'] ?? false;
	$number3 = $_POST['number3'] ?? false;
	$number4 = $_POST['number4'] ?? false;		
	$password = $_POST['password'] ?? false;

	$phone = '';
	$phone = $number1 . $number2 . $number3 . $number4;
	
   $password = md5($password.'adminka');
 

    if (databaseContainsAuthor($phone, $password))
    {
      session_start();
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['phone'] = $phone;	  
      $_SESSION['password'] = $password;
      return TRUE;
    }
    else
    {
      session_start();
      unset($_SESSION['loggedIn']);
	  unset($_SESSION['phone']);
      unset($_SESSION['password']);	  
    $error = 'Указанное имя или пароль были неверны..';
    include 'error.html.php';
    exit();
    }
  }

  if (isset($_POST['action']) and $_POST['action'] == 'logout')
  {
    session_start();
    unset($_SESSION['loggedIn']);
	unset($_SESSION['phone']);
    unset($_SESSION['password']);
    header('Location: '.$_POST['goto']);
    exit();
  }

  session_start();
  if (isset($_SESSION['loggedIn']))
  {
    return databaseContainsAuthor($_SESSION['phone'], $_SESSION['password']);
  }
}

function databaseContainsAuthor($phone, $password)
{
	
  include 'db.inc.php';
  
  try
  {
    $sql = 'SELECT COUNT(*) FROM admin
        WHERE phone = :phone AND pswd = :password';
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $phone);
    $s->bindValue(':password', $password);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка службы аунтификации.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  if ($row[0] > 0)
  {
    return TRUE;
  }
  else
  {
    return FALSE;
  }   
}


function userHasRole($role)
{
  include 'db.inc.php';

  try
  {
    $sql = "SELECT COUNT(*) FROM admin
        WHERE phone = :phone AND role = :role";
    $s = $pdo->prepare($sql);
    $s->bindValue(':phone', $_SESSION['phone']);
    $s->bindValue(':role', $role);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка службы привилегий.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  if ($row[0] > 0)
  {
    return TRUE;
  }
  else
  {
    return FALSE;
  }
}
