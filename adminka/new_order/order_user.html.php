<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Оформление счёта</title>
  </head>
  <body>
    <h1>Оформление счёта</h1>

	<fieldset>
        <legend>КЛИЕНТ</legend>
    <ul>
      <?php 	if (isset($useres1) and $useres1 != '') {?>
      <?php foreach ($useres1 as $user): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($user['number']); ?>
              <?php echo ' ('; ?>
              <?php htmlout($user['number1']); ?>
              <?php echo ') '; ?>
              <?php htmlout($user['number2']); ?>
              <?php echo '-'; ?>
              <?php htmlout($user['number3']); ?>
              <?php echo '-'; ?>
              <?php htmlout($user['number4']); ?>
              <?php echo '   '; ?>
              <?php htmlout($user['name']); ?>
              <?php htmlout($user['time']); ?>
              <?php htmlout($user['role']); ?>
              <?php htmlout($user['operator']); ?>
              <?php htmlout($user['locate']); ?>			  
              <?php htmlout($user['B']); ?>
              <?php htmlout($user['A']); ?>				   
              <input type="hidden" name="id" value="<?php
                   htmlout($user['B']); ?>">	
              <input type="hidden" name="A" value="<?php
                   htmlout($user['A']); ?>">					   
              <input type="submit" name="action" value="РЕДАКТИРОВАТЬ">
              <input type="submit" name="action" value="ГРУППА">
              <input type="submit" name="action" value="ДОБАВИТЬ В ГРУППУ">
              <input type="submit" name="action" value="ОФОРМЛЕНИЕ ЗАКАЗА">
            </div>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
	  <?php } ?>
	</fieldset>	
  </body>
</html>
