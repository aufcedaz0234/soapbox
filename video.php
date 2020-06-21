<?php
include('header.php');
require('dbcon/dbcon.php');
include('functions.php');

isLoggedIn();
date_default_timezone_set('UTC');

$id = $_GET['id'];
$username = $_SESSION['username'];
$sql = $pdo->query("SELECT video_id, uploader, upload_date, video, thumbnail, video_title, video_desc from videos001 WHERE video_id='$id'");

$SQL = $pdo->query("SELECT v.video_id, v.uploader, v.upload_date, v.video, v.thumbnail, v.video_title, v.video_desc, p.avatar FROM videos001 AS v CROSS JOIN profiles001 AS p ON (v.uploader = p.username) WHERE v.uploader = p.username");
$row = $SQL->fetch(PDO::FETCH_ASSOC);

$avatar = $row['avatar'];
$title = $row['video_title'];
$uploader = $row['uploader'];
$video = "/soapbox/" . $row['video'];
$video_desc = $row['video_desc'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>soapbox - <?php echo $title; ?></title>
</head>
<body>
	<div class="video-container">
		<video class="video-display" src="<?php echo $video; ?>" width="640px;" height="360px;" controls></video>
		<h3><?php echo $title; ?></h3>
		<p class="video_desc"><?php echo $video_desc; ?></p>
		<span><a href="/soapbox/channel/<?php echo $uploader; ?>>"><img src="<?php echo $avatar; ?>" width="140" height="140"> <?php echo $uploader; ?></a></span>
		<span class="upload_info"><?php echo "Uploaded on " . date('F j, Y', strtotime($row['upload_date'])); ?></span>
	</div>
</body>

<style type="text/css">
	.video-container {
		position: relative;
		top: 50px;
		width: 700px;
	}
</style>
</html>
