<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Script Error</title>
  </head>
  <body>
    <p>
      <?php echo $error; ?>
    </p>
<form action="" method="post">
  <div>
    <input type="hidden" name="action" value="logout">
    <input type="hidden" name="goto" value="../admin.php">
    <input type="submit" value="ВЫХОД">
  </div>
</form>
  </body>
</html>
