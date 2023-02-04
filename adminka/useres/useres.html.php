<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление клиентами</title>
  </head>
  <body>
    <h1>Управление клиентами</h1>
	<fieldset>
        <legend>ПОИСК КЛИЕНТОВ</legend>
	<form action="" method="post">
      <p><a href="?add">Добавить клиента</a></p>
	  <div>
	    <label for="number">ТЕЛЕФОН:  <?php echo $number; ?></label>
        <label for="number1">(<input type="text" name="number1"  size = "3"  maxlength = "3" id="number1">)</label>
		<label for="number2"><input type="text" name="number2" size = "3" maxlength = "3"  id="number2">
		<label for="number3"> - <input type="text" name="number3" size = "2" maxlength = "2"  id="number3">
		<label for="number4"> - <input type="text" name="number4" size = "2" maxlength = "2"  id="number4">	
      </div>
	  <div>
        <label for="name">ФИО:</label>
        <select name="name" id="name">
          <option value="">Выберите ФИО</option>
          <?php foreach ($names as $name): ?>
            <option value="<?php htmlout($name['surname'] . $name['firstname'] . $name['middle_name']); ?>"><?php
                htmlout($name['surname'] . ' ' . $name['firstname'] . ' ' . $name['middle_name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="status">Статус:</label>
        <select name="status" id="status">
          <option value="">Выберите статус</option>
          <?php foreach ($status as $status1): ?>
            <option value="<?php htmlout($status1); ?>"><?php
                htmlout($status1); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="operator">Операторы связи:</label>
        <select name="operator" id="operator">
          <option value="">Выберите оператора связи</option>
          <?php foreach ($operators as $operator): ?>
            <option value="<?php htmlout($operator); ?>"><?php
                htmlout($operator); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label for="region">Регионы:</label>
        <select name="region" id="region">
          <option value="">Выберите регион</option>
          <?php foreach ($regions as $region): ?>
            <option value="<?php htmlout($region); ?>"><?php
                htmlout($region); ?></option>
          <?php endforeach; ?>
        </select>
      </div>	  
	  <div>
	    <label for="date">Дата регистрации:</label> 
		<input type="date" name = "date" id ="date" > 
      </div>
	  <div>
	     <label for="lost">Последние регистрации: </label>
	     <input type="number"  name = "lost" id = "lost" min="0" max="1000" step="1"  value = ""><br>
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
      <div>
        <input type="hidden" name="action" value="search">
        <input type="submit" value="ПОИСК">
      </div>
    </form>
	</fieldset>
	<p><a href="?">Новый поиск</a></p>
    <p><a href="..">Система управлеия</a></p>	
	<fieldset>
        <legend>РЕЗУЛЬТАТ ПОИСКА</legend>
    <ul>
      <?php 	if (isset($useres) and $useres != '') {?>
      <?php foreach ($useres as $user): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php htmlout($user['number']); ?>
              <?php echo ' ('; ?>
              <?php htmlout($user['number1']); ?>
              <?php echo ') '; ?>
              <?php htmlout($user['number2']); ?>
              <?php echo '-'; ?>
              <?php htmlout($user['number3']); ?>
              <?php echo '-'; ?>
              <?php htmlout($user['number4']); ?>
              <?php echo '   '; ?>
              <?php htmlout($user['surname']); ?>
              <?php htmlout($user['firstname']); ?>
              <?php htmlout($user['middle_name']); ?>
              <?php htmlout($user['time_reg']); ?>
              <?php htmlout($user['operator']); ?>
              <?php htmlout($user['region']); ?>			  
              <?php htmlout($user['status']); ?>				   	
              <input type="hidden" name="uid" value="<?php
                   htmlout($user['uid']); ?>">
              <?php if ($user['trash'] == $trash_out) { ?>				   
              <?php echo $input_edit; ?>
              <?php echo $input_group; ?>
              <?php echo $input_addgroup; ?>
              <?php echo $input_intrash; ?>
			  <?php } elseif ($user['trash'] == $trash_in) {?>
              <?php echo $input_outtrash; ?>
              <?php echo $input_devnull; ?>
              <?php } ?>
            </div>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
	  <?php } ?>
	</fieldset>	

  </body>
</html>
