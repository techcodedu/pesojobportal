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

    <?= $this->section('content') ?>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Edit Job Posting</h2>
        </div>
        <div class="card-body">
          <?php if (!empty($validation->getErrors())): ?>
            <div class="alert alert-danger" role="alert">
              <?= $validation->listErrors() ?>
            </div>
          <?php endif; ?>

          <?= form_open('job_postings/update/' . $jobPosting['job_posting_id'], ['method' => 'post']) ?>

          <div class="form-group">
            <?= form_label('Title', 'title', ['class' => 'form-label']) ?>
            <?= form_input('title', $jobPosting['title'], ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Enter job title']) ?>
          </div>
          <div class="form-group">
            <?= form_label('Description', 'description', ['class' => 'form-label']) ?>
            <?= form_textarea('description', $jobPosting['description'], ['id' => 'description', 'class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter job description']) ?>
          </div>
          <div class="form-group">
            <?= form_label('Requirements', 'requirements', ['class' => 'form-label']) ?>
            <?= form_textarea('requirements', $jobPosting['requirements'], ['id' => 'requirements', 'class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter job requirements']) ?>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <?= form_label('Salary', 'salary', ['class' => 'form-label']) ?>
              <?= form_input('salary', $jobPosting['salary'], ['id' => 'salary', 'class' => 'form-control', 'placeholder' => 'Enter job salary']) ?>
            </div>
            <div class="col-md-6">
              <?= form_label('Location', 'location', ['class' => 'form-label']) ?>
              <?= form_input('location', $jobPosting['location'], ['id' => 'location', 'class' => 'form-control', 'placeholder' => 'Enter job location']) ?>
            </div>
          </div>
          <div class="form-group row">
          <div class="col-md-6">
                <?= form_label('Job Type', 'job_type_id', ['class' => 'form-label']) ?>
                <?php $jobTypeOptions = []; ?>
                <?php foreach ($jobTypesList as $jobType): ?>
                    <?php $jobTypeOptions[$jobType['id']] = $jobType['name']; ?>
                <?php endforeach; ?>
                <?= form_dropdown('job_type_id', $jobTypeOptions, set_value('job_type_id'), ['id' => 'job_type_id', 'class' => 'form-control']) ?>
            </div>
            <div class="col-md-6">
              <?= form_label('Job Category', 'category_id', ['class' => 'form-label']) ?>
              <?= form_dropdown('category_id', $jobCategories, set_value('category_id'), ['id' => 'category_id', 'class' => 'form-control']) ?>
            </div>
</div>
<?= form_submit('submit', 'Update', ['class' => 'btn btn-primary']) ?>
<?= form_close() ?>
</div>
</div>
</div>

  </div>
</div>
<?= $this->endSection() ?>
