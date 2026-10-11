<?php helper('url'); ?>

<div class="row">
    <div class="col-md-12">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mb-1">User Accounts</h1>
                <p class="mb-0">
                    These user records are stored in the database.
                </p>
            </div>

            <a href="<?= site_url('users/new') ?>" class="btn btn-warning">
                Add User
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th class="text-center" style="width: 100px;">Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th class="text-center" style="width: 120px;">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (! empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <?php
                    $placeholderUrl = base_url('images/user-placeholder.svg');
                    $avatarName = basename((string) ($user['avatar'] ?? ''));
                    $avatarUrl = $avatarName !== ''
                        ? base_url('uploads/avatars/' . rawurlencode($avatarName))
                        : $placeholderUrl;
                ?>

                <tr class="align-middle">
                    <td class="text-center">
                        <img
                            src="<?= esc($avatarUrl, 'attr') ?>"
                            alt="<?= esc(($user['full_name'] ?? 'User') . ' profile picture', 'attr') ?>"
                            class="rounded-circle border"
                            style="width: 56px; height: 56px; object-fit: cover;"
                            onerror="this.onerror=null;this.src='<?= esc($placeholderUrl, 'attr') ?>';"
                        >
                    </td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td class="text-center">
                        <a
                            href="<?= site_url('users/edit/' . $user['id']) ?>"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No user records found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
    </div>
</div>