<?php

namespace App;

class Server
{
    public function has($key)
    {
        return isset($_SERVER[$key])
            && $_SERVER[$key] !== '';
    }

    public function exists($key)
    {
        return array_key_exists($key, $_SERVER);
    }

    public function httpHost()
    {
        return $this->exists('HTTP_HOST')
            ? $_SERVER['HTTP_HOST']
            : null;
    }

    public function httpReferer()
    {
        return $this->exists('HTTP_REFERER')
            ? $_SERVER['HTTP_REFERER']
            : null;
    }

    public function httpUserAgent()
    {
        return $this->exists('HTTP_USER_AGENT')
            ? $_SERVER['HTTP_USER_AGENT']
            : null;
    }

    public function remoteAddr()
    {
        $remoteAddr = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remoteAddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $remoteAddr = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        return $remoteAddr;
    }

    public function serverAddr()
    {
        return $this->exists('SERVER_ADDR')
            ? $_SERVER['SERVER_ADDR']
            : null;
    }

    public function serverName()
    {
        return $this->exists('SERVER_NAME')
            ? $_SERVER['SERVER_NAME']
            : null;
    }

    public function requestUri()
    {
        return $this->exists('REQUEST_URI')
            ? $_SERVER['REQUEST_URI']
            : null;
    }

    public function queryString()
    {
        return $this->exists('QUERY_STRING')
            ? $_SERVER['QUERY_STRING']
            : null;
    }
}