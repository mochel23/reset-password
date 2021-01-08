<?php

if (isset($_POST["reset-request-submit"])) {
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // $url = "www.robertmochel.com/reset-password/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $url = "www.robertmochel.com/reset-password/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    // Enter the Database

    require 'dbh.inc.php';
    // $conn =     require '../../file/db_connection.php';

    // echo "set for the reset <br>";
    // echo "next we delete <br>";
    // DELETE SECTION
    $userEmail = $_POST["email"];
    $sql = 'DELETE FROM pwdReset WHERE pwdResetEmail=?';
    $stmt = mysqli_stmt_init($conn);
    // echo "the statement (stmt) is created <br>";
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error after '. $userEmail .' delete";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    // echo "the stmt is binded <br>";


    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an insert error!";
    exit();
  } else {
    // Here we also hash the token to make it unreadable, in case a hacker accessess our database.
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
    mysqli_stmt_execute($stmt);
  }
// echo "this is before we clos the stement";
  // Here we close the statement and connection.
  mysqli_stmt_close($stmt);
  mysqli_close($conn);

  // The last thing we need to do is to format an e-mail and send it to the user, so they can click a link that allow them to reset their password.

  // Who are we sending it to.
  $to = $userEmail;

  // Subject
  $subject = 'Reset your password for RMI';

  // Message
  $message = '<p>We recieved a password reset request. The link to reset your password is below. ';
  $message .= 'If you did not make this request, you can ignore this email</p>';
  $message .= '<p>Here is your password reset link: </br>';
  $message .= '<a href="' . $url . '">' . $url . '</a></p>';

  // Headers
  // Headers
  $headers = "From: RMI<rmi@robertmochel.com>\r\n";
  $headers .= "Reply-To: rmi@robertmochel.com\r\n";
  $headers .= "Content-type: text/html\r\n";

  // Send e-mail
  mail($to, $subject, $message, $headers);
  // echo "mailed stuff, ut bw need to go to another page.";

  // Finally we send them back to a page telling them to check their e-mail.
  header("Location: https://www.robertmochel.com");
} else {
  header("Location: https://www.robertmochel.com");
  exit();
}