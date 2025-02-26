document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("topnav");
    const toggleBtn = document.getElementById("isToggle");
    const navigation = document.querySelector(".navigation-menu");
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

    // Toggle Mobile Menu
    if (toggleBtn && navigation) {
        toggleBtn.addEventListener("click", function (event) {
            event.preventDefault();
            navigation.classList.toggle("show-menu"); // Use a custom class instead of d-none
        });
    }

    // Handle Submenus for Mobile
    let dropdownButtons = document.querySelectorAll(".has-submenu > a");

    dropdownButtons.forEach(function (btn) {
        btn.addEventListener("click", function (event) {
            event.preventDefault();
            let parentLi = btn.parentElement;
            let submenu = parentLi.querySelector(".submenu");

            if (submenu) {
                submenu.classList.toggle("open");
                parentLi.classList.toggle("submenu-open"); // Add class to indicate it's open
            }
        });
    });

    // Keep active navigation highlighted
    let currentPath = window.location.pathname;
    let navLinks = document.querySelectorAll(".navigation-menu a");

    navLinks.forEach(link => {
        if (link.href.includes(currentPath)) {
            link.closest("li").classList.add("active");
            
            // Open submenu if inside a submenu
            let parentSubmenu = link.closest(".submenu");
            if (parentSubmenu) {
                parentSubmenu.classList.add("open");
                parentSubmenu.closest(".has-submenu").classList.add("submenu-open");
            }
        }
    });
        const videoButton = document.querySelector(".lightbox");
        const videoContainer = document.getElementById("videoContainer");
        const videoModal = new bootstrap.Modal(document.getElementById("videoModal"));
    
        videoButton.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default behavior
    
            // Simulate an AJAX request to get the YouTube video URL
            fetch("/ngo_web/controller/get-video-url.php") // Replace with your actual AJAX URL
                .then(response => response.json())
                .then(data => {
                    const videoUrl = data.url; // Expected to be a full YouTube embed URL
    
                    if (videoUrl) {
                        // Inject the YouTube iframe into the modal
                        videoContainer.innerHTML = `<iframe src="${videoUrl}" frameborder="0" allowfullscreen></iframe>`;
                        
                        // Show the modal
                        videoModal.show();
                    }
                })
                .catch(error => console.error("Error loading video:", error));
        });
    
        // Clear video on modal close
        document.getElementById("videoModal").addEventListener("hidden.bs.modal", function () {
            videoContainer.innerHTML = "";
        });
    });  
    // $(document).ready(function () {
    //     let slides = [
    //         {
    //             image: "/ngo_web/static/media/1.7f69c54a140a726fb49f.jpg",
    //             title: "Give a Helping Hand <br> for Children",
    //             description: "We value every human life placed in our hands and constantly work towards meeting the expectations of our patients."
    //         },
    //         {
    //             image: "/ngo_web/static/media/5.e8f17001a583f6134077.jpg",
    //             title: "Building Brighter Futures",
    //             description: "Empowering communities through education and sustainable development programs."
    //         },
    //         {
    //             image: "/ngo_web/static/media/3.4900ea7cd803e2c42272.jpg",
    //             title: "Join Us in Making a Difference",
    //             description: "Together, we can create a world where every child has access to opportunities."
    //         },
    //         {
    //             image: "/ngo_web/static/media/4.jpg",
    //             title: "A World of Hope & Possibilities",
    //             description: "Your support brings hope to those who need it the most."
    //         }
    //     ];
    
    //     let index = 0;
    //     let section = $("#home");
    //     let titleElement = $("#hero-title");
    //     let descElement = $("#hero-desc");
    
    //     // Set the first background immediately (no fade)
    //     section.css('background-image', 'url(' + slides[index].image + ')');
    
    //     function changeSlide() {
    //         index = (index + 1) % slides.length; // Loop through slides
    //         let nextSlide = slides[index];
    
    //         // Change background with a fade effect
    //         let overlay = $('<div class="bg-overlay bg-gradient-overlay"></div>').css({
    //             'background-image': 'url(' + nextSlide.image + ')',
    //             'position': 'absolute',
    //             'top': 0,
    //             'left': 0,
    //             'width': '100%',
    //             'height': '100%',
    //             'background-size': 'cover',
    //             'background-position': 'center',
    //             'opacity': 0,
    //             'z-index': -1
    //         });
    
    //         section.prepend(overlay);
    //         overlay.animate({ opacity: 1 }, 2000, function () {
    //             section.css('background-image', 'url(' + nextSlide.image + ')');
    //             overlay.remove();
    //         });
    
    //         // Fade out and change text
    //         titleElement.fadeOut(500, function () {
    //             titleElement.html(nextSlide.title).fadeIn(1000);
    //         });
    
    //         descElement.fadeOut(500, function () {
    //             descElement.text(nextSlide.description).fadeIn(1000);
    //         });
    //     }
    
    //     setInterval(changeSlide, 5000); // Change slide every 5 seconds
    // });    
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
    });