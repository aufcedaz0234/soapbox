<?php
include('header.php');
require('dbcon/dbcon.php');

// User is taken to this page from the search bar
// This is where the search results are displayed

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    function getSearchResults($pdo) {
	    $userInput = $_GET['search'];

	    $query = $pdo->query("SELECT video, video_id, video_title, video_desc, thumbnail FROM videos001 WHERE video_title LIKE '%{$userInput}%' ");

	    $row = $query->fetch(PDO::FETCH_ASSOC);

	    $title = $row['video_title'];
	    $desc = $row['video_desc'];
	    $thumbnail = $row['thumbnail'];
	    $video = $row['video'];
	    $id = $row['video_id'];
	// echo out, thumbnail, video title, video description, user, views, video age

?>

<html>
    <div class="resultBox"><a href="<?php echo "/soapbox/video.php/?id=" . $id; ?>"><IMG src="<?php echo $thumbnail; ?>" width="300px;" height="200px;"></img></a><?php echo $title, $desc?></div>
</html>

<?php

	    //echo $title,  $desc;
    }

    getSearchResults($pdo);

}




?>
