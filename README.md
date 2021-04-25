# Maple Meadows Baseball
This is the website for the Maple Meadows baseball team.

# SQL Queries to get started
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
  PRIMARY KEY (`StatisticsID`)
);

CREATE TABLE `announcements` (
  `AnnouncementID` INT AUTO_INCREMENT,
  `AnnouncementTitle` VARCHAR(50),
  `Announcement` VARCHAR(200),
  `ImagePath` VARCHAR(100),
  PRIMARY KEY (`AnnouncementID`)
)

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

## /views 
Contains the header and footer for the site.

## Files in root directory

### admin-login.php
Login page to admin console.

### admin.php
Admin console. Contains calendar and player stat editor.

### config.php
Contain database variables for site connectivity.

### index.php
Main page of the website.

### Login.php
to do

### logout.php
Logs out of the session and redirects to index.

### Roster.php
Roster for the team.

### PlayersPics.php
to do

### Register.php
Registration page.

### reset-password.php
Password reset page.

### schedule.php
Displays the schedule for the team.

### welcome.php
Login landing page.
