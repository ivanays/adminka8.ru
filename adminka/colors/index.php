<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВЫЙ ЦВЕТ';
  $action = 'addform';
  $color = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $color = '';
  $colors_in = array();
  $key = '';
	
	if (isset($_POST['color']) AND $_POST['color'] != '')
    {

      $color = $_POST['color'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "colors".';
    include 'error.html.php';
    exit(); 
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$colors_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


	$count = '';
	$count = count($colors_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$color}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ ЦВЕТ';
  $action = 'editform';
  $color = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['color']) && $_POST['color'] != '')
  {
	  $color = $_POST['color'] ?? false;
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
	
  $color = '';
  $colors_in = array();
  $key = '';
	
	if (isset($_POST['color']) AND $_POST['color'] != '')
    {

      $color = $_POST['color'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "materials".';
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


//	$colors_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$colors_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($colors_in) and $colors_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini', "r+t") or die("Ошибка!");
			    
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

	if (isset($colors_in) and $colors_in != '')
	{

		foreach ($colors_in as $key1 => $color1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$color1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$color}");
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
	$color = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА ЦВЕТОВ';
	$action = 'action_color';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['color']) && $_POST['color'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$color = $_POST['color'] ?? false;
		
	    $number = ' ИЗ СПИСКА ЦВЕТОВ' . ' ' . $color;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_color']) && $_POST['action_color'] == 'ДА')
{

	
  $color = '';
  $colors_in = array();
  $key = '';
	
	if (isset($_POST['color']) AND $_POST['color'] != '')
    {

      $color = $_POST['color'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "color".';
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




        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$colors_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($colors_in) and $colors_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini', "r+t") or die("Ошибка!");
			    
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

	if (isset($colors_in) and $colors_in != '')
	{

		foreach ($colors_in as $key1 => $color1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$color1}");
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

	if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini"))
	{
	$colors_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/colors.ini", false);
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'colors.html.php';

