<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком статусов</title>
  </head>
  <body>
    <h1>Управление списком статусов</h1>
	<fieldset>
        <legend>СТАТУСЫ</legend>
    <p><a href="?add">Добавить статус</a></p>
    <ul>
      <?php 	if (isset($statuses_out) and $statuses_out != '') {?>	
      <?php foreach ($statuses_out as $key => $status): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($status); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="status" value="<?php echo $status; ?>">
                
              <?php echo $button_edit; ?>
              <?php echo $button_del; ?>				
            </div>
          </form>
        </li>
      <?php endforeach; ?>
	  <?php } ?>	 	  
    </ul>
	</fieldset>
    <p><a href="..">Система управлеия</a></p>
  </body>
</html>

