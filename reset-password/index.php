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
        <div class="one">
        <a href="../index.php"><img src="../logo/MyLogo.png" class="logo" width="15%" alt="logo">
</a>
        </div>
        <!-- <h4 class="two center">Contact the <a href="mailto:rmi@robert-mochel.com">admin</a> for more information </h4> -->
    </div>
        <form action="includes/reset-request.inc.php" class="subForm" method="post">
        <div class=""> 
        <h1>Reset Pasword</h1>
        <p>An Email will be sent to you with instructions on how to to reset your password.</p>
        </div class="btmCenter">
            <input type="text" name="email" placeholder="ENTER YOU EMAIL ADDRESS" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
            <br>
            <input type="submit" name="reset-request-submit" value="CLICK TO RESET YOUR PASSWORD" class="sendBtn" style="width:100%;">
        </form>
        </div>
    </body>
</html>