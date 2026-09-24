<?php
namespace App\Controllers;
use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $data = array(
            'title' => 'Customer Accounts',
            'customers' => $customerModel->findAll()
        );

        return view('partials/header', $data)
            . view('customers', $data)
            . view('partials/footer');
    }
}