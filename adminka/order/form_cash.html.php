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
    <form action="?<?php htmlout($action); ?>" method="post">
		<p>
        <legend>Вид транзакции:</legend>
        <?php for ($i = 0; $i < count($cash_type); $i++): ?>          
            <label for="cash_type"><input name="cash_type" id="cash_type" type="radio"             
              value="<?php htmlout($cash_type[$i]); ?>"<?php
              if ($cash_type[$i] == $selected_cash_type)
              {
                echo ' checked';
              }
              ?>><?php htmlout($cash_type[$i]); ?></label>
        <?php endfor; ?>	  
		</p>
	  <div>
	    <label for="cash_in">ПОЛУЧЕНО: </label>
	     <input type="number"  name = "cash_in" id = "cash_in" min="0" max="100000" step="50"  value = "<?php if (isset($cash_in) and $cash_in != '')     htmlout($cash_in); ?>" />      
	  </div>
	<div>
	  <div>
	    <label for="cash_out">ВЫДАНО: </label>
	     <input type="number"  name = "cash_out" id = "cash_out" min="0" max="100000" step="50"  value = "<?php if (isset($cash_out) and $cash_out != '')     htmlout($cash_out); ?>" />      
	  </div>
	  <div>
        <label for="cash_description">Примечание:</label>
        <textarea id="cash_description" name="cash_description" rows="3" cols="100"><?php if (isset($cash_description) and $cash_description != '')     htmlout($cash_description); ?> </textarea>
      </div>		
 	</fieldset>

      <div>
        
        <input type="hidden" name="caid" id="caid" value="<?php htmlout($cash_id); ?>">
        <input type="hidden" name="oid" id="oid" value="<?php htmlout($cash_oid); ?>">
	  
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>	
  </body>
</html>
