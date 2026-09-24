<?php
namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data = array(
            'title' => 'User Accounts',
            'users' => $userModel->findAll()
        );

        return view('partials/header', $data)
            . view('users', $data)
            . view('partials/footer');
    }
}