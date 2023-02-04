<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title><?php htmlout($pageTitle); ?></title>
  </head>
  <body>
    <h1><?php htmlout($pageTitle); ?></h1>
	<fieldset>
        <legend><?php htmlout($pageTitle); ?></legend>	
    <form action="" method="post">
	
	<p>ПОДТВЕРДИТЕ УДАЛЕНИЕ <?php ' ' . htmlout($number) . ' ' . '!'; ?> 
  
 	</fieldset>

      <div>
        
        <input type="hidden" name="key" id="key" value="<?php htmlout($key); ?>">
        <input type="hidden" name="sex" id="sex" value="<?php htmlout($sex); ?>">
	  
        <input type="submit" name="<?php htmlout($action); ?>" value="<?php htmlout($button_yes); ?>">
        <input type="submit" name="<?php htmlout($action); ?>" value="<?php htmlout($button_no); ?>">
        <input type="submit" name="<?php htmlout($action); ?>" value="<?php htmlout($button_cancel); ?>">
      </div>
    </form>	
  </body>
</html>
