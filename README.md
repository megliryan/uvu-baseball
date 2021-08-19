# Maple Meadows Baseball
This is the website for the Maple Meadows baseball team.

# SQL Queries to get started
CREATE TABLE `schedule` (
  `ScheduleID` INT AUTO_INCREMENT,
  `GameDate` VARCHAR(50),
  `GameTime` VARCHAR(20),
  `Opponent` VARCHAR(50),
  `HomeAway` CHAR(4),
  PRIMARY KEY (`ScheduleID`)
);

CREATE TABLE `adminusers` (
  `id` INT AUTO_INCREMENT,
  `username` VARCHAR(255),
  `password` VARCHAR(255),
  PRIMARY KEY (`id`)
)

CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT,
  `username` VARCHAR(255),
  `password` VARCHAR(255),
  PRIMARY KEY (`id`)
);

CREATE TABLE `videos` (
  `VideoID` INT AUTO_INCREMENT,
  `VideoPath` VARCHAR(100),
  PRIMARY KEY (`VideoID`)
);

CREATE TABLE `livestream` (
  `url` VARCHAR(255)
);


CREATE TABLE `players` (
  `PlayersID` INT AUTO_INCREMENT,
  `PlayerName` VARCHAR(25),
  `PlayerPosition` VARCHAR(25),
  `PlayerNumber` VARCHAR(25),
  `PlayerYear` VARCHAR(25),
  `ImagePath` VARCHAR(100),
  `AB` INT,
  `PA` INT,
  `AVG` VARCHAR(5),
  `OBP` VARCHAR(5),
  `SLG` VARCHAR(5),
  `H` INT,
  `1B` INT,
  `2B` INT,
  `3B` INT,
  `HR` INT,
  `RBI` INT,
  `SB` INT,
  `CS` INT,
  `W` INT,
  `L` INT,
  `ERA` VARCHAR(4),
  `WHIP` VARCHAR(4),
  `SO` INT,
  `BB` INT,
  `BAA` VARCHAR(5),
  `IP` INT,
  PRIMARY KEY (`PlayersID`)
);

## /forms
Contains the website for hosting and downloading PDF forms.

### index.php
Gives a list of all PDF files in the `/forms/all_forms` directory.

### upload.php
Admins can upload forms here.

### manage.php
Admins can delete forms here.

## /images
Hosts images for the website.

## /PlayerPics
Hosts images for the players on roster.

## /PlayerVideos
Hosts videos for the players on videos page.

## /views 
Contains the header and footer for the site.

## Files in root directory

### admin-login.php
Login page to admin console.

### admin.php
Admin console. Contains calendar, announcement, livestream, player videos and player stat editor. Only availabe to admin users.

### adminregister.php
Admin users can register other admin users here.

### config.php
Contain database variables for site connectivity.

### getplayer.php
Gets player information from the DB.

### index.php
Main page of the website. Shows announcements and livestream.

### Login.php
Login page for normal users to see videos.

### logout.php
Logs out of the session and redirects to index.

### playeredit.js
Dynamically shows players stats from the db to the admin page.

### Register.php
Admin users can register normal users here.

### reset-password.php
Password reset page.

### Roster.php
Roster for the team.

### Schedule.php
Displays the schedule for the team.

### styles.css
CSS file for all formatting.

### videos.php
Login landing page shows videos of players.
