<?php
	
	/*
	 * Sets the HTTP headers to redirect the user to a different page
	 * along with settings the HTTP status code to 307 Temporary Redirect
	 */
	function redirect($url) {
		header("Location: {$url}", true, 307);
	}

	/*
	 * Checks if the URL is valid and uses the HTTP or HTTPS scheme.
	 */
	function valid_url($url) {
		if(filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED|FILTER_FLAG_HOST_REQUIRED) === false) {
			return false;
		}

		$scheme = parse_url($url, PHP_URL_SCHEME);
		if($scheme !== "http" && $scheme !== "https") {
			return false;
		}

		return true;
	}


	if(!isset($_GET['url'])) {
		// Missing required argument. What should we do?
		redirect("/");
		exit;
	}else{
		$url = $_GET['url'];
		print($url);
		if(valid_url($url)) {
			redirect($url);
			exit;
		}else{
			// Invalid URL. What should we do?
			redirect("/");
			exit;
		}
	}