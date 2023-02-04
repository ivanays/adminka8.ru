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

       <div>
        <label for="point_product_id">Номер изделия:</label>
        <select name="point_product_id" id="point_product_id">
      <?php 	if (isset($products_all) ) {?>		  
          <?php foreach ($products_all as $product): ?>
            <option value="<?php htmlout($product['pr_id']); ?>"<?php
              if ($product['pr_id'] == $product_id)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout('№ ' . $product['pr_id'] . ' ' . $product['product'] . ' ' . $product['sex'] . ' ' . $product['pr_mat'] . ' ' . $product['color'] . ' ' . $product['pr_desc'] . ' ' . $product['pr_read'] . ' ' . $product['availability'] . ' '); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>	   
       <div>
        <label for="point_service">Разновидность ремонта:</label>
        <select name="point_service" id="point_service">
      <?php 	if (isset($point_services) and $point_services != '') {?>		  
          <?php foreach ($point_services as $point_service): ?>
            <option value="<?php htmlout($point_service['id']); ?>"<?php
              if ($point_service['id'] == $selected_point_service_id)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($point_service['service'] . ' ' . $point_service['measurement'] . ' ' . $point_service['material'] . ' ' . '(от ' . $point_service['min_price'] . ' р) ' . ' ' . $point_service['description']); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
      <div>
        <label for="point_description">Примечание:</label>
        <textarea id="point_description" name="point_description" rows="3" cols="100"><?php
             if (isset($point_description) and $point_description != '')     htmlout($point_description); ?></textarea>
      </div>
	  <div>
	     <label for="point_price">Стоимость услуги: </label>
	     <input type="number"  name = "point_price" id = "point_price" min="0" max="100000" step="50"  value = "<?php htmlout($point_price); ?>"><br>
	  </div>
	  <div>
        <label for="point_readiness">Выполнение услуги:</label>
        <select name="point_readiness" id="point_readiness">
		  		<?php echo $select_point_readiness; ?>		  
	        <?php 	if (isset($point_readinesses) and $point_readinesses != '') {?>
          <?php foreach ($point_readinesses as $point_readiness): ?>
            <option value="<?php htmlout($point_readiness); ?>"<?php
              if ($point_readiness == $selected_point_readiness)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($point_readiness); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>	  
  
 	</fieldset>

      <div>
        
        <input type="hidden" name="poid" id="prid" value="<?php htmlout($poid); ?>">
        <input type="hidden" name="prid" id="prid" value="<?php htmlout($prid); ?>">
        <input type="hidden" name="oid" id="oid" value="<?php htmlout($oid); ?>">
	  
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>	
  </body>
</html>
