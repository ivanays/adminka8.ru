<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком регионов</title>
  </head>
  <body>
    <h1>Управление списком регионов</h1>
	<fieldset>
        <legend>РЕГИОНЫ</legend>
    <p><a href="?add">Добавить регион</a></p>
    <ul>
      <?php 	if (isset($regions_out) and $regions_out != '') {?>	
      <?php foreach ($regions_out as $key => $region): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($region); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="region" value="<?php echo $region; ?>">
                
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

