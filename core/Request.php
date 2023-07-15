<?php
class Request
{
    private $method;
    private $dataFields;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->dataFields = [];
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function isPost()
    {
        return $this->method === 'POST';
    }

    public function isGet()
    {
        return $this->method === 'GET';
    }

    public function getBody()
    {
        if ($this->isGet() && !empty($_GET)) {
            $this->sanitizeData($_GET);
        }

        if ($this->isPost() && !empty($_POST)) {
            $this->sanitizeData($_POST);
        }

        return $this->dataFields;
    }

    private function sanitizeData($data)
    {
        foreach ($data as $key => $value) {
            $this->dataFields[$key] = $this->sanitizeValue($value);
        }
    }

    private function sanitizeValue($value)
    {
        if (is_array($value)) {
            return filter_var_array($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
