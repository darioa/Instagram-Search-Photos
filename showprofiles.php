<html>
<head>
<title>Show profiles</title>
</head>
<body>
<?php
	include 'functions.php';
	$username = $_GET['username'];
	$username = str_replace(" ", "", $username);
	$users = search_users($username);
	
	//link to the page showimages.php
	$link ='showimages.php?q=';
?>
	<table>
<?php 
	foreach ($users as $user) {
		$username = $user['username'];
		$fullname = $user['fullname'];
		$profimage = $user['profile_picture'];
		$userlink = $link . $user['id']; 
?>
		<tr>
		<td>
		<div style="width: 56px;" class="profimage_small"><a href="<?php echo $userlink;?>"><img width="50" height="50" alt="<?php echo $username;?>" src="<?php echo $profimage;?>"></a></div>
		</td>
		<td style="vertical-align:middle;">
		<strong><a href="<?php echo $userlink;?>"><?php echo $username;?></a></strong>
		( <a href="<?php echo $userlink;?>"><?php echo $fullname;?></a> )
		</td>
		</tr>
<?php
	}
?>
	</table>
</body>
</html>