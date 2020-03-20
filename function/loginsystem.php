<?php

    session_start();

    if(isset($_POST['submit'])) {
        include 'connection.php';
        $username = htmlspecialchars(stripcslashes($_POST['username']));
        $password = htmlspecialchars(stripcslashes($_POST['password']));

        //ERROR CHECK
        if(empty($username) || empty($password)) {
            header("Location: ../login.php?login=empty");
            exit();
        } else {
            $sql = "SELECT * FROM user_student WHERE username = '$username';";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck < 1) {
                header("Location: ../login.php?login=errorUname");
                exit();
            } else {
                if($row = mysqli_fetch_assoc($result)) {
                    $hashedPassCheck = password_verify($password, $row['password']);
                    if($hashedPassCheck == true) {
                        header("Location: ../login.php?login=errorPass");
                        exit();
                    } elseif ($hashedPassCheck == false) {
                        $_SESSION[student] = $row['username'];
                        $_SESSION[submit] = true;
                        header("Location: ../timeline.php");
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