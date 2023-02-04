<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

//  $operator1 = '';

if (isset($_GET['add']))
{

  $pageTitle = 'НОВЫЙ ОПЕРАТОР СВЯЗИ';
  $action = 'addform';
  $operator = '';
  $key = '';
  $button = 'ДОБАВИТЬ';


  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $operator = '';
  $operators_in = array();
  
	
	if (isset($_POST['operator']) AND $_POST['operator'] != '')
    {

      $operator = $_POST['operator'] ?? false;	
		
    
    }
	else
	{
    $error = 'Пожалуйста, заполните поле "ОПЕРАТОР".';
    include 'error.html.php';
    exit(); 
	}





        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	$count = '';
	$count = count($operators_in);
	$key = $count + 1;
	

	
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$operator}");
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


  $pageTitle = 'РЕДАКТИРОВАТЬ ОПЕРАТОРА СВЯЗИ';
  $action = 'editform';
  $operator = '';
  $key = '';
  $button = 'РЕДАКТИРОВАТЬ';
  
  if (isset($_POST['operator']) && $_POST['operator'] != '')
  {
	  $operator = $_POST['operator'] ?? false;
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
	
  $operator = '';
  $operators_in = array();
  $key = '';
	
	if (isset($_POST['operator']) AND $_POST['operator'] != '')
    {

      $operator = $_POST['operator'] ?? false;	
		
    
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($operators_in) and $operators_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini', "r+t") or die("Ошибка!");
			    
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

	if (isset($operators_in) and $operators_in != '')
	{

		foreach ($operators_in as $key1 => $operator1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$operator1}");
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
			
			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key}={$operator}");
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
	$operator = '';
	$button_yes = '';
	$button_no = '';
	$button_cancel = '';
	
	$pageTitle = 'УДАЛЕНИЕ ОПЕРАТОРА СВЯЗИ';
	$action = 'action_operator';

	if ((isset($_POST['key']) && $_POST['key'] != '' && is_numeric($_POST['key'])) && (isset($_POST['operator']) && $_POST['operator'] != ''))
	{
		$key = $_POST['key'] ?? false;
		$operator = $_POST['operator'] ?? false;
		
	    $number = ' ОПЕРАТОРА СВЯЗИ' . ' ' . $operator;
		
	$button_yes = 'ДА';
	$button_no = 'НЕТ';
	$button_cancel = 'ОТМЕНА';
	}

  include  'form_confirm.html.php';
  exit();
}


if (isset($_POST['action_operator']) && $_POST['action_operator'] == 'ДА')
{

	
  $operator = '';
  $operators_in = array();
  $key = '';
	
	if (isset($_POST['operator']) AND $_POST['operator'] != '')
    {

      $operator = $_POST['operator'] ?? false;	
		
    
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators_in = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

	if (isset($operators_in) and $operators_in != '')
	{	

			if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini'))
			{
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini', "r+t") or die("Ошибка!");
			    
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

	if (isset($operators_in) and $operators_in != '')
	{

		foreach ($operators_in as $key1 => $operator1)
		{
			
			if ($key1 != $key) 
			{			

			    if (is_writeable('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini'))
			    {
			    $f = fopen('C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini', "a+t") or die("Ошибка!");

			    fseek($f, SEEK_END);

			    fwrite($f, "\n{$key1}={$operator1}");
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

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini"))
	{
	$operators_out = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/operators.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

  $button_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $button_del = '<input type="submit" name="action" value="УДАЛИТЬ">';

include 'operators.html.php';

