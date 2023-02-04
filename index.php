<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
	
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>ВХОД В СИСТЕМУ</title>
  <script type="text/javascript" src="ajax.js"> </script>
  <script type="text/javascript" src="text-utils.js"> </script>
  <script type="text/javascript" src="oder.js"> </script>
  <script type="text/javascript" src="validation-utils.js"> </script>	
  </head>
  <body onLoad="document.forms[0].reset();">
    <h1>АДМИНКА</h1>
	<fieldset>
        <legend>ВХОД В СИСТЕМУ</legend>
  <div id="main-page">
   <form method="post" action="./adminka/index.php">
	  <div>
        <label for="number1">ТЕЛЕФОН:  8 ( <input type="text" name="number1" size = "3" maxlength = "3" 
            id="number1"></label>
		<label for="number2">) <input type="text" name="number2" size = "3" maxlength = "3" 
            id="number2"></label>
		<label for="number3"> - <input type="text" name="number3" size = "2" maxlength = "2" 
            id="number3"></label>
		<label for="number4"> - <input type="text" name="number4" size = "2" maxlength = "2" 
            id="number4"></label>
      </div>
      <div>
		<p>
		<label for="password">ПАРОЛЬ: <input type='password' name='password'/>
		</p>	
      </div>
	<input type="hidden" name="action" value="login">	  
      <div>			
	     <p><input type="submit"   value="ВХОД" /></p>
      </div>
	</form>
  </div>
 	</fieldset>
  <div>
  </body>
</html>
