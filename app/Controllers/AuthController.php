<?php

namespace App\Controllers;

use App\Services\AuthService;

final class AuthController extends Controller
{
    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index(): void
    {
        $this->render('auth.login');
    }


    public function login()
    {
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $username=$_POST['username']??'';
            $password=$_POST['password']??'';
            if($this->authService->attempt($username,$password)){
                $_SESSION['user']=$username;
                header('Location: : /movies');
                exit;
            }
        }
        $this->render('auth.login',['error'=>'Invalid credentials']);
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}