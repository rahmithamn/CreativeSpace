<?php
    session_start();
    include 'connection.php';
    
    $u_name = $_SESSION['student'];
    if(isset($_POST['upload_content'])){
        $description = htmlspecialchars(stripcslashes($_POST['description']));
        $category = htmlspecialchars(stripcslashes($_POST['category']));

        
        $file_content = $_FILES['file'];

        $fileName_content = $_FILES['file']['name'];
        $filetmpName_content = $_FILES['file']['tmp_name'];
        $fileSize_content = $_FILES['file']['size'];
        $fileError_content = $_FILES['file']['error'];
        $fileType_content = $_FILES['file']['type'];

        $fileExt_content = explode('.', $fileName_content);
        $fileActualExt_content = strtolower(end($fileExt_content));

        $allowed_content = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt_content, $allowed_content)){
            if($fileError_content === 0) {
                if($fileSize_content < 1000000) {
                    $fileNameNew_content = "content-".uniqid('', true).".".$fileActualExt_content;
                    $fileDestination_content = '../content-file/'.$fileNameNew_content;
                   
                    move_uploaded_file($filetmpName_content, $fileDestination_content);

                    $query = "INSERT INTO content(uname, description, category, file, upload_date) VALUES ('$u_name', '$description', '$category', '$fileNameNew_content', now());";
                    mysqli_query($conn, $query);
                    header("Location: ../timeline.php?post=successful");

                } else {
                    echo "Your file is too big";
                }
            } else {
                echo "You have an error";
            }
        } else {
            echo "You cannot upload file in this type";
        }
    } else {
        header("Location: ../timeline.php?post=unsuccessful");
    }
?>