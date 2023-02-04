<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (isset($_GET['add']))
{
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  $pageTitle = 'НОВАЯ УСЛУГА';
  $action = 'addform';
  $sid = '';
  $service = '';
  $measurement = '';
  $material = '';
  $min_price = '';
  $description = '';
  $trash = '';


  $maasurements = array();
  $materials = array();
  $trashes = array();


  $selected_measurement = '';
  $selected_material = '';
  $selected_trash = '';
  $select_measurement = '';
  $select_material = '';
  $button = 'ДОБАВИТЬ УСЛУГУ';

  $min_price = '00000.00';
  $selected_trash = 'АКТИВЕН';


        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$materials = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini"))
	{
	$measurements = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $trashes = array('АКТИВЕН', 'УДАЛЁН');
  $select_measurement = '<option value="">Выберите 	единицу измерения</option>';
  $select_material = '<option value="">Выберите материал</option>';

  include 'form.html.php';
  exit();
}

if (isset($_GET['addform']))
{
	
  $sid = '';
  $service = '';
  $measurement = '';
  $material = '';
  $min_price = '';
  $description = '';
  $trash = '';
  
	
	if ((!isset($_POST['service']) AND $_POST['service'] == '') AND (!isset($_POST['measurement']) AND $_POST['measurement'] == '') OR (!isset($_POST['material']) AND $_POST['material'] == '') AND (!isset($_POST['min_price']) AND $_POST['min_price'] == '') AND (!isset($_POST['trash']) AND $_POST['trash'] == ''))
    {		
    $error = 'Пожалуйста, заполните поля1.';
    include 'error.html.php';
    exit();     
    }
	else
	{
      $service = $_POST['service'] ?? false;
      $measurement = $_POST['measurement'] ?? false;
      $material = $_POST['material'] ?? false;
      $min_price = $_POST['min_price'] ?? false;
      $trash = $_POST['trash'];	
	}

    if (isset($_POST['description']) AND $_POST['description'] != '')
	{
      $description = $_POST['description'] ?? false;
	}
	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'INSERT INTO services SET
        service = :service,
        measurement = :measurement,
        material = :material,
        min_price = :min_price,
        description = :description,
        trash = :trash';
    $s = $pdo->prepare($sql);
    $s->bindValue(':service', $service);
    $s->bindValue(':measurement', $measurement);
    $s->bindValue(':material', $material);
    $s->bindValue(':min_price', $min_price);
    $s->bindValue(':description', $description);
    $s->bindValue(':trash', $trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Добавить услугу не удалось.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'РЕДАКТИРОВАТЬ')
{

  $sid = '';
  $service = '';
  $measurement = '';
  $material = '';
  $min_price = '';
  $description = '';
  $trash = '';

	
  $maasurements = array();
  $materials = array();
  $trashes = array();


  $selected_measurement = '';
  $selected_material = '';
  $selected_trash = '';
  $select_measurement = '';
  $select_material = '';
  
  if (isset($_POST['sid']) && $_POST['sid'] != '' && is_numeric($_POST['sid']))
  {
	  $sid = $_POST['sid'] ?? false;
  }  
  
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'SELECT services.id, services.service, services.measurement, services.material, services.min_price, services.description, services.trash FROM services WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $sid);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Ошибка выборки данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  $pageTitle = 'РЕДАКТИРОВАТЬ';
  $action = 'editform';
  $sid = $row['id'];
  $service = $row['service'];
  $selected_measurement = $row['measurement'];
  $selected_material = $row['material'];
  $min_price = $row['min_price'];
  $description = $row['description'];
  $selected_trash = $row['trash'];

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini"))
	{
	$materials = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/materials.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}

        if (is_readable("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini"))
	{
	$measurements = parse_ini_file("C:/OpenServer/domains/adminka2.ru/ini_files/measurements.ini", false);	
	} else

        {
	$error = 'Отказано в доступе.';
        include 'error.html.php';
	exit();
	}


  $trashes = array('АКТИВЕН', 'УДАЛЁН');
  $button = 'ОБНОВИТЬ'; 

  include 'form.html.php';
  exit();
}

if (isset($_GET['editform']))
{
	
	
  $sid = '';
  $service = '';
  $measurement = '';
  $material = '';
  $min_price = '';
  $description = '';
  $trash = '';
  
	
	if ((!isset($_POST['sid']) AND $_POST['sid'] == '' AND !is_numeric($_POST['sid'])) AND (!isset($_POST['service']) AND $_POST['service'] == '') AND (!isset($_POST['measurement']) AND $_POST['measurement'] == '') OR (!isset($_POST['material']) AND $_POST['material'] == '') AND (!isset($_POST['min_price']) AND $_POST['min_price'] == '') AND (!isset($_POST['trash']) AND $_POST['trash'] == ''))
    {		
    $error = 'Пожалуйста, заполните поля1.';
    include 'error.html.php';
    exit();     
    }
	else
	{
	  $sid = $_POST['sid'] ?? false;
      $service = $_POST['service'] ?? false;
      $measurement = $_POST['measurement'] ?? false;
      $material = $_POST['material'] ?? false;
      $min_price = $_POST['min_price'] ?? false;
      $trash = $_POST['trash'];	
	}

    if (isset($_POST['description']) AND $_POST['description'] != '')
	{
      $description = $_POST['description'] ?? false;
	}
	
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  try
  {
    $sql = 'UPDATE services SET
        service = :service,
        measurement = :measurement,
        material = :material,
        min_price = :min_price,
        description = :description,
        trash = :trash
		WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $sid);
    $s->bindValue(':service', $service);
    $s->bindValue(':measurement', $measurement);
    $s->bindValue(':material', $material);
    $s->bindValue(':min_price', $min_price);
    $s->bindValue(':description', $description);
    $s->bindValue(':trash', $trash);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Редактировать услугу не удалось.' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
 
  header('Location: .');
  exit();
}


if (isset($_POST['action']) and $_POST['action'] == 'УДАЛИТЬ В КОРЗИНУ')
{
		
	$sid = '';
	$trash = '';
	$trash = 'УДАЛЁН';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['sid']) && $_POST['sid'] != '' && is_numeric($_POST['sid']))
  {
	$sid = $_POST['sid'] ?? false;

    try
    {
      $sql = 'UPDATE services SET
          trash = :trash
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':id', $sid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
  }	

  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'ВОССТАНОВЛЕНИЕ')
{
	
	$sid = '';
	$trash = '';
	$trash = 'АКТИВЕН';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['sid']) && $_POST['sid'] != '' && is_numeric($_POST['sid']))
  {
	$sid = $_POST['sid'] ?? false;

    try
    {
      $sql = 'UPDATE services SET
          trash = :trash
          WHERE id = :id';
      $s = $pdo->prepare($sql);
      $s->bindValue(':id', $sid);
      $s->bindValue(':trash', $trash);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Ошибка удаления в корзину.' . $e->getMessage();
      include 'error.html.php';
      exit();
    }
  }
  
  header('Location: .');
  exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'ПОЛНОЕ УДАЛЕНИЕ')
{
	
	$sid = '';
	
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
  
   if (isset($_POST['sid']) && $_POST['sid'] != '' && is_numeric($_POST['sid']))
  {
	$sid = $_POST['sid'] ?? false;
	
	try
    {
    $sql = 'DELETE FROM services WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $sid);
    $s->execute();
    }
    catch (PDOException $e)
    {
    $error = 'Ошибка удаления данных.' . $e->getMessage();
    include 'error.html.php';
    exit();
    }
		
  } 
  
  header('Location: .');
  exit();
}


