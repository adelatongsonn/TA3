<?php helper('url'); ?>

<div class="row">
    <div class="col-md-12">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mb-1">Customer Accounts</h1>
                <p class="mb-0">
                    These customer records are stored in the database.
                </p>
            </div>

            <a href="<?= site_url('customers/new') ?>" class="btn btn-warning">
                Add Customer
            </a>
        </div>
<?php if ($message = session()->getFlashdata('customer_success')): ?>
    <div class="alert alert-success" role="alert">
        <?= esc($message) ?>
    </div>
<?php endif; ?>
        <table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th class="text-center" style="width: 120px;">Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (! empty($customers)): ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone'] ?? '') ?></td>
                    <td class="text-center align-middle">
                        <a
                            href="<?= site_url('customers/edit/' . $customer['id']) ?>"
                            class="btn btn-sm btn-outline-primary"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">
                    No customer records found.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
    </div>
</div>