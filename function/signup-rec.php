<?php
    if(isset($_POST['submit'])) {
        include_once 'connection.php';

            $email_rec = htmlspecialchars(stripcslashes($_POST['email_rec']));
            $username_rec = htmlspecialchars(stripcslashes($_POST['username_rec']));
            $rec_name = htmlspecialchars(stripcslashes($_POST['rec_name']));
            $city_rec = htmlspecialchars(stripcslashes($_POST['city_rec']));
            $password_rec = mysqli_real_escape_string($conn, $_POST['password_rec']);
            $cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);

            //ERROR CHECK

            //Empty Field
            if(empty($email_rec) || empty($username_rec) || empty($city_rec) || empty($password_rec) || empty($cpassword)) {
                header("Location: ../register.php?register=empty");
                exit();
            } else {
                //Name Characters
                if(!filter_var($email_rec, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../register.php?register=invalidEmail");
                    exit();
                } else {
                        //Check Username and Check Email
                        $cek_uname = mysqli_query($conn, "SELECT username_rec FROM user_recruiter WHERE username_rec = '$username_rec' ");
                        $cek_email = mysqli_query($conn, "SELECT email_rec FROM user_recruiter WHERE email_rec = '$email_rec' ");
                        
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
                                if ($password_rec !== $cpassword) {
                                    echo "<script>alert('Password tidak sama !');</script>";
                                    return false;
                                } else {
                                    // IF ALL = TRUE THEN INSERT TO TABLE
                                    $password = password_hash($password, PASSWORD_DEFAULT);

                                    $sql = "INSERT INTO user_recruiter (email_rec, username_rec, password_rec, status_rec) 
                                            VALUES('$email_rec', '$username_rec', '$password_rec', 1);
                                            INSERT INTO recruiter_profile (recruiter_email, recruiter_uname, recruiter_name, recruiter_city) 
                                            VALUES('$email_rec', '$username_rec', '$rec_name', '$city_rec');";
                                    mysqli_multi_query($conn, $sql);

                                    header("Location: ../login.php?signup-rec=success");

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