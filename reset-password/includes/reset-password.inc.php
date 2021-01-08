<?php

// First we check if the form was submitted.
if (isset($_POST['reset-password-submit'])) {

  // Here we grab the data from the form.
  $selector = $_POST['selector'];
  $validator = $_POST['validator'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  if (empty($password) || empty($passwordRepeat)) {
    header("Location: https://www.robertmochel.com");
    exit();
  } else if ($password != $passwordRepeat) {
    header("Location: https://www.robertmochel.com");
    exit();
  }

  // We get the current date and time.
  $currentDate = date('U');

  // We get the database connection.
  require 'dbh.inc.php';

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= $currentDate";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an error for line 29!";
    exit();
  } else {
    mysqli_stmt_bind_param($stmt, "s", $selector);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
      echo "You need to re-submit your reset request.";
      exit();
    } else {

      $tokenBin = hex2bin($validator);

      // Then we check if it matches the one from the database.
      $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

      // Then if they match we grab the users e-mail from the database.
      if ($tokenCheck === false) {
        echo "There was an error on line 47!";
      } elseif ($tokenCheck === true) {

        // Before we get the users info from the user table we need to store the token email for later.
        $tokenEmail = $row['pwdResetEmail'];

        // Here we query the user table to check if the email we have in our pwdReset table exists.
        $sql = "SELECT * FROM users WHERE user_email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "There was an error on 57!";
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          if (!$row = mysqli_fetch_assoc($result)) {
            echo "There was an error on 64!";
            exit();
          } else {

            // Finally we update the users table with the newly created password.
            $sql = "UPDATE users SET user_password=? WHERE user_email=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "There was an error after update on 72!";
              exit();
            } else {
              $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
              mysqli_stmt_execute($stmt);

              // Then we delete any leftover tokens from the pwdReset table.
              $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "There was an error after delete on 83!";
                exit();
              } else {
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
                header("Location: ../../index.php?newpwd=passwordupdated");
              }

            }

          }
        }

      }

    }
  }

} else {
  header("Location: www.robertmochel.com");
  exit();
}

            