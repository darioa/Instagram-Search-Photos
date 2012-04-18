<html>
<head>
<title>Show images</title>
</head>
<body>
<ul style="list-style-type: none;">
<?php
include 'functions.php';
$q = $_SERVER['QUERY_STRING'];
parse_str($q, $userid);
$images = search_images($userid['q']);

//if the user has not loaded images appears only a simple message
if(count($images) == 0) {
	echo "<li>No images for the this user</li>";
}
foreach ($images as $image) {
	$thumbnail = $image['thumbnail'];
	$imagelink = $image['image'];
?>
	<li>
		<div style="width: 56px;" class="thumbnail"><a href="<?php echo $imagelink;?>"><img width="100" height="100" src="<?php echo $thumbnail;?>"></a></div>
	</li>
<?php 
}
?>
</ul>
</body>
</html>