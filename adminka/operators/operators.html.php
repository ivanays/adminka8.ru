<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление операторами связи</title>
  </head>
  <body>
    <h1>Управление операторами связи</h1>
	<fieldset>
        <legend>ОПЕРАТОРЫ СВЯЗИ</legend>
    <p><a href="?add">Добавить оператора связи</a></p>
    <ul>
      <?php 	if (isset($operators_out) and $operators_out != '') {?>	
      <?php foreach ($operators_out as $key => $operator): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($operator); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="operator" value="<?php echo $operator; ?>">
                
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

