<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UsersModel();

        $data = [
            'title' => 'User Accounts',
            'users' => $userModel->findAll(),
        ];

        return view('partials/header', $data)
            . view('users', $data)
            . view('partials/footer');
    }

    public function newUser()
    {
        helper(['form', 'url']);

        return view('user_form', [
            'title'    => 'Add New User',
            'errors'   => [],
            'formData' => [],
        ]);
    }

    public function create()
    {
        helper(['form', 'url']);

        $formData = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
        ];

        $messages = [
            'username' => [
                'required'   => 'Username is required.',
                'max_length' => 'Username cannot exceed 50 characters.',
                'is_unique'  => 'That username is already taken. Please choose another.',
            ],
            'full_name' => [
                'required'   => 'Full name is required.',
                'max_length' => 'Full name cannot exceed 100 characters.',
            ],
        ];

        if (! $this->validateData($formData, $rules, $messages)) {
            return view('user_form', [
                'title'    => 'Add New User',
                'errors'   => $this->validator->getErrors(),
                'formData' => $formData,
            ]);
        }

        $userData = $this->validator->getValidated();
        $userData['created_at'] = date('Y-m-d H:i:s');

        $userModel = new UsersModel();
        $userModel->insert($userData);

        return redirect()->to(site_url('users'))
            ->with('success', 'User added successfully.');
    }

    public function edit(int $id)
    {
        helper(['form', 'url']);

        $userModel = new UsersModel();
        $user = $userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        return view('user_edit_form', [
            'title'        => 'Edit User',
            'errors'       => [],
            'formData'     => $user,
            'currentAvatar' => $user['avatar'] ?? null,
            'id'           => $id,
        ]);
    }

    public function update(int $id)
    {
        helper(['form', 'url']);

        $userModel = new UsersModel();
        $user = $userModel->find($id);

        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        $formData = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $viewData = [
            'title'         => 'Edit User',
            'errors'        => [],
            'formData'      => $formData,
            'currentAvatar' => $user['avatar'] ?? null,
            'id'            => $id,
        ];

        $rules = [
            'username'  => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];

        $messages = [
            'username' => [
                'required'   => 'Username is required.',
                'max_length' => 'Username cannot exceed 50 characters.',
                'is_unique'  => 'That username is already taken.',
            ],
            'full_name' => [
                'required'   => 'Full name is required.',
                'max_length' => 'Full name cannot exceed 100 characters.',
            ],
        ];

        if (! $this->validateData($formData, $rules, $messages)) {
            $viewData['errors'] = $this->validator->getErrors();

            return view('user_edit_form', $viewData);
        }

        $userData = $this->validator->getValidated();

        $avatarFile = $this->request->getFile('avatar');
        $hasNewAvatar = $avatarFile
            && $avatarFile->getError() !== UPLOAD_ERR_NO_FILE;

        $newAvatarName = null;
        $avatarDirectory = FCPATH . 'uploads/avatars/';

        if ($hasNewAvatar) {
            $avatarRules = [
                'avatar' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]',
            ];

            $avatarMessages = [
                'avatar' => [
                    'uploaded' => 'Choose a profile picture.',
                    'is_image' => 'The uploaded file must be an image.',
                    'mime_in'  => 'The profile picture must be JPG or PNG.',
                    'ext_in'   => 'Use a .jpg, .jpeg, or .png file.',
                    'max_size' => 'The profile picture must not exceed 2 MB.',
                ],
            ];

            if (! $this->validateData([], $avatarRules, $avatarMessages)) {
                $viewData['errors'] = $this->validator->getErrors();

                return view('user_edit_form', $viewData);
            }

            if (
                ! is_dir($avatarDirectory)
                && ! mkdir($avatarDirectory, 0755, true)
                && ! is_dir($avatarDirectory)
            ) {
                $viewData['errors'] = [
                    'The avatar upload folder could not be created.',
                ];

                return view('user_edit_form', $viewData);
            }

            $extension = $avatarFile->getMimeType() === 'image/png'
                ? 'png'
                : 'jpg';

            $newAvatarName = bin2hex(random_bytes(16)) . '.' . $extension;
            $targetPath = $avatarDirectory . $newAvatarName;

            try {
                service('image')
                    ->withFile($avatarFile->getTempName())
                    ->fit(300, 300, 'center')
                    ->save($targetPath);
            } catch (\Throwable $e) {
                log_message(
                    'error',
                    'Avatar processing failed: ' . $e->getMessage()
                );

                if (is_file($targetPath)) {
                    unlink($targetPath);
                }

                $viewData['errors'] = [
                    'The picture could not be processed. Check the PHP image extension and the uploads folder.',
                ];

                return view('user_edit_form', $viewData);
            }

            $userData['avatar'] = $newAvatarName;
        }

        $userModel->update($id, $userData);

        if ($newAvatarName !== null && ! empty($user['avatar'])) {
            $oldAvatarPath = $avatarDirectory . basename($user['avatar']);

            if (is_file($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }

        return redirect()->to(site_url('users'))
            ->with('user_success', 'User updated successfully.');
    }
}