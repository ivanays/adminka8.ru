<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВЫЙ СТАТУС';
  $action = 'addform';
  $status = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $status = '';
  $statuses_in = array();
  $key = '';
	
	if (isset($_POST['status']) AND $_POST['status'] != '')
    {

      $status = $_POST['status'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "status".';
    include 'error.html.php';
    exit(); 
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$statuses_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($statuses_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$status}");
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'РЕДАКТИРОВАТЬ')
{


  $pageTitle = 'РЕДАКТИРОВАТЬ СТАТУС';
  $action = 'editform';
  $status = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['status']) && $_POST['status'] != '')
  {
	  $status = $_POST['status'] ?? false;
  }

	else
	{
   $error = 'Ошибкаop.';
    include 'error.html.php';
    exit(); 
	}

  if (isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key']))
  {
	  $key = $_POST['key'] ?? false;
  }

	else
	{
    $error = 'Ошибкаke.';
    include 'error.html.php';
    exit(); 
	}  




  include 'form.html.php';
  exit();
}



if (isset($_GET['editform']))
{
	
  $status = '';
  $statuses_in = array();
  $key = '';
	
	if (isset($_POST['status']) AND $_POST['status'] != '')
    {

      $status = $_POST['status'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "status".';
    include 'error.html.php';
    exit(); 
	}

  if (isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key']))
  {
	  $key = $_POST['key'] ?? false;
  }

	else
	{
    $error = 'Ошибкаke.';
    include 'error.html.php';
    exit(); 
	} 

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$statuses_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($statuses_in) and $statuses_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 9);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($statuses_in) and $statuses_in != '')
	{

		foreach ($statuses_in as $key1 => $status1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$status1}");
			    fclose($f);
			    } else

			    {
			     $error = 'Отказано в доступе.';
		    	     include 'error.html.php';
		    	     exit();
			    }
			}
			elseif ($key1 == $key) 
			{
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$status}");
			    fclose($f);
			    } else

			    {
			    $error = 'Отказано в доступе.';
		    	    include 'error.html.php';
		    	    exit();
			    }
			}


		}
	}

	
			


  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'УДАЛИТЬ')
{
			
	$pageTitle = '';
	$action = '';
	$number = '';
	$key = '';
	$status = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА СТАТУСОВ';
	$action = 'action_status';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['status']) && $_POST['status'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$status = $_POST['status'] ?? false;
		
	    $number = ' ИЗ СПИСКА СТАТУСОВ' . ' ' . $status;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_status']) && $_POST['action_status'] == 'ДА')
{

	
  $status = '';
  $statuses_in = array();
  $key = '';
	
	if (isset($_POST['status']) AND $_POST['status'] != '')
    {

      $status = $_POST['status'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "statuses".';
    include 'error.html.php';
    exit(); 
	}

  if (isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key']))
  {
	  $key = $_POST['key'] ?? false;
  }

	else
	{
    $error = 'Ошибкаke.';
    include 'error.html.php';
    exit(); 
	} 

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$statuses_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($statuses_in) and $statuses_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 9);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($statuses_in) and $statuses_in != '')
	{

		foreach ($statuses_in as $key1 => $status1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/status.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$status1}");
			    fclose($f);
			    } else

			    {
			     $error = 'Отказано в доступе.';
		    	     include 'error.html.php';
		    	     exit();
			    }
			}

	      }	

	}	

  header('Location: .');
  exit();  	
}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini"))
	{
	$statuses_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/status.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'status.html.php';

