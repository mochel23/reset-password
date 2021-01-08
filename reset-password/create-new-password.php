<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Reset Password</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="../file/style.css" media="all" type="text/css">
    </head>
    <body>
        <div class="container-fluid">
        <div class="inline">
        <div class="one"><img src="../logo/MyLogo.png" class="logo" width="15%" alt="logo"></div>
    </div>
<?php
      // First we grab the tokens from the URL.
      $selector = $_GET['selector'];
      $validator = $_GET['validator'];

      // Then we check if the tokens are here.
      if (empty($selector) || empty($validator)) {
        echo "Could not validate your request!";
      } else {
        // Here we check if all characters in our tokens are hexadecimal 'digits'. This is a boolean. Again another error check to make sure the URL wasn't changed by the user.
        // If this check returns "true", we show the form that the user uses to reset their password.
        if (ctype_xdigit( $selector ) !== false && ctype_xdigit( $validator ) !== false) {
          ?>
    
          <form class="subForm" action="includes/reset-password.inc.php" method="post">
            <input type="hidden" name="selector" value="<?php echo $selector ?>" minlength="8" required>
            <input type="hidden" name="validator" value="<?php echo $validator ?>"minlength="8" required>

            <input type="password" name="pwd" placeholder="Enter new password..." minlength="8" required>
            <br>
            <input type="password" name="pwd-repeat" placeholder="Repeat new password..." minlength="8" required>
            <input type="submit" name="reset-password-submit" value="Reset password" class="sendBtn">
          </form>

          <?php
        }
      }
      ?>
        </div>
    </body>
</html>