<?php
	require "twitteroauth/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;

	add_action('wp_head', 'twitter_auth', 1);

	add_action('wp_ajax_lysupp_vote', 'lysupp_vote');
	add_action('wp_ajax_nopriv_lysupp_vote', 'lysupp_vote');

	function lysupp_vote(){
		$consumer_key = '7NclIbYeXof2sk4gHNQMRUYsW';
		$consumer_secret = 'oiSaJhBQG6SiYUVoZATtJo7YX5x7rm4I0xPKrp4s2QtkuHEnE8';

		if(isset($_POST['id']) && isset($_POST['voter']) && isset($_POST['via'])){
			$id = $_POST['id'];
			$voter = $_POST['voter'];
			$via = $_POST['via'];

			if(!isset($id)){
				error_log('No ID was received by lysupp_vote()');
				exit();
			}

			if(!isset($voter)){
				error_log('No voter was recived by lysupp_vote()');
				exit();
			}

			if($via == 'facebook'){
				$url = 'http://graph.facebook.com/'.$voter.'/picture';
				$headers = get_headers($url);
				if($headers[0] == 'HTTP/1.1 404 Not Found'){
					echo json_encode(array('success' => 0, 'error' => 'Användaren hittades inte', 'id' => $id, 'voter' => $voter));
					die();
				}
			} elseif($via == 'twitter'){
				$connection = new TwitterOAuth($consumer_key, $consumer_secret);
				$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => 'http://www.lysuppsundsvall.nu'));

				$connection = new TwitterOAuth($consumer_key, $consumer_secret, $request_token['oauth_token']);
				$user_data = $connection->get("users/lookup", array("user_id" => $voter));
				if(isset($user_data->errors)){
					echo json_encode(array('success' => 0, 'error' => 'Användaren hittades inte', 'id' => $id, 'voter' => $voter));
					die();
				}
			}

			global $wpdb;
			$contributions_table = $wpdb->prefix.'lysupp_contributions';
			$votes_table = $wpdb->prefix.'lysupp_votes';

			$contribution_exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $contributions_table WHERE contribution_id = %d", $id));
			if(!$contribution_exists){
				echo json_encode(array('success' => 0, 'error' => 'Bidraget hittades inte', 'id' => $id, 'voter' => $voter));
				die();
			}

			$may_not_vote = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $votes_table WHERE voter = %d", $voter));
			if($may_not_vote){
				echo json_encode(array('success' => 0, 'error' => 'Du verkar redan ha röstat', 'id' => $id, 'voter' => $voter));
				die();
			}

			$do_vote = $wpdb->insert($votes_table, array('contribution_id' => $id, 'voter' => $voter), array('%d', '%d'));
			if(!$do_vote){
				echo json_encode(array('success' => 0, 'error' => 'Röstningen misslyckades, försök igen!', 'id' => $id, 'voter' => $voter));
				die();
			}

			echo json_encode(array('success' => 1, 'id' => $id, 'voter' => $voter));
			die();
		} else {
			echo json_encode(array('success' => 0, 'error' => 'Missing POST parameters', 'id' => $id, 'voter' => $voter));
			die();
		}
	}

	function twitter_auth(){
		$consumer_key = '7NclIbYeXof2sk4gHNQMRUYsW';
		$consumer_secret = 'oiSaJhBQG6SiYUVoZATtJo7YX5x7rm4I0xPKrp4s2QtkuHEnE8';

		if(isset($_GET['contrib'])){
			$connection = new TwitterOAuth($consumer_key, $consumer_secret);
			$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => 'http://www.lysuppsundsvall.nu?contrib='.$_GET['contrib']));

			$_SESSION['oauth_token'] = $request_token['oauth_token'];
			$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

			$url = $connection->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
			
			if(isset($_GET['redir'])){
				echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
			}
		}

		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
			$_SESSION['oauth_token'] = $_GET['oauth_token'];
			$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];

			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_GET['oauth_verifier']));
		
			$_SESSION['accessToken'] = $access_token['oauth_token'];
			$_SESSION['accessTokenSecret'] = $access_token['oauth_token_secret'];

			$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['accessToken'], $_SESSION['accessTokenSecret']);
			$user_info = $connection->get('account/verify_credentials');

			if(!empty($user_info) && isset($_GET['contrib'])){
				wp_localize_script('main', 'twitter_user_id', $user_info->id_str);
				wp_localize_script('main', 'twitter_contrib_id', $_GET['contrib']);
			} else {
				session_unset();
				session_destroy();
			}
		}
	}
?>