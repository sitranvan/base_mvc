<?php
class HomeController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = $this->loadModel('home/HomeModel');
    }
    public function index()
    {
        $this->render('home/index');
        $this->model->getHome();
    }
}
