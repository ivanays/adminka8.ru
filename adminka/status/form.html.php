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
        <legend>Статус</legend>
      <div>
        <label for="status">СТАТУС: <input type="text" name="status"
            id="status" value="<?php htmlout($status); ?>"></label>
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
