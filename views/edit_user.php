<!-- Verify is session exists -->
<?php

include_once '../auth/verify.php';

include '../dbo/dbConnect.php';
?>

<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
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

    <title>Add User | Assessment</title>

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

    <!-- Custome Styling -->
    <style>
        .app-brand demo{
            text-align= center;
        }
    </style>

</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php include 'menu.php'; ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php include 'navbar.php'; ?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- Basic Layout -->
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-12">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">User Information</h5>
                                </div>
                                <div class="card-body">

                                    <span class="alertBoxMessage"></span>

                                    <?php

                                        //USER DATA
                                        $user = $_GET['user'];
                                        $fetchDetails = $con->query("SELECT * FROM user_details WHERE md5(id)='$user'");
                                        $rows = $fetchDetails->fetchAll();
                                        $rowId = $rows[0]['id'];
                                        $name = $rows[0]['name'];
                                        $surname = $rows[0]['surname'];
                                        $sa_id_number = $rows[0]['sa_id_number'];
                                        $mobile = $rows[0]['mobile'];
                                        $email_address  = $rows[0]['email_address'];
                                        $birth_date = $rows[0]['birth_date'];
                                        $language = $rows[0]['language'];
                                        $interests = unserialize($rows[0]['interests']);

                                    ?>

                                    <form id="edit-user" class="was-validated">

                                        <input type="text" name="formType" id="formType" value="editUser" hidden/>
                                        <input type="text" name="userUpdateId" id="userUpdateId" value="<?php echo $rowId; ?>" hidden/>

                                        <?php include 'form-details.php'; ?>

                                        <input type="button" class="editButton btn btn-success" value="Update User" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <?php include 'footer.php'; ?>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->

<!-- Custom JS -->
<script>

    function editUser(){

        let form = $("#edit-user");
        let spanAlertBox = $(".alertBoxMessage");
        let userData = form.serializeArray();

        spanAlertBox.html('');

        $.post(

            '../dbo/users.php',
            userData,
            function(data){

                if($.trim(data) === "Success"){
                    spanAlertBox.html('<div class="alert alert-success" role="alert">User has been successfully loaded.</div>');
                    spanAlertBox.get(0).scrollIntoView();
                    form.remove();
                    $(".editButton").val('Update User').prop('disabled', false);

                }else if($.trim(data) === "Failed"){
                    spanAlertBox.html('<div class="alert alert-danger" role="alert">Oops - Something went wrong.</div>');
                    spanAlertBox.get(0).scrollIntoView();
                    $(".editButton").val('Update User').prop('disabled', false);
                }else{
                    spanAlertBox.html('<div class="alert alert-warning" role="alert">Information provided was incorrect format.</div>');
                    spanAlertBox.get(0).scrollIntoView();
                    form.remove();
                    $(".editButton").val('Update User').prop('disabled', false);
                }

            }

        )
    }

    $(function() {

        //ID Number
        let maxLength = 13;
        $('#user-sa-id').keyup(function () {

            this.value = this.value.replace(/[^0-9\.]/g, '');

            let len = maxLength - $(this).val().length;

            $('.user-input-count-id').text("ID Numbers Remaining: " + len);

        });

        //Validate Inputs
        let submitBtn = $(".editButton");
        submitBtn.on("click", function () {

            let has_empty = false;

            $('form').find('input[type!="hidden"]').each(function () {
                if (!$(this).val()) {
                    has_empty = true;
                    return false;
                }
            });

            if (has_empty) {
                $(".alertBoxMessage").html('<div class="alert alert-warning" role="alert">Please ensure all fields are filled in.</div>')
                return false;
            } else {
                submitBtn.prop('disabled', true);
                submitBtn.val('Loading user please wait. . .');
                editUser();
            }
        });

    });

</script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
