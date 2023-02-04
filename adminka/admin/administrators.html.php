<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление администраторами.</title>
  </head>
  <body>
    <h1>Управление администраторами.</h1>
	<fieldset>
        <legend>АДМИНИСТРАТОРЫ</legend>
    <p><a href="?add">Добавить администратора.</a></p>
    <ul>
      <?php 	if (isset($administrators) and $administrators != '') {?>	
      <?php foreach ($administrators as $administrator): ?>
        <li>
          <form action="" method="post">
            <div>
			  <?php htmlout($administrator['number']); ?>
              <?php echo ' ('; ?>
              <?php htmlout($administrator['number1']); ?>
              <?php echo ') '; ?>
              <?php htmlout($administrator['number2']); ?>
              <?php echo '-'; ?>
              <?php htmlout($administrator['number3']); ?>
              <?php echo '-'; ?>
              <?php htmlout($administrator['number4']); ?>
              <?php echo '   '; ?>			
              <?php htmlout($administrator['role']); ?>
              <input type="hidden" name="id" value="<?php
                  echo $administrator['id']; ?>">
              <input type="submit" name="action" value="РЕДАКТИРОВАТЬ">
              <input type="submit" name="action" value="УДАЛИТЬ">
            </div>
          </form>
        </li>
      <?php endforeach; ?>
	  <?php } ?>	  
    </ul>
</form>
	</fieldset>
	<p><a href="..">Система управлеия</a></p>
  </body>
</html>
