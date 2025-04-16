<?php
function getWebsiteTitleWithCurl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Follow redirects
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');  // Pretend to be a browser

    $html = curl_exec($ch);
    curl_close($ch);

    if ($html === false) {
        return "Could not retrieve content.";
    }

    if (preg_match("/<title>(.*?)<\/title>/is", $html, $matches)) {
        return trim($matches[1]);
    } else {
        return "No title found.";
    }
}