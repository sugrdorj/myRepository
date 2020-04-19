<?php
if (isset($_POST['info-submit'])) {
    require '../includes/dbh.inc.php';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    /*$phonenumber = $_POST['phonenumber'];$birthday = $_POST['birthDay'];$birthmonth = $_POST['birthMonth'];$birthyear = $_POST['birthYear'];$gMale = $_POST['gender'] == 'male';$gFemale = $_POST['gender'] == 'female';$gOther = $_POST['gender'] == 'other';*/

    if (empty($firstname) || empty($lastname)) {
        header("Location: ../?name=empty");
        exit();
    } else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../?name=sqlerror");
            exit();
        } else {
            $sql = "UPDATE `users` SET `ufisrtname` = '$firstname', `ulastname` = '$lastname' WHERE `users`.`idUsers`";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../?name=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $firstname, $lastname);
                mysqli_stmt_execute($stmt);
                header("Location: ../?name=success");
                exit();
            }
        }
    }
}