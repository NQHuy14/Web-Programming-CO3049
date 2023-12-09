<?php
include_once("component/header.php");
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <div class="container">
            <a class="navbar-brand fw-bold fs-2" href="index.php?page=home">
                <span>
                    <img src="img/cvIcon.png" alt="" class="img-thumbnail" id="logo" loading="lazy" />
                </span>
                <span class="navbar-brand-text">CV</span> Design
            </a>
            <button type="button" class="btn btn-login btn-primary sm-lg-4 px-4 fs-18 mt-3 mt-lg-0 ms-auto" id="createNew-btn">
                <a href="index.php?page=create-resume" class="text-decoration-none text-white">
                    Create New CV
                </a>
            </button>
            <button type="button" class="btn-login btn btn-danger ms-lg-4 px-4 fs-18 mt-3 mt-lg-0" id="logout-btn">
                <a href="" class="text-decoration-none text-white">
                    Sign out
                </a>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="bg-white rounded shadow p-2 mt-4" style="min-height: 80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Resumes</h5>
                <div>
                    <a href="index.php?page=create-resume" class="text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
                        Add New</a>
                </div>
            </div>

            <div class="d-flex flex-wrap" id="cv-container">

            </div>
        </div>
    </div>
    <script>
        // document.addEventListener("DOMContentLoaded", callAPI);
        if (getCookie('userID') === "") {
            document.location.replace('home.php');
        }
        document.getElementById("logout-btn").addEventListener('click', function() {
            document.cookie = `${'userID'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            document.cookie = `${'username'}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            document.location.replace('home.php');
        });

        function callAPI() {
            fetch("service/cvService/findCVByUserId.php?userID=" + getCookie('userID'), {
                    method: 'GET',
                })
                .then(response => response.json())
                .then(result => {
                    // Handle the response
                    console.log(result);
                    if (result.error) {
                        // console.log();
                        throw result.error;
                    } else {
                        const container = document.getElementById("cv-container");
                        for (let i = 0; i < result.data.length; i++) {
                            const item = result.data[i];
                            container.innerHTML += `                <div class="col-12 col-md-6 p-2">
                    <div class="p-2 border rounded">
                        <h5>${item.fname} - ${item.title}</h5>
                        <p class="small text-info m-0" style="font-size: 12px">
                        </p>
                        <div class="d-flex gap-2 mt-1">
                            <a href="index.php?page=update-resume&cvID=${item.id}" class="text-decoration-none small"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                                Edit</a>
                            <a href="" class="text-decoration-none small" id="deleteBtn${item.id}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                    <path
                                        d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793" />
                                </svg>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>`;

                        }

                        for (let i = 0; i < result.data.length; i++) {
                            const item = result.data[i];
                            var postData = new FormData();
                            postData.append("cvID", item.id);
                            document.getElementById(`deleteBtn${item.id}`).addEventListener('click', function() {
                                console.log("ok");
                                fetch("service/cvService/deleteCV.php", {
                                        method: 'POST',
                                        body: postData,
                                    })
                                    .then(response => response.json())
                                    .then(result => {
                                        // Handle the response

                                        if (result.error) {
                                            throw result.error;
                                        } else {
                                            window.location.reload();
                                        }
                                    })
                                    .catch(error => {
                                        // Handle errors
                                        Toastify({

                                            text: error,

                                            duration: 2000,
                                            style: {
                                                // background: "rgb(214, 106, 70)",
                                                background: "linear-gradient(to right, #d66a46, #d71b32)",
                                            },

                                        }).showToast();
                                    });
                            });
                        }
                    }
                })
                .catch(error => {
                    // Handle errors

                });
        }

        callAPI();
    </script>
</body>
<hr />


<?php
include_once("component/footer.php");
?>