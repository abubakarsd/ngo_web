document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("topnav");
    const logoLight = document.querySelector(".logo-light-mode img.l-light");

    // Sticky Navbar: Change logo and styles when scrolling
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            header.classList.add("nav-sticky");
            if (logoLight) {
                logoLight.src = "/ngo_web/static/media/logo/logo-03.png"; // Dark logo
            }
        } else {
            header.classList.remove("nav-sticky");
            if (logoLight) {
                logoLight.src = "/ngo_web/static/media/logo/logo-03.png"; // Light logo
            }
        }
    });
    });
    
    function viewVideo(event) {
        event.preventDefault(); // Prevent link default behavior
    
        // Simulate an AJAX request to get the video URL
        fetch("/ngo_web/controller/get-video-url.php")
            .then(response => response.json())
            .then(data => {
                const videoUrl = data.url; // Expected to be a full YouTube embed URL
    
                if (videoUrl) {
                    document.getElementById("videoContainer").innerHTML = 
                        `<iframe src="${videoUrl}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
    
                    // Show modal
                    document.getElementById("videoModal").style.display = "flex";
                }
            })
            .catch(error => console.error("Error loading video:", error));
    }
    
    function closeVideoModal() {
        let modal = document.getElementById("videoModal");
        modal.style.display = "none";
        document.getElementById("videoContainer").innerHTML = ""; // Clears the video
    }    
    $(document).ready(function () {
        let slides = [];
        let index = 0;
        let section = $("#home");
        let titleElement = $("#hero-title");
        let descElement = $("#hero-desc");
    
        // Fetch data from the server
        $.ajax({
            url: "/ngo_web/controller/carousel_items.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                slides = data.map(slide => ({
                    image: "/ngo_web/static/media/" + slide.image, // Adjusting path
                    title: slide.title,
                    description: slide.description
                }));
    
                if (slides.length > 0) {
                    // Set the first background and text
                    section.css('background-image', 'url(' + slides[index].image + ')');
                    titleElement.html(slides[index].title);
                    descElement.text(slides[index].description);
    
                    function changeSlide() {
                        index = (index + 1) % slides.length; // Loop through slides
                        let nextSlide = slides[index];
    
                        // Change background with a fade effect
                        let overlay = $('<div class="bg-overlay bg-gradient-overlay"></div>').css({
                            'background-image': 'url(' + nextSlide.image + ')',
                            'position': 'absolute',
                            'top': 0,
                            'left': 0,
                            'width': '100%',
                            'height': '100%',
                            'background-size': 'cover',
                            'background-position': 'center',
                            'opacity': 0,
                            'z-index': -1
                        });
    
                        section.prepend(overlay);
                        overlay.animate({ opacity: 1 }, 2000, function () {
                            section.css('background-image', 'url(' + nextSlide.image + ')');
                            overlay.remove();
                        });
    
                        // Fade out and change text
                        titleElement.fadeOut(500, function () {
                            titleElement.html(nextSlide.title).fadeIn(1000);
                        });
    
                        descElement.fadeOut(500, function () {
                            descElement.text(nextSlide.description).fadeIn(1000);
                        });
                    }
    
                    setInterval(changeSlide, 5000); // Change slide every 5 seconds
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
        function loadPageInfo() {
            $.ajax({
                url: "/ngo_web/controller/page_info.php",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (!data.error) {
                        $(".about-info").html(data.page_info);
                        $(".mission-info").html(data.mission);
                        $(".vision-info").html(data.vission);
                        $(".contact-phone").text(data.phone_number);
                        $(".contact-email").text(data.page_email);
                        $(".contact-address").text(data.page_address);
                        $(".social-facebook").attr("href", data.media_facebook);
                        $(".social-twitter").attr("href", data.media_twiter);
                        $(".social-instagram").attr("href", data.media_ig);
                        $(".social-linkedin").attr("href", data.linkedin);
                    } else {
                        console.error("Error: No data found");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }
        loadPageInfo();
        
        function loadhomePrograms() {
            $.ajax({
                url: "/ngo_web/controller/get_home_programs.php",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        let programsHTML = "";
                        data.forEach(program => {
                            programsHTML += `
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="blog position-relative overflow-hidden shadow rounded p-4">
                                        <div class="position-relative">
                                            <div class="blog-image position-relative overflow-hidden rounded shadow">
                                                <img src="/ngo_web/static/media/${program.program_img}" class="img-fluid" alt="">
                                            </div>
                                            <div class="position-absolute top-100 start-0 translate-middle-y ms-2">
                                                <a class="badge bg-primary" href="${program.program_detail_url}">The Life We Deserve Foundation</a>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <a class="text-dark title h5" href="${program.program_detail_url}">${program.program_head}</a>
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <div class="text-sm-start">
                                                        <span><span class="mdi mdi-calendar-clock align-middle fs-6 text-primary"></span> ${program.days}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span><span class="mdi mdi-map-marker align-middle fs-6 text-primary"></span> ${program.prog_location} </span>
                                                </div>
                                            </div>
                                            <p class="text-muted my-2">${stripHtml(program.prog_discription).substring(0, 100)}...</p>
                                            <a class="text-dark read-more" href="${program.program_detail_url}">Read More <i class="mdi mdi-chevron-right align-middle"></i></a>
                                        </div>
                                    </div>
                                </div>`;
                        });
        
                        $("#programs-container").html(programsHTML);
                    } else {
                        $("#programs-container").html("<p>No programs available at the moment.</p>");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }
        
        // Define stripHtml function
        function stripHtml(html) {
            let tempDiv = document.createElement("div");
            tempDiv.innerHTML = html;
            return tempDiv.textContent || tempDiv.innerText || "";
        }
        
        // Call function
        loadhomePrograms();        

        let slideIndex = 0;
        let slideInterval;

function fetchTestimonials() {
    $.ajax({
        url: "/ngo_web/controller/testimonials.php", // Fetch from backend PHP
        method: "GET",
        dataType: "json",
        success: function (response) {
            let testimonialsHTML = "";
            response.forEach((testimonial, index) => {
                testimonialsHTML += `
                    <div class="tiny-slide tns-item m-4" data-index="${index}" style="position: absolute; top: 0; left: 100%; opacity: 0; transition: transform 1s, opacity 1s;">
                        <div class="position-relative overflow-hidden">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">${testimonial.title}</h6>
                                <ul class="list-unstyled mb-0 text-warning">
                                    ${generateStars(testimonial.rating)}
                                </ul>
                            </div>
                            <p class="text-muted fst-italic mt-2">"${stripHtml(testimonial.text)}"</p>
                            <div class="d-flex align-items-center">
                                <img src="/ngo_web/static/media/${testimonial.image}" class="avatar avatar-small rounded-pill shadow" alt="">
                                <div class="ms-2">
                                    <h6 class="text-dark small mb-0">${testimonial.name}</h6>
                                    <small class="text-muted d-block">${testimonial.role}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $(".tns-slider").html(testimonialsHTML); // Update the testimonial container

            // Reset slide index
            slideIndex = 0;

            // Set first slide as active
            let slides = document.querySelectorAll(".tiny-slide");
            if (slides.length > 0) {
                slides[0].style.left = "0";
                slides[0].style.opacity = "1";
            }

            startSliding(); // Restart the sliding effect
        }
    });
}