include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  $input_edit = '';
  $input_intrash = '';
  $input_outtrash = '';
  $input_devnull = '';
  $trash_out = '';
  $trash_in = '';
  
  $input_edit = '<input type="submit" name="action" value="РЕДАКТИРОВАТЬ">';
  $input_intrash = '<input type="submit" name="action" value="УДАЛИТЬ В КОРЗИНУ">';
  $input_outtrash = '<input type="submit" name="action" value="ВОССТАНОВЛЕНИЕ">';
  $input_devnull = '<input type="submit" name="action" value="ПОЛНОЕ УДАЛЕНИЕ">';  
  $trash_out = 'АКТИВЕН';
  $trash_in = 'УДАЛЁН';

  $services = array();

try
{
	$sql1 = 'SELECT services.id AS sid, services.service, services.measurement, services.material, services.min_price, services.description, services.trash     
		FROM services'; 
								
  $result1 = $pdo->query($sql1);
}
catch (PDOException $e)
{
  $error = 'Ошибка выборки данных.' . $e->getMessage();
  include 'error.html.php';
  exit();
}

foreach ($result1 as $row)
{
  $services[] = array('sid' => $row['sid'], 'service' => $row['service'], 'measurement' => $row['measurement'], 'material' => $row['material'], 'min_price' => $row['min_price'], 'description' => $row['description'], 'trash' => $row['trash']);
}

include 'services.html.php';

