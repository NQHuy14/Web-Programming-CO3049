<?php
include_once("component/header.php");
?>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <div class="container">
                <a class="navbar-brand fw-bold fs-2" href="index.php?page=home">
                    <span>
                        <img src="img/cvIcon.png" alt="" class="img-thumbnail" id="logo" loading="lazy" />
                    </span>
                    <span class="navbar-brand-text">CV</span> Design
                </a>

                <button type="button" class="btn btn-login btn-primary sm-lg-4 px-4 fs-18 mt-3 mt-lg-0 ms-auto d-none"
                    id="manage-btn">
                    <a href="index.php?page=manage-resume" class="text-decoration-none text-white">
                        View my CVs
                    </a>
                </button>

                <button type="button" class="btn btn-login btn-primary ms-lg-4 px-4 fs-18 mt-3 mt-lg-0"
                    id="register-btn">
                    <a href="index.php?page=login-register" class="text-decoration-none text-white">
                        Login/Register
                    </a>
                </button>
                <button type="button" class="btn-login btn btn-danger ms-lg-4 px-4 fs-18 mt-3 mt-lg-0 d-none ms-4"
                    id="logout-btn">
                    <a href="" class="text-decoration-none text-white">
                        Sign out
                    </a>
                </button>
            </div>
            </div>
        </nav>

        <div class="header-banner">
            <div class="container h-100 d-flex align-items-center justify-content-center">
                <div class="row text-center justify-content-center">
                    <h1 class="text-uppercase text-blue fw-6 lh-17 display-5">
                        <!-- create your professional cv in just 5 -->
                        Unlock your career potential with our user-friendly CV builder website.
                        <p class="text-grey fs-4 mt-3 mb-5">
                            Easy to use. Time-saver. Professional.
                        </p>
                        <p id="welcome-text" class="fs-4 text-lowercase text-info"></p>
                        <button class="btn btn-lg text-capitalize btn-primary btn-banner fs-4 d-none" id="start-btn">
                            <a href="index.php?page=create-resume" class="text-decoration-none text-white">
                                let's get started
                            </a>
                        </button>

                        <button class="btn btn-lg text-capitalize btn-primary btn-banner fs-4" id="login-to-start-btn">
                            <a href="index.php?page=login-register" class="text-decoration-none text-white">
                                login to start
                            </a>
                        </button>

                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="templates py-8 bg-secondary">
            <div class="container">
                <div class="row section-title text-center mb-5">
                    <div class="col-12">
                        <h2 class="display-6 text-blue fw-bold">
                            Here are the Best Templates for you
                        </h2>
                        <p class="text-grey fs-4 my-4 mx-auto">
                            A great job application leads to a good interview. An amazing
                            resume is what makes it all possible.
                        </p>
                    </div>
                </div>

                <div class="row templates-list gy-5 gx-lg-5">
                    <div class="templates-item position-relative col-lg-6">
                        <div class="template-item-img mx-auto me-lg-0 position-relative">
                            <img src="img/CVTemplate.jpg" alt="" class="img-fluid" loading="lazy" />
                            <a href="#" class="btn btn-lg btn-primary position-absolute choose-template-btn">Select
                                Template</a>
                        </div>
                    </div>

                    <div class="templates-item position-relative col-lg-6">
                        <div class="template-item-img mx-auto ms-lg-0 position-relative">
                            <img src="img/CVtermplate2.png" alt="" class="img-fluid" loading="lazy" />
                            <a href="#" class="btn btn-lg btn-primary position-absolute choose-template-btn">Select
                                Template</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", showHideBtn);
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("welcome-text").innerHTML = "Welcome back, " + getCookie('username');
        })

        document.getElementById("logout-btn").addEventListener('click', function () {
            document.cookie = `${'userID'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            document.cookie = `${'username'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            // console.log("ok");
        });


        function showHideBtn() {
            if (getCookie('userID') == "") {

            }
            else {
                document.getElementById("manage-btn").classList.toggle("d-none");
                document.getElementById("login-to-start-btn").classList.toggle("d-none");
                document.getElementById("register-btn").classList.toggle("d-none");
                document.getElementById("start-btn").classList.toggle("d-none");
                document.getElementById("logout-btn").classList.toggle("d-none");
            }
        }
    </script>
</body>

<?php
include_once("component/footer.php");
?>