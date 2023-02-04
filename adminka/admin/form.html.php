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
      <div>
	  <div>
        <label for="number1">ТЕЛЕФОН:  8 ( <input type="text" name="number1" size = "3" maxlength = "3" 
            id="number1" value="<?php htmlout($number1); ?>"></label>
		<label for="number2">) <input type="text" name="number2" size = "3" maxlength = "3" 
            id="number2" value="<?php htmlout($number2); ?>"></label>
		<label for="number3"> - <input type="text" name="number3" size = "2" maxlength = "2" 
            id="number3" value="<?php htmlout($number3); ?>"></label>
		<label for="number4"> - <input type="text" name="number4" size = "2" maxlength = "2" 
            id="number4" value="<?php htmlout($number4); ?>"></label>	
      </div>
      <div>
        <label for="password">ПАРОЛЬ: <input type="password"
            name="password" id="password"></label>
      </div>	  
      <fieldset>
        <legend>ПРИВИЛЕГИИ:</legend>
        <?php for ($i = 0; $i < count($roles); $i++): ?>
          <div>
            <label for="role"><input name="role" id="role" type="radio"             
              value="<?php htmlout($roles[$i]); ?>"<?php
              if ($roles[$i] == $selected)
              {
                echo ' checked';
              }
              ?>><?php htmlout($roles[$i]); ?></label>
          </div>
        <?php endfor; ?>
      </fieldset>
      <div>
        <input type="hidden" name="id" value="<?php
            htmlout($id); ?>">
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>
	<p><a href=".">Управление администраторами</a></p>
  </body>
</html>
