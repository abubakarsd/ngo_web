<?php
// Get the current full URL path
$current_page = trim($_SERVER['REQUEST_URI'], "/");

// Function to get site title
function getSiteTitle() {
    return "The Life We Deserve Foundation";
}

// Function to get navigation links dynamically, including submenus
function getNavLinks() {
    return [
        "ngo_web/index" => ["title" => "Home", "submenu" => []],
        "ngo_web/about" => ["title" => "About Us", "submenu" => []],
        "ngo_web/priorities" => ["title" => "Our Priorities", "submenu" => []],
        "ngo_web/pages" => [
            "title" => "Explore",
            "submenu" => [
                "ngo_web/programs" => "Our Programs",
                "ngo_web/resources" => "Resources"
            ]
            ],
        "ngo_web/blog" => ["title" => "Blog", "submenu" => []],
        "ngo_web/contact" => ["title" => "Contact Us", "submenu" => []],
        // "ngo_web/ngo_web/service-detail" => ["title" => "priorities", "submenu" => []]
    ];
}
?>