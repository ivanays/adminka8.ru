<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>СЧЁТ №<?php htmlout($oid); ?>. <?php htmlout($pageTitle) . '.'; ?>  <?php '№' . htmlout($uid) . '.'; ?></title>
  </head>
  <body>
    <h1>СЧЁТ №<?php htmlout($oid); ?>. <?php htmlout($pageTitle); ?>  <?php '№' . htmlout($uid); ?></h1>
	<fieldset>
        <legend><?php htmlout($pageTitle); ?></legend>	
    <form action="?<?php htmlout($action); ?>" method="post">
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
      <div>
        <label for="surname">ФАМИЛИЯ: <input type="text" name="surname"
            id="surname" value="<?php htmlout($surname); ?>"></label>
      </div>
      <div>
        <label for="firstname">ИМЯ: <input type="text" name="firstname"
            id="firstname" value="<?php htmlout($firstname); ?>"></label>
      </div>
      <div>
        <label for="middle_name">ОТЧЕСТВО: <input type="text" name="middle_name"
            id="middle_name" value="<?php htmlout($middle_name); ?>"></label>
      </div>
      <div>
        <label for="operator">Операторы связи:</label>
        <select name="operator" id="operator">
		<?php echo $select_operator; ?>
          <?php foreach ($operators as $operator): ?>
            <option value="<?php htmlout($operator); ?>"<?php
              if ($operator == $selected_operator)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($operator); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="region">Регионы:</label>
        <select name="region" id="region">
		<?php echo $select_region; ?>
          <?php foreach ($regions as $region): ?>
            <option value="<?php htmlout($region); ?>"<?php
              if ($region == $selected_region)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($region); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="status">Статус:</label>
        <select name="status" id="status">
		<?php echo $select_status; ?>
          <?php foreach ($status as $status1): ?>
            <option value="<?php htmlout($status1); ?>"<?php
              if ($status1 == $selected_status)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($status1); ?></option>
          <?php endforeach; ?>
        </select>
      </div>	  
 	</fieldset>

      <div>
        
        <input type="hidden" name="guid" id="guid" value="<?php htmlout($guid); ?>">
        <input type="hidden" name="uid" id="guid" value="<?php htmlout($uid); ?>">
        <input type="hidden" name="oid" id="oid" value="<?php htmlout($oid); ?>">
	  
        <input type="submit" value="<?php htmlout($button); ?>">
      </div>
    </form>	
  </body>
</html>
