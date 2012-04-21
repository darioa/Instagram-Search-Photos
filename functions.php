<?php
//insert here the token retrieved from instagram
define("YOUR_TOKEN", 'INSERT HERE YOUR TOKEN');

//superior limit of number of recent images 
define("MAX_IMAGES", 10);

//function that send request to the instagram services
function retrieve_values($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

//function that retrieve the user informations that match the username searched
//note:if you don't use a name that matchs exactly an username in instagram
//it will retrieve a list of usernames that probably identify the user you are
//looking for and you have to choose one of them
function search_users($username) {
	
	$users = array();
	
	//send the request to instagram and retrieve the response
	$url ='https://api.instagram.com/v1/users/search?q=' . $username . '&access_token='. YOUR_TOKEN;
	$response = retrieve_values($url);
	
	//decode the answer
	$json = json_decode($response, true);
	$datas = $json['data'];
	foreach ($datas as $data)
	array_push($users, array(
			'username' => $data['username'],
			'fullname' => $data['full_name'],
			'profile_picture' => $data['profile_picture'],
			'id' => $data['id']
	));
	
	return $users;
}

//function that retrieve the images related to a numeric userid
//the number of images is limited to the most recent 10
function search_images($userid) {
	
	$images = array();
	
	//send the request to instagram and retrieve the response
	$url ='https://api.instagram.com/v1/users/'. $userid . '/media/recent/?access_token=' . YOUR_TOKEN;
	$response = retrieve_values($url);

	
	//decode the answer
	$json = json_decode($response, true);
	$data = $json['data'];
	foreach ($data as $elem) {
		$image = $elem['images'];
		array_push($images, array(
						'thumbnail' => $image['thumbnail']['url'],
						'image' => $image['standard_resolution']['url']
				));
	}
	
	//if there are more than 10 images extract the first 10 
	if(count($images) > MAX_IMAGES) {
		$images = array_slice($images, 0, MAX_IMAGES);
	}
	return $images;
}


?>