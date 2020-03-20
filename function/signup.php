<?php
    if(isset($_POST['submit'])) {
        include_once 'connection.php';

            $email = htmlspecialchars(stripcslashes($_POST['email']));
            $username = htmlspecialchars(stripcslashes($_POST['username']));
            $name = htmlspecialchars(stripcslashes($_POST['name']));
            $uni_name = htmlspecialchars(stripcslashes($_POST['uni_name']));
            $city = htmlspecialchars(stripcslashes($_POST['city']));
            $birthdate = htmlspecialchars(stripcslashes($_POST['birthdate']));
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);

            //ERROR CHECK

            //Empty Field
            if(empty($email) || empty($username) || empty($uni_name) || empty($city) || empty($birthdate) || empty($password) || empty($cpassword)) {
                header("Location: ../register.php?register=empty");
                exit();
            } else {
                //Name Characters
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../register.php?register=invalidEmail");
                    exit();
                } else {
                        //Check Username and Check Email
                        $cek_uname = mysqli_query($conn, "SELECT username FROM user_student WHERE username = '$username' ");
                        $cek_email = mysqli_query($conn, "SELECT email FROM user_student WHERE email = '$email' ");
                        
                        //Check Uname
                        if (mysqli_num_rows($cek_uname) > 0){	
                            echo "<script>alert('Username sudah ada !');</script>";
                            return false;
                        } else {
                            //Check Email
                            if (mysqli_num_rows($cek_email) > 0){
                                echo "<script>alert('Email sudah ada !');</script>";
                                return false;
                            } else {
                                //Check Password
                                if ($password !== $cpassword) {
                                    echo "<script>alert('Password tidak sama !');</script>";
                                    return false;
                                } else {
                                    // IF ALL = TRUE THEN INSERT TO TABLE
                                    //$password = password_hash($password, PASSWORD_DEFAULT);

                                    $sql = "INSERT INTO user_student (email, username, password, status) 
                                            VALUES('$email', '$username', '$password', 1);
                                            INSERT INTO student_profile (student_uname, name, university, birthdate, loc_city, email_stu)  
                                            VALUES('$username', '$name', '$uni_name', '$birthdate', '$city', '$email');";
                                    mysqli_multi_query($conn, $sql);

                                    header("Location: ../login.php?signup=success");
                                }
                            }
                        }
                    
                }
            }     
            
    } else {
        header("Location: ../register.php");
        exit();
    }
    

?>