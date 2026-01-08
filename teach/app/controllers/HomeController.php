<?php
declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $home = $this->model('home');
        $message = $home->welcome();
        $this->view('home/index', ['message' => $message]);
    }
}
