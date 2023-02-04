<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление услугами</title>
  </head>
  <body>
    <h1>Управление услугами</h1>
	<fieldset>
        <legend>УСЛУГИ</legend>
    <p><a href="?add">Добавить услугу</a></p>
    <ul>
      <?php 	if (isset($services) and $services != '') {?>	
      <?php foreach ($services as $service): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($service['service']); ?>
              <?php htmlout($service['measurement']); ?>
              <?php htmlout($service['material']); ?>
              от <?php htmlout($service['min_price']); ?> руб
              <?php htmlout($service['description']); ?>
              <input type="hidden" name="sid" value="<?php
                  echo $service['sid']; ?>">
              <?php if ($service['trash'] == $trash_out) { ?>				   
              <?php echo $input_edit; ?>
              <?php echo $input_intrash; ?>
			  <?php } elseif ($service['trash'] == $trash_in) {?>
              <?php echo $input_outtrash; ?>
              <?php echo $input_devnull; ?>
              <?php } ?>				  
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

