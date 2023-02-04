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
		
      <p><a href="../new_order/order_new.html.php">Оформить счёт</a></p>		
		

	  <div>
	     <label for="order_in">Номер счёта: </label>
	     <input type="number"  name="order_in" id="order_in" min="0" max="10000000" step="1"  value=""><br>
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
			    
      <?php 	if (isset($orders) and $orders != '') {?>
      <?php foreach ($orders as $order): ?>
            <li>
			 <form action="" method="post">
			 <div>
              <?php echo '№ '; ?>			
                  <?php htmlout($order['id']); ?>
              <?php //htmlout($order['price']); ?>				   
              <?php htmlout($order['plus']); ?>				   
              <?php htmlout($order['sale']); ?>				   
              <?php htmlout(date('d.m.Y H:i:s', $order['time_in'])); ?>
              <?php htmlout(date('d.m.Y H:i:s', $order['time_out'])); ?>
              <?php htmlout($order['description']); ?>				   
              <?php htmlout($order['state']); ?>				   				              
              <?php htmlout($order['user_id']); ?>				   
                <input type="hidden" name="id" value="<?php
                   $order['id']; ?>">					   
                <input type="submit" name="action" value="ПРОСМОТР СЧЁТА">
                <input type="submit" name="action" value="РЕДАКТИРОВАТЬ СЧЁТ">          
                <input type="submit" name="action" value="УДАЛИТЬ СЧЁТ В КОРЗИНУ">          
                <input type="submit" name="action" value="ВОССТАНОВЛЕНИЕ">          
                <input type="submit" name="action" value="ПОЛНОЕ УДАЛЕНИЕ"> 
				</div>
              </form>
			<li>  
          <?php endforeach; ?>
       </ul>
	  <?php } ?>
	</fieldset>		
  </body>
</html>
