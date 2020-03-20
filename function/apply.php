<?php
    session_start();
    if(isset($_POST['send-apply'])) {
        include 'connection.php';

        $job_apply = addslashes($_POST['id_job']);
        $explanation = htmlspecialchars(stripcslashes($_POST['explanation']));

        $job_info = "SELECT uname_rec_job, 
                            id_jobapp,
                            job_title,
                            job_skill,
                            job_deadline,
                            job_payment
                        FROM job_application
                        WHERE id_jobapp = '$job_apply';";
        $result_apply = mysqli_query($conn, $job_info);
        $resultCheck_apply = mysqli_num_rows($result_apply);

        $row_apply = mysqli_fetch_assoc($result_apply);

        $uname_stu = $_SESSION['student'];
        $uname_rec = $row_apply['uname_rec_job'];
        $j_title = $row_apply['job_title'];
        $j_skill = $row_apply['job_skill'];
        $j_deadline = $row_apply['job_deadline'];
        $j_payment = $row_apply['job_payment'];

        $sql = "INSERT INTO apply_job(uname_stu_apply,
                                    uname_rec_apply,
                                    explanation,
                                    job_title,
                                    job_skill,
                                    job_deadline,
                                    job_payment,
                                    status_apply)
                VALUES('$uname_stu', '$uname_rec', '$explanation', '$j_title', '$j_skill', '$j_deadline', '$j_payment', 'pending');
                INSERT INTO reply_apply(uname_rec,
                                        uname_stu,
                                        job_t,
                                        status)
                VALUES('$uname_rec', '$uname_stu', '$j_title', 'pending');";
        
        mysqli_multi_query($conn, $sql);

        header("Location: ../timeline-jobapp.php?apply=success");
    }
?>