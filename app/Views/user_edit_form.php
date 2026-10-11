<?php helper(['form', 'url']); ?>
<?php $errors = $errors ?? []; ?>

<?= $this->include('partials/header') ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <h1 class="mb-1">Edit User</h1>
            <p class="text-muted mb-0">Update the user account details below.</p>
        </div>

        <a href="<?= site_url('users') ?>" class="btn btn-outline-secondary">
            &larr; Back
        </a>
    </div>

    <?php if (! empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Please correct the following:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form
                action="<?= site_url('users/update/' . $id) ?>"
                method="post"
                enctype="multipart/form-data"
                novalidate
            >
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">
                        Username <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        value="<?= esc($formData['username'] ?? '') ?>"
                    >
                </div>

                <div class="mb-3">
                    <label for="full_name" class="form-label fw-semibold">
                        Full name <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control"
                        id="full_name"
                        name="full_name"
                        value="<?= esc($formData['full_name'] ?? '') ?>"
                    >
                </div>

                <?php if (! empty($currentAvatar)): ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current profile picture</label>
                        <div>
                            <img
                                src="<?= esc(base_url('uploads/avatars/' . rawurlencode($currentAvatar))) ?>"
                                alt="Current profile picture"
                                width="120"
                                height="120"
                                class="rounded-circle border"
                                style="object-fit: cover;"
                            >
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <label for="avatar" class="form-label fw-semibold">
                        Profile picture <span class="text-muted">(optional)</span>
                    </label>
                    <input
                        type="file"
                        class="form-control"
                        id="avatar"
                        name="avatar"
                        accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                    >
                    <div class="form-text">
                        JPG or PNG, maximum 2 MB. Leave empty to keep the current picture.
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning fw-semibold">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>