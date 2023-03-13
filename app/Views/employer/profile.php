<?php $this->extend('layouts/main'); ?>
    <?php $this->section('title'); ?>
        Employer| Profile
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
    <div class="container">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h2 class="m-0"><?= $employer['company_name'] ?></h2>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <img src="<?= site_url('public/'.$employer['company_logo']) ?>" alt="<?= $employer['company_name'] ?>" class="img-fluid">
        </div>
        <div class="col-md-6 col-sm-12">
          <p class="card-text"><?= $employer['company_description'] ?></p>
          <p class="card-text"><strong>Website:</strong> <a href="<?= $employer['website'] ?>" target="_blank"><?= $employer['website'] ?></a></p>
          <p class="card-text"><strong>Address:</strong> <?= $employer['address'] ?></p>
          <p class="card-text"><strong>Number of Employees:</strong> <?= $employer['number_of_employees'] ?></p>
          <a href="<?= base_url('employer/edit') ?>" class="btn btn-outline-primary"><i class="fas fa-pencil-alt mr-2"></i>Edit Profile</a>
        </div>
      </div>
    </div>
  </div>
</div>




    <?php $this->endSection(); ?>
