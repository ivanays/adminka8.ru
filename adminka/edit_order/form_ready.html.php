<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title> СЧЁТ №<?php htmlout($oid); ?>. <?php htmlout($pageTitle); ?></title>
  </head>
  <body>
    <h1> СЧЁТ №<?php htmlout($oid); ?>. <?php htmlout($pageTitle); ?></h1>
	<fieldset>
        <legend>ПОДТВЕРЖДЕНИЕ ИЗМЕНЕНИЙ</legend>	
    <form action="../edit_order/index.php" method="post">
	
	<p> СЧЁТ №<?php htmlout($oid); ?>. <?php htmlout($pageTitle); ?></p> 
  
 	</fieldset>

      <div>
        
        <input type="hidden" name="oid" id="oid" value="<?php htmlout($oid); ?>">
	  
        <input type="submit"  value="ОК">

      </div>
    </form>	
  </body>
</html>
