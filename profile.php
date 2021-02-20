<?php 
    session_start();
    if (!$_SESSION['user']) {
        header('Location: index.php');
    }
    if ($_SESSION['user']['banned']) {
        header('Location: error.html');
    }
    require_once 'connect/connect.php';
    $user_id = $_SESSION['user']['id'];
    $user = mysqli_query($connect, "SELECT * FROM `test` WHERE `user_id` = '$user_id'");
    $logined = mysqli_fetch_assoc($user);
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
        <div class="profile__header">
            <div class="row justify-content-end">
                <div class="col-auto align-self-center">
                    <img src="<?= $logined['user_img'] ?>" height="100px" alt="userIMG"  onError="this.onerror=null;this.src='../img/error_img.png';">
                </div>
                <div class="col-auto align-self-center">
                    <div class="text-right">
                        <?= $logined['user_email']?>
                    </div>
                </div>
                    <?php 
                        if (!empty($_SESSION['user']['privilege'])) {
                            echo '<div class="col-auto align-self-center">privilege: active</div>';
                        } else {
                            echo '<div class="col-auto align-self-center">privilege: none</div>';
                        } 
                    ?>
                <div class="col-auto align-self-center">
                    <img class="img-fluid settings" src="img/settings.png" alt="settings" data-toggle="modal" data-target="#exampleModal"">
                </div>
                <div class="col-auto align-self-center">
                    <button onclick="location.href='vendor/logout.php'" type="button" class="btn btn-danger">Выйти</button>
                </div>
            </div>
        </div>

        <!-- ALL USERS IF ADMIN -->
        <?php 
            if (!empty($_SESSION['user']['privilege'])) { ?>
        <div class="admin__panel">
            <div class="row">
                <div class="col-3">
                    EMAIL
                </div>
                <div class="col-3">
                    NUMBER
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                PRIVILEGE
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                BANNED
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $users = mysqli_query($connect, "SELECT * FROM `test`");
            $users = mysqli_fetch_all($users);
            foreach($users as $user) {  ?>
            <form action="vendor/admin-change.php" method="POST">
                <div class="row user__info">
                <input name="user_id" value="<?= $user[0] ?>" type="hidden"> <!-- USER ID-->
                    <div class="col-3">
                        <div class="text-left">
                            <?= $user[2] ?> <!-- USER EMAIL -->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="text-left">
                            <?= $user[4] ?> <!-- USER NUMBER -->
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-6">
                                    <input name="user_privilege" value="<?= $user[8] ?>" type="text" class="form-control" aria-label="PRIVILEGE" aria-describedby="basic-addon1"> <!-- USER PRIVELEGE -->
                                </div>
                                <div class="col-6">
                                    <input name="user_banned" value="<?= $user[9] ?>" type="text" class="form-control" aria-label="PRIVILEGE" aria-describedby="basic-addon1"> <!-- USER PRIVELEGE -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
            <? } ?>
        </div>
        <? } ?>

        <!-- //ALL USERS IF ADMIN -->

        <!-- MODAL -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Настройки профиля</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="vendor/change.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input name="user_id" value="<?= $_SESSION['user']['id']?>" type="hidden" class="form-control change__input" aria-label="Email" aria-describedby="basic-addon1">
                            <label for="basic-url">Фото</label> <br>
                            <input name="user_img" class="change__input" type="file"> <br>
                            <label for="basic-url">Почта</label>
                            <input name="user_email" value="<?= $logined['user_email']?>" class="form-control change__input" aria-label="Email" aria-describedby="basic-addon1">
                            <label for="basic-url">Номер телефона</label>
                            <input name="user_number" value="<?= $logined['user_number']?>" type="text" class="form-control change__input" aria-label="MobileNumber" aria-describedby="basic-addon1">
                            <label for="basic-url">Имя</label>
                            <input name="user_name" value="<?= $logined['user_name']?>" type="text" class="form-control change__input" aria-label="Name" aria-describedby="basic-addon1">
                            <label for="basic-url">Фамилия</label>
                            <input name="user_surname" value="<?= $logined['user_surname']?>" type="text" class="form-control change__input" aria-label="Surname" aria-describedby="basic-addon1">
                            <label for="basic-url">Отчество</label>
                            <input name="user_patronymic" value="<?= $logined['user_patronymic']?>" type="text" class="form-control change__input" aria-label="Patronymic" aria-describedby="basic-addon1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
      </div>
      <!-- //MODAL --> 

    <!-- jQuery first, then Popper.js, then Bootstrap JS FOR MODAL -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>