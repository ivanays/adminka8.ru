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
        <legend>Новая услуга:</legend>
      <div>
        <label for="service">УСЛУГА: <input type="text" name="service"
            id="service" value="<?php htmlout($service); ?>"></label>
      </div>
      <div>
        <label for="measurement">Единица измерения:</label>
        <select name="measurement" id="measurement">
		<?php echo $select_measurement; ?>
          <?php foreach ($measurements as $measurement): ?>
            <option value="<?php htmlout($measurement); ?>"<?php
              if ($measurement == $selected_measurement)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($measurement); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="material">Материал:</label>
        <select name="material" id="material">
		<?php echo $select_material; ?>
          <?php foreach ($materials as $material): ?>
            <option value="<?php htmlout($material); ?>"<?php
              if ($material == $selected_material)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($material); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="min_price">Минимальная цена: <input type="number" min="00000.00" max="90000.00" step="50.00" name="min_price"
            id="min_price" value="<?php htmlout($min_price); ?>"></label>
      </div>
      <div>
        <label for="description">Примечание:</label>
        <textarea id="description" name="description" rows="3" cols="100"><?php
             if (isset($description) and $description != '')     htmlout($description); ?></textarea>
      </div>
		<div>
			<legend>Активность:</legend>
        <?php for ($i = 0; $i < count($trashes); $i++): ?>          
            <label for="trash"><input name="trash" id="trash" type="radio"             
              value="<?php htmlout($trashes[$i]); ?>"<?php
              if ($trashes[$i] == $selected_trash)
              {
                echo ' checked';
              }
              ?>><?php htmlout($trashes[$i]); ?></label>
        <?php endfor; ?>	  
		</div>	  
      </fieldset>
      <div>
        <input type="hidden" name="sid" value="<?php
            htmlout($sid); ?>">
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>
	<p><a href=".">Управление услугами</a></p>
  </body>
</html>
