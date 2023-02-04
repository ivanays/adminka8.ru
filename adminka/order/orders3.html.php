<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Управление счетами</title>
  </head>
  <body>
    <h1>Управление счетами</h1>
	<fieldset>
        <legend>ПОИСК 	СЧЕТОВ</legend>
	<form action="" method="post">
      <p><a href="../newoder8/index.php">Оформить счёт</a></p>
	  <div>
        <label for="readiness">Готовность:</label>
        <select name="readiness" id="readiness">
          <option value="">Выберите готовность</option>
          <?php foreach ($readiness4 as $readiness): ?>
            <option value="<?php htmlout($readiness['readiness3']); ?>"><?php
                htmlout($readiness['readiness3']); ?></option>				
          <?php endforeach; ?>
        </select>
      </div>	  
	  <div>
	    <label for="number">ТЕЛЕФОН:  <?php echo $number; ?></label>
        <label for="number1">(<input type="text" name="number1"  size = "3"  maxlength = "3" id="number1">)</label>
		<label for="number2"><input type="text" name="number2" size = "3" maxlength = "3"  id="number2">
		<label for="number3"> - <input type="text" name="number3" size = "2" maxlength = "2"  id="number3">
		<label for="number4"> - <input type="text" name="number4" size = "2" maxlength = "2"  id="number4">	
      </div>
	  
	  <div>
        <label for="name">Имена:</label>
        <select name="name" id="name">
          <option value="">Выберите имя</option>
          <?php foreach ($names as $name): ?>
            <option value="<?php htmlout($name['name']); ?>"><?php
                htmlout($name['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
	  <div>
	     <label for="numoder">Номер счёта: </label>
	     <input type="number"  name = "numoder" id = "numoder" min="0" max="10000000" step="1"  value = ""><br>
	  </div>	  
	  <div>
	    <label for="oderdate">Дата оформления счёта:</label> 
		<input type="date" name = 'oderdate' id ='oderdate' > 
      </div>
	  <div>
	     <label for="lost">Последние счета: </label>
	     <input type="number"  name = "lost" id = "lost" min="0" max="1000" step="1"  value = ""><br>
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
      <?php 	if (isset($oderes1) and $oderes1 != '') {?>
      <?php foreach ($oderes1 as $oder): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php echo 'СЧЁТ'; ?>			
              <?php htmlout($oder['O']); ?>
              <?php htmlout($oder['Ot']); ?>
              <?php htmlout($oder['readiness']); ?>
              <?php htmlout($oder['oderprice']); ?>				   
              <?php htmlout($oder['odersale']); ?>				   
              <?php htmlout($oder['odertotalprice']); ?>				   
              <?php htmlout($oder['oderdebit']); ?>				   
              <?php htmlout($oder['odercredit']); ?>				   
              <?php htmlout($oder['oderdescription']); ?>				   
              <?php htmlout($oder['G']); ?>				   
              <?php echo '/'; ?>
              <?php htmlout($oder['U']); ?>				   
              <?php htmlout($oder['number']); ?>
              <?php echo ' ('; ?>
              <?php htmlout($oder['number1']); ?>
              <?php echo ') '; ?>
              <?php htmlout($oder['number2']); ?>
              <?php echo '-'; ?>
              <?php htmlout($oder['number3']); ?>
              <?php echo '-'; ?>
              <?php htmlout($oder['number4']); ?>
              <?php echo '   '; ?>
              <?php htmlout($oder['name']); ?>			  
              <?php htmlout($oder['Ut']); ?>				   
              <?php htmlout($oder['role']); ?>				   
              <?php htmlout($oder['operator']); ?>				   
              <?php htmlout($oder['locate']); ?>				   
              <input type="hidden" name="O" value="<?php
                   htmlout($oder['O']); ?>">	
              <input type="hidden" name="G" value="<?php
                   htmlout($oder['G']); ?>">
              <input type="hidden" name="U" value="<?php
                   htmlout($oder['U']); ?>">				   
              <input type="submit" name="action" value="ПРОСМОТР СЧЁТА">
              <input type="submit" name="action" value="РЕДАКТИРОВАТЬ / УДАЛИТЬ СЧЁТ">
            </div>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
	  <?php } ?>
	</fieldset>	

	<fieldset>
        <legend>СЧЕТА</legend>
    <ul>
      <?php 	if (isset($oderes) and $oderes != '') {?>
      <?php foreach ($oderes as $oder): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php echo 'СЧЁТ'; ?>			
              <?php htmlout($oder['O']); ?>
              <?php htmlout($oder['Ot']); ?>
              <?php htmlout($oder['readiness']); ?>
              <?php htmlout($oder['oderprice']); ?>				   
              <?php htmlout($oder['odersale']); ?>				   
              <?php htmlout($oder['odertotalprice']); ?>				   
              <?php htmlout($oder['oderdebit']); ?>				   
              <?php htmlout($oder['odercredit']); ?>				   
              <?php htmlout($oder['oderdescription']); ?>				   
              <?php htmlout($oder['G']); ?>				   
              <?php echo '/'; ?>
              <?php htmlout($oder['U']); ?>				   
              <?php htmlout($oder['number']); ?>
              <?php echo ' ('; ?>
              <?php htmlout($oder['number1']); ?>
              <?php echo ') '; ?>
              <?php htmlout($oder['number2']); ?>
              <?php echo '-'; ?>
              <?php htmlout($oder['number3']); ?>
              <?php echo '-'; ?>
              <?php htmlout($oder['number4']); ?>
              <?php echo '   '; ?>
              <?php htmlout($oder['name']); ?>			  
              <?php htmlout($oder['Ut']); ?>				   
              <?php htmlout($oder['role']); ?>				   
              <?php htmlout($oder['operator']); ?>				   
              <?php htmlout($oder['locate']); ?>				   
              <input type="hidden" name="O" value="<?php
                   htmlout($oder['O']); ?>">	
              <input type="hidden" name="G" value="<?php
                   htmlout($oder['G']); ?>">
              <input type="hidden" name="U" value="<?php
                   htmlout($oder['U']); ?>">				   
              <input type="submit" name="action1" value="ПРОСМОТР СЧЁТА">
              <input type="submit" name="action1" value="УДАЛИТЬ СЧЁТ">			  
              <input type="submit" name="action" value="РЕДАКТИРОВАТЬ СЧЁТ">
            </div>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
	  <?php } ?>	  	
	</fieldset>		
  </body>
</html>
