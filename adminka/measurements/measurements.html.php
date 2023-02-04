<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком единиц измерения</title>
  </head>
  <body>
    <h1>Управление списком единиц измерения</h1>
	<fieldset>
        <legend>ЕДИНИЦЫ ИЗМЕРЕНИЯ</legend>
    <p><a href="?add">Добавить единицу измерения</a></p>
    <ul>
      <?php 	if (isset($measurements_out) and $measurements_out != '') {?>	
      <?php foreach ($measurements_out as $key => $measurement): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($measurement); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="measurement" value="<?php echo $measurement; ?>">
                
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

