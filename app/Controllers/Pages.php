<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = array(
            'title' => 'Home Page'
        );

        return view('partials/header', $data)
            . view('index')
            . view('partials/footer');
    }

    public function about()
    {
        $data = array(
            'title' => 'About Page'
        );

        return view('partials/header', $data)
            . view('about')
            . view('partials/footer');
    }
}