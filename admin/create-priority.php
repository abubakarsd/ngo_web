<?php
// Start session
session_start();

// Check if session variable is not set or is empty
if (!isset($_SESSION['adm_id']) || empty($_SESSION['adm_id'])) {
    // Redirect user to the login page
    header("Location: sign-in.php");
    exit(); // Make sure to exit after redirecting
}
?>
<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.wrraptheme.com/templates/compass/html/blog-post.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 May 2024 10:27:42 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>TLWDFoundation Admin</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/dropzone/dropzone.css">
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/blog.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
</head>
<body class="theme-blush">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/favicon.png" width="48" height="48" alt="Compass"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">        
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.php"><img src="assets/images/favicon.png" width="30" alt="Compass"><span class="m-l-10">Admin</span></a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right slideDown">
                    <li class="header">NOTIFICATIONS</li>
                    <li class="body">
                        <ul class="menu list-unstyled">
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                <div class="menu-info">
                                    <h4>8 New Members joined</h4>
                                    <p><i class="zmdi zmdi-time"></i> 14 mins ago </p>
                                </div>
                                </a> </li>
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-amber"><i class="zmdi zmdi-shopping-cart"></i></div>
                                <div class="menu-info">
                                    <h4>4 Sales made</h4>
                                    <p> <i class="zmdi zmdi-time"></i> 22 mins ago </p>
                                </div>
                                </a> </li>
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>
                                <div class="menu-info">
                                    <h4><b>Nancy Doe</b> Deleted account</h4>
                                    <p> <i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                </div>
                                </a> </li>
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>
                                <div class="menu-info">
                                    <h4><b>Nancy</b> Changed name</h4>
                                    <p> <i class="zmdi zmdi-time"></i> 2 hours ago </p>
                                </div>
                                </a> </li>
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>
                                <div class="menu-info">
                                    <h4><b>John</b> Commented your post</h4>
                                    <p> <i class="zmdi zmdi-time"></i> 4 hours ago </p>
                                </div>
                                </a> </li>
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>
                                <div class="menu-info">
                                    <h4><b>John</b> Updated status</h4>
                                    <p> <i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                </div>
                                </a> </li>
                            <li> <a href="javascript:void(0);">
                                <div class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>
                                <div class="menu-info">
                                    <h4>Settings Updated</h4>
                                    <p> <i class="zmdi zmdi-time"></i> Yesterday </p>
                                </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true"><i class="zmdi zmdi-fullscreen"></i></a>
            </li>
            <a href="#" class="btn_logout" title="Sign out"><i class="zmdi zmdi-power"></i></a>
        </ul>
    </div>
</nav>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar"> 
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="image"><a href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a></div>
                    <div class="detail">
                        <h4 id="user_name"></h4>
                        <small id="user_position"></small>                        
                    </div>
                    <a href="mail-inbox.html" title="Inbox"><i class="zmdi zmdi-email"></i></a>
                    <a href="#" class="btn_logout" title="Sign out"><i class="zmdi zmdi-power"></i></a>
                </div>
            </li>
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="index.php"><i class="zmdi zmdi-view-dashboard"></i><span>Dashboard</span> </a> </li>
            <li class="active open"> <a href="testimonials.php"><i class="zmdi zmdi-view-dashboard"></i><span>Testimonials</span> </a> </li>
            <li> <a href="resources.php"><i class="zmdi zmdi-image-alt"></i><span>Resources</span> </a> </li>
            <li class="active open"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-label col-red"></i><span>Priorities</span> </a>
                <ul class="ml-menu">
                    <li class="active"><a href="priorities-list.php">Priorities List</a> </li>
                    <li><a href="priorities-info.php">Priorities Info</a> </li>
                </ul>
            </li>
            <li> <a href="programs-list.php"><i class="zmdi zmdi-blogger"></i><span>Programs</span> </a> </li>
            <li> <a href="blog-post.php"><i class="zmdi zmdi-picture-in-picture"></i><span>Post New Blog</span> </a> </li>
            <li><a href="blog-list.php"><i class="zmdi zmdi-sort-amount-desc"></i><span>Blog List</span> </a> </li>
            <li><a href="general-settings.php"><i class="zmdi zmdi-settings-square"></i><span>General Settings</span> </a> </li>                
        </ul>
    </div>
    <!-- #Menu --> 
</aside>

<section class="content blog-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>New Priority</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i> Priority</a></li>
                    <li class="breadcrumb-item active">New Priority</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Add new Priority</strong></h2>
                    </div>
                    <div class="body">
                    <form action="#" id="priority_form" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" id="priority_icon" name="priority_icon" placeholder="Enter Priority icon">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="priority_title" name="priority_title" placeholder="Enter Title">
                </div>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="priority_text" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-round waves-effect">Add Now</button>
                </div>
            </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>
<!-- Jquery Core Js --> 
<script src="https://cdn.tiny.cloud/1/uqjr96ttph2jje5ulmyo6h4sxynphrx0yvf8a1ps4nqg4u8z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/dropzone/dropzone.js"></script> <!-- Dropzone Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/plugins/momentjs/moment.js"></script>
<script src="assets/js/pages/forms/basic-form-elements.js"></script>
<script>
    $(document).ready(function () {
        fetch_users_info();
        function fetch_users_info() {
            $.ajax({
                url: 'includes/fetch_users_info.php',
                method: 'POST',
                success: function(data) {
                    $('#user_name').html(data.fullname);
                    $('#user_position').html(data.userposition);
                }
            });
        }
        $(document).on('submit', '#priority_form', function (e) {
            e.preventDefault();

            // Create FormData object
            let formData = new FormData(this);

            // Send the AJAX request
            // alert('Priority added successfully!');
            $.ajax({
                type: "POST",
                url: "includes/post_priority_list.php",
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.error !== '') {
                        alert(response.error);
                    } else {
                        alert(response.msg);
                        $("#largeModal").modal('hide');
                        load_donation_list();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

               // logout function call
        $(".btn_logout").on('click', function(e){
            e.preventDefault();
            // Ajax request for logout
            $.ajax({
                type: 'POST',
                url: 'includes/logout.php', // PHP script to handle logout
                dataType: 'json',
                success: function(response) {
                    // Redirect to login page after logout
                    window.location.href = "sign-in.php";
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Error logging out. Please try again.');
                }
            });
        });
    });
</script>

</body>

<!-- Mirrored from www.wrraptheme.com/templates/compass/html/blog-post.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 May 2024 10:27:46 GMT -->
</html>