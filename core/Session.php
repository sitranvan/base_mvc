<?php
class Session
{
    public static function data($key = '', $value = '')
    {
        if (!empty($value)) {
            $_SESSION[$key] = $value; // Set Session
            return true;
        } else {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key]; // Get Session
            }
        }
    }

    public static function delete($key = '')
    {
        if (!empty($key) && isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
    }
    /**
     * Flash data
     */
    public static function flash($key = '', $value = '')
    {
        $dataFlash = self::data($key, $value);
        if (empty($value)) {
            self::delete($key);
        }
        return $dataFlash;
    }
}
