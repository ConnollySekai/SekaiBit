<?php

/**
 * Show notification based on session
 *
 * @param String $message
 * @param String $type
 * @return void 
 */
if (!function_exists('show_notification')) {

    function show_notification($message, $type = 'error') {

        //types option are error, success, info, warning
        $notif = view('partials.notifications.default')->with([
            'message' => $message,
            'type' => $type
        ])->render();

        echo  $notif;
    }
}

/**
 * Creates a link with https
 *
 * @param String $url
 * @return String
 */
if (!function_exists('generate_url_string')) {

    function generate_url_string($url) {
        
        $parsed_url = parse_url($url);
	
        if (isset($parsed_url['scheme'])) {
            return $url;
        }
        
        return "https://".$url;
    }
}