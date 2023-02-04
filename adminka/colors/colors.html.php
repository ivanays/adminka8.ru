<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком цветов</title>
  </head>
  <body>
    <h1>Управление списком цветов</h1>
	<fieldset>
        <legend>ЦВЕТ</legend>
    <p><a href="?add">Добавить цвет</a></p>
    <ul>
      <?php 	if (isset($colors_out) and $colors_out != '') {?>	
      <?php foreach ($colors_out as $key => $color): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($color); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="color" value="<?php echo $color; ?>">
                
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

