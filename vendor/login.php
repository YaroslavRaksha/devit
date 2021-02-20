<?php
    session_start();
    require_once '../connect/connect.php';
    $user_email = $_POST['user_email'];
    $user_password = md5($_POST['user_password']);
    $check = $connect->query("SELECT * FROM `test` WHERE `user_email` = '$user_email' AND `user_password`= '$user_password'");
    if (mysqli_num_rows($check) > 0) {
        $user = mysqli_fetch_assoc($check);
        $_SESSION['user'] = [
            'id' => $user['user_id'],
            'privilege' => $user['user_privilege'],
            'banned' => $user['user_banned']
        ];
        header('Location: ../profile.php');
    } else {
        $_SESSION['msg'] = 'Неверный логин или пароль';
        header('Location: ../index.php');
    }
?>