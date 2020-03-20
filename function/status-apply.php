<?php
session_start();
    if(isset($_POST['submit'])) {
        include 'connection.php';
        $uname_rec = $_SESSION['recruiter'];
        $accept = htmlspecialchars(stripcslashes($_POST['accept']));
        $reply = htmlspecialchars(stripcslashes($_POST['reply']));
        $uname_stu = htmlspecialchars(stripcslashes($_POST['uname_stu']));
        $job_t= htmlspecialchars(stripcslashes($_POST['job_t']));

        $reply_sql = "UPDATE reply_apply SET reply = '$reply' WHERE uname_stu = '$uname_stu' AND uname_rec = '$uname_rec' AND job_t = '$job_t';
                    UPDATE reply_apply SET status = '$accept' WHERE uname_stu = '$uname_stu' AND uname_rec = '$uname_rec' AND job_t = '$job_t';
                    UPDATE apply_job SET status_apply = '$accept' WHERE uname_stu_apply = '$uname_stu' AND uname_rec_apply = '$uname_rec' AND job_title = '$job_t';";
         mysqli_multi_query($conn, $reply_sql);

         header("Location: ../job-applicant.php?reply=success");
        
    }

?>