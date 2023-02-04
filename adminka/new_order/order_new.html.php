<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; 
	
	$pageTitle = 'ОФОРМЛЕНИЕ СЧЁТА: ВВЕДИТЕ НОМЕР ТЕЛЕФОНА';	
	
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title><?php htmlout($pageTitle); ?></title>
  </head>
  <body>
    <h1><?php htmlout($pageTitle); ?></h1>	
	<fieldset>
        <legend>ОФОРМЛЕНИЕ СЧЁТА</legend>
  <div>
   <form action="../new_order/index.php" method="post">
	  <div>
        <label for="number1">ТЕЛЕФОН:  8 ( <input type="text" name="number1" size = "3" maxlength = "3" 
            id="number1"></label>
		<label for="number2">) <input type="text" name="number2" size = "3" maxlength = "3" 
            id="number2"></label>
		<label for="number3"> - <input type="text" name="number3" size = "2" maxlength = "2" 
            id="number3"></label>
		<label for="number4"> - <input type="text" name="number4" size = "2" maxlength = "2" 
            id="number4"></label>
      </div>			
      <div>			
        <input type="hidden" name="action" value="new">
	    <input type="submit"   value="ПРОДОЛЖИТЬ" />
      </div>			
	</form>
  </div>
 	</fieldset>
  </body>
</html>