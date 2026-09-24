<?php helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <title><?= esc($title) ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                POS System
            </a>

            <div class="navbar-nav">
                <a class="nav-link" href="<?= base_url('/') ?>">Home</a>

                <a class="nav-link" href="<?= base_url('about') ?>">
                    About
                </a>

                <a class="nav-link" href="<?= base_url('customers') ?>">
                    Customer 
                </a>

                <a class="nav-link" href="<?= base_url('users') ?>">
                    User 
                </a>
            </div>
        </div>
    </nav>

    <div class="container">