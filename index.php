<?php 
  session_start();
  if ($_SESSION['user']) {
    header('Location: profile.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS-->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <div class="container">
          <!-- LOGIN FORM ... VENDOR/LOGIN.PHP -->
          <form action="vendor/login.php" method="POST" class="login__form">
            <div class="row justify-content-center">
                <div class="col-10 col-md-6 col-lg-4">
                    <button type="button" class="btn btn-warning" onclick="location.href='registration.php'">Еще не зарегистрировался?</button>
                    <input name="user_email" type="text"  class="form-control form__input" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
                    <input name="user_password" type="text" class="form-control form__input" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                    <div class="text-right">
                      <button type="submit" class="btn btn-success form__input">Войти</button>
                    </div>
                    <?php 
                      if ($_SESSION['msg']) {
                        echo '<div class="text-center"><button type="disabled" class="btn btn-danger form__input"> ' . $_SESSION['msg'] . ' </button></div>';
                      }
                      unset ($_SESSION['msg']);
                    ?>
                </div>
            </div>
          </form>
          <!-- //LOGIN FORM -->
      </div>
  </body>
</html>