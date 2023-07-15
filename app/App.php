<?php
class App
{
    private $__controller;
    private $__action;
    private $__params;
    private $__routes;
    public static $app;
    public function __construct()
    {
        global $routesConfig;
        self::$app = $this;
        $this->__routes = new Route();
        $this->__controller = $routesConfig['default_controller'];
        $this->__action = 'index';
        $this->__params = [];
        $this->handleUrl();
    }

    // Xử lí url
    public function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        } else {
            return '/';
        }
    }

    public function handleUrl()
    {

        $url = $this->getUrl();
        $url = $this->__routes->handleRoute($url);
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);

        // Xử lí trường hợp nếu bên trong controller có thư mục và mới đến controller
        $controllerPath = 'app/controllers';
        $urlCheck = '';
        foreach ($urlArr as $key => $item) {
            $urlCheck .= $item . '/';
            $fileCheck = rtrim($urlCheck, '/');
            $fileArr = explode('/', $fileCheck);
            $fileArr[$key] = ucfirst($fileArr[$key]);
            $fileCheck = implode('/', $fileArr);
            if (!empty($urlArr[$key - 1])) {
                unset($urlArr[$key - 1]);
            }
            if (file_exists($controllerPath . '/' . $fileCheck . '.php')) {
                $urlCheck = $fileCheck;
                break;
            }
        }
        $urlArr = array_values($urlArr);
        // Xử lí khi $urlCheck rỗng
        if (empty($urlCheck)) {
            // Lấy controller mặc định nếu path là /
            $urlCheck =  'home/' . $this->__controller;
        }
        // Xử lí controller
        $this->__controller = ucfirst(!empty($urlArr[0]) ? $urlArr[0] : $this->__controller);
        $controllerFile = $controllerPath . '/' . $urlCheck . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            } else {
                $this->renderError();
                return;
            }
        } else {
            $this->renderError();
            return;
        }
        // Xử lí action
        $this->__action = !empty($urlArr[1]) ? $urlArr[1] : $this->__action;
        unset($urlArr[1]);

        // Xử lí params
        $this->__params = array_values($urlArr);

        // Kiểm tra method tồn tại
        if (method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->renderError();
        }
    }

    public function renderError($errorName = '404', $data = [])
    {
        extract($data);
        $fileError =  _DIR_ROOT . '/app/views/errors/' . $errorName . '.php';
        require_once $fileError;
    }
}
