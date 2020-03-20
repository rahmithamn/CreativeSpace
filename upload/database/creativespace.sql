-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 10:03 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `creativespace`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_job`
--

CREATE TABLE `apply_job` (
  `id_apply` int(11) NOT NULL,
  `uname_stu_apply` varchar(28) NOT NULL,
  `uname_rec_apply` varchar(28) NOT NULL,
  `explanation` varchar(300) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_skill` varchar(100) NOT NULL,
  `job_deadline` varchar(100) NOT NULL,
  `job_payment` varchar(100) NOT NULL,
  `status_apply` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_job`
--

INSERT INTO `apply_job` (`id_apply`, `uname_stu_apply`, `uname_rec_apply`, `explanation`, `job_title`, `job_skill`, `job_deadline`, `job_payment`, `status_apply`) VALUES
(7, 'rahmithamn', 'magnata', 'hy! i am a student from Telkom University and i am interested to take part in your project. please visit my profile to see my portofolio and my job experience or feel free to contact me on my email', 'i need someone to do my website', 'Web Development', '1 - 6 Days', '1000000', 'Accepted'),
(8, 'wandaalifia', 'recruiter', 'Hi! i saw your job application and i am excited to be a part of your event. Please visit my profile to see my portofolio and my job experience. Feel free to contact me on my email', 'We need someone to make an event poster', 'Graphic Design', '1 - 3 Weeks', '500000', 'Accepted'),
(9, 'adniasalsabila', 'magnata', 'hi! i am currently an organisator at my university and would like to take part at the event. Please check my profile for more details on me!', 'I need a photographer for my event', 'Photography', '1 - 6 Days', '1000000', 'pending'),
(10, 'wandaalifia', 'magnata', 'i would like to take part in this project', 'i need someone to do my website', 'Web Development', '1 - 6 Days', '1000000', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id_content` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `category` varchar(25) NOT NULL,
  `file` varchar(100) NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id_content`, `uname`, `description`, `category`, `file`, `upload_date`) VALUES
(26, 'rahmithamn', 'The original landing page mockup for this website', 'Web Design', 'content-5ca570f515c5f1.29293540.jpg', '2019-04-04 09:50:29'),
(27, 'rahmithamn', '&quot;TUBES&quot; of Web  Design in Semester 1 : Flight Tickets', 'Web Design', 'content-5ca571623da757.38052719.png', '2019-04-04 09:52:18'),
(28, 'adniasalsabila', 'content-adnia', 'Sketch', 'content-5ca5720f23df15.78444692.jpg', '2019-04-04 09:55:11'),
(29, 'rahmithamn', 'Report task cover in high school : Firewall', 'Graphic Design', 'content-5ca57a51d639f6.58188729.jpg', '2019-04-04 10:30:25'),
(30, 'rahmithamn', 'My first watercolour paint order', 'Painting', 'content-5ca5e39fdae4b0.58087802.jpg', '2019-04-04 17:59:43'),
(31, 'rahmithamn', 'The website that i designed when i was an intern in Telkom Akses', 'Web Design', 'content-5ca5e40028f7a4.13193222.jpg', '2019-04-04 18:01:20'),
(32, 'rahmithamn', 'The project that i did in high school with one of my senior', 'Web Design', 'content-5ca5e44c7173a2.51766210.jpg', '2019-04-04 18:02:36'),
(33, 'wandaalifia', 'content-wanda', 'Graphic Design', 'content-5ca851ac80da28.38738249.jpg', '2019-04-06 14:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `id_jobapp` int(11) NOT NULL,
  `uname_rec_job` varchar(28) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `job_desc` varchar(500) NOT NULL,
  `job_skill` varchar(50) NOT NULL,
  `job_deadline` varchar(100) NOT NULL,
  `job_payment` varchar(100) NOT NULL,
  `job_upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`id_jobapp`, `uname_rec_job`, `job_title`, `job_desc`, `job_skill`, `job_deadline`, `job_payment`, `job_upload_date`) VALUES
