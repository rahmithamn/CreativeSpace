<?php
session_start();
include 'connection.php';
$u_name = $_SESSION['student'];

    if(isset($_POST['update_profile'])) {

        $university = htmlspecialchars(stripcslashes($_POST['university']));
                    $major = htmlspecialchars(stripcslashes($_POST['major']));
                    $status_desc = htmlspecialchars(stripcslashes($_POST['status_desc']));
                    $loc_city = htmlspecialchars(stripcslashes($_POST['loc_city']));
                    $phone = htmlspecialchars(stripcslashes($_POST['phone']));
                    $email_stu = htmlspecialchars(stripcslashes($_POST['email_stu']));
                   
                   $sql = "UPDATE student_profile
                            SET university = '$university',
                                major = '$major',
                                status_desc = '$status_desc',
                                loc_city = '$loc_city',
                                phone = '$phone',
                                email_stu = '$email_stu'
                            WHERE student_uname = '$u_name';";
                    mysqli_query($conn, $sql);

        //PROFILE PICTURE
        $file = $_FILES['propic'];

        $fileName = $_FILES['propic']['name'];
        $filetmpName = $_FILES['propic']['tmp_name'];
        $fileSize = $_FILES['propic']['size'];
        $fileError = $_FILES['propic']['error'];
        $fileType = $_FILES['propic']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0) {
                if($fileSize < 1000000) {
                    $fileNameNew = "profile-".$u_name.".".$fileActualExt;
                    $fileDestination = '../profile-picture/'.$fileNameNew;
                   
                    move_uploaded_file($filetmpName, $fileDestination);

                    $query = "UPDATE student_profile SET student_img = '$fileNameNew' WHERE student_uname = '$u_name';";
                    mysqli_query($conn, $query);
                    

                } else {
                    echo "Your file is too big";
                }
            } else {
                echo "You have an error";
            }
        } else {
            echo "You cannot upload file in this type";
        }

        //PROFILE HEADER
        $file_header = $_FILES['header_pic'];

        $fileName_header = $_FILES['header_pic']['name'];
        $filetmpName_header = $_FILES['header_pic']['tmp_name'];
        $fileSize_header = $_FILES['header_pic']['size'];
        $fileError_header = $_FILES['header_pic']['error'];
        $fileType_header = $_FILES['header_pic']['type'];

        $fileExt_header = explode('.', $fileName_header);
        $fileActualExt_header = strtolower(end($fileExt_header));

        $allowed_header = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt_header, $allowed_header)){
            if($fileError_header === 0) {
                if($fileSize_header < 1000000) {
                    $fileNameNew_header = "header-".$u_name.".".$fileActualExt_header;
                    $fileDestination_header = '../header-student/'.$fileNameNew_header;
                   
                    move_uploaded_file($filetmpName_header, $fileDestination_header);

                    $query_header = "UPDATE student_profile SET student_header = '$fileNameNew_header' WHERE student_uname = '$u_name';";
                    mysqli_query($conn, $query_header);
                    

                } else {
                    echo "Your file is too big";
                }
            } else {
                echo "You have an error";
            }
        } else {
            echo "You cannot upload file in this type";
        }
       
        header("Location: ../profile-edit.php?edit=success");
    }
?>