function generateStars(rating) {
    let stars = "";
    for (let i = 0; i < rating; i++) {
        stars += `<li class="list-inline-item"><i class="mdi mdi-star"></i></li>`;
    }
    return stars;
}

function startSliding() {
    clearInterval(slideInterval); // Clear any existing intervals

    let slides = document.querySelectorAll(".tiny-slide");

    if (slides.length === 0) return; // Prevent errors if no slides exist

    slideInterval = setInterval(() => {
        let current = slideIndex % slides.length;
        let next = (slideIndex + 1) % slides.length;

        // Move current slide out to the left
        slides[current].style.transform = "translateX(-100%)";
        slides[current].style.opacity = "0";

        // Move next slide into view from the right
        slides[next].style.left = "0";
        slides[next].style.transform = "translateX(0)";
        slides[next].style.opacity = "1";

        // Reset previous slides so they can be used again
        setTimeout(() => {
            slides[current].style.left = "100%"; // Move back to right for reuse
        }, 1000);

        slideIndex++;
    }, 5000); // Slide every 5 seconds
}

// Fetch testimonials every 30 seconds and refresh slides
fetchTestimonials();
setInterval(fetchTestimonials, 30000);

function fetchPriorities() {
    $.ajax({
        url: "/ngo_web/controller/fetch_home_priorities.php", // Adjust if necessary
        method: "GET",
        dataType: "json",
        success: function (response) {
            let priorityHTML = "";
            response.forEach(priority => {
                priorityHTML += `
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="position-relative features shadow text-center rounded p-4 pt-5">
                            <div class="position-relative d-flex justify-content-center">${priority.icon}
                                <div class="feature-icon bg-soft-primary position-absolute top-0 translate-middle"></div>
                            </div>
                            <div class="mt-4">
                                <a class="h5 text-dark link-title" href="/ngo_web/priorities-detail?id=${priority.id}">${priority.title}</a>
                                <p class="text-muted mt-3">${priority.short_text}</p>
                                <a class="text-primary" href="/ngo_web/priorities-detail?id=${priority.id}">Learn More <i class="mdi mdi-arrow-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Inject into the correct section
            $("#prioritiesContainer").html(priorityHTML);
        },
        error: function () {
            console.error("Failed to fetch priorities.");
        }
    });
}
fetchPriorities();

function fetchValues() {
    $.ajax({
        url: "/ngo_web/controller/fetch_values.php", // Adjust if necessary
        method: "GET",
        dataType: "json",
        success: function (response) {
            let priorityHTML = "";
            response.forEach(priority => {
                priorityHTML += `
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="position-relative features shadow text-center rounded p-4 pt-5">
                            <div class="position-relative d-flex justify-content-center">${priority.icon}
                                <div class="feature-icon bg-soft-primary position-absolute top-0 translate-middle"></div>
                            </div>
                            <div class="mt-4">
                                <p class="h5 text-dark link-title">${priority.title}</p>
                                <p class="text-muted mt-3">${priority.short_text}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Inject into the correct section
            $("#valuesContainer").html(priorityHTML);
        },
        error: function () {
            console.error("Failed to fetch priorities.");
        }
    });
}
fetchValues();

function fetchPriorities_page() {
    $.ajax({
        url: "/ngo_web/controller/fetch_page_priorities.php", // Adjust if necessary
        method: "GET",
        dataType: "json",
        success: function (response) {
            let priorityHTML = "";
            response.forEach(priority => {
                priorityHTML += `
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="position-relative features shadow text-center rounded p-4 pt-5">
                            <div class="position-relative d-flex justify-content-center">${priority.icon}
                                <div class="feature-icon bg-soft-primary position-absolute top-0 translate-middle"></div>
                            </div>
                            <div class="mt-4">
                                <a class="h5 text-dark link-title" href="/ngo_web/priorities-detail?id=${priority.id}">${priority.title}</a>
                                <p class="text-muted mt-3">${priority.short_text}</p>
                                <a class="text-primary" href="/ngo_web/priorities-detail?id=${priority.id}">Learn More <i class="mdi mdi-arrow-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Inject into the correct section
            $("#prioritiesContainer_page").html(priorityHTML);
        },
        error: function () {
            console.error("Failed to fetch priorities.");
        }
    });
}
fetchPriorities_page();
function fetchTeamMembers() {
    $.ajax({
        url: "/ngo_web/controller/fetch_team.php", // Ensure the path is correct
        method: "GET",
        dataType: "json",
        success: function (response) {
            let teamHTML = "";
            response.forEach(member => {
                teamHTML += `
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                        <div class="card team team-primary bg-transparent text-center mb-5">
                            <div class="card-img team-image d-inline-block mx-auto rounded overflow-hidden">
                                <img src="/ngo_web/static/media/${member.team_image}" class="img-fluid" alt="">
                                <ul class="list-unstyled team-social mb-0">
                                    ${member.facebook_link ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.facebook_link}" target="_blank"><i class="mdi mdi-facebook"></i></a></li>` : ""}
                                    ${member.instagram_link ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.instagram_link}" target="_blank"><i class="mdi mdi-instagram"></i></a></li>` : ""}
                                    ${member.x_link ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.x_link}" target="_blank"><i class="mdi mdi-twitter"></i></a></li>` : ""}
                                    ${member.in_link ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.in_link}" target="_blank"><i class="mdi mdi-linkedin"></i></a></li>` : ""}
                                </ul>
                            </div>
                            <div class="content bg-white mx-4 p-4 z-1 rounded shadow">
                                <a class="text-dark h5 mb-0 title" href="/ngo_web/team-details?id=${member.id}">${member.team_name}</a>
                                <h6 class="text-muted mb-0 mt-1 fw-normal">${member.team_position}</h6>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Inject the generated HTML into the container
            $("#teamContainer").html(teamHTML);
        },
        error: function () {
            console.error("Failed to fetch team members.");
        }
    });
}

fetchTeamMembers();

function fetchRecentBlogs() {
    $.ajax({
        url: "/ngo_web/controller/fetch_recent_blogs.php", // Adjust the path if needed
        method: "GET",
        dataType: "json",
        success: function (response) {
            let blogHTML = "";
            response.forEach(blog => {
                blogHTML += `
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog position-relative overflow-hidden shadow rounded p-4">
                            <div class="position-relative">
                                <div class="blog-image position-relative overflow-hidden rounded shadow">
                                    <img src="/ngo_web/static/media/${blog.blog_image}" class="img-fluid" alt="">
                                </div>
                                <div class="position-absolute top-100 start-0 translate-middle-y ms-2">
                                    <a class="badge bg-primary" href="/">The Life We Deserve Foundation</a>
                                </div>
                            </div>
                            <div class="pt-4">
                                <a class="text-dark title h5" href="/ngo_web/blog-detail?id=${blog.id}">${blog.blog_header.substring(0, 80)}...</a>
                                <p class="text-muted my-2">${stripHtml(blog.blog_details).substring(0, 80)}...</p>
                                <a class="text-dark read-more" href="/ngo_web/blog-detail?id=${blog.id}">Read More <i class="mdi mdi-chevron-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>
                `;
            });

            $("#recentBlogsContainer").html(blogHTML);
        },
        error: function () {
            console.error("Failed to fetch recent blogs.");
        }
    });
}
    fetchRecentBlogs();

    fetchPartners();
    function fetchPartners() {
        $.ajax({
            url: "/ngo_web/controller/fetch_partners.php", // Adjust URL if needed
            method: "GET",
            dataType: "json",
            success: function (response) {
                let partnersHTML = "";
                response.forEach(partner => {
                    partnersHTML += `
                        <div class="swiper-slide text-center">
                            <img src="/ngo_web/static/media/${partner.logo}" class="img-fluid mx-auto" alt="${partner.name}" style="max-height: 80px;">
                        </div>
                    `;
                });

                $("#partnersContainer").html(partnersHTML);

                // Initialize Swiper AFTER content is loaded
                new Swiper(".mySwiper", {
                    loop: true,
                    spaceBetween: 20,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        320: { slidesPerView: 2 },
                        600: { slidesPerView: 3 },
                        1000: { slidesPerView: 5 }
                    }
                });
            },
            error: function () {
                console.error("Failed to fetch partners.");
            }
        });
    }

    directors_fetch();

    function directors_fetch() {
        $.ajax({
            url: "/ngo_web/controller/fetch_director.php", // Adjust path if needed
            method: "GET",
            dataType: "json",
            success: function (response) {
                let teamHTML = "";
                response.forEach(member => {
                    teamHTML += `
                        <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                            <div class="card team team-primary bg-transparent text-center mb-5">
                                <div class="card-img team-image d-inline-block mx-auto rounded overflow-hidden">
                                    <img src="/ngo_web/static/media/${member.image}" class="img-fluid" alt="${member.name}">
                                    <ul class="list-unstyled team-social mb-0">
                                        ${member.facebook ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.facebook}" target="_blank"><i class="mdi mdi-facebook"></i></a></li>` : ""}
                                        ${member.twitter ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.twitter}" target="_blank"><i class="mdi mdi-twitter"></i></a></li>` : ""}
                                        ${member.linkedin ? `<li class="mt-1"><a class="btn btn-sm btn-pills btn-icon" href="${member.linkedin}" target="_blank"><i class="mdi mdi-linkedin"></i></a></li>` : ""}
                                    </ul>
                                </div>
                                <div class="content bg-white mx-4 p-4 z-1 rounded shadow">
                                    <a class="text-dark h5 mb-0 title" href="mailto:">${member.name}</a>
                                    <h6 class="text-muted mb-0 mt-1 fw-normal">${member.position}</h6>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $("#directorContainer").html(teamHTML);
            },
            error: function () {
                console.error("Failed to fetch team members.");
            }
        });
    }
    function loadprograms(page = 1) {
        $.ajax({
            url: "/ngo_web/controller/get_programs_page.php",
            type: "GET",
            data: { page: page },
            dataType: "json",
            success: function (response) {
                if (response.blogs.length > 0) {
                    let blogsHTML = "";
                    response.blogs.forEach(blog => {
                        blogsHTML += `
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="blog position-relative overflow-hidden shadow rounded p-4">
                                    <div class="position-relative">
                                        <div class="blog-image position-relative overflow-hidden rounded shadow">
                                            <img src="/ngo_web/static/media/${blog.program_img}" class="img-fluid" alt="">
                                        </div>
                                        <div class="position-absolute top-100 start-0 translate-middle-y ms-2">
                                            <a class="badge bg-primary" href="${blog.program_detail_url}">The Life We Deserve Foundation</a>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <a class="text-dark title h5" href="${blog.program_detail_url}">${blog.program_head}</a>
                                        <div class="row align-items-center">
                                            <div class="col-sm-6">
                                                <div class="text-sm-start">
                                                    <span><span class="mdi mdi-calendar-clock align-middle fs-6 text-primary"></span> ${blog.days}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <span><span class="mdi mdi-map-marker align-middle fs-6 text-primary"></span> ${blog.prog_location}</span>
                                            </div>
                                        </div>
                                        <p class="text-muted my-2">${blog.prog_discription.substring(0, 100)}...</p>
                                        <a class="text-dark read-more" href="${blog.program_detail_url}">Read More <i class="mdi mdi-chevron-right align-middle"></i></a>
                                    </div>
                                </div>
                            </div>`;
                    });

                    $("#programs_container_page").html(blogsHTML);
                    updatePagination(response.current_page, response.total_pages);
                } else {
                    $("#programs_container_page").html("<p>No programs available at the moment.</p>");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function updatePagination(currentPage, totalPages) {
        let paginationHTML = `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous">
                <span aria-hidden="true"><i class="mdi mdi-chevron-left align-middle fs-6"></i></span>
            </a>
        </li>`;

        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`;
        }

        paginationHTML += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next">
                <span aria-hidden="true"><i class="mdi mdi-chevron-right align-middle fs-6"></i></span>
            </a>
        </li>`;

        $(".pagination").html(paginationHTML);
    }

    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        let page = $(this).data("page");
        if (page) {
            loadprograms(page);
        }
    });

    // Load first page on document ready
    loadprograms();

    function loadBlog_page(page = 1) {
        $.ajax({
            url: "/ngo_web/controller/get_blog_page.php",
            type: "GET",
            data: { page: page },
            dataType: "json",
            success: function (response) {
                if (response.blogs.length > 0) {
                    let blogsHTML = "";
                    response.blogs.forEach(blog => {
                        blogsHTML += `<div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog position-relative overflow-hidden shadow rounded p-4">
                            <div class="position-relative">
                                <div class="blog-image position-relative overflow-hidden rounded shadow">
                                    <img src="/ngo_web/static/media/${blog.blog_image}" class="img-fluid" alt="">
                                </div>
                                <div class="position-absolute top-100 start-0 translate-middle-y ms-2">
                                    <a class="badge bg-primary" href="/">The Life We Deserve Foundation</a>
                                </div>
                            </div>
                            <div class="pt-4">
                                <a class="text-dark title h5" href="/ngo_web/blog-detail?id=${blog.id}">${blog.blog_header.substring(0, 80)}...</a>
                                <p class="text-muted my-2">${blog.blog_details.substring(0, 80)}...</p>
                                <a class="text-dark read-more" href="${blog.blog_detail_url}">Read More <i class="mdi mdi-chevron-right align-middle"></i></a>
                            </div>
                        </div>
                    </div>`;
                    });

                    $("#blog_post_page").html(blogsHTML);
                    updatePagination_blog(response.current_page, response.total_pages);
                } else {
                    $("#blog_post_page").html("<p>No programs available at the moment.</p>");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }

    function updatePagination_blog(currentPage, totalPages) {
        let paginationHTML = `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous">
                <span aria-hidden="true"><i class="mdi mdi-chevron-left align-middle fs-6"></i></span>
            </a>
        </li>`;

        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`;
        }

        paginationHTML += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next">
                <span aria-hidden="true"><i class="mdi mdi-chevron-right align-middle fs-6"></i></span>
            </a>
        </li>`;

        $(".pagination").html(paginationHTML);
    }

    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        let page = $(this).data("page");
        if (page) {
            loadBlog_page(page);
        }
    });
    // Load first page on document ready
    loadBlog_page();

    function loadResource_page() {
        $.ajax({
            url: "/ngo_web/controller/fetch_resource_page.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.length > 0) {
                    let resourceHTML = "";
                    response.forEach(resource => {
                        resourceHTML += ` 
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="blog position-relative overflow-hidden shadow rounded p-4">
                                <div class="position-relative">
                                    <div class="blog-image position-relative overflow-hidden rounded shadow">
                                        <img src="/ngo_web/static/media/${resource.resource_img}" class="img-fluid preview-img" alt="" onclick="viewImage(this.src)">
                                        <div class="image-overlay">
                                            <span class="plus-icon" onclick="viewImage('/ngo_web/static/media/${resource.resource_img}')">+</span>
                                        </div>
                                    </div>
                                    <div class="position-absolute top-100 start-0 translate-middle-y ms-2">
                                        <a class="badge bg-primary" target="_blank" href="${resource.resource_link}">${resource.resource_name}</a>
                                    </div>
                                </div>
                                <br>
                                <a class="text-dark read-more" target="_blank" href="${resource.resource_link}">View Document <i class="mdi mdi-chevron-right align-middle"></i></a>
                            </div>
                        </div>`;
                    });
    
                    $("#loadrows_resources").html(resourceHTML);
                } else {
                    $("#loadrows_resources").html("<p>No resource available at the moment.</p>");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    }
    
    loadResource_page();    
        // Get Priority ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        const priorityId = urlParams.get("id");
    
        if (priorityId) {
            // Fetch Priority Details
            $.ajax({
                url: "/ngo_web/controller/get_priority_details.php",
                type: "GET",
                data: { id: priorityId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $("#priority_image").attr("src", "/ngo_web/static/media/" + response.data.page_img);
                        $("#priority_details").html(response.data.page_discription);
                    } else {
                        $("#priority_details").html("<p>No priority details found.</p>");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching priority details:", error);
                }
            });
    
            // Fetch Program Listings
            $.ajax({
                url: "/ngo_web/controller/get_programs_list.php",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        let programsHTML = "";
                        response.data.forEach(program => {
                            programsHTML += `
                                <a class="bg-light rounded d-flex justify-content-between text-dark py-3 px-4 mt-2" 
                                   href="/ngo_web/project-detail?id=${program.id}">
                                    <span class="fw-semibold">${program.program_head}</span>
                                    <i class="mdi mdi-chevron-right align-middle"></i>
                                </a>`;
                        });
                        $("#loadprogrammes").html(programsHTML);
                    } else {
                        $("#loadprogrammes").html("<p>No programs available.</p>");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching programs:", error);
                }
            });
        } else {
            $("#priority_details").html("<p>Invalid priority ID.</p>");
        }
        $("#prog_comments").off("submit").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission
    
            let formData = {
                progID: new URLSearchParams(window.location.search).get("id"), // Get program ID from URL
                name: $("#comment_name").val(),
                email: $("#comment_email").val(),
                message: $("#comment_message").val()
            };
    
            $.ajax({
                url: "/ngo_web/controller/post_prog_comment.php",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#comment_submit").attr("disabled", true);
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $("#prog_comments")[0].reset(); // Reset the form
                        loadComments(); // Reload comments
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                },
                complete: function () {
                    $("#comment_submit").attr("disabled", false);
                }
            });
        });

        $("#blog_comment_form").off("submit").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission
    
            let formData = {
                blogID: new URLSearchParams(window.location.search).get("id"), // Get program ID from URL
                name: $("#comment_blog_name").val(),
                email: $("#comment_blog_email").val(),
                message: $("#comment_blog_message").val()
            };
    
            $.ajax({
                url: "/ngo_web/controller/post_blog_comment.php",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#comment_blog_submit").attr("disabled", true);
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $("#blog_comment_form")[0].reset(); // Reset the form
                        loadComments_blog(); // Reload comments
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                },
                complete: function () {
                    $("#comment_blog_submit").attr("disabled", false);
                }
            });
        });

        function loadComments() {
            let programID = new URLSearchParams(window.location.search).get("id");
        
            $.ajax({
                url: "/ngo_web/controller/fetch_prog_comments.php",
                type: "GET",
                data: { progID: programID }, // FIXED PARAMETER
                dataType: "json",
                success: function (response) {
                    console.log("Response:", response); // DEBUGGING
                    if (response.success) {
                        let commentsHTML = "";
                        if (response.comments.length > 0) {
                            response.comments.forEach(comment => {
                                commentsHTML += `
                                    <li class="mt-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="/ngo_web/static/media/363639-200.png" class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                                                <div class="commentor-detail ms-3">
                                                    <h6 class="mb-0">${comment.commentor_name}</h6>
                                                    <small class="text-muted">${comment.comments_date}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-muted fst-italic p-3 bg-light rounded">"${comment.commentor_post}"</p>
                                        </div>
                                    </li>
                                `;
                            });
                        } else {
                            commentsHTML = `<p class="text-muted">No comments yet. Be the first to comment!</p>`;
                        }
                        $(".media-list").html(commentsHTML);
                    } else {
                        console.error("Error fetching comments:", response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }        
        // Load comments on page load
        loadComments();

        function loadComments_blog() {
            let blogID = new URLSearchParams(window.location.search).get("id");
        
            $.ajax({
                url: "/ngo_web/controller/fetch_blog_comments.php",
                type: "GET",
                data: { blogID: blogID }, // FIXED PARAMETER
                dataType: "json",
                success: function (response) {
                    console.log("Response:", response); // DEBUGGING
                    if (response.success) {
                        let commentsHTML = "";
                        if (response.comments.length > 0) {
                            response.comments.forEach(comment => {
                                commentsHTML += `
                                    <li class="mt-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <img src="/ngo_web/static/media/363639-200.png" class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                                                <div class="commentor-detail ms-3">
                                                    <h6 class="mb-0">${comment.commentor_name}</h6>
                                                    <small class="text-muted">${comment.comments_date}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-muted fst-italic p-3 bg-light rounded">"${comment.commentor_post}"</p>
                                        </div>
                                    </li>
                                `;
                            });
                        } else {
                            commentsHTML = `<p class="text-muted">No comments yet. Be the first to comment!</p>`;
                        }
                        $(".media-list-blog").html(commentsHTML);
                    } else {
                        console.error("Error fetching comments:", response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }        
        // Load comments on page load
        loadComments_blog();

        function loadprograms_pages() {
    let programID = new URLSearchParams(window.location.search).get("id");

    if (!programID) {
        $("#program_details").html(`<p class="text-danger">Invalid program ID.</p>`);
        return;
    }

    $.ajax({
        url: "/ngo_web/controller/fetch_program_details.php",
        type: "GET",
        data: { id: programID },
        dataType: "json",
        success: function (response) {
            console.log("Response:", response);
            if (response.success) {
                $("#program_image").attr("src", response.program.program_img);
                $("#program_details").html(response.program.prog_discription);
            } else {
                $("#program_details").html(`<p class="text-danger">${response.message}</p>`);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            console.error("Server Response:", xhr.responseText);
            $("#program_details").html(`<p class="text-danger">Server error occurred.</p>`);
        }
    });
        }
        loadprograms_pages();

        function fetch_blog_page() {
            let blogID = new URLSearchParams(window.location.search).get("id");
        
            if (!blogID) {
                $("#blog_header").text("Invalid Blog ID");
                return;
            }
        
            $.ajax({
                url: "/ngo_web/controller/fetch_blog_details.php",
                type: "GET",
                data: { id: blogID },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $("#blog_header").text(response.blog.blog_header);
                        $("#blog_author").text(response.blog.author);
                        $("#blog_author").attr("href", "/ngo_web/blog-detail?id=" + blogID);
                        $("#blog_date").text(response.blog.date_post);
                        $("#blog_image").attr("src", response.blog.blog_image);
                        $("#blog_body").html(response.blog.blog_details); // Insert HTML content
                    } else {
                        $("#blog_header").text("Blog Not Found");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    $("#blog_header").text("Server Error. Please try again.");
                }
            });
        }
        fetch_blog_page();
        
        blog_recent();
        function blog_recent() {
            $.ajax({
                url: "/ngo_web/controller/fetch_recent_blogs.php", // Ensure the path is correct
                type: "GET",
                dataType: "json",
                success: function (response) {
                    console.log("AJAX Response:", response); // Debugging output
        
                    if (response.length > 0) {
                        let recentBlogsHtml = "";
        
                        response.forEach(blog => {
                            recentBlogsHtml += `
                                <div class="blog blog-primary d-flex align-items-center mt-3">
                                    <img src="/ngo_web/static/media/${blog.blog_image}" class="avatar avatar-small rounded" alt="" style="width: auto;">
                                    <div class="flex-1 ms-3">
                                        <a class="d-block title text-dark fw-medium" href="/ngo_web/blog-detail?id=${blog.id}">${blog.blog_header}</a>
                                        <span class="text-muted small">${formatDate(blog.date_post)}</span>
                                    </div>
                                </div>
                            `;
                        });
        
                        $("#recent_blogs").html(recentBlogsHtml);
                    } else {
                        $("#recent_blogs").html("<p class='text-muted'>No recent blogs available.</p>");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    $("#recent_blogs").html("<p class='text-danger'>Failed to load recent blogs.</p>");
                }
            });
        }
        
        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { day: "numeric", month: "long", year: "numeric" };
            return date.toLocaleDateString("en-US", options);
        }
        
        function loadteam_info_pages() {
            let teamID = new URLSearchParams(window.location.search).get("id");
        
            if (!teamID) {
                $("#team_info_page").html(`<p class="text-danger">Invalid program ID.</p>`);
                return;
            }
        
            $.ajax({
                url: "/ngo_web/controller/fetch_team_details.php",
                type: "GET",
                data: { id: teamID },
                dataType: "json",
                success: function (response) {
                    console.log("Response:", response);
                    if (response.success) {
                        $("#team_img").attr("src", response.program.team_image);
                        $("#team_name").html(response.program.team_name + "<br> <span class='text-muted'>" + response.program.team_position + "</span> ");
                        $("#team_info_page").html(response.program.about_team);
                        $("#fb_link").attr("src", response.program.facebook_link);
                        $("#x_link").attr("src", response.program.x_link);
                        $("#email_link").attr("src", response.program.email_address);
                        $(".email_link").html(response.program.email_address);
                        $("#ig_link").attr("src", response.program.instagram_link);
                        $("#ln_link").attr("src", response.program.in_link);
                    } else {
                        $("#team_info_page").html(`<p class="text-danger">${response.message}</p>`);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                    console.error("Server Response:", xhr.responseText);
                    $("#team_info_page").html(`<p class="text-danger">Server error occurred.</p>`);
                }
            });
        }
        loadteam_info_pages();

        $(document).off("click", "#isToggle").on("click", "#isToggle", function (e) {
            e.preventDefault();
            
            let navBar = $("#navigation"); // Get the navigation element
            
            // Toggle the visibility classes
            if (navBar.hasClass("d-none")) {
                navBar.removeClass("d-none").addClass("d-block");
                $("#isToggle").addClass("open");
            } else {
                navBar.removeClass("d-block").addClass("d-none");
                $("#isToggle").removeClass("open");
            }
        });

        // $(document).off("click", ".sub-menu-item").on("click", ".sub-menu-item", function (e) {
        //     e.preventDefault();
            
        //     let subMenu = $("#submenu"); // Get the sub-menu element
            
        //     // Toggle the visibility classes
        //     if (subMenu.hasClass("d-lg-none d-none")) {
        //         subMenu.removeClass("d-lg-none d-none").addClass("d-lg-block d-block");
        //     } else {
        //         subMenu.removeClass("d-lg-block d-block").addClass("d-lg-none d-none");
        //     }
        // });
        
        function dynamic_button_change() {
            $.ajax({
                url: "/ngo_web/controller/fetch_dynamic_button.php", // Fetch data from PHP
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.error) {
                        console.error("Error:", response.error);
                        return;
                    }
        
                    let dynamicButton = $("#dynamic_button");
                    dynamicButton.text(response.btn_text); // Set button text
        
                    if (response.btn_style === "btn-link-external") {
                        dynamicButton.attr("href", response.txt_external);
                        dynamicButton.attr("target", "_blank"); // Open in a new tab
                    } else if (response.btn_style === "btn-link-internal") {
                        dynamicButton.attr("href", "/ngo_web/callbod");
                        dynamicButton.attr("target", ""); // Open in the same page
                    } else {
                        // Default: No link assigned
                        dynamicButton.attr("href", "#");
                        dynamicButton.attr("target", ""); 
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }
        // Call function on page load
        dynamic_button_change();
                                   
    });

    function viewImage(imageSrc) {
        document.getElementById("modalImage").src = imageSrc;
        document.getElementById("imageModal").style.display = "flex"; // Show modal
    }
    function closeModal() {
        document.getElementById("imageModal").style.display = "none"; // Hide modal
    }