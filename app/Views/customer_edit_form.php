<?php helper(['form', 'url']); ?>
<?php $errors = $errors ?? []; ?>

<?= $this->include('partials/header') ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <h1 class="mb-1">Edit Customer</h1>
            <p class="text-muted mb-0">Update the customer’s contact details.</p>
        </div>

        <a href="<?= site_url('customers') ?>" class="btn btn-outline-secondary">
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
            <form action="<?= site_url('customers/update/' . $id) ?>" method="post" novalidate>
                <?= csrf_field() ?>

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

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        Email address <span class="text-danger">*</span>
                    </label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        value="<?= esc($formData['email'] ?? '') ?>"
                    >
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label fw-semibold">
                        Phone number <span class="text-muted">(optional)</span>
                    </label>
                    <input
                        type="tel"
                        class="form-control"
                        id="phone"
                        name="phone"
                        value="<?= esc($formData['phone'] ?? '') ?>"
                    >
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning fw-semibold">
                        Update Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('partials/footer') ?>