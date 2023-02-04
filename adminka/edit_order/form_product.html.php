<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>СЧЁТ №<?php htmlout($product_oid); ?>. ИЗДЕЛИЕ №<?php htmlout($product_id); ?>. <?php htmlout($pageTitle); ?></title>
  </head>
  <body>
    <h1>СЧЁТ №<?php htmlout($product_oid); ?>. ИЗДЕЛИЕ №<?php htmlout($product_id); ?>. <?php htmlout($pageTitle); ?></h1>
	<fieldset>
        <legend><?php htmlout($pageTitle); ?></legend>	
    <form action="?<?php htmlout($action); ?>" method="post">
      <div>
        <label for="product_name">Вид изделия:</label>
        <select name="product_name" id="product_name">          
      <?php 	if (isset($product_names) and $product_names != '') {?>		  
          <?php foreach ($product_names as $product_name): ?>
            <option value="<?php htmlout($product_name); ?>"<?php
              if ($product_name == $selected_product_name)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($product_name); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_sex">Половая пренадлежность:</label>
        <select name="product_sex" id="product_sex">          
      <?php 	if (isset($product_sexes) and $product_sexes != '') {?>		  
          <?php foreach ($product_sexes as $product_sex): ?>
            <option value="<?php htmlout($product_sex); ?>"<?php
              if ($product_sex == $selected_product_sex)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($product_sex); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_material">Материал:</label>
        <select name="product_material" id="product_material">          
      <?php 	if (isset($product_materials) and $product_materials != '') {?>		  
          <?php foreach ($product_materials as $product_material): ?>
            <option value="<?php htmlout($product_material); ?>"<?php
              if ($product_material == $selected_product_material)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($product_material); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_color">Цвет изделия:</label>
        <select name="product_color" id="product_color">          
      <?php 	if (isset($product_colors) and $product_colors != '') {?>		  
          <?php foreach ($product_colors as $product_color): ?>
            <option value="<?php htmlout($product_color); ?>"<?php
              if ($product_color == $selected_product_color)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($product_color); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
      <div>
        <label for="product_description">Примечание:</label>
        <textarea id="product_description" name="product_description" rows="3" cols="100"><?php
            if (isset($product_description) and $product_description != '') htmlout($product_description); ?></textarea>
      </div>
       <div>
        <label for="product_readiness">Готовность изделия:</label>
        <select name="product_readiness" id="product_readiness">
		  		<?php echo $select_product_readiness; ?>			  
      <?php 	if (isset($product_readinesses) and $product_readinesses != '') {?>		  
          <?php foreach ($product_readinesses as $product_readiness): ?>
            <option value="<?php htmlout($product_readiness); ?>"<?php
              if ($product_readiness == $selected_product_readiness)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($product_readiness); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_availability">Наличие изделия:</label>
        <select name="product_availability" id="product_">
		  		<?php echo $select_product_availability; ?>			  
      <?php 	if (isset($product_availabilities) and $product_availabilities != '') {?>		  
          <?php foreach ($product_availabilities as $product_availability): ?>
            <option value="<?php htmlout($product_availability); ?>"<?php
              if ($product_availability == $selected_product_availability)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($product_availability); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>	  
  
 	</fieldset>

      <div>
        
        <input type="hidden" name="prid" id="prid" value="<?php htmlout($product_id); ?>">
        <input type="hidden" name="oid" id="oid" value="<?php htmlout($product_oid); ?>">
	  
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>	
  </body>
</html>
