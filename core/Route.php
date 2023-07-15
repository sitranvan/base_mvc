<?php

class Route
{
    public function handleRoute($url)
    {
        global $routesConfig;
        unset($routesConfig['default_controller']);
        $url = trim($url, '/');
        $handleUrl = $url;
        if (!empty($routesConfig)) {
            $pattern = '~' . implode('|', array_keys($routesConfig)) . '~is';
            $handleUrl = preg_replace_callback($pattern, function ($matches) use ($routesConfig) {
                return $routesConfig[$matches[0]];
            }, $url);
        }

        return $handleUrl;
    }
}
