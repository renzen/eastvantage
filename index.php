<?php 

include "twitteroauth/twitteroauth.php";

$consumer_key = "Da4bW1YJUTrI4kFwfKhSpT2dw";
$consumer_secret = "nhBQEXEltVW4D4LIwRXRF0pG8OBvS0zDbde8oWbKyvek8qCcwB";
$access_token = "911599057-vSuOjjF0vyR1mF2Doq0WCrCuYU51OLhwe5HYpchs";
$access_token_secret = "HdfSqquXoGwBYVit8iAJ2Y4xy7o6ML2QrRTSiz3G0m47J";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

//$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=realDonaldTrump&result_type=recent&count=500');

//$user->get('account/verify_credentials'); 

//printing username
echo "welcome " .$user->screen_name . '<br>';

$tweets = $twitter->get('statuses/user_timeline', ['count' =>200, 'exclude_replies' => true, 'screen_name' => 'snowden']);

print($tweets);

$totalTweets[] = $tweets;
$page = 0;

for ($count = 200; $count < 500; $count +- 200) {
	$max = count($totalTweets[$page]) - 1;
	$tweets = $twitter->get('statuses/user_timeline', ['count' => 200, 'exclude_replies' => true, 'max_id' => $totalTweets[$page][$max] ->id_str, 'screen_name' => 'snowden']);
	$totalTweets[] = $tweets;
	$page += 1;
	}
	
	//echo "<pre>";
	//print_r($totalTweets);
	//echo "</pre>";
	
	$start = 1;
	foreach ($totalTweets as $page) {
		foreach ($page as $key) {
			echo $start . ':' . $key->text . '<br>';
			$start++; 
			
		}
		
	}

	

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API SEARCH</title>
</head>
<body>
<?php foreach ($tweets->statuses as $key => $tweet) { ?>
    Tweet : <img src="<?=$tweet->user->profile_image_url;?>" /><?=$tweet->text; ?><br>
<?php } ?>
  

</body>
</html>