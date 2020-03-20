<?php

    session_start();

    if(isset($_POST['login_rec'])) {
        include 'connection.php';
        $uname_rec = htmlspecialchars(stripcslashes($_POST['uname_rec']));
        $pass_rec = htmlspecialchars(stripcslashes($_POST['pass_rec']));

        //ERROR CHECK
        if(empty($uname_rec) || empty($pass_rec)) {
            header("Location: ../login.php?login=empty");
            exit();
        } else {
            $sql = "SELECT * FROM user_recruiter WHERE username_rec = '$uname_rec';";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck < 1) {
                header("Location: ../login.php?login=errorUname");
                exit();
            } else {
                if($row = mysqli_fetch_assoc($result)) {
                    $hashedPassCheck = password_verify($pass_rec, $row['password_rec']);
                    if($hashedPassCheck == true) {
                        header("Location: ../login.php?login=errorPass");
                        exit();
                    } elseif ($hashedPassCheck == false) {
                        $_SESSION[recruiter] = $row['username_rec'];
                        $_SESSION[login_rec] = true;
                        header("Location: ../timeline-rec.php");
                        exit();
                    }
                }
            }
        }

    } else {
        header("Location: ../login.php?login=error");
        exit();
    }
?>