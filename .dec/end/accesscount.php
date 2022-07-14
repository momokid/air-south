<?php
error_reporting(0);
$remoteip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];

$clean_ip = filter_var($remoteip, FILTER_SANITIZE_NUMBER_INT);

$visitcount = 5;

if (filter_var($remoteip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
{
    if (file_exists('deny/' . $clean_ip . '.txt'))
    {
        $lines = count(file('deny/' . $clean_ip . '.txt'));
        if ($lines >= $visitcount)
        {
            header('HTTP/1.0 403 Forbidden');
            die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this  server.</p><p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p></body></html>');

        }
    }
    file_put_contents('deny/' . $clean_ip . '.txt', $remoteip . "\n", FILE_APPEND);
}
else
{
    header('HTTP/1.0 403 Forbidden');
    die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this  server.</p><p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p></body></html>');
}

?>
