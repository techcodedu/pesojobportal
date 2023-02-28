<!-- app/Views/layouts/default.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title ?? 'Job Portal'?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    img {
        width: 100px;
        height: 100px;
    }
    </style>

</head>

<body class="d-flex flex-column min-vh-100">
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <img src="<?= base_url('public/images/peso.png') ?>" class="img-fluid mx-auto d-block mb-3" alt="Peso">
                <div class=" card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Create an Account</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(\Config\Services::validation()->getErrors())) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= \Config\Services::validation()->listErrors() ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= site_url('signup/register') ?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username"
                                    value="<?= set_value('username') ?>" placeholder="Enter your Unique username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" value="<?= set_value('email') ?>"
                                    placeholder="Enter your personal email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirm">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirm">
                            </div>
                            <div class="form-group">
                                <label for="user_type">Access for:</label>
                                <select name="user_type" class="form-control">
                                    <option value="employer" <?= set_select('user_type', 'employer') ?>>Employer
                                    </option>
                                    <option value="job seeker" <?= set_select('user_type','job seeker') ?>>JobSeeker
                                    </option>
                                </select><br>

                                <button type="submit" class="btn btn-primary">Register</button>
                        </form>

                        <div class="text-center my-3">
                            <p>Already have an account? <a href="<?php echo base_url('/login'); ?>">Login</a> |
                                <a href="<?= base_url() ?>"> Home </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center bg-light py-2 w-100">
        <p>Copyright 2023 Peso Job Portal</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



</body>

</html>