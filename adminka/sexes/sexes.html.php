<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком полов</title>
  </head>
  <body>
    <h1>Управление списком полов</h1>
	<fieldset>
        <legend>ПОЛОВАЯ ПРИНАДЛЕЖНОСТЬ</legend>
    <p><a href="?add">Добавить пол</a></p>
    <ul>
      <?php 	if (isset($sexes_out) and $sexes_out != '') {?>	
      <?php foreach ($sexes_out as $key => $sex): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($sex); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="sex" value="<?php echo $sex; ?>">
                
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

