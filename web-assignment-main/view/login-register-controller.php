<script>
    document.addEventListener("DOMContentLoaded", loginHandler);
    document.addEventListener("DOMContentLoaded", RegisterHandler);

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function loginHandler() {
        const loginBtn = document.getElementById("login-btn");
        if (loginBtn) {
            loginBtn.addEventListener('click', function() {
                fetchLogin()
            });

            const fetchLogin = () => {
                const email = document.getElementById("login-email").value;
                const password = document.getElementById("login-password").value;

                var postData = new FormData();
                postData.append("username", email);
                postData.append("password", password);

                fetch("service/userService/loginUser.php", {
                        method: 'POST',
                        body: postData
                    })
                    .then(response => {
                        if (!response.ok) {
                            var errMsg;
                            response.json()
                                .then((result) => {
                                    errMsg = result.error;
                                    alert(errMsg);
                                });
                        } else {
                            // Handle the response
                            // SET SESSION
                            // SET COOKIE
                            response.json().then(result => {
                                setCookie('userID', result.data[0].id, 1);
                                setCookie('username', result.data[0].username, 1);
                            })

                            Toastify({

                                text: "Login Successfully",

                                duration: 2000,
                                style: {
                                    // background: "rgb(214, 106, 70)",
                                    background: "linear-gradient(to right, #46d691, #1bd72d)",
                                },

                            }).showToast();
                            // console.log("ok");

                            const redirectUser = () => {
                                document.location.replace('home.php')
                            }

                            setTimeout(redirectUser, 1000);
                        }
                    })
                    .catch(error => {
                        // Handle errors
                        console.error('Error:', error);
                        // alert(`Error: ${error}`);
                    });
            }
        }
    }

    function RegisterHandler() {
        const signupBtn = document.getElementById("signup-btn");
        if (signupBtn) {
            signupBtn.addEventListener('click', function() {
                fetchRegister()
            });

            const fetchRegister = () => {
                const email = document.getElementById("signup-email").value;
                const password = document.getElementById("signup-password").value;
                const conpassword = document.getElementById("signup-conpassword").value;

                var postData = new FormData();
                postData.append("username", email);
                postData.append("password", password);
                postData.append("confirm-password", conpassword);

                fetch("service/userService/registerUser.php", {
                        method: 'POST',
                        body: postData
                    })
                    .then(response => {
                        if (!response.ok) {
                            var errMsg;
                            response.json()
                                .then((result) => {
                                    errMsg = result.error;
                                    alert(errMsg);
                                });
                        } else {
                            // Handle the response
                            alert("Sign Up Successfully");
                            setTimeout(function() {
                                window.location.reload();
                            }, 350);
                        }
                    })
                    .catch(error => {
                        // Handle errors
                        console.error('Error:', error);
                        // alert(`Error: ${error}`);
                    });
            }
        }
    }
</script>