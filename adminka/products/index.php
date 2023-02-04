<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (isset($_GET['add']))
{

  $pageTitle = 'НОВОЕ ИЗДЕЛИЕ';
  $action = 'addform';
  $product = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $product = '';
  $products_in = array();
  $key = '';
	
	if (isset($_POST['product']) AND $_POST['product'] != '')
    {

      $product = $_POST['product'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "produc".';
    include 'error.html.php';
    exit(); 
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini"))
	{
	$products_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($products_in);
	$key = $count + 1;
	
	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$product}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ ИЗДЕЛИЕ';
  $action = 'editform';
  $product = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['product']) && $_POST['product'] != '')
  {
	  $product = $_POST['product'] ?? false;
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
	
  $product = '';
  $products_in = array();
  $key = '';
	
	if (isset($_POST['product']) AND $_POST['product'] != '')
    {

      $product = $_POST['product'] ?? false;	
		
    
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini"))
	{
	$products_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($products_in) and $products_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 11);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($products_in) and $products_in != '')
	{

		foreach ($products_in as $key1 => $product1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$product1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$product}");
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
	$product = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ИЗ СПИСКА ИЗДЕЛИЙ';
	$action = 'action_product';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['product']) && $_POST['product'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$product = $_POST['product'] ?? false;
		
	    $number = ' ИЗ СПИСКА ИЗДЕЛИЙ' . ' ' . $product;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_product']) && $_POST['action_product'] == 'ДА')
{

	
  $product = '';
  $products_in = array();
  $key = '';
	
	if (isset($_POST['product']) AND $_POST['product'] != '')
    {

      $product = $_POST['product'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "product".';
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini"))
	{
	$products_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($products_in) and $products_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini', "r+t") or die("Ошибка!");
			    
			    ftruncate ($f, 11);
                            fseek($f, SEEK_END); 

                             
			    fclose($f);
			} else

			{
			$error = 'Отказано в доступе.';
		    	include 'error.html.php';
		    	exit();
			 }
	}	

	if (isset($products_in) and $products_in != '')
	{

		foreach ($products_in as $key1 => $product1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/products.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$product1}");
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini"))
	{
	$products_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/products.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'products.html.php';

