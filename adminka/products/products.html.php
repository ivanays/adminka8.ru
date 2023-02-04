<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
//include $_SERVER['DOCUMENT_ROOT'] . '/includes/array_all.inc.php';	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление списком изделий</title>
  </head>
  <body>
    <h1>Управление списком изделий</h1>
	<fieldset>
        <legend>ИЗДЕЛИЯ</legend>
    <p><a href="?add">Добавить изделие</a></p>
    <ul>
      <?php 	if (isset($products_out) and $products_out != '') {?>	
      <?php foreach ($products_out as $key => $product): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($product); ?>
		<input type="hidden" name="key" value="<?php echo $key; ?>">
                <input type="hidden" name="product" value="<?php echo $product; ?>">
                
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

