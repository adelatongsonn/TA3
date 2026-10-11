<?php

namespace App\Controllers;

use App\Models\CustomersModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomersModel();

        $data = [
            'title'     => 'Customer Accounts',
            'customers' => $customerModel->findAll(),
        ];

        return view('partials/header', $data)
            . view('customers', $data)
            . view('partials/footer');
    }

    public function newCustomer()
    {
        helper(['form', 'url']);

        return view('customer_form', [
            'title'    => 'Add New Customer',
            'errors'   => [],
            'formData' => [],
        ]);
    }

    public function create()
    {
        helper(['form', 'url']);

        $formData = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required|max_length[50]',
            'email'     => 'required|valid_email|max_length[50]',
            'phone'     => 'permit_empty|max_length[11]',
        ];

        $messages = [
            'full_name' => [
                'required'   => 'Full name is required.',
                'max_length' => 'Full name cannot exceed 50 characters.',
            ],
            'email' => [
                'required'    => 'Email is required.',
                'valid_email' => 'Enter a valid email address.',
                'max_length'  => 'Email cannot exceed 50 characters.',
            ],
            'phone' => [
                'max_length' => 'Phone number cannot exceed 11 characters.',
            ],
        ];

        if (! $this->validateData($formData, $rules, $messages)) {
            return view('customer_form', [
                'title'    => 'Add New Customer',
                'errors'   => $this->validator->getErrors(),
                'formData' => $formData,
            ]);
        }

        $customerData = $this->validator->getValidated();
        $customerData['created_at'] = date('Y-m-d H:i:s');

        $customerModel = new CustomersModel();
        $customerModel->insert($customerData);

        return redirect()->to(site_url('customers'))
            ->with('customer_success', 'Customer added successfully.');
    }

    public function edit(int $id)
    {
        helper(['form', 'url']);

        $customerModel = new CustomersModel();
        $customer = $customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        return view('customer_edit_form', [
            'title'    => 'Edit Customer',
            'errors'   => [],
            'formData' => $customer,
            'id'       => $id,
        ]);
    }

    public function update(int $id)
    {
        helper(['form', 'url']);

        $customerModel = new CustomersModel();
        $customer = $customerModel->find($id);

        if (! $customer) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $formData = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
        ];

        $rules = [
            'full_name' => 'required|max_length[50]',
            'email'     => 'required|valid_email|max_length[50]',
            'phone'     => 'permit_empty|max_length[11]',
        ];

        $messages = [
            'full_name' => [
                'required'   => 'Full name is required.',
                'max_length' => 'Full name cannot exceed 50 characters.',
            ],
            'email' => [
                'required'    => 'Email is required.',
                'valid_email' => 'Enter a valid email address.',
                'max_length'  => 'Email cannot exceed 50 characters.',
            ],
            'phone' => [
                'max_length' => 'Phone number cannot exceed 11 characters.',
            ],
        ];

        if (! $this->validateData($formData, $rules, $messages)) {
            return view('customer_edit_form', [
                'title'    => 'Edit Customer',
                'errors'   => $this->validator->getErrors(),
                'formData' => $formData,
                'id'       => $id,
            ]);
        }

        $customerModel->update($id, $this->validator->getValidated());

        return redirect()->to(site_url('customers'))
            ->with('customer_success', 'Customer updated successfully.');
    }
}