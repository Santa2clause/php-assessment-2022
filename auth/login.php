<?php

    session_start();
    if(isset($_SESSION['user'])){
        if($_SESSION['user'] == 'AdminUser_LoggedIn'){
            header('location: ../views/index.php');
        }
    }


?>

<!DOCTYPE html>
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login | Assessment</title>

    <meta name="PHP Assessment" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon-assessment.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Custom Styles -->
    <style>
        .btn {
            background-color: #2d7cbd;
            border-color: #2a3a4c;
        }
        .btn:hover {
            background-color: #2a3a4c;
            border-color: #03a6c9;
        }

    </style>
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                       <img src="../assets/img/login-page/login-logo.png">
                    </div>
                    <!-- /Logo -->

                    <form id="formLoginAuthentication" class="mb-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                placeholder="Enter your username"
                                autofocus
                            />
                            <div class="alert-req" style="color: red; padding-top: 1px" hidden="hidden"></div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label for="email" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div class="alert-req" style="color: red; padding-top: 1px" hidden="hidden"></div>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn-primary d-grid w-100" type="button" onclick="submitForm()" value="Sign in" />
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->


<!-- JS Scripts -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script>
    function submitForm() {

        let usrEmail = $("#username");
        let usrPass = $("#password");
        let alertBox = $('.alert-req');

        let alertFieldsReq = "Information is required";
        let alertIncorrectData = "Incorrect information was provided";

        if(usrEmail.val() === '' && usrPass.val() === ''){

            alertBox.prop('hidden','').html(alertFieldsReq)

        }else{

            let loginFormData = $("#formLoginAuthentication").serializeArray();

            $.post(
                "login-script.php",
                loginFormData,
                function(data){

                    console.log(data)

                    if(data === 'true'){
                        window.location = '../views/index.php'
                    }else{
                        alertBox.prop('hidden','').html(alertIncorrectData)
                        usrEmail.val('')
                        usrPass.val('')
                    }
                }
            );

        }

    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
