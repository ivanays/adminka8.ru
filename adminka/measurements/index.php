<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВАЯ ЕДИНИЦА ИЗМЕРЕНИЯ';
  $action = 'addform';
  $measurement = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $measurement = '';
  $measurements_in = array();
  $key = '';
	
	if (isset($_POST['measurement']) AND $_POST['measurement'] != '')
    {

      $measurement = $_POST['measurement'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "measurement".';
    include 'error.html.php';
    exit(); 
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini"))
	{
	$measurements_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($measurements_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$measurement}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ ЕДИНИЦУ ИЗМЕРЕНИЯ';
  $action = 'editform';
  $measurement = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['measurement']) && $_POST['measurement'] != '')
  {
	  $measurement = $_POST['measurement'] ?? false;
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
	
  $measurement = '';
  $measurements_in = array();
  $key = '';
	
	if (isset($_POST['measurement']) AND $_POST['measurement'] != '')
    {

      $measurement = $_POST['measurement'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "measurement".';
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


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini"))
	{
	$measurements_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($measurements_in) and $measurements_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 15);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($measurements_in) and $measurements_in != '')
	{

		foreach ($measurements_in as $key1 => $measurement1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$measurement1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$measurement}");
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
	$measurement = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА ЕДИНИЦ ИЗМЕРЕНИЯ';
	$action = 'action_measurement';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['measurement']) && $_POST['measurement'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$measurement = $_POST['measurement'] ?? false;
		
	    $number = ' ИЗ СПИСКА ЕДИНИЦ ИЗМЕРЕНИЯ' . ' ' . $measurement;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_measurement']) && $_POST['action_measurement'] == 'ДА')
{

	
  $measurement = '';
  $measurements_in = array();
  $key = '';
	
	if (isset($_POST['measurement']) AND $_POST['measurement'] != '')
    {

      $measurement = $_POST['measurement'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "measurement".';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini"))
	{
	$measurements_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($measurements_in) and $measurements_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 15);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($measurements_in) and $measurements_in != '')
	{

		foreach ($measurements_in as $key1 => $measurement1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$measurement1}");
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



        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini"))
	{
	$measurements_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'measurements.html.php';

