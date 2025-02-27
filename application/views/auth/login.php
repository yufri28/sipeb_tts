<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistem Informasi Pendataan Barang - BPBD Kab TTS</title>

    <!-- Meta -->
    <meta name="description" content="Sistem Informasi Pendataan Barang - BPBD Kab TTS" />
    <meta name="author" content="Sistem Informasi Pendataan Barang - BPBD Kab TTS" />
    <meta property="og:title" content="Sistem Informasi Pendataan Barang - BPBD Kab TTS">
    <meta property="og:description" content="Sistem Informasi Pendataan Barang - BPBD Kab TTS">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Sistem Informasi Pendataan Barang - BPBD Kab TTS">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?=base_url("assets/img/kaiadmin/logo-dinas.png");?>" />

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        background: linear-gradient(135deg, rgb(46, 117, 139), rgb(32, 115, 178));
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .login-logo {
        width: 100px;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-primary {
        border-radius: 30px;
        background-color: rgb(32, 66, 178);
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-secondary {
        border-radius: 30px;
        border: none;
        color: white;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: rgb(46, 100, 139);
    }

    .btn-primary:hover {
        background-color: rgb(46, 100, 139);
    }

    .alert {
        font-size: 0.9rem;
    }

    .form-label {
        font-weight: bold;
    }

    /* Hover effect */
    button,
    a {
        transition: transform 0.2s ease;
    }

    a:hover {
        transform: scale(1.05);
    }

    button:hover {
        transform: scale(1.05);
    }
    </style>
</head>

<body>
    <!-- Container start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="login-container text-center">
                    <form action="<?= base_url('auth/login'); ?>" method="post" class="my-5">
                        <a href="#" class="mb-4">
                            <img src="<?=base_url("assets/img/kaiadmin/logo-dinas.png");?>" class="img-fluid login-logo"
                                alt="CBIM logo" />
                        </a>

                        <!-- Flash message -->
                        <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-info">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <?php endif; ?>

                        <!-- Validation errors -->
                        <?php if (validation_errors()): ?>
                        <div class="alert alert-danger">
                            <?= validation_errors(); ?>
                        </div>
                        <?php endif; ?>

                        <!-- Username Input -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukan Username"
                                required />
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password"
                                required />
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid pt-3 pb-1 mt-4">
                            <button type="submit" class="btn btn-lg btn-primary">
                                LOGIN
                            </button>
                        </div>
                        <!-- Submit Button -->
                        <div class="d-grid">
                            <a href="<?=base_url('auth/register');?>" class="btn btn-lg btn-secondary">
                                REGISTER
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Alerts -->
    <!-- begin::Alert -->
    <?php if ($this->session->flashdata('success')): ?>
    <script>
    var successfuly = '<?= $this->session->flashdata('success'); ?>';
    Swal.fire({
        title: 'Sukses!',
        text: successfuly,
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(function(result) {
        if (result.isConfirmed) {
            // window.location.href = '';
            window.location.reload();

        }
    });
    </script>
    <?php $this->session->unset_userdata('success'); // Menghapus session setelah ditampilkan ?>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
    <script>
    Swal.fire({
        title: 'Error!',
        text: '<?= $this->session->flashdata('error'); ?>',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(function(result) {
        if (result.isConfirmed) {
            // window.location.href = '';
            window.location.reload();
        }
    });
    </script>
    <?php $this->session->unset_userdata('error'); // Menghapus session setelah ditampilkan ?>
    <?php endif; ?>
    <!-- end::Alert -->
    <!-- Container end -->

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>