<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php htmlout($pageTitle); ?></title>
  </head>
  <body>
    <h1><?php htmlout($pageTitle); ?></h1>
    <form action="?<?php htmlout($action); ?>" method="post">
      <fieldset>
        <legend>Изделие</legend>
      <div>
        <label for="product">ИЗДЕЛИЕ: <input type="text" name="product"
            id="product" value="<?php htmlout($product); ?>"></label>
	<input type="hidden" name="key" id="key" value="<?php htmlout($key); ?>"></label>
      </div>	  
      </fieldset>
      <div>
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>
	<p><a href=".">Управление услугами</a></p>
  </body>
</html>
