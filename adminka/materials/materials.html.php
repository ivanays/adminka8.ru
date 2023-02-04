<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком материалов</title>
  </head>
  <body>
    <h1>Управление списком материалов</h1>
	<fieldset>
        <legend>МАТЕРИАЛЫ</legend>
    <p><a href="?add">Добавить материал</a></p>
    <ul>
      <?php 	if (isset($materials_out) and $materials_out != '') {?>	
      <?php foreach ($materials_out as $key => $material): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($material); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="material" value="<?php echo $material; ?>">
                
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

