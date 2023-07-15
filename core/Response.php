<?php
class Response
{
    public static function redirect($path = '')
    {
        if (preg_match('~^(http|https)~is', $path)) {
            $url = $path;
        }
        $url = _WEB_ROOT . '/' . $path;
        header('Location:' . $url);
        exit;
    }
}
