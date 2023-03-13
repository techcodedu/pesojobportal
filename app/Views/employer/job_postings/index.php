<?php $this->extend('layouts/main'); ?>
    <?php $this->section('title'); ?>
        Manage Job Post
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

    <?= $this->section('content') ?>
<div class="container-fluid">
  <h1 class="mb-4">Job Postings</h1>
  <div class="row">
    <?php foreach ($jobPostings as $jobPosting): ?>
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title font-weight-bold"><?= $jobPosting['title'] ?></h5>
          <p class="card-text"><?= $jobPosting['description'] ?></p>
          <div class="row">
            <div class="col-6">
              <p class="card-text">
                <i class="fas fa-briefcase mr-2"></i>
                <?= $jobPosting['job_type_name'] ?>
              </p>
            </div>
            <div class="col-6">
              <p class="card-text">
                <i class="fas fa-map-marker-alt mr-2"></i>
                <?= $jobPosting['location'] ?>
              </p>
            </div>
          </div>
          <p class="card-text">
            <span class="badge badge-secondary">
              Salary: <?= $jobPosting['salary'] ?>
            </span>
          </p>
          <p class="card-text">
            <small class="text-muted">
              <i class="fas fa-layer-group mr-2"></i>
              <?= $jobPosting['job_type_name'] ?>
            </small>
          </p>
          <p class="card-text">
            <small class="text-muted">
              <i class="fas fa-th-large mr-2"></i>
              <?= $jobPosting['category_name'] ?>
            </small>
          </p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary btn-sm mr-2">
            <i class="fas fa-eye mr-1"></i>
            View
          </a>
          <a href="<?= site_url('/job_postings/edit/'. $jobPosting['job_posting_id']) ?>" class="btn btn-secondary btn-sm mr-2">
            <i class="fas fa-edit mr-1"></i>
            Edit
        </a>

          <a href="<?= site_url("job_postings/delete/{$jobPosting['job_posting_id']}") ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-trash mr-1"></i> Remove
        </a>

        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?= $this->endSection() ?>
