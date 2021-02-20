<?php 
    require_once '../connect/connect.php';

    $user_id = $_POST['user_id'];
    $user_privilege = $_POST['user_privilege'];
    $user_banned = $_POST['user_banned'];

    mysqli_query($connect, "UPDATE `test` SET `user_privilege` = '$user_privilege', `user_banned` = '$user_banned' WHERE `test`.`user_id` = '$user_id'");
    header("location: ../profile.php");
?> 