(3, 'magnata', 'i need someone to do my website', 'i need someone to do my website which is an online shopping website', 'Web Development', '1 - 6 Days', '1000000', '2019-04-06 13:55:44'),
(5, 'recruiter', 'We need someone to make an event poster', 'the company will be having an event in early May 2019 and we would like to make a poster that promote our event, the details will be emailed to you later. we will be paying Rp 500.000 / poster', 'Graphic Design', '1 - 3 Weeks', '500000', '2019-04-06 20:37:32'),
(6, 'magnata', 'I need a photographer for my event', 'we will be having an event soon and need at least 2 photographers. payment can still be discussed', 'Photography', '1 - 6 Days', '1000000', '2019-04-06 22:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_profile`
--

CREATE TABLE `recruiter_profile` (
  `id_recruiter` int(11) NOT NULL,
  `recruiter_name` varchar(40) NOT NULL,
  `recruiter_uname` varchar(20) NOT NULL,
  `recruiter_email` varchar(30) NOT NULL,
  `recruiter_phone` varchar(100) NOT NULL,
  `recruiter_city` varchar(28) NOT NULL,
  `recruiter_img` varchar(100) NOT NULL,
  `recruiter_status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter_profile`
--

INSERT INTO `recruiter_profile` (`id_recruiter`, `recruiter_name`, `recruiter_uname`, `recruiter_email`, `recruiter_phone`, `recruiter_city`, `recruiter_img`, `recruiter_status`) VALUES
(4, 'Magnata Team', 'magnata', 'magnata@gmail.com', '', 'Bandung', '', ''),
(5, 'Recruiter Corp', 'recruiter', 'rec@gmail.com', '', 'Bandung', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `reply_apply`
--

CREATE TABLE `reply_apply` (
  `id_reply` int(11) NOT NULL,
  `uname_rec` varchar(28) NOT NULL,
  `uname_stu` varchar(28) NOT NULL,
  `job_t` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reply` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply_apply`
--

INSERT INTO `reply_apply` (`id_reply`, `uname_rec`, `uname_stu`, `job_t`, `status`, `reply`) VALUES
(3, 'magnata', 'rahmithamn', 'i need someone to do my website', 'Accepted', 'Hi! i would love for you to take part for the project. we will send you the details via email'),
(4, 'magnata', 'wandaalifia', 'i need someone to do my website', 'Declined', 'Hi! takes for your ineterest in the project but we think your portofolio is not enough'),
(5, 'recruiter', 'wandaalifia', 'We need someone to make an event poster', 'Accepted', 'hi! i saw your profile and we would like to hire you. please check your email for for information about the project');

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id_student` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `student_uname` varchar(20) NOT NULL,
  `student_header` varchar(50) NOT NULL,
  `student_img` varchar(100) NOT NULL,
  `university` varchar(28) NOT NULL,
  `major` varchar(30) NOT NULL,
  `status_desc` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `loc_city` varchar(20) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email_stu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id_student`, `name`, `student_uname`, `student_header`, `student_img`, `university`, `major`, `status_desc`, `birthdate`, `loc_city`, `phone`, `email_stu`) VALUES
(11, 'Rahmitha Mahrul Nisa', 'rahmithamn', 'header-rahmithamn.jpg', 'profile-rahmithamn.jpg', 'Telkom University', 'Software Engineering', 'I can do Graphic Design, Web Design, and Painting', '2000-11-15', 'Bandung', '082352381692', 'rahmithasaid@gmail.com'),
(12, 'Wanda Alifia', 'wandaalifia', 'header-wandaalifia.jpg', 'profile-wandaalifia.jpg', 'Telkom University', 'Software Engineering', 'Software Engineering student at Telkom University', '2019-04-01', 'Bandung', '', 'wanda@gmail.com'),
(13, 'Adnia Salsabila', 'adniasalsabila', 'header-adniasalsabila.png', 'profile-adniasalsabila.jpg', 'Telkom University', 'Software Engineering', 'Currently freshman at Telkom University', '2000-02-08', 'Bandung', '', 'adnia@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_recruiter`
--

CREATE TABLE `user_recruiter` (
  `id_rec` int(11) NOT NULL,
  `email_rec` varchar(30) NOT NULL,
  `username_rec` varchar(20) NOT NULL,
  `password_rec` varchar(15) NOT NULL,
  `status_rec` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_recruiter`
--

INSERT INTO `user_recruiter` (`id_rec`, `email_rec`, `username_rec`, `password_rec`, `status_rec`) VALUES
(6, 'magnata@gmail.com', 'magnata', '1234', 1),
(7, 'rec@gmail.com', 'recruiter', '1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_student`
--

CREATE TABLE `user_student` (
  `id_student` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_student`
--

INSERT INTO `user_student` (`id_student`, `email`, `username`, `password`, `status`) VALUES
(24, 'rahmithasaid@gmail.com', 'rahmithamn', '1234', 1),
(25, 'wanda@gmail.com', 'wandaalifia', 'wanda', 1),
(26, 'adnia@gmail.com', 'adniasalsabila', 'adnia', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_job`
--
ALTER TABLE `apply_job`
  ADD PRIMARY KEY (`id_apply`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id_content`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`id_jobapp`);

--
-- Indexes for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  ADD PRIMARY KEY (`id_recruiter`);

--
-- Indexes for table `reply_apply`
--
ALTER TABLE `reply_apply`
  ADD PRIMARY KEY (`id_reply`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `user_recruiter`
--
ALTER TABLE `user_recruiter`
  ADD PRIMARY KEY (`id_rec`);

--
-- Indexes for table `user_student`
--
ALTER TABLE `user_student`
  ADD PRIMARY KEY (`id_student`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_job`
--
ALTER TABLE `apply_job`
  MODIFY `id_apply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id_content` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id_jobapp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruiter_profile`
--
ALTER TABLE `recruiter_profile`
  MODIFY `id_recruiter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reply_apply`
--
ALTER TABLE `reply_apply`
  MODIFY `id_reply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_recruiter`
--
ALTER TABLE `user_recruiter`
  MODIFY `id_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_student`
--
ALTER TABLE `user_student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
