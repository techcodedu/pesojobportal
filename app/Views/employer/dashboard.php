<?php
use App\Models\UserModel;
// Get the current session
$session = session();

// Get the user ID from the session
$user_id = $session->get('user_id');

// Load the UserModel and retrieve the user's data
$userModel = new UserModel();
$user = $userModel->find($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employer Dashboard</title>

    <!-- Load AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .nav-sidebar>.nav-item>.nav-link {
        padding-left: 1rem !important;
        background: none !important;
        border-left: 0 !important;
    }

    /* Adjust the brand logo position */
    .brand-link {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button" data-toggle="offcanvas">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-flex align-items-center">
                    <div>
                        <p class="mr-2 mb-0">Welcome, <?php echo $user['username']; ?></p>
                    </div>
                    <a class="nav-link" href="<?= site_url('/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar">
            <!-- Brand Logo -->
            <!-- Brand Logo -->
            <a href="<?= site_url('/employer/dashboard') ?>" class="brand-link d-flex align-items-center">
                <span class="brand-text font-weight-light pl-2">Job Seeker Dashboard</span>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= site_url('/jobseeker/dashboard') ?>" class="nav-link">
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
                                    <a h href="<?= site_url('/employer/dashboard/post-job') ?>" class="nav-link">
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
                                <p>
                                    Applications

                                </p>
                            </a>

                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper mt-2">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Manage Job Postings</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Location</th>
                                                <th>Date Posted</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Software Developer</td>
                                                <td>New York, NY</td>
                                                <td>2023-02-18</td>
                                                <td>
                                                    <a href="<?= site_url('/employer/jobpost/edit') ?>"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Web Designer</td>
                                                <td>San Francisco, CA</td>
                                                <td>2023-02-15</td>
                                                <td>
                                                    <a href="<?= site_url('/employer/jobpost/edit') ?>"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Marketing Manager</td>
                                                <td>Los Angeles, CA</td>
                                                <td>2023-02-10</td>
                                                <td>
                                                    <a href="<?= site_url('/employer/jobpost/edit') ?>"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                                                        Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->

        <!-- Load AdminLTE JS -->
        <!-- Load jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

        <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                if ($('body').hasClass('sidebar-collapse')) {
                    $('body').removeClass('sidebar-collapse').trigger('expanded.pushMenu');
                } else {
                    $('body').addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                }
            });
        });
        </script>

    </div>
    <!-- ./wrapper -->
</body>

</html>