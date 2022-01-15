<?php

function getClientIp(): string
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        //from remote address
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }

    return $ip;
}
