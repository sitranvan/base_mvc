<?php
class Controller
{
    public function loadModel($model)
    {
        $fileModel = _DIR_ROOT . '/app/models/' . $model . '.php';
        if (file_exists($fileModel)) {
            require_once $fileModel;
            $modelArr = explode('/', $model);
            $finalModel = end($modelArr);

            if (!empty($finalModel) && class_exists($finalModel)) {
                return new $finalModel();
            }
        }
        return false;
    }

    public function render($viewPath, $data = [])
    {
        extract($data);
        $fileView =  _DIR_ROOT . '/app/views/' . $viewPath . '.php';
        if (file_exists($fileView)) {
            require_once $fileView;
        }
    }
}
