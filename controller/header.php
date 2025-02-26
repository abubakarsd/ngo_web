<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Web site created using create-react-app">
    <link rel="apple-touch-icon" href="/ngo_web/static/media/logo/logo-03.png">
    <link rel="manifest" href="/manifest.json">
    <title><?php echo getSiteTitle(); ?></title>
    <script defer src="/ngo_web/static/js/main.c41c699f.js"></script>
    <link href="/ngo_web/static/css/main.f4e1f862.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <!-- Bootstrap CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- Bootstrap JS (for modal functionality) -->
</head>
<body>
<header id="topnav" class="defaultscroll sticky">
    <div class="container">
    <a class="logo" href="/ngo_web/index">
            <span class="logo-light-mode">
                <img src="/ngo_web/static/media/logo/logo-03.png" class="l-dark" alt="">
                <img src="/ngo_web/static/media/logo/logo-03.png" class="l-light" alt="">
            </span>
            <img src="" class="logo-dark-mode" alt="">
        </a>
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" href="#">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
        <ul class="buy-button list-inline mb-0">
            <li class="list-inline-item mb-0"><div class="dropdown"><button type="button" class="dropdown-toggle btn btn-sm p-0 border-0"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="fea icon-20 login-btn-primary" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="fea icon-20 text-white login-btn-light" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button></div></li>
            <li class="list-inline-item d-lg-none ps-1 mb-0"><a href="/priorities"><div class="btn btn-sm btn-icon btn-pills btn-primary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492" xml:space="preserve"><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M241.626 329.96h-.264c-3.192 0-5.76-2.592-5.76-5.76s2.592-5.76 5.76-5.76h.24c11.568 0 21.744-1.752 29.424-5.064 6.024-2.592 10.488-6.144 12.528-9.96 1.032-1.944 1.92-4.824.12-7.512-3.048-4.536-11.112-5.448-17.64-4.776-16.08 1.632-29.424-3.96-40.152-8.448-6.936-2.904-12.936-5.424-17.952-5.424h-.024c-11.832 0-20.808 8.328-31.2 17.952-10.344 9.6-22.08 20.472-38.928 24.576-3.096.744-6.216-1.128-6.96-4.224-.744-3.096 1.128-6.216 4.224-6.96 13.92-3.408 24.048-12.768 33.816-21.84 11.16-10.344 22.68-21.024 39.048-21.024h.024c7.32 0 14.64 3.072 22.392 6.312 10.008 4.2 21.36 8.952 34.536 7.608 12.96-1.32 23.304 2.28 28.368 9.84 3.816 5.712 3.984 12.768.456 19.344-3.312 6.192-9.576 11.424-18.12 15.096-9.217 3.984-20.64 6.024-33.936 6.024z"/><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M179.082 385.304c-1.632 0-3.24-.672-4.368-2.016-2.064-2.424-1.8-6.048.624-8.112 9.768-8.4 18.072-13.488 26.088-16.032 7.152-2.28 14.184-2.472 22.08-.672 25.464 5.856 43.416 1.776 57.84-1.512.96-.216 1.92-.432 2.856-.648 10.272-2.304 31.848-12.528 51.264-24.288 10.368-6.264 19.32-12.504 25.896-18 9.624-8.04 11.304-12.168 11.592-13.224.336-1.296 1.008-4.416-.288-5.616-1.344-1.248-6.36-2.424-16.752 1.056-.552.192-3.024 1.272-5.64 2.4-18.696 8.16-68.352 29.856-97.968 30.816-3.168.096-5.832-2.4-5.952-5.568-.096-3.168 2.4-5.832 5.568-5.952 27.408-.888 77.328-22.68 93.72-29.856 3.984-1.752 5.64-2.448 6.552-2.76 16.272-5.496 24.384-2.232 28.32 1.44 5.616 5.256 4.632 12.912 3.528 16.992-1.44 5.448-6.456 11.688-15.336 19.104-7.032 5.88-16.464 12.456-27.336 19.008-20.688 12.528-43.2 23.088-54.72 25.68-.912.216-1.848.432-2.808.648-9.792 2.232-21.096 4.8-35.088 4.8-8.28 0-17.496-.888-27.888-3.288-10.488-2.4-20.52-.864-38.088 14.208-1.032.936-2.376 1.392-3.696 1.392z"/><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M141.186 431.072a5.733 5.733 0 0 1-4.824-2.616c-1.728-2.664-.984-6.24 1.68-7.968l42.624-27.744-55.68-85.584-42.624 27.744c-2.664 1.728-6.24.984-7.968-1.68-1.728-2.664-.984-6.24 1.68-7.968l47.448-30.888a5.756 5.756 0 0 1 4.344-.816 5.728 5.728 0 0 1 3.624 2.496l61.968 95.232c1.728 2.664.984 6.24-1.68 7.968l-47.448 30.888a5.79 5.79 0 0 1-3.144.936z"/><g><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M314.129 214.112a5.76 5.76 0 0 1-4.08-1.68l-37.128-37.128c-5.64-5.64-8.76-13.152-8.76-21.144s3.12-15.48 8.76-21.144c5.64-5.64 13.152-8.76 21.144-8.76 7.488 0 14.544 2.736 20.064 7.728 5.496-4.992 12.576-7.728 20.064-7.728 7.992 0 15.48 3.12 21.144 8.76 5.64 5.64 8.76 13.152 8.76 21.144s-3.12 15.48-8.76 21.144l-37.128 37.128a5.72 5.72 0 0 1-4.08 1.68zM294.065 135.8c-4.896 0-9.528 1.92-12.984 5.376-3.48 3.48-5.376 8.088-5.376 12.984s1.92 9.528 5.376 12.984l33.048 33.048 33.048-33.048c3.48-3.48 5.376-8.088 5.376-12.984s-1.92-9.528-5.376-12.984c-3.48-3.48-8.088-5.376-12.984-5.376s-9.528 1.92-12.984 5.376l-3 3c-2.256 2.256-5.904 2.256-8.136 0l-3-3c-3.479-3.456-8.087-5.376-13.008-5.376zm-17.064 1.32z"/></g><g><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M220.002 149.192c-.36 0-.744-.024-1.128-.12-3.12-.624-5.16-3.648-4.536-6.768 4.368-22.224 16.416-42.456 33.912-57.024a98.926 98.926 0 0 1 29.064-16.8c10.944-4.032 22.488-6.072 34.248-6.072 11.76 0 23.304 2.04 34.248 6.072a98.097 98.097 0 0 1 29.064 16.8c17.496 14.544 29.544 34.8 33.912 57.024.624 3.12-1.416 6.144-4.536 6.768-3.12.624-6.144-1.416-6.768-4.536-3.864-19.632-14.496-37.512-29.976-50.376-7.704-6.408-16.344-11.4-25.68-14.832a87.502 87.502 0 0 0-30.264-5.376c-10.416 0-20.592 1.8-30.264 5.376a86.425 86.425 0 0 0-25.68 14.832c-15.48 12.864-26.112 30.768-29.976 50.376a5.765 5.765 0 0 1-5.64 4.656zM311.585 260.648c-11.784 0-23.304-2.04-34.248-6.072a98.097 98.097 0 0 1-29.064-16.8c-17.52-14.568-29.568-34.799-33.936-57.023-.624-3.12 1.416-6.144 4.536-6.768 3.12-.624 6.144 1.416 6.768 4.536 3.864 19.632 14.496 37.512 29.976 50.376 7.704 6.408 16.344 11.4 25.68 14.832a87.502 87.502 0 0 0 30.264 5.376c10.416 0 20.592-1.8 30.264-5.376 9.36-3.432 18-8.424 25.68-14.832 15.48-12.864 26.112-30.768 29.976-50.376.624-3.12 3.648-5.16 6.768-4.536 3.12.624 5.16 3.648 4.536 6.768-4.368 22.224-16.416 42.456-33.912 57.024a98.926 98.926 0 0 1-29.064 16.8 99.279 99.279 0 0 1-34.224 6.071z"/><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M220.05 169.448c-8.76 0-15.888-7.128-15.888-15.888s7.128-15.888 15.888-15.888 15.888 7.128 15.888 15.888-7.128 15.888-15.888 15.888zm0-20.256a4.384 4.384 0 0 0-4.368 4.368c0 2.4 1.968 4.368 4.368 4.368 2.4 0 4.368-1.968 4.368-4.368 0-2.4-1.968-4.368-4.368-4.368z"/><g><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#FFFFFF" d="M403.169 185.096c-8.76 0-15.888-7.128-15.888-15.888s7.128-15.888 15.888-15.888 15.888 7.128 15.888 15.888-7.127 15.888-15.888 15.888zm0-20.256a4.384 4.384 0 0 0-4.368 4.368c0 2.4 1.968 4.368 4.368 4.368 2.4 0 4.368-1.968 4.368-4.368 0-2.4-1.968-4.368-4.368-4.368z"/></g></g></svg></div></a></li>
            <li class="list-inline-item"><a class="btn btn-sm btn-primary" href="/ngo_web/donate">Donate Us</a></li>
        </ul>
        <div id="navigation" class="d-lg-none d-none">
            <ul class="navigation-menu nav-right nav-light">
                <?php foreach (getNavLinks() as $url => $data): ?>
                    <li class="<?php echo ($current_page === $url) ? 'active' : ''; ?> 
                        <?php echo (!empty($data['submenu'])) ? 'has-submenu parent-parent-menu-item' : ''; ?>">
                        <a class="sub-menu-item" href="/<?php echo $url; ?>"><?php echo $data['title']; ?></a>
                        
                        <?php if (!empty($data['submenu'])): ?>
                            <span class="menu-arrow"></span>
                            <ul class="submenu">
                                <?php foreach ($data['submenu'] as $sub_url => $sub_title): ?>
                                    <li class="<?php echo ($current_page === $sub_url) ? 'active' : ''; ?>">
                                        <a class="sub-menu-item" href="/<?php echo $sub_url; ?>"><?php echo $sub_title; ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</header>
