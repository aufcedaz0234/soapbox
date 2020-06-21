/*
 Initial database setup SQL script
 Authored by drb Friday 11/23/18 20:32


*/
CREATE DATABASE IF NOT EXISTS soapbox;

USE soapbox;

-- create the profiles001 table
CREATE TABLE IF NOT EXISTS `profiles001` (
    `userid` VARCHAR(255) PRIMARY KEY,
    `username` VARCHAR(255),
    `password` VARCHAR(255),
    `avatar` VARCHAR(255),
    `doc` VARCHAR(255),
    `las` VARCHAR(255),
    `email` VARCHAR(255),
    `c_status` VARCHAR(255),
    `verification_key` VARCHAR(255),
    `account_age` VARCHAR(255),
    `bio` VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `videos001` (
   `video_id` INT AUTO_INCREMENT PRIMARY KEY,
   `uploader` VARCHAR(255),
   `upload_date` VARCHAR(255),
   `video` VARCHAR(255),
   `thumbnail` VARCHAR(255),
   `video_title` VARCHAR(255),
   `video_desc` VARCHAR(255)
);

/*

doc = date of creation
las = last active session
c_status = confirmation_status

change video title and video desc to strings

*/
