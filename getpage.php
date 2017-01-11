<?php		
	
require_once 'libraries/httpProxyClass.php';
require_once 'libraries/cloudflareClass.php';

function getPage($url){
$httpProxy   = new httpProxy();
$httpProxyUA = 'proxyFactory';

$requestLink = 'http://animeflv.me'.$url;
$requestPage = json_decode($httpProxy->performRequest($requestLink));

// if page is protected by cloudflare
if($requestPage->status->http_code == 503) {
	// Make this the same user agent you use for other cURL requests in your app
	cloudflare::useUserAgent($httpProxyUA);
	
	// attempt to get clearance cookie	
	if($clearanceCookie = cloudflare::bypass($requestLink)) {
		// use clearance cookie to bypass page
		$requestPage = $httpProxy->performRequest($requestLink, 'GET', null, array(
			'cookies' => $clearanceCookie,
            'mode' => 'native'
		));
		// return real page content for site
		//$requestPage = json_decode($requestPage);
        echo $requestPage;
		return $requestPage->content;
	} else {
		// could not fetch clearance cookie
		return 'Could not fetch CloudFlare clearance cookie (most likely due to excessive requests)';
	}	
}}

function getImage($url){
    $httpProxy   = new httpProxy();
    $httpProxyUA = 'proxyFactory';

    $requestLink = 'http://animeflv.me'.$url;
    $requestPage = json_decode($httpProxy->performRequest($requestLink));

// if page is protected by cloudflare
    if($requestPage->status->http_code == 503) {
        // Make this the same user agent you use for other cURL requests in your app
        cloudflare::useUserAgent($httpProxyUA);

        // attempt to get clearance cookie
        if($clearanceCookie = cloudflare::bypass($requestLink)) {
            // use clearance cookie to bypass page
            $requestPage = $httpProxy->performRequest($requestLink, 'GET', null, array(
                'cookies' => $clearanceCookie
            ));
            // return real page content for site
            $requestPage = json_decode($requestPage);
            $image = $requestPage->content;
            return $image;
        } else {
            // could not fetch clearance cookie
            return 'Could not fetch CloudFlare clearance cookie (most likely due to excessive requests)';
        }
    }
}


function postPage($url,$idu){
    $httpProxy   = new httpProxy();
    $httpProxyUA = 'proxyFactory';

    $requestLink = $url;
    $requestPage = json_decode($httpProxy->performRequest($requestLink));

// if page is protected by cloudflare
    if($requestPage->status->http_code == 503) {
        // Make this the same user agent you use for other cURL requests in your app
        cloudflare::useUserAgent($httpProxyUA);

        // attempt to get clearance cookie
        if($clearanceCookie = cloudflare::bypass($requestLink)) {
            // use clearance cookie to bypass page
            /*
            $requestPage = $httpProxy->performRequest($requestLink, 'GET', null, array(
                'cookies' => $clearanceCookie
            )); */
            $requestPage = $httpProxy->performRequest($requestLink, 'POST', array('id' => $idu),array(
                'cookies' => $clearanceCookie
            ));
            // return real page content for site
            $requestPage = json_decode($requestPage);
            return $requestPage->content;
        } else {
            // could not fetch clearance cookie
            return 'Could not fetch CloudFlare clearance cookie (most likely due to excessive requests)';
        }
    }}

function getPage2($url){
	$pagina_inicio = file_get_contents($url);
	return $pagina_inicio;
}

