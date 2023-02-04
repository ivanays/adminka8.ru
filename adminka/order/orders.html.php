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
	     <label for="order">Номер счёта: </label>
	     <input type="number"  name="order" id="order" min="0" max="10000000" step="1"  value=""><br>
	  </div>	  
	  <div>
	    <label for="date_in">Дата открытия счёта:</label> 
		<input type="date" name="date_in" id="date_in" > 
      </div>
	  <div>
	    <label for="date_out">Дата закрытия счёта:</label> 
		<input type="date" name="date_out" id="date_out" > 
      </div>	  
	  <div>
	     <label for="lost">Последние счета: </label>
	     <input type="number"  name="lost" id="lost" min="0" max="1000" step="1"  value = ""><br>
	  </div>
	  <div>
        <label for="state">Состояние счета:</label>
        <select name="state" id="state">
          <option value="">Выберите состояние счета</option>
          <?php foreach ($states as $state): ?>
            <option value="<?php htmlout($state); ?>"><?php
                htmlout($state); ?></option>				
          <?php endforeach; ?>
        </select>
      </div>
		<div>
        <legend>Активность:</legend>
        <?php for ($i = 0; $i < count($trashes); $i++): ?>          
            <label for="o_trash"><input name="o_trash" id="o_trash" type="radio"             
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
      <?php 	if (isset($orders) and $orders != '') {?>
      <?php foreach ($orders as $order): ?>
      <fieldset>
        <legend> СЧЁТ № <?php  htmlout($order['oid']); ?> от <?php   htmlout(date('d.m.Y H:i:s', $order['time_in'])); ?></legend>	  
      <ul>
			 <form action="../edit_order/index.php" method="post">	  
            <li>
              <?php echo 'счёт № '; ?>			
                  <?php htmlout($order['oid']); ?>
              <?php $oid = $order['oid']; ?>			  
              <?php echo ' ' . '|' . ' ' . 'сумма:' . ' '; ?>
              <?php htmlout(order_price($order['oid'])); ?>
              <?php echo ' ' . '&#8381;'; ?>				   
              <?php $order_price_in = order_price($order['oid']); ?>			  
              <?php $order_product_in = order_product($order['oid']); ?>			  
              <?php $order_cash_in = order_cash($order['oid']); ?>			  
              <?php echo ' ' . '|' . ' ' . 'доплата:' . ' '; ?>
              <?php htmlout($order['plus']); ?>				   
              <?php echo ' ' . '&#8381;'; ?>				   
              <?php echo ' ' . '|' . ' ' . 'скидка:' . ' '; ?>
              <?php htmlout($order['sale']); ?>				   
              <?php echo ' ' . '&#8381;'; ?>				   
              <?php echo ' ' . '|' . ' ' . 'ИТОГО К ОПЛАТЕ:' . ' '; ?>
              <?php htmlout(order_price_all($order_price_in, $order['plus'], $order['sale'])); ?>				   
              <?php echo ' ' . '&#8381;'; ?>
              <?php echo ' ' . '|' . ' ' . 'ПОЛУЧЕНО:' . ' '; ?>
              <?php htmlout(order_cash_in_all($order['oid'])); ?>				   
              <?php echo ' ' . '&#8381;'; ?>
              <?php echo ' ' . '|' . ' ' . 'ВЫДАНО:' . ' '; ?>
              <?php htmlout(order_cash_out_all($order['oid'])); ?>				   
              <?php echo ' ' . '&#8381;'; ?>				   				   
              <?php echo ' ' . '|' . ' ' . 'откр. счёта:' . ' '; ?>
              <?php htmlout(date('d.m.Y H:i:s', $order['time_in'])); ?>
              <?php echo ' ' . '|' . ' ' . 'закр. счёта:' . ' '; ?>
              <?php if ($order['time_out'] != '0000000000') htmlout(date('d.m.Y H:i:s', $order['time_out'])); ?>				   
              <?php echo ' ' . '|' . ' ' . 'сост-ние счета:' . ' '; ?>
              <?php htmlout($order['state']); ?>
			<ul>
			<li>	
              <?php echo 'кл-нт № '; ?>			
                  <?php htmlout($order['uid']); ?>
              <?php $order_group_user = order_group_user($order['uid']); ?>			  				  
              <?php echo ' ' . '|' . ' ' . 'тел:' . ' '; ?>
              <?php htmlout($order['number']); ?>
                  <?php echo ' ('; ?>
                  <?php htmlout($order['number1']); ?>
                  <?php echo ') '; ?>
                  <?php htmlout($order['number2']); ?>
                  <?php echo '-'; ?>
                  <?php htmlout($order['number3']); ?>
                  <?php echo '-'; ?>
                  <?php htmlout($order['number4']); ?>
              <?php echo ' ' . '|' . ' ' . 'ФИО:' . ' '; ?>
              <?php htmlout($order['surname']); ?>				   
              <?php htmlout($order['firstname']); ?>				   
              <?php htmlout($order['middle_name']); ?>				   
              <?php echo ' ' . '|' . ' ' . 'рег-ция:' . ' '; ?>
              <?php htmlout(date('d.m.Y H:i:s', $order['time_reg'])); ?>				   
              <?php echo ' ' . '|' . ' ' . 'оп-тор связи:' . ' '; ?>
              <?php htmlout($order['operator']); ?>				   
              <?php echo ' ' . '|' . ' ' . 'регион:' . ' '; ?>
              <?php htmlout($order['region']); ?>				   
              <?php echo ' ' . '|' . ' ' . 'статус:' . ' '; ?>
              <?php htmlout($order['status']); ?>				   				  
			<ul>
			      <?php 	if (isset($order_group_user)) {?>
                <?php foreach ($order_group_user as $group_user): ?>
              <?php if ($group_user['uid'] != $group_user['group_id']) { ?>				
			<li>
              <?php echo 'гр-па № '; ?>			
                  <?php htmlout($group_user['group_id']); ?>			
              <?php echo 'кл-нт № '; ?>			
                  <?php htmlout($group_user['uid']); ?>
              <?php echo ' ' . '|' . ' ' . 'тел:' . ' '; ?>
              <?php htmlout($group_user['number']); ?>
                  <?php echo ' ('; ?>
                  <?php htmlout($group_user['number1']); ?>
                  <?php echo ') '; ?>
                  <?php htmlout($group_user['number2']); ?>
                  <?php echo '-'; ?>
                  <?php htmlout($group_user['number3']); ?>
                  <?php echo '-'; ?>
                  <?php htmlout($group_user['number4']); ?>
              <?php echo ' ' . '|' . ' ' . 'ФИО:' . ' '; ?>
              <?php htmlout($group_user['surname']); ?>				   
              <?php htmlout($group_user['firstname']); ?>				   
              <?php htmlout($group_user['middle_name']); ?>				   
              <?php echo ' ' . '|' . ' ' . 'рег-ция:' . ' '; ?>
              <?php htmlout($group_user['time_reg']); ?>				   				   
              <?php echo ' ' . '|' . ' ' . 'оп-тор связи:' . ' '; ?>
              <?php htmlout($group_user['operator']); ?>				   
              <?php echo ' ' . '|' . ' ' . 'регион:' . ' '; ?>
              <?php htmlout($group_user['region']); ?>				   
              <?php echo ' ' . '|' . ' ' . 'статус:' . ' '; ?>
              <?php htmlout($group_user['status']); ?>				   				  		         
			</li>
	  <?php } ?>        
          <?php endforeach; ?>			
						     
	  <?php } ?> 
       <ul>
      <?php 	if (isset($order_product_in)) {?>
      <?php foreach ($order_product_in as $product): ?>	   
          <li>
              <?php echo 'из-лие №'; ?>
              <?php echo htmlout($product['pr_id']); ?>
              <?php $pr_id = $product['pr_id']; ?>
              <?php echo ' '; ?>
              <?php echo ' ' . '|' . ' ' . 'изделие:' . ' '; ?>
              <?php htmlout($product['product']); ?>
              <?php echo ' '; ?>
              <?php echo ' ' . '|' . ' ' . 'пол:' . ' '; ?>
              <?php htmlout($product['sex']); ?>
              <?php echo ' '; ?>
              <?php echo ' ' . '|' . ' ' . 'материал:' . ' '; ?>
              <?php htmlout($product['pr_mat']); ?>
              <?php echo ' '; ?>
              <?php echo ' ' . '|' . ' ' . 'цвет:' . ' '; ?>
              <?php htmlout($product['color']); ?>
              <?php echo ' ' . '|' . ' ' . 'ст-ть изделия:' . ' '; ?>
              <?php htmlout(product_price($pr_id)); ?>
              <?php echo ' ' . '&#8381;'; ?>				   				   
              <?php $points_all_in = points_all($pr_id); ?>				   
              <?php echo '   '; ?>
              <?php echo ' ' . '|' . ' ' . 'наличие:' . ' '; ?>
              <?php htmlout($product['availability']); ?>									   
              <?php echo '   '; ?>
              <?php echo ' ' . '|' . ' ' . 'гот-сть:' . ' '; ?>
              <?php htmlout($product['pr_read']); ?>
           </li>
		<ul>
      <?php 	if (isset($points_all_in)) {?>
      <?php foreach ($points_all_in as $point): ?>  
          <li>			
              <?php echo 'ус-га №'; ?>
              <?php echo htmlout($point['po_id']); ?>
              <?php echo ' ' . '|' . ' ' . 'вид ус-ги:' . ' '; ?>
              <?php htmlout($point['service']); ?>
              <?php echo ' ' . '|' . ' ' . 'ед. изм-ния:' . ' '; ?>
              <?php htmlout($point['measurement']); ?>
              <?php echo ' '; ?>
              <?php echo ' ' . '|' . ' ' . 'материал:' . ' '; ?>
              <?php htmlout($point['se_mat']); ?>
              <?php echo ' ' . '|' . ' ' . 'ст-ть ус-ги:' . ' '; ?>
              <?php htmlout($point['po_price']); ?>
              <?php echo ' ' . '&#8381;'; ?>				   				   
              <?php echo ' ' . '|' . ' ' . 'гот-сть:' . ' '; ?>
              <?php htmlout($point['po_read']); ?>
           </li>
			<?php // }?>		  
      <?php endforeach; ?>		   
			<?php  }?>
   <ul>
      <?php 	if (isset($order_cash_in)) {?>
      <?php foreach ($order_cash_in as $cash): ?>
        <li>
              <?php echo 'тр-ция №'; ?>
              <?php htmlout($cash['ca_id']); ?>
              <?php echo ' ' . '|' . ' ' . 'принято:' . ' '; ?>
              <?php htmlout($cash['cash_in']); ?>
              <?php echo ' ' . '&#8381;'; ?>				   				   
              <?php echo ' ' . '|' . ' ' . 'выдано:' . ' '; ?>
              <?php htmlout($cash['cash_out']); ?>
              <?php echo ' ' . '&#8381;'; ?>				   				   
              <?php echo ' ' . '|' . ' ' . 'вид тр-ции:' . ' '; ?>
              <?php htmlout($cash['cash_type']); ?>
              <?php echo ' ' . '|' . ' ' . 'время тр-ции:' . ' '; ?>
              <?php htmlout($cash['ca_time']); ?>				   	
        </li>				
      <?php endforeach; ?>
    </ul>
			<?php  }?>			
        </ul>				   
      <?php endforeach; ?>		   
			<?php  }?>
		</ul>	
        </ul>	  
			</li>
			</ul>
			</li>  
       </ul>
       <ul>
	        <li>
		         <div>
                <input type="hidden" name="oid" id="oid" value="<?php htmlout($order['oid']); ?>">
                </div>
              <?php echo 'опции: '; ?>					
			  <?php if ($order['o_trash'] == $trash_out) { ?>				   
              <?php echo $input_vew_order; ?>
              <?php echo $input_edit_order; ?>
              <?php echo $input_intrash_order; ?>
			  <?php } elseif ($order['o_trash'] == $trash_in) {?>
              <?php echo $input_outtrash_order; ?>
              <?php echo $input_devnull_order; ?>			  
              <?php } ?>
	        </li>
       </ul>
	</fieldset>		  
              </form>
	<?php endforeach; ?>
	  <?php } ?>
	</fieldset>			
  </body>
</html>
