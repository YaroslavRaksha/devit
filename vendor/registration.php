<?php
    session_start();
    require_once '../connect/connect.php';
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_number = $_POST['user_number'];
    $hash = md5($user_password);
    $runcheck = mysqli_query($connect, 
    "INSERT INTO `test` (`user_id`, `user_img`, `user_email`, `user_password`, `user_number`, `user_name`, `user_surname`, `user_patronymic`, `user_privilege`, `user_banned`) 
    VALUES (NULL, '', '$user_email', '$hash', '$user_number', '', '', '', '0', '0');");
    // ПРОВЕРКА НА СУЩЕСТВОВАНИЕ ЗНАЧЕНИЯ
    if(!$runcheck == 'true') {
        $_SESSION['msg'] = 'Такая почта уже существует';
        header('Location: ../registration.php');
        exit();
    }
    header('Location: ../index.php');
?>