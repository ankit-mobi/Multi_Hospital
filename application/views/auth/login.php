<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Hospital Management System Login">
    <meta name="author" content="Rizvi">
    <base href="<?php echo base_url(); ?>">

    <title>Login - 
        <?php 
        // Note: Ideally, fetch this in your Controller and pass as $vendor_name
        $system_vendor = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row()->system_vendor;
        echo $system_vendor; 
        ?>
    </title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .login-header {
            background: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .login-logo {
            width: 80px;
            height: auto;
            margin-bottom: 15px;
        }
        .btn-login {
            background-color: #4e73df;
            border-color: #4e73df;
            color: white;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                
                <!-- Main Login Card -->
                <div class="card login-card">
                    <div class="login-header">
                        <?php 
                            // Ideally fetch in controller
                            $settings = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();
                        ?>
                        <img src="uploads/favicon.png" alt="Logo" class="login-logo" onerror="this.src='https://via.placeholder.com/80'">
                        <h4 class="fw-bold text-dark"><?php echo $settings->title; ?></h4>
                        <p class="text-muted small mb-0">Please sign in to continue</p>
                    </div>

                    <div class="card-body p-4">
                        
                        <!-- Error Message Alert -->
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Login Form -->
                        <form class="needs-validation" action="auth/login" method="post" novalidate>
                            
                            <!-- Email Input -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="identity" name="identity" placeholder="name@example.com" value="<?php echo set_value('identity'); ?>" required>
                                <label for="identity"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                <div class="invalid-feedback">
                                    Please provide a valid email.
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon" style="cursor: pointer;"></i>
                                </span>
                                <div class="invalid-feedback">
                                    Password is required.
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberMe">
                                    <label class="form-check-label text-secondary" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="text-decoration-none small">Forgot Password?</a>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button class="btn btn-login shadow-sm" type="submit">
                                    Sign In <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
              
                </div>

            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="auth/forgot_password" class="needs-validation" novalidate>
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="forgotPasswordLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted mb-4">Enter your registered email address and we'll send you a link to reset your password.</p>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="resetEmail" placeholder="name@example.com" required>
                            <label for="resetEmail">Email Address</label>
                            <div class="invalid-feedback">
                                Please enter a valid email.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Bootstrap 5 Validation Logic
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Toggle Password Visibility
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var icon = document.getElementById("toggleIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>