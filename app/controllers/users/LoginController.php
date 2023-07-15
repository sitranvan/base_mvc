<?php
class LoginController extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->loadModel('users/UserModel');
    }
    public function index()
    {
        echo 'Login';
        $data = $this->userModel->getList();
    }
}
