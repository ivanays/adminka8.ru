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
          <form action="../edit_order/index.php" method="post">
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
              <input type="hidden" name="ouid" value="<?php $oid; ?>">				   
              <input type="hidden" name="guid" value="<?php
                   htmlout($user['group_id']); ?>">					   
              <?php if ($user['trash'] == $trash_out) { ?>				   
              <?php echo $input_edit_user; ?>
              <?php echo $input_addgroup_user; ?>
			  <?php } elseif ($user['trash'] == $trash_in) {?>
              <?php echo $input_outtrash; ?>
              <?php echo $input_devnull; ?>
              <?php } ?>
            </div>
          </form>			
        </li>
              <?php } elseif ($user['uid'] != $user['group_id']) { ?>
		<ul>	  
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
              <input type="hidden" name="ugid" value="<?php
                   htmlout($user['uid']); ?>">
              <?php if ($user['trash'] == $trash_out) { ?>				   
              <?php echo $input_edit_user; ?>
              <?php echo $input_devgroup_user; ?>
			  <?php } elseif ($user['trash'] == $trash_in) {?>
              <?php echo $input_outtrash; ?>
              <?php echo $input_devnull; ?>
              <?php } ?>
            </div>
        </li>
		</ul>
	  <?php } ?>	  
		
          </form>
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
        <form action="" method="post">
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
              <?php htmlout(product_price($pr_id)); ?>
              <?php $points_all_in = points_all($pr_id); ?>				   
              <?php echo '   '; ?>
              <?php htmlout($product['pr_read']); ?>
              <?php echo '   '; ?>
              <?php htmlout($product['availability']); ?>					
              <input type="hidden" name="oid" value="<?php
                   htmlout($product['pr_order_id']); ?>">
			  <input type="hidden" name="prid" value="<?php
                   htmlout($product['pr_id']); ?>">
              <?php if ($product['pr_trash'] == $trash_out) { ?>				   
              <?php echo $input_edit_product; ?>
              <?php echo $input_intrash_product; ?>
              <?php } ?>				   
            </div>
          </form>
           </li>
		<ul>
      <?php 	if (isset($points_all_in)) {?>
      <?php foreach ($points_all_in as $point): ?>
      <?php 	//if ($point['prod_id'] != $pr_id) {?>	  
          <li>
        <form action="" method="post">
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
              <?php echo '   '; ?>
              <?php// htmlout($product['availability']); ?>					
              <input type="hidden" name="oid" value="<?php
                   htmlout($point['po_order_id']); ?>">
				   <input type="hidden" name="poid" value="<?php
                   htmlout($point['po_id']); ?>">
			  <input type="hidden" name="prid" value="<?php
                   htmlout($point['prod_id']); ?>">
              <?php if ($point['po_trash'] == $trash_out) { ?>				   
              <?php echo $input_edit_point; ?>
              <?php echo $input_intrash_point; ?>
              <?php } ?>				   
            </div>
          </form>
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
        <legend>НОВОЕ ИЗДЕЛИЕ </legend>
       <form action="" method="post">		
       <div>
        <label for="product_name">Вид изделия:</label>
        <select name="product_name" id="product_name">
          <option value="">Выберите вид изделия</option>
      <?php 	if (isset($product_names) and $product_names != '') {?>		  
          <?php foreach ($product_names as $product_name): ?>
            <option value="<?php htmlout($product_name); ?>"><?php
                htmlout($product_name); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_sex">Половая пренадлежность:</label>
        <select name="product_sex" id="product_sex">
          <option value="">Выберите половую пренадлежность</option>
      <?php 	if (isset($product_sexes) and $product_sexes != '') {?>		  
          <?php foreach ($product_sexes as $product_sex): ?>
            <option value="<?php htmlout($product_sex); ?>"><?php
                htmlout($product_sex); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_material">Материал:</label>
        <select name="product_material" id="product_material">
          <option value="">Выберите материал</option>
      <?php 	if (isset($product_materials) and $product_materials != '') {?>		  
          <?php foreach ($product_materials as $product_material): ?>
            <option value="<?php htmlout($product_material); ?>"><?php
                htmlout($product_material); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>
       <div>
        <label for="product_color">Цвет изделия:</label>
        <select name="product_color" id="product_color">
          <option value="">Выберите цвет изделия</option>
      <?php 	if (isset($product_colors) and $product_colors != '') {?>		  
          <?php foreach ($product_colors as $product_color): ?>
            <option value="<?php htmlout($product_color); ?>"><?php
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
      <div>
        <input type="hidden" name="product_oid"
            id="product_oid" value="<?php htmlout($oid); ?>">
      </div>	  
      </fieldset>
      <div>	  
        <input type="submit" name="action"  value="<?php htmlout($button1); ?>">
      </div>	  
          </form>	  
	  <fieldset>
        <legend>НОВАЯ УСЛУГА </legend>
       <form action="" method="post">
       <div>
        <label for="point_product_id">Номер изделия:</label>
        <select name="point_product_id" id="point_product_id">
          <option value="">Выберите изделие</option>
      <?php 	if (isset($products_all) ) {?>		  
          <?php foreach ($products_all as $product): ?>
            <option value="<?php htmlout($product['pr_id']); ?>"><?php
                htmlout('№ ' . $product['pr_id'] . ' ' . $product['product'] . ' ' . $product['sex'] . ' ' . $product['pr_mat'] . ' ' . $product['color'] . ' ' . $product['pr_desc'] . ' ' . $product['pr_read'] . ' ' . $product['availability'] . ' '); ?></option>
          <?php endforeach; ?>
              <?php } ?>		  
        </select>
      </div>	   
       <div>
        <label for="point_service">Разновидность ремонта:</label>
        <select name="point_service" id="point_service">
          <option value="">Выберите услугу</option>
      <?php 	if (isset($point_services) and $point_services != '') {?>		  
          <?php foreach ($point_services as $point_service): ?>
            <option value="<?php htmlout($point_service['id']); ?>"><?php
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
	     <input type="number"  name = "point_price" id = "point_price" min="0" max="100000" step="50"  value = ""><br>
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
     <div>
        <input type="hidden" name="point_oid"
            id="point_oid" value="<?php htmlout($oid); ?>">
      </div> 	  
      </fieldset>   
      <div>	  
        <input type="submit" name="action" value="<?php htmlout($button2); ?>">
      </div>
     </form>
	 
	  	  <fieldset>
        <legend>ТРАНЗАКЦИИ </legend>
		
	<div>
   <ul>
      <?php 	if (isset($cashes)) {?>
      <?php foreach ($cashes as $cash): ?>
        <li>
          <form action="" method="post">
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
              <input type="hidden" name="ca_id" value="<?php
                   htmlout($cash['ca_id']); ?>">
              <input type="hidden" name="ca_oid" value="<?php
                   htmlout($cash['ca_order_id']); ?>">				   
              <?php if ($cash['ca_trash'] == $trash_out) { ?>				   
              <?php echo $input_edit_cash; ?>
              <?php echo $input_intrash_cash; ?>
			  <?php } elseif ($cash['ca_trash'] == $trash_in) {?>
              <?php echo $input_outtrash; ?>
              <?php echo $input_devnull; ?>
              <?php } ?>
            </div>			
          </form>
        </li>				
      <?php endforeach; ?>
    </ul>
	  <?php } else  { ?>
	  <?php echo 'НЕТ ДАННЫХ О ТРАНЗАКЦИЯХ'; ?>
			<?php  }?>
      </div>
	  	  </fieldset>
	  	  <fieldset>
        <legend>НОВАЯ ТРАНЗАКЦИЯ </legend>	  
          <form action="" method="post">
		<p>
        <legend>Вид транзакции:</legend>
        <?php for ($i = 0; $i < count($cash_type); $i++): ?>          
            <label for="ca_type"><input name="ca_type" id="ca_type" type="radio"             
              value="<?php htmlout($cash_type[$i]); ?>"<?php
              if ($cash_type[$i] == $selected_cash_type)
              {
                echo ' checked';
              }
              ?>><?php htmlout($cash_type[$i]); ?></label>
        <?php endfor; ?>	  
		</p>	  
	  <div>
	    <label for="cash_in">ПОЛУЧИТЬ: </label>
	     <input type="number"  name = "cash_in" id = "cash_in" min="0" max="100000" step="50"  value = "" />      
	  </div>
	<div>
	  <div>
	    <label for="cash_out">ВЫДАТЬ: </label>
	     <input type="number"  name = "cash_out" id = "cash_out" min="0" max="100000" step="50"  value = "" />      
	  </div>
	  <div>
        <label for="cash_description">Примечание:</label>
        <textarea id="cash_description" name="cash_description" rows="3" cols="100"><?php if (isset($cash_description) and $cash_description != '')     htmlout($cash_description); ?> </textarea>
      </div>
	  	  </fieldset>
      <div>
        <input type="hidden" name="oid"
            id="oid" value="<?php htmlout($oid); ?>">
      </div>	  
     <div>	  
        <input type="submit" name="action" value="<?php htmlout($button3); ?>">
      </div>	 
          </form>
    <form action="" method="post">	  	  
	<div>
	    <p>СУММА: <?php if (isset($order_price) and $order_price != '')     htmlout($order_price); ?></p>    		
	</div>
	  <div>
	    <label for="order_plus_add">РАСЧЁТ ДОПЛАТЫ: </label>
	     <input type="number"  name = "order_plus_add" id = "order_plus_add" min="0" max="100000" step="50"  value = "" />      
	  </div>
	<div>
	    <p>ДОПЛАТА: <?php if (isset($order_plus) and $order_plus != '')     htmlout($order_plus); ?></p>    		
	</div>	  
	  <div>
	    <label for="order_sale_add">РАСЧЁТ СКИДКИ: </label>
	     <input type="number"  name = "order_sale_add" id = "order_sale_add" min="0" max="100000" step="50"  value = "" />      
	  </div>
	<div>
	    <p>СКИДКА: <?php if (isset($order_sale) and $order_sale != '')     htmlout($order_sale); ?></p>    		
	</div>
	<div>
	    <p>ИТОГО К ОПЛАТЕ: <?php if (isset($order_all_price) and $order_all_price != '')     htmlout($order_all_price); ?></p>
	</div>	
      <div>
        <label for="order_description">Примечание:</label>
        <textarea id="order_description" name="order_description" rows="3" cols="100"><?php if (isset($order_description) and $order_description != '')     htmlout($order_description); ?> </textarea>
      </div>	  	  
      <div>
        <label for="order_state">СОСТОЯНИЕ СЧЁТА:</label>
        <select name="order_state" id="order_state">
		  		<?php echo $select_order_state; ?>
          <?php foreach ($order_states as $order_state): ?>
            <option value="<?php htmlout($order_state); ?>"<?php
              if ($order_state == $selected_state)
              {
                echo ' selected="selected"';
              }
              ?>><?php
                htmlout($order_state); ?></option>
          <?php endforeach; ?>
        </select>		
      </div>	
      <div>
        <input type="hidden" name="oid"
            id="oid" value="<?php htmlout($oid); ?>">
      </div>
    </fieldset>
     <div>	  
        <input type="submit" name="action" value="<?php htmlout($button4); ?>">
      </div>	  
    </form>	  
	<p><a href="../order/index.php">СЧЕТА</a></p>	
  </body>
</html>
