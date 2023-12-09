<?php include_once("view/handleRequest.php") ?>
<script>
    document.addEventListener("DOMContentLoaded", addCV);
    document.addEventListener("DOMContentLoaded", getIcon("snippet/addButton.html", "add-btnForm"));
    document.addEventListener("DOMContentLoaded", getIcon("snippet/removeButton.html", "remove-btnForm"));
    document.addEventListener("DOMContentLoaded", function() {
        bindActionAdd();
    });
    document.addEventListener("DOMContentLoaded", function() {
        bindActionRemove();
    });



    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function addCV() {
        const allService = ["certification", "award", "education", 'language', 'workExp', 'phoneNo', 'email', 'socialLink', 'activity'];

        document.getElementById("submit-btn").addEventListener('click', function() {
            fetchSequentially(allService)
        });

        const fetchSequentially = (serviceTypes) => {
            var cvID;

            // CREATE NEW CV
            const url = "service/cvService/createCV.php"
            const formData = new FormData();
            // Append id to formData

            console.log(document.cookie);
            formData.append('userID', getCookie('userID'));

            // Make an AJAX request using fetch
            fetch(url, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.error) {
                        throw result.error;
                    } else {
                        // Handle the response
                        cvID = parseInt(result.data[0].id);
                        // UPDATE INFORMATION
                        var infoData = new FormData();
                        infoData.append("cvID", cvID);
                        var infoAPI = "service/cvService/updateCV.php";

                        let error_flag = 0;

                        const infoArray = [
                            document.querySelector(".firstname").value,
                            document.querySelector(".lastname").value,
                            document.querySelector(".selfTitle").value,
                            document.querySelector(".gender").value,
                            document.querySelector(".DOB").value,
                            document.querySelector(".address").value,
                            document.querySelector(".designation").value,
                            document.querySelector(".hobby").value
                        ];

                        const infoField = ["fname", "lname", "title", "gender", "dob", "location", "objective", "hobby"];
                        for (let i = 0; i < infoField.length; i++) {
                            infoData.append(infoField[i], infoArray[i]);
                        }
                        const fetchUserData = [];
                        fetchUserData.push(fetch(infoAPI, {
                                method: 'POST',
                                body: infoData
                            })
                            .then(response => response.json())
                            .then(result => {
                                // Handle the response
                                // console.log(result);
                                if (result.error) {
                                    // console.log();
                                    throw result.error;
                                } else {

                                }
                            })
                            .catch(error => {
                                // Handle errors
                                // console.error('Error:', error);
                                Toastify({

                                    text: error,

                                    duration: 2000,
                                    style: {
                                        // background: "rgb(214, 106, 70)",
                                        background: "linear-gradient(to right, #d66a46, #d71b32)",
                                    },

                                }).showToast();

                                const formData = new FormData();
                                formData.append('cvID', cvID);
                                deleteCVForSubmitError(formData);
                            })
                        )

                        var imgData = new FormData();
                        imgData.append("cvID", cvID);
                        var imgAPI = "service/cvService/uploadImg.php";

                        const input = document.getElementById('imageInput');
                        const file = input.files[0];
                        imgData.append('file', file);

                        fetchUserData.push(fetch(imgAPI, {
                                method: 'POST',
                                body: imgData
                            })
                            .then(response => response.json())
                            .then(result => {
                                // Handle the response
                                if (result.error) {
                                    throw result.error;
                                } else {

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
                                console.log("here");
                                const formData = new FormData();
                                formData.append('cvID', cvID);
                                deleteCVForSubmitError(formData);
                            })
                        ); // CREATE NEW RECORDS
                        for (const service of serviceTypes) {
                            var postData = new FormData();
                            var apiPath = "";
                            postData.append("cvID", cvID);
                            // 
                            if (service == "certification") {
                                // Find all pairs of certDetail and certYear elements
                                const certDetails = document.querySelectorAll('.certDetail');
                                const certYears = document.querySelectorAll('.certYear');

                                // Check if the number of certDetail and certYear pairs match
                                if (certDetails.length === certYears.length) {
                                    // Iterate through each pair
                                    for (let i = 0; i < certDetails.length; i++) {
                                        postData.append('detail', certDetails[i].value);
                                        postData.append('year', parseInt(certYears[i].value.slice(0, 4)));

                                        const apiPath = 'service/certificationService/createCertification.php';

                                        fetchUserData.push(fetch(apiPath, {
                                                method: 'POST',
                                                body: postData,
                                            })
                                            .then(response => response.json())
                                            .then(result => {
                                                // Handle the response

                                                if (result.error) {
                                                    throw result.error;
                                                } else {

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

                                                const formData = new FormData();
                                                formData.append('cvID', cvID);
                                                deleteCVForSubmitError(formData);
                                            })
                                        )
                                    }
                                } else {
                                    console.error('Number of certDetail and certYear elements do not match');
                                }

                            } else if (service == "award") {
                                // Find all pairs of certDetail and certYear elements
                                const awardDetails = document.querySelectorAll('.awardDetail');
                                const awardYears = document.querySelectorAll('.awardYear');

                                // Check if the number of certDetail and certYear pairs match
                                if (awardDetails.length === awardYears.length) {
                                    // Iterate through each pair
                                    for (let i = 0; i < awardDetails.length; i++) {
                                        postData.append('detail', awardDetails[i].value);
                                        postData.append('year', parseInt(awardYears[i].value.slice(0, 4)));

                                        const apiPath = "service/awardService/createAward.php";

                                        fetchUserData.push(fetch(apiPath, {
                                                method: 'POST',
                                                body: postData,
                                            })
                                            .then(response => response.json())
                                            .then(result => {
                                                // Handle the response

                                                if (result.error) {
                                                    throw result.error;
                                                } else {

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

                                                const formData = new FormData();
                                                formData.append('cvID', cvID);
                                                deleteCVForSubmitError(formData);
                                            })
                                        )
                                    }
                                } else {
                                    console.error('Number of awardDetail and awardYear elements do not match');
                                }
                            } else if (service == "education") {
                                // Find all pairs of education elements
                                const eduSchools = document.querySelectorAll('.edu_school');
                                const eduMajors = document.querySelectorAll('.edu_major');
                                const eduGPAs = document.querySelectorAll('.edu_gpa');
                                const eduStartDates = document.querySelectorAll('.edu_start_date');
                                const eduGraduationDates = document.querySelectorAll('.edu_graduation_date');

                                // Check if the number of education elements match
                                if (
                                    eduSchools.length === eduMajors.length &&
                                    eduMajors.length === eduGPAs.length &&
                                    eduGPAs.length === eduStartDates.length &&
                                    eduStartDates.length === eduGraduationDates.length
                                ) {
                                    // Iterate through each pair
                                    for (let i = 0; i < eduSchools.length; i++) {
                                        postData.append('school', eduSchools[i].value);
                                        postData.append('major', eduMajors[i].value);
                                        postData.append('gpa', parseFloat(eduGPAs[i].value));
                                        postData.append('startYear', parseInt(eduStartDates[i].value.slice(0, 4)));
                                        postData.append('endYear', parseInt(eduGraduationDates[i].value.slice(0, 4)));

                                        const apiPath = 'service/degreeService/createDegree.php';

                                        fetchUserData.push(fetch(apiPath, {
                                                method: 'POST',
                                                body: postData,
                                            })
                                            .then(response => response.json())
                                            .then(result => {
                                                // Handle the response

                                                if (result.error) {
                                                    throw result.error;
                                                } else {

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

                                                const formData = new FormData();
                                                formData.append('cvID', cvID);
                                                deleteCVForSubmitError(formData);
                                            })
                                        )
                                    }
                                } else {
                                    console.error('Number of education elements do not match');
                                }

                            } else if (service == 'language') {
                                // Find all language elements
                                const languageLangs = document.querySelectorAll('.languageLang');

                                // Iterate through each language element
                                for (let i = 0; i < languageLangs.length; i++) {
                                    postData.append('lang', languageLangs[i].value);

                                    const apiPath = 'service/languagesService/createLanguage.php';

                                    fetchUserData.push(fetch(apiPath, {
                                            method: 'POST',
                                            body: postData,
                                        })
                                        .then(response => response.json())
                                        .then(result => {
                                            // Handle the response

                                            if (result.error) {
                                                throw result.error;
                                            } else {

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

                                            const formData = new FormData();
                                            formData.append('cvID', cvID);
                                            deleteCVForSubmitError(formData);
                                        })
                                    )
                                }
                            } else if (service == 'workExp') {
                                // Find all work experience elements
                                const expOrganizations = document.querySelectorAll('.exp_organization');
                                const expTitles = document.querySelectorAll('.exp_title');
                                const expDescriptions = document.querySelectorAll('.exp_description');
                                const expStartDates = document.querySelectorAll('.experience_start_date');
                                const expEndDates = document.querySelectorAll('.experience_end_date');

                                // Check if the number of work experience elements match
                                if (
                                    expOrganizations.length === expTitles.length &&
                                    expTitles.length === expDescriptions.length &&
                                    expDescriptions.length === expStartDates.length &&
                                    expStartDates.length === expEndDates.length
                                ) {
                                    // Iterate through each set of work experience elements
                                    for (let i = 0; i < expOrganizations.length; i++) {
                                        postData.append('company', expOrganizations[i].value);
                                        postData.append('title', expTitles[i].value);
                                        postData.append('detail', expDescriptions[i].value);
                                        postData.append('startYear', parseInt(expStartDates[i].value.slice(0, 4)));
                                        postData.append('endYear', parseInt(expEndDates[i].value.slice(0, 4)));

                                        const apiPath = 'service/workExperienceService/createWorkExperience.php';

                                        fetchUserData.push(fetch(apiPath, {
                                                method: 'POST',
                                                body: postData,
                                            })
                                            .then(response => response.json())
                                            .then(result => {
                                                // Handle the response

                                                if (result.error) {
                                                    throw result.error;
                                                } else {

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

                                                const formData = new FormData();
                                                formData.append('cvID', cvID);
                                                deleteCVForSubmitError(formData);
                                            })
                                        )
                                    }
                                } else {
                                    console.error('Number of work experience elements do not match');
                                }

                            } else if (service == 'phoneNo') {
                                const phonenos = document.querySelectorAll('.phoneno');

                                // Iterate through each phone element
                                for (let i = 0; i < phonenos.length; i++) {
                                    postData.append('numbers', phonenos[i].value);

                                    const apiPath = 'service/phoneNumberService/createPhoneNumber.php';

                                    fetchUserData.push(fetch(apiPath, {
                                            method: 'POST',
                                            body: postData,
                                        })
                                        .then(response => response.json())
                                        .then(result => {
                                            // Handle the response

                                            if (result.error) {
                                                throw result.error;
                                            } else {

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

                                            const formData = new FormData();
                                            formData.append('cvID', cvID);
                                            deleteCVForSubmitError(formData);
                                        })
                                    )
                                }

                            } else if (service == 'email') {

                                const emails = document.querySelectorAll('.email');

                                // Iterate through each emails element
                                for (let i = 0; i < emails.length; i++) {
                                    postData.append('email', emails[i].value);

                                    const apiPath = 'service/emailAddressService/createEmailAddress.php';

                                    fetchUserData.push(fetch(apiPath, {
                                            method: 'POST',
                                            body: postData,
                                        })
                                        .then(response => response.json())
                                        .then(result => {
                                            // Handle the response

                                            if (result.error) {
                                                throw result.error;
                                            } else {

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

                                            const formData = new FormData();
                                            formData.append('cvID', cvID);
                                            deleteCVForSubmitError(formData);
                                        })
                                    )
                                }


                            } else if (service == 'socialLink') {
                                const socialLinks = document.querySelectorAll('.socialLink');

                                // Iterate through each social Link element
                                for (let i = 0; i < socialLinks.length; i++) {
                                    postData.append('link', socialLinks[i].value);

                                    const apiPath = 'service/socialLinkService/createSocialLink.php';

                                    fetchUserData.push(fetch(apiPath, {
                                            method: 'POST',
                                            body: postData,
                                        })
                                        .then(response => response.json())
                                        .then(result => {
                                            // Handle the response

                                            if (result.error) {
                                                throw result.error;
                                            } else {

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

                                            const formData = new FormData();
                                            formData.append('cvID', cvID);
                                            deleteCVForSubmitError(formData);
                                        })
                                    )
                                }

                            } else if (service == 'activity') {

                                // Find all activity elements
                                const activityDetails = document.querySelectorAll('.activity_detail');
                                const activityTitles = document.querySelectorAll('.activity_title');
                                const activityStartDates = document.querySelectorAll('.activity_start_date');
                                const activityEndDates = document.querySelectorAll('.activity_end_date');

                                // Check if the number of work experience elements match
                                if (
                                    activityDetails.length === activityTitles.length &&
                                    activityTitles.length === activityStartDates.length &&
                                    activityStartDates.length === activityEndDates.length
                                ) {
                                    // Iterate through each set of activity elements
                                    for (let i = 0; i < activityDetails.length; i++) {
                                        postData.append('detail', activityDetails[i].value);
                                        postData.append('title', activityTitles[i].value);
                                        postData.append('startYear', parseInt(activityStartDates[i].value.slice(0, 4)));
                                        postData.append('endYear', parseInt(activityEndDates[i].value.slice(0, 4)));

                                        const apiPath = 'service/activityService/createActivity.php';

                                        fetchUserData.push(fetch(apiPath, {
                                                method: 'POST',
                                                body: postData,
                                            })
                                            .then(response => response.json())
                                            .then(result => {
                                                // Handle the response

                                                if (result.error) {
                                                    throw result.error;
                                                } else {

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

                                                const formData = new FormData();
                                                formData.append('cvID', cvID);
                                                deleteCVForSubmitError(formData);
                                            })
                                        )
                                    }
                                } else {
                                    console.error('Number of activity elements do not match');
                                }



                            }

                        }

                        Promise.all(fetchUserData).then(() => {
                            fetch(`service/cvService/findCVById.php?cvID=${cvID}`, {
                                    method: "GET",
                                    headers: {
                                        "Content-Type": "application/json",
                                    },
                                })
                                .then((response) => response.json())
                                .then((result) => {
                                    console.log(result);
                                    if (result.data.length > 0) {
                                        window.location.href = "index.php?page=manage-resume"
                                    }
                                })
                                .catch((err) => {
                                    alert("Error: " + err);
                                });
                        })

                    }
                })

            // RELOAD PAGE
            // window.location.reload();
            // BAD RESPONSE
        }
    }

    function getIcon(pathToFile, containerClassName) {
        fetch(pathToFile)
            .then(response => {
                if (!response.ok) {
                    // throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
                const elements = document.getElementsByClassName(containerClassName);
                for (let i = 0; i < elements.length; i++) {
                    // console.log("ok" + containerClassName);
                    elements[i].innerHTML = data;
                }
            })
            .catch(error => {
                console.error("Error fetching content:", error);
            });
    }

    function bindActionAdd() {
        const elements = ["certification", "award", "education", "language", "workExp", "phoneNo", "email", "socialLink", "activity"];


        elements.forEach(fileName => {
            const target = document.getElementById(fileName + "Add");
            // console.log(target);
            target.addEventListener("click", function() {
                addSnippet(fileName);
            });
        });
    };

    function addSnippet(fileName) {
        var data = document.querySelector(`.${fileName}HTML .repeater`).cloneNode(true);
        var inputs = data.querySelectorAll("input");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
        }

        const queryString = "#" + fileName + "Remove";
        const target = document.querySelector(queryString);
        // target.appendChild(data);
        target.insertAdjacentElement('beforebegin', data);
    }

    function bindActionRemove() {
        const elements = ["certification", "award", "education", "language", "workExp", "phoneNo", "email", "socialLink", "activity"];


        elements.forEach(fileName => {
            const target = document.getElementById(fileName + "Remove");
            // console.log(target);
            target.addEventListener("click", function() {
                removeSnippet(fileName);
            });
        })
    };

    function removeSnippet(fileName) {
        const parent = document.querySelector(`.${fileName}HTML`);
        const repeater = parent.querySelectorAll('.repeater');
        if (repeater.length > 1) {
            const lastRepeater = repeater[repeater.length - 1];
            lastRepeater.remove();
        }
    }
</script>