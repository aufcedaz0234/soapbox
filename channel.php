<!-- 
	TODO:
	- Move elements to separate stylesheet
-->

<?php
include('header.php');
include('user.php');
require('dbcon/dbcon.php');
include('functions.php');

$helperFunctionsClass = new helperFunctions();
$helperFunctionsClass->isLoggedIn();

$suser = $_SESSION['username'];

$query = $pdo->prepare("SELECT avatar, bio, doc from profiles001 WHERE username = :suser ");
$query->bindValue(':suser', $suser);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

//$userID = $row['user_id'];

$url = "/soapbox/";
$avatar = $row['avatar'];
$bio = $row['bio'];
date_default_timezone_set('UTC');
$join_date = date('F j, Y', strtotime($row['doc']));

$username = $_SESSION['username'];
$sql = $pdo->prepare("SELECT video_id, thumbnail, video_title from videos001 WHERE uploader='$username'");
$sql->execute();
$row2 = $sql->fetch(PDO::FETCH_ASSOC);
//$num = mysqli_num_rows($result);
$num = $sql->rowCount();
?>

<!DOCTYPE html>
<html>
<head>
	<title>soapbox - <?php echo $username . "'s profile"; ?></title>
</head>
<body>
	<div class="container" id="container">
		<img src="<?php echo $avatar; ?>" width="200" height="200" class="avatar" alt="user's avatar image">
		<span class="username"><?php echo $_SESSION['username']; ?></span>
		<span class="joined">&#9679;<i><b><?php echo " Joined " . $join_date;?></b> (<?php if ($num == 1) { echo $num . " video"; } else if ($num == 0 || $num > 1) { echo $num . " videos"; } ?>)</i></span>
		<p class="bio"><i class="bio-i-tag"><?php echo $bio; ?></i></p>
	</div>

	<div class="wrapper">
		<?php
			if ($sql->rowCount() > 0) {
				while ($row2 = $sql->fetch(PDO::FETCH_ASSOC)/*mysqli_fetch_assoc($result)*/) {
					$thumbnail = "/soapbox/" . $row2['thumbnail'];
					$title = $row2['video_title'];
		?>
				<a href="<?php echo "/soapbox/video.php?id=" . $row2['video_id']; ?>" class="link">
					<div class="img-container">
						<img src="<?php echo $thumbnail; ?>" class="thumbnail_img" width="276" height="183">
						<?php echo $title; ?>
					</div>
				</a>
		<?php
				}
			} else {
		?>
				<div class="no-vid-msg">No content available.</div>
		<?php
			}
		?>
	</div>
</body>

	<style type="text/css">
		.container {
			margin-top: 100px;
			margin-left: 5px;
		}

		.avatar {
			float: left;
			vertical-align: top;
			border-style: solid;
			border-color: #000000;
		}

		.username {
			padding-left: 5px;
			display: inline;
			position: relative;
			font-size: 20px;
		}

		.joined {
			display: inline;
		}

		.bio-i-tag {
			padding-left: 5px;
		}

		.wrapper {
			margin-top: 50px;
			right: 222px;
			width: 100%;
			position: relative;
		}

		.link {

		}

		.img-container {
			display: inline-block;
			position: relative;
			margin: 1em;
			top: 150px;
			width: 245px;
		}

		.thumbnail_img {
			padding: 1px;
		}

		a {
			text-decoration: none;
		}

		.no-vid-msg {
			text-align: center;
			margin-top: 255px;
			position: relative;
			left: 200px;
		}
	</style>
</body>
</html>
