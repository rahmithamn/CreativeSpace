<?php
    session_start();
    if(isset($_POST['submit-job'])) {
        include 'connection.php';
        $uname_job = $_SESSION['recruiter'];
        $job_title = htmlspecialchars(stripcslashes($_POST['job_title']));
        $job_desc = htmlspecialchars(stripcslashes($_POST['job_desc']));
        $job_skill = htmlspecialchars(stripcslashes($_POST['job_skill']));
        $job_deadline = htmlspecialchars(stripcslashes($_POST['job_deadline']));
        $job_payment = htmlspecialchars(stripcslashes($_POST['job_payment']));

        $sql = "INSERT INTO job_application(uname_rec_job, job_title, job_desc, job_skill, job_deadline, job_payment, job_upload_date)
                VALUES('$uname_job', '$job_title', '$job_desc', '$job_skill', '$job_deadline', '$job_payment', now());";
        mysqli_query($conn, $sql);

        header("Location: ../timeline-jobapp-employer.php?postjob=success");

    }

?>