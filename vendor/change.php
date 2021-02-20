<?php 
    require_once '../connect/connect.php';

    $user_id = $_POST['user_id'];
    $user_email = $_POST['user_email'];
    $user_number = $_POST['user_number'];
    $user_name = $_POST['user_name'];
    $user_surname = $_POST['user_surname'];
    $user_patronymic = $_POST['user_patronymic'];
    $path = 'uploads/' . time() . $_FILES['user_img']['name'];
    move_uploaded_file($_FILES['user_img']['tmp_name'], '../' . $path);
    mysqli_query($connect, "UPDATE `test` SET `user_email` = '$user_email', `user_img` = '$path', `user_number` = '$user_number', `user_name` = '$user_name', `user_surname` = '$user_surname', `user_patronymic` = '$user_patronymic' WHERE `test`.`user_id` = '$user_id'");
    header("location: ../profile.php");
?> 