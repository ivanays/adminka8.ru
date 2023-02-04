<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВЫЙ РЕГИОН';
  $action = 'addform';
  $region = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $region = '';
  $regions_in = array();
  $key = '';
	
	if (isset($_POST['region']) AND $_POST['region'] != '')
    {

      $region = $_POST['region'] ?? false;	
		    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "РЕГИОН".';
    include 'error.html.php';
    exit(); 
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($regions_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$region}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ РЕГИОН';
  $action = 'editform';
  $region = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['region']) && $_POST['region'] != '')
  {
	  $region = $_POST['region'] ?? false;
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
	
  $region = '';
  $regions_in = array();
  $key = '';
	
	if (isset($_POST['region']) AND $_POST['region'] != '')
    {

      $region = $_POST['region'] ?? false;	
		
    
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($regions_in) and $regions_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 10);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($regions_in) and $regions_in != '')
	{

		foreach ($regions_in as $key1 => $region1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$region1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$region}");
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
	$region = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА РЕГИОНОВ';
	$action = 'action_region';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['region']) && $_POST['region'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$region = $_POST['region'] ?? false;
		
	    $number = ' ИЗ СПИСКА РЕГИОНОВ' . ' ' . $region;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_region']) && $_POST['action_region'] == 'ДА')
{

	
  $region = '';
  $regions_in = array();
  $key = '';
	
	if (isset($_POST['region']) AND $_POST['region'] != '')
    {

      $region = $_POST['region'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "ОПЕРАТОР".';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($regions_in) and $regions_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 10);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($regions_in) and $regions_in != '')
	{

		foreach ($regions_in as $key1 => $region1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$region1}");
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



        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini"))
	{
	$regions_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/regions.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'regions.html.php';

