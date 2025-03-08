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
              <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-label col-red"></i><span>Priorities</span> </a>
                <ul class="ml-menu">
                    <li><a href="priorities-list.php">Priorities List</a> </li>
                    <li><a href="priorities-info.php">Priorities Info</a> </li>
                    <li><a href="values-list.php">Our Values</a> </li>
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
                <h2>Testimonial list</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="zmdi zmdi-home"></i> Testimonial</a></li>
                    <li class="breadcrumb-item active">Testimonial List</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card product_item_list">
                    <div class="body table-responsive">
                        <div class="header">
                            <a href="create-testimonial.php" class="btn btn-primary">Creat New</a>
                        </div>
                        <table class="table table-hover m-b-0 footable footable-1 footable-paging footable-paging-center breakpoint-lg" style="">
                            <thead>
                                <tr class="footable-header">
                                    <th class="footable-sortable footable-first-visible" style="display: table-cell;">Title<span class="fooicon fooicon-sort"></span></th>
                                    <th class="footable-sortable" style="display: table-cell;">Info<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="sm xs" class="footable-sortable" style="display: table-cell;">Name<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs" class="footable-sortable" style="display: table-cell;">Role<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs md" class="footable-sortable" style="display: table-cell;">Image<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="xs md" class="footable-sortable" style="display: table-cell;">Rating<span class="fooicon fooicon-sort"></span></th>
                                    <th data-breakpoints="sm xs md" class="footable-sortable footable-last-visible" style="display: table-cell;">Action<span class="fooicon fooicon-sort"></span></th></tr>
                            </thead>
                            <tbody id="load_testimonial_list">

                            </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <div class="card">
                    <div class="body">                            
                        <ul class="pagination pagination-primary m-b-0">
                            <li class="page-item"><a class="page-link" href="#"><i class="zmdi zmdi-arrow-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="zmdi zmdi-arrow-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Edit Donation</h4>
            </div>
            <div class="modal-body">
            <form action="#" id="testimonial_form" enctype="multipart/form-data">
                <input type="hidden" id="testimonial_id" name="testimonial_id">
                <div class="form-group">
                    <input type="text" class="form-control" id="testimonial_title" name="testimonial_title" placeholder="Enter title">
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control" id="testimonial_name" name="testimonial_name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="testimonial_role" name="testimonial_role" placeholder="Enter Role">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="testimonial_rating" name="testimonial_rating" placeholder="Enter Rate">
                </div>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <textarea id="myTextarea" name="testimonial_details" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="frmFileUpload" class="dropzone m-b-20 m-t-20 dz-clickable">
                    <div class="dz-message">
                        <div class="drag-icon-cph"> <i class="material-icons">touch_app</i> </div>
                        <h3>Drop an image here or click to upload.</h3>
                        <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
                    </div>
                    <!-- No need for the input file element here -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
                        
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js --> 
<script src="https://cdn.tiny.cloud/1/uqjr96ttph2jje5ulmyo6h4sxynphrx0yvf8a1ps4nqg4u8z/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/plugins/dropzone/dropzone.js"></script> <!-- Dropzone Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script>
    var currentUrl = window.location.href;
    Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#frmFileUpload", {
    url: currentUrl, // Specify the URL for uploading files
    maxFiles: 1, // Maximum number of files allowed to be uploaded
    maxFilesize: 5, // Maximum file size in MB
    acceptedFiles: 'image/*', // Limit accepted file types to images only
    addRemoveLinks: true, // Show remove button for uploaded files
    dictDefaultMessage: 'Drop an image here or click to upload.', // Default message
    dictRemoveFile: 'Remove', // Text for remove file button
    dictCancelUpload: 'Cancel', // Text for cancel upload button
    dictInvalidFileType: 'Invalid file type.', // Error message for invalid file type
    dictFileTooBig: 'File is too big ({{filesize}} MB). Max file size: {{maxFilesize}} MB.', // Error message for file too big
    init: function() {
        // Customize initialization if needed
        this.on("addedfile", function(file) {
            // Handle file added event
            console.log("File added:", file);
            // Remove previous error messages if any
            $('.error-message').remove();
        });
    }
});
    $(document).ready(function(){
        tinymce.init({
    selector: '#myTextarea',
    plugins: 'advlist autolink lists link image charmap print preview anchor',
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
    height: 400,
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
    ]
});

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
        // load donation list
        load_testimonial();
        function load_testimonial(){
            $.ajax({
                type: "POST",
                url: "includes/load_testimonial.php",
                success: function (result) {
                    $("#load_testimonial_list").html(result);
                }
            });
            }
            // largeModal
            // edit donation function
            $(document).on('click', '.btn_edit_testimonial', function (e) {
                e.preventDefault();
                var testID = $(this).attr('id');

                $.ajax({
                    type: "POST",
                    url: "includes/edit_testimonial.php",
                    dataType: 'json',
                    data: {testID: testID},
                    success: function (result) {
                        $("#testimonial_id").val(result.id);
                        $("#testimonial_title").val(result.title);
                        $("#testimonial_name").val(result.name);
                        $("#testimonial_role").val(result.role);
                        $("#testimonial_rating").val(result.rating);
                        tinymce.get('myTextarea').setContent(result.text);

                        $("#largeModal").modal('show');
                    },
                    error: function () {
                        alert("Error fetching testimonial data.");
                    }
                });
            });

      // delete button action
            $(document).on('click', '.btn_delete_testimonial', function (e) {
                e.preventDefault();
                
                // Get the donation ID
                var testID = $(this).attr('id');
                
                // Display confirmation dialog
                var confirmation = confirm("Are you sure you want to delete this data?");
                
                // Check user's choice
                if (confirmation) {
                    // If user clicks OK, proceed with deletion
                    $.ajax({
                        type: "POST",
                        url: "includes/delete_testimonial.php",
                        dataType: 'json',
                        data: {testID: testID},
                        success: function (result) {
                            // Reload donation list after successful deletion
                            load_testimonial();
                            // Close the modal
                        }
                    });
                } else {
                    // If user clicks Cancel, do nothing
                    // Optionally, you can provide feedback to the user here
                }
            });


            // Handle form submission
            $(document).on('submit', '#testimonial_form', function (e) {
                e.preventDefault();

                // Get the content of the rich text editor
                var description = tinymce.get('myTextarea').getContent();

                // Create a FormData object to handle file uploads
                var formDataWithFiles = new FormData();

                // Append the first (and only) file added to Dropzone to FormData
                var files = myDropzone.getAcceptedFiles();
                if (files.length > 0) {
                    formDataWithFiles.append('file', files[0]);
                }

                // Append form data to FormData
                formDataWithFiles.append('testimonial_id', $('#testimonial_id').val());
                formDataWithFiles.append('testimonial_title', $('#testimonial_title').val());
                formDataWithFiles.append('testimonial_name', $('#testimonial_name').val());
                formDataWithFiles.append('testimonial_role', $('#testimonial_role').val());
                formDataWithFiles.append('testimonial_rating', $('#testimonial_rating').val());
                formDataWithFiles.append('testimonial_details', description);

                // Send the AJAX request
                $.ajax({
                    type: "POST",
                    url: "includes/update_testimonials.php",
                    data: formDataWithFiles,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.error !== '') {
                            alert(response.error);
                            console.log(response.error);
                        } else {
                            alert(response.msg);
                            $("#largeModal").modal('hide');
                            load_testimonial();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: ", xhr.responseText);
                        console.error("Status: ", status);
                        console.error("Error: ", error);
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