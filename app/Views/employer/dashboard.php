<?php $this->extend('layouts/main'); ?>
    <?php $this->section('title'); ?>
        Employer Dashboard
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
                                <a href="<?= site_url('/employer/job_postings/create') ?>" class="nav-link">
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
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
    <?php $this->endSection(); ?>
