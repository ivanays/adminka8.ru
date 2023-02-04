<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВЫЙ МАТЕРИАЛ';
  $action = 'addform';
  $material = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $material = '';
  $materials_in = array();
  $key = '';
	
	if (isset($_POST['material']) AND $_POST['material'] != '')
    {

      $material = $_POST['material'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "sex".';
    include 'error.html.php';
    exit(); 
	}


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$materials_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($materials_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$material}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ МАТЕРИАЛ';
  $action = 'editform';
  $material = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['material']) && $_POST['material'] != '')
  {
	  $material = $_POST['material'] ?? false;
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
  $materials_in = array();
  $key = '';
	
	if (isset($_POST['material']) AND $_POST['material'] != '')
    {

      $material = $_POST['material'] ?? false;	
		
    
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$materials_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($materials_in) and $materials_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 12);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($materials_in) and $materials_in != '')
	{

		foreach ($materials_in as $key1 => $material1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$material1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$material}");
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
	$material = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА МАТЕРИАЛОВ';
	$action = 'action_material';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['material']) && $_POST['material'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$material = $_POST['material'] ?? false;
		
	    $number = ' ИЗ СПИСКА МАТЕРИАЛОВ' . ' ' . $material;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_material']) && $_POST['action_material'] == 'ДА')
{

	
  $material = '';
  $materials_in = array();
  $key = '';
	
	if (isset($_POST['material']) AND $_POST['material'] != '')
    {

      $material = $_POST['material'] ?? false;	
		
    
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$materials_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($materials_in) and $materials_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 12);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($materials_in) and $materials_in != '')
	{

		foreach ($materials_in as $key1 => $material1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$material1}");
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




        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$materials_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'materials.html.php';

