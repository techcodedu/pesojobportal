<?php $this->extend('layouts/main'); ?>
    <?php $this->section('title'); ?>
        Complete Registration| Employer
    <?php $this->endSection(); ?>

    <?php $this->section('nav'); ?>
    <!-- Sidebar -->
        <div class="sidebar">
        <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= site_url('/employer/dashboard') ?>" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>
                                Jobs
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('/employer/dashboard/post-job') ?>" class="nav-link">
                                    <i class="fas fa-user"></i>
                                    <p>Post a Job</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('/employer/dashboard/manage-jobs') ?>" class="nav-link">
                                    <i class="fas fa-user-edit"></i>
                                    <p>Manage Job Post</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= site_url('/employer/dashboard/applications') ?>" class="nav-link">
                            <i class="fas fa-briefcase"></i>
                            <p>Applications</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= site_url('/employer/dashboard/profile') ?>" class="nav-link">
                            <i class="fas fa-briefcase"></i>
                            <p>Employers Profile</p>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    <?php $this->endSection(); ?>
    <?php $this->section('content'); ?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Complete your Registration</h2>
            <?php if (isset($validation) && $validation->getErrors()): ?>
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
            <?php endif; ?>
            <form action="<?= site_url('/employer/register/complete') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <?= form_label('Company Name', 'company_name') ?>
                <?= form_input('company_name', set_value('company_name', $employer['company_name'] ?? ''), ['id' => 'company_name', 'class' => 'form-control', 'placeholder' => 'Enter your company name']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Company Description', 'company_description') ?>
                <?= form_textarea('company_description', set_value('company_description', $employer['company_description'] ?? ''), ['id' => 'company_description', 'class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter a brief description about your company']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Company Logo', 'company_logo') ?>
                <?= form_upload('company_logo', set_value('company_logo'), ['id' => 'company_logo', 'class' => 'form-control-file']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Company Website', 'website') ?>
                <?= form_input('website', set_value('website', $employer['website'] ?? ''), ['id' => 'website', 'class' => 'form-control', 'placeholder' => 'Enter your company website URL']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Company Address', 'address') ?>
                <?= form_input('address', set_value('address', $employer['address'] ?? ''), ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Enter your company address']) ?>
            </div>
            <div class="form-group">
                <?= form_label('Number of Employees', 'number_of_employees') ?>
                <?= form_dropdown('number_of_employees', $numberOfEmployees, set_value('number_of_employees', $employer['number_of_employees'] ?? ''), ['id' => 'number_of_employees', 'class' => 'form-control']) ?>
            </div>

                <?= form_submit('submit', 'Submit', ['class' => 'btn btn-primary']) ?>
            <?= form_close() ?>
        </div>
    </div>
</div>


    <?php $this->endSection(); ?>
