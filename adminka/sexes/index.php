<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВЫЙ ПОЛ';
  $action = 'addform';
  $sex = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $sex = '';
  $sexes_in = array();
  $key = '';
	
	if (isset($_POST['sex']) AND $_POST['sex'] != '')
    {

      $sex = $_POST['sex'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "sex".';
    include 'error.html.php';
    exit(); 
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini"))
	{
	$sexes_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($sexes_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$sex}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ ПОЛ';
  $action = 'editform';
  $sex = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['sex']) && $_POST['sex'] != '')
  {
	  $sex = $_POST['sex'] ?? false;
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
	
  $sex = '';
  $sexes_in = array();
  $key = '';
	
	if (isset($_POST['sex']) AND $_POST['sex'] != '')
    {

      $sex = $_POST['sex'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "region".';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini"))
	{
	$sexes_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($sexes_in) and $sexes_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 8);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($sexes_in) and $sexes_in != '')
	{

		foreach ($sexes_in as $key1 => $sex1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$sex1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$sex}");
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
	$sex = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА ПОЛОВ';
	$action = 'action_sex';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['sex']) && $_POST['sex'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$sex = $_POST['sex'] ?? false;
		
	    $number = ' ИЗ СПИСКА ПОЛОВ' . ' ' . $sex;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_sex']) && $_POST['action_sex'] == 'ДА')
{

	
  $sex = '';
  $sexes_in = array();
  $key = '';
	
	if (isset($_POST['sex']) AND $_POST['sex'] != '')
    {

      $sex = $_POST['sex'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "sex".';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini"))
	{
	$sexes_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($sexes_in) and $sexes_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 8);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($sexes_in) and $sexes_in != '')
	{

		foreach ($sexes_in as $key1 => $sex1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$sex1}");
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini"))
	{
	$sexes_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/sexes.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'sexes.html.php';

