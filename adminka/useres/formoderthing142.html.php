<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title><?php htmlout($pageTitle); ?></title>
  <script type="text/javascript" src="ajax.js"> </script>
  <script type="text/javascript" src="text-utils.js"> </script>
  <script type="text/javascript" src="oder.js"> </script>
  <script type="text/javascript" src="validation-utils.js"> </script>
 </head>	
  </head>
  <body onLoad="document.forms[0].reset();">
    <h1><?php htmlout($pageTitle); ?></h1>
    <form action="oderthinglot12.php" method="post">
      <fieldset>
        <legend> <p>СЧЁТ № <?php   if (isset($oderid) and $oderid != '')  htmlout($oderid); ?> от <?php   if (isset($oderdate) and $oderdate != '')  htmlout($oderdate); ?></p></legend>
		
      <fieldset>
        <legend>ДАННЫЕ КЛИЕНТА № <?php   if (isset($B) and $B != '')  htmlout($B); ?></legend>
  <div id="user">
   <ul>
      <?php 	if (isset($useres) and $useres != '') {?>
      <?php foreach ($useres as $user): ?>
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
              <?php htmlout($user['name']); ?>
              <?php htmlout($user['time']); ?>
              <?php htmlout($user['role']); ?>
              <?php htmlout($user['operator']); ?>
              <?php htmlout($user['locate']); ?>			  
              <?php htmlout($user['B']); ?>
              <?php htmlout($user['A']); ?>				   
              <input type="hidden" name="id" value="<?php
                   htmlout($user['B']); ?>">	
              <input type="hidden" name="A" value="<?php
                   htmlout($user['A']); ?>">					   
            </div>
        </li>
      <?php endforeach; ?>
    </ul>
	  <?php } ?>	  
   </div>		
      <fieldset>
        <legend>ГРУППА № <?php   if (isset($A) and $A != '')  htmlout($A); ?></legend>		
  <div id="group">
   <ul>
      <?php 	if (isset($useres1) and $useres1 != '') {?>
      <?php foreach ($useres1 as $user): ?>
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
              <?php htmlout($user['name']); ?>
              <?php htmlout($user['time']); ?>
              <?php htmlout($user['role']); ?>
              <?php htmlout($user['operator']); ?>
              <?php htmlout($user['locate']); ?>			  
              <?php htmlout($user['B']); ?>
              <?php htmlout($user['A']); ?>				   					   
            </div>
        </li>
      <?php endforeach; ?>
    </ul>
	  <?php } ?>	  
   </div>
  </div>		   
      </fieldset>	  
      </fieldset>
        <?php //for ($i = 0; $i < $thingcount; $i++): ?>
      <?php 	if (isset($oderthing) and $oderthing != '') {?>
      <?php foreach ($oderthing as $oderthing1): ?>		
<div id="thingbox">	  
      <fieldset>
        <legend>ИЗДЕЛИЕ №  <?php  htmlout($oderthing1['D']); ?></legend>
  <div id="thing">
   <ul>

        <li>
            <div>
              <?php echo 'СЧЁТ'; ?>
              <?php echo htmlout($oderthing1['oderid']); ?>
              <?php echo 'ИЗДЕЛИЕ'; ?>
              <?php echo htmlout($oderthing1['D']); ?>
              <?php echo ' '; ?>
              <?php htmlout($oderthing1['wear']); ?>
              <?php echo ' '; ?>
              <?php htmlout($oderthing1['sex']); ?>
              <?php echo ' '; ?>
              <?php htmlout($oderthing1['kind']); ?>
              <?php echo ' '; ?>
              <?php htmlout($oderthing1['color']); ?>
              <?php echo ' '; ?>
              <?php htmlout($oderthing1['thingdescription']); ?>
              <?php echo ' '; ?>
              <?php htmlout($oderthing1['thingprice']); ?>
              <?php //echo '   '; ?>
              <?php //htmlout($oderthing['thingkindid']); ?>
              <?php //htmlout($oderthing['thingcolorid']); ?>
              <?php//htmlout($oderthing['role']); ?>
              <?php//htmlout($oderthing['operator']); ?>
              <?php//htmlout($oderthing['locate']); ?>			  
              <?php// htmlout($oderthing['B']); ?>
              <?php// htmlout($oderthing['A']); ?>				   					   
            </div>
        </li>

    </ul>
	  
   </div>
      <?php 	//if (isset($oderthinglot) and $oderthinglot != '') {?>
      <?php //foreach ($oderthinglot as $oderthinglot1): ?>
      <?php 	if (isset($oderall) and $oderall != '') {?>
      <?php foreach ($oderall as $oder1): ?> 	  
  <div id="lotbox">  
	  <fieldset>
        <legend>ЛОТ №   <?php htmlout($oder1['L']); ?></legend>	
   <div id="lot">
   <ul>

 

    </ul>
	  
   </div>	  
      </fieldset>
  </div>
      <?php endforeach; ?>
	  <?php } ?>	  
      </fieldset>
</div>
      <?php endforeach; ?>
	  <?php } ?>	  
        <?php// endfor; ?>

      <?php 	if (isset($oderall) and $oderall != '') {?>
      <?php foreach ($oderall as $oder1): ?>   
  <div id="oderallbox">  
	  <fieldset>
        <legend>СЧЁТ №   <?php htmlout($oder1['O']); ?></legend>
		
   <div id="oder1">
   
   
		  <fieldset>
        <legend>ИЗДЕЛИЕ №   <?php htmlout($oder1['T']); ?></legend>	
   <div id="thing1">

			<fieldset>
				<legend>ЛОТ №   <?php htmlout($oder1['L']); ?></legend>	
					<div id="lot1">

	  
   </div>	  
      </fieldset>
	  
   </div>	  
      </fieldset>
	  
   </div>	  
      </fieldset>
  </div>
      <?php endforeach; ?>
	  <?php } ?>
		
	<div>
	    <p>СУММА <?php   if (isset($oderprice) and $oderprice != '')  htmlout($oderprice); ?></p>		
	</div>
	<div>
	    <p>СКИДКА <?php   if (isset($odersale) and $odersale != '')  htmlout($odersale); ?></p>		
	</div>
	<div>
	    <p>Примечание: <?php   if (isset($oderdescription) and $oderdescription != '')  htmlout($oderdescription); ?></p>		
	</div>		  
	<div>
	    <p>ИТОГО <?php   if (isset($odertotalprice) and $odertotalprice != '')  htmlout($odertotalprice); ?></p>		
	</div>	  
      </fieldset>
     <div>	  
        <input type="submit" name="action" value="<?php htmlout($button2); ?>">
      </div>	  
    </form>
	<p><a href="..">СЧЕТА</a></p>	
  </body>
</html>
