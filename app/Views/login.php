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

    <section class="container my-5 flex-grow-1">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <img src="<?= base_url('public/images/peso.png') ?>" class="img-fluid mx-auto d-block mb-3" alt=" Peso
                    logo">
                <div class=" card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= site_url('login') ?>">
                            <div class="form-group">
                                <label for="username_email">Email or Username</label>
                                <input type="text"
                                    class="form-control <?= $validation && $validation->hasError('username_email') ? 'is-invalid' : '' ?>"
                                    name="username_email" value="<?= set_value('username_email') ?>">
                                <?php if ($validation && $validation->hasError('username_email')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username_email') ?>
                                </div>
                                <?php endif ?>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                    class="form-control <?= $validation && $validation->hasError('password') ? 'is-invalid' : '' ?>"
                                    name="password">
                                <?php if ($validation && $validation->hasError('password')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                                <?php endif ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>

                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                        <?php endif; ?>

                        <div class="text-center my-3">
                            <p>Don't have an account yet? <a href="<?= site_url('/signup') ?>">Register here</a> |
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