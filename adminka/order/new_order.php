<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';	
	
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
  
 
  header('Location: .');
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
	
    if ((isset($_POST['uid']) && $_POST['uid'] != '' && is_numeric($_POST['uid'])) || (isset($_POST['surname']) && $_POST['surname'] != '') || (isset($_POST['firstname']) && $_POST['firstname'] != '') || (isset($_POST['middle_name']) && $_POST['middle_name'] != '') || (isset($_POST['operator']) && $_POST['operator'] != '') || (isset($_POST['region']) && $_POST['region'] != '') || (isset($_POST['status']) && $_POST['status'] != '') || (isset($_POST['trash']) && $_POST['trash'] != ''))
	{
	   $uid = $_POST['uid'] ?? false;
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

?>

/*	

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

$number = '';
$names = array();
$operators = array();
$regions = array();
$status =array();
$trashes =array();
$states =array();
$orders =array();
//$row = array();
$selected_trash = '';


$number = '8';
$operators = array('BEELINE', 'MEGAFON','MTS', 'ROSTELECOM', 'TELE2', 'YOTA', 'ДРУГОЙ ОПЕРАТОР');
$regions = array('Республика Адыгея (01)','Республика Алтай (04)', 'Республика Башкортостан (02)');
$status = array('WELCOME', 'GOLD', 'BLACK JACK', 'BLACK LIST', 'ANONIMUS');
$trashes = array('АКТИВЕН', 'УДАЛЁН');
$selected_trash = 'АКТИВЕН';
$states =array('ОТКРЫТ', 'ЗАКРЫТ');
//$orders =array('oid' => $row['oid'], 'state' => $row['state'], 'time_in' => $row['time_in'], 'time_out' => $row['time_out'], 'price' => $row['price'], 'plus' => $row['plus'], 'sale' => $row['sale'], 'all_price' => $row['all_price'], 'description' => $row['description'], 'rid' => $row['rid'], 'uid' => $row['uid'], 'number' => $row['number'], 'number1' => $row['number1'], 'number2' => $row['number2'], 'number3' => $row['number3'], 'number4' => $row['number4'], 'surname' => $row['surname'], 'firstname' => $row['firstname'], 'middle_name' => $row['middle_name'], 'time_reg' => $row['time_reg'], 'operator' => $row['operator'], 'region' => $row['region'], 'status' => $row['status']);


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



include  'orders.html.php';
*/