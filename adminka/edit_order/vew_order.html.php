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
        <legend> СЧЁТ № <?php   if (isset($oid) and $oid != '')  htmlout($oid); ?> от <?php   if (isset($time_in) and $time_in != '') echo  date('d.m.Y H:i:s', $time_in); ?></legend>
		
      <fieldset>
        <legend>ДАННЫЕ КЛИЕНТА № <?php   if (isset($uid) and $uid != '')  htmlout($uid); ?></legend>
   <ul>
      <?php 	if (isset($useres)) {?>
      <?php foreach ($useres as $user): ?>
      <?php 	if ($user['uid'] == $user['group_id']) {?>
        <li>				   
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
            </div>			
        </li>
              <?php } elseif ($user['uid'] != $user['group_id']) { ?>
		<ul>	  
        <li>		  
            <div>
              <?php echo 'кл-нт №'; ?>			
              <?php htmlout($user['uid']); ?>
              <?php echo ' '; ?>
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
            </div>
        </li>
		</ul>
	  <?php } ?>	  
      <?php endforeach; ?>
    </ul>
	  <?php } else  { ?>
	  <?php echo 'НЕТ ДАННЫХ О КЛИЕНТЕ'; ?>
			<?php  }?>	  			  
      </fieldset>
	  
      <fieldset>
        <legend>ИЗДЕЛИЯ И УСЛУГИ</legend>	  
	<div>
       <ul>
      <?php 	if (isset($products_all)) {?>
      <?php foreach ($products_all as $product): ?>	   
          <li>
            <div>
              <?php echo 'ИЗДЕЛИЕ №'; ?>
              <?php echo htmlout($product['pr_id']); ?>
              <?php $pr_id = $product['pr_id']; ?>
              <?php echo ' '; ?>
              <?php htmlout($product['product']); ?>
              <?php echo ' '; ?>
              <?php htmlout($product['sex']); ?>
              <?php echo ' '; ?>
              <?php htmlout($product['pr_mat']); ?>
              <?php echo ' '; ?>
              <?php htmlout($product['color']); ?>
              <?php echo ' '; ?>
              <?php htmlout($product['pr_desc']); ?>
              <?php echo ' '; ?>
              <?php htmlout(vew_product_price($pr_id)); ?>
              <?php $points_all_in = vew_points_all($pr_id); ?>				   
              <?php echo '   '; ?>
              <?php htmlout($product['pr_read']); ?>
              <?php echo '   '; ?>
              <?php htmlout($product['availability']); ?>									   
            </div>
           </li>
		<ul>
      <?php 	if (isset($points_all_in)) {?>
      <?php foreach ($points_all_in as $point): ?>	  
          <li>
            <div>			
              <?php echo 'УСЛУГА №'; ?>
              <?php echo htmlout($point['po_id']); ?>
              <?php htmlout($point['service']); ?>
              <?php echo ' '; ?>
              <?php htmlout($point['measurement']); ?>
              <?php echo ' '; ?>
              <?php htmlout($point['se_mat']); ?>
              <?php echo ' '; ?>
              <?php htmlout($point['se_desc']); ?>
              <?php echo ' '; ?>
              <?php htmlout($point['po_desc']); ?>
              <?php echo ' '; ?>
              <?php htmlout($point['po_price']); ?>
              <?php echo ' '; ?>
              <?php //htmlout($point['pr_price']); ?>				   
              <?php echo '   '; ?>
              <?php htmlout($point['po_read']); ?>				   
            </div>
           </li>
			<?php // }?>		  
      <?php endforeach; ?>		   
	  <?php } else  { ?> 
	  <?php echo 'НЕТ ДАННЫХ ОБ УСЛУГАХ'; ?>
			<?php  }?>		  
        </ul>				   
      <?php endforeach; ?>		   
	  <?php } else  { ?> 
	  <?php echo 'НЕТ ДАННЫХ ОБ ИЗДЕЛИЯХ'; ?>
			<?php  }?>		  		
        </ul>
    </div> 		  
      </fieldset>	 
	  	  <fieldset>
        <legend>ТРАНЗАКЦИИ </legend>
		
	<div>
   <ul>
      <?php 	if (isset($cashes)) {?>
      <?php foreach ($cashes as $cash): ?>
        <li>
     		<div>
              <?php echo ' №'; ?>
              <?php htmlout($cash['ca_id']); ?>
              <?php echo ' '; ?>
              <?php htmlout($cash['cash_in']); ?>
              <?php echo ' '; ?>
              <?php htmlout($cash['cash_out']); ?>
              <?php echo ' '; ?>
              <?php htmlout($cash['cash_type']); ?>
              <?php echo ' '; ?>
              <?php htmlout($cash['ca_time']); ?>
              <?php echo '   '; ?>
              <?php htmlout($cash['ca_desc']); ?>				   	
            </div>			
        </li>				
      <?php endforeach; ?>
    </ul>
	  <?php } else  { ?>
	  <?php echo 'НЕТ ДАННЫХ О ТРАНЗАКЦИЯХ'; ?>
			<?php  }?>
      </div>
	  	  </fieldset>	  	  
	<div>
	    <p>СУММА: <?php if (isset($order_price) and $order_price != '')     htmlout($order_price); ?></p>    		
	</div>
	<div>
	    <p>ДОПЛАТА: <?php if (isset($order_plus) and $order_plus != '')     htmlout($order_plus); ?></p>    		
	</div>	  
	<div>
	    <p>СКИДКА: <?php if (isset($order_sale) and $order_sale != '')     htmlout($order_sale); ?></p>    		
	</div>
	<div>
	    <p>ИТОГО К ОПЛАТЕ: <?php if (isset($order_all_price) and $order_all_price != '')     htmlout($order_all_price); ?></p>
	</div>
	<div>
	    <p>ПОЛУЧЕНО СРЕДСТВ: <?php if (isset($order_cash_in_all) and $order_cash_in_all != '')     htmlout($order_cash_in_all); ?></p>
	</div>
	<div>
	    <p>ВЫДАНО СРЕДСТВ: <?php if (isset($order_cash_out_all) and $order_cash_out_all != '')     htmlout($order_cash_out_all); ?></p>
	</div>	
      <div>
        <p>ПРИМЕЧАНИЕ: <?php if (isset($order_description) and $order_description != '')     htmlout($order_description); ?> </p>
      </div>	  	  
      <div>
      <div>
        <p>СОСТОЯНИЕ СЧЁТА: <?php if (isset($selected_state) and $selected_state != '')     htmlout($selected_state); ?></p>
      </div>
    </fieldset>	  
	<p><a href="../order/index.php">СЧЕТА</a></p>	
  </body>
</html>
