<?php include_once("view/getApiUrl.php"); ?>
<?php include_once("view/handleRequest.php"); ?>

<script>
    /**
     * @brief open Popup dialog to either add new object or update an existing object
     *
     * @param section The section to be added or updated.
     * @param data if type === "update", this will get the existing data to the form, else type === "add", this will be empty.
     * @param type "update" or "add".
     */

    function openPopup(section, data, type) { // ensure everything is loaded after dynamic loading so that we can add event listener
        openPopupPromise(section, data, type)
            .then(() => {

                /*******   section 'About Me' with have formId 'aboutmeForm'   *******/
                const validateSection = section.replace(/\s+/g, '').toLowerCase();
                // Get the form element using its ID
                const formId = `${validateSection}Form`;

                if (type === "update") {
                    document.getElementById("form-update-btn").addEventListener("click", function (event) {
                        event.preventDefault();

                        const formElement = document.getElementById(formId);
                        const formData = new FormData(formElement);

                        const urlParams = new URLSearchParams(window.location.search);
                        if (formId === 'aboutmeForm')
                            updateCVData(urlParams.get('cvID'), formData);
                        else {
                            const dataId = sessionStorage.getItem('dataId');
                            updateData(dataId, updatedApiUrl[formId], formData);
                        }
                    });

                    document.getElementById("form-del-btn").addEventListener("click", function (event) {
                        event.preventDefault();

                        const dataId = sessionStorage.getItem('dataId');
                        deleteData(dataId, deletedApiUrl[formId]);
                    });
                } else {
                    document.getElementById("form-add-btn").addEventListener("click", function (event) {
                        event.preventDefault();

                        const formElement = document.getElementById(formId);
                        const formData = new FormData(formElement);

                        const urlParams = new URLSearchParams(window.location.search);
                        addData(urlParams.get('cvID'), addedApiUrl[formId], formData);
                    });
                }
            });

    }

    function openPopupPromise(section, data, type) {
        return new Promise((resolve) => {
            const formItems = getFormItems(section, data);
            document.getElementById("formContainer").innerHTML = generateForm(section, formItems, type);
            document.getElementById("overlay").style.display = "flex";

            // Resolve the promise after a short delay to ensure the DOM has been updated
            setTimeout(() => {
                resolve();
            }, 100);
        });
    }

    function closePopup() {
        document.getElementById("overlay").style.display = "none";
    }

    // Function to generate form HTML based on section and form items
    function generateForm(heading, formItems, type) {
        const validateHeading = heading.replace(/\s+/g, '').toLowerCase();
        let formHTML = `
        <div class="update-card">
        <h5 class="text-center mb-4">${heading}</h5>
        <form class="form-card" method="post" id="${validateHeading}Form">
            <div class="row justify-content-between text-left">
        `;


        if (formItems.length === 1) { // for case: email, phone number, social link, language
            const item = formItems[0];
            formHTML += `</div><div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex"> 
                                <label class="form-control-label px-3">${item.label}
                                <span class="text-danger"> *</span></label> 
                                <input type="text" 
                                id="${item.name}"
                                name="${item.name}"
                                placeholder="Enter your ${item.label}" 
                                value="${item.value}"
                                required>
                            </div>`;
        } else {
            let flag = 0 // no textarea data

            formItems.forEach((item, index) => {
                if (item.label === "Objective" || item.label === "Detail") {
                    flag = 1;
                    return;
                }

                if (index % 2 === 0 && index !== 0) {
                    formHTML += '</div><div class="row justify-content-between text-left">'
                }
                formHTML += generateFormItem(item.label, item.inputType, item.name, item.importance, item.value);
            });

            if (flag) {
                const item = formItems[formItems.length - 1];
                formHTML += `</div><div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex"> 
                                <div class="d-flex justify-content-between">
                                    <label class="form-control-label px-3">${item.label}
                                    <span class="text-danger"> *</span></label> 
                                    <div id="wordCountDisplay">? / ${item.maxWords} words</div>
                                </div>
                                <textarea type="${item.inputType}" 
                                id="${item.name}" 
                                name="${item.name}" 
                                rows="4"
                                cols="80"
                                placeholder="Add your ${item.label}" 
                                oninput="limitWords(this, ${item.maxWords})"
                                required>${item.value}</textarea> 
                            </div>`;
            }
        }

        const canDelete = heading === 'About Me' ? '' : `<button id="form-del-btn" class="btn-block btn-primary">Delete</button>`;

        const btn = type === "update" ?
            `<div class="form-group col-sm-6 d-flex justify-content-center">${canDelete}</div> 
            <div class="form-group col-sm-6 d-flex justify-content-center">
                <button id="form-update-btn" class="btn-block btn-primary">Update</button>
            </div>` :
            `<div class="form-group col-sm-6 d-flex justify-content-center"></div>
            <div class="form-group col-sm-6 d-flex justify-content-center">
                <button id="form-add-btn" class="btn-block btn-primary">Add</button>
            </div>`

        formHTML += `</div>
            <div class="row">${btn}</div> 
        </form> 
    </div>
            `;

        return formHTML;
    }

    // Function to generate form item HTML based on label and input type
    function generateFormItem(label, inputType, name, importance, value) {
        const skipped = label === 'skip';
        if (skipped) return '';

        const importanceSpan = importance ? '<span class="text-danger">*</span>' : '';
        const required = importance ? 'required' : '';
        return `<div class="form-group col-sm-6 flex-column d-flex">
                <label class="form-control-label px-3" for="${name}">${label} ${importanceSpan}</label>
                <input type="${inputType}" 
                    id="${name}" 
                    name="${name}"
                    placeholder="Enter your ${label.toLowerCase()}"
                    value="${value}"  
                    ${required}>
            </div>`;
    }

    // Define form items for each section
    function getFormItems(section, data) {
        sessionStorage.setItem('dataId', data.id); // Set the data.id in sessionStorage

        switch (section) {
            case 'About Me':
                return [{
                    label: 'First Name',
                    name: 'fname',
                    inputType: 'text',
                    importance: true,
                    value: data.fname || ''
                },
                {
                    label: 'Last Name',
                    name: 'lname',
                    inputType: 'text',
                    importance: true,
                    value: data.lname || ''
                },
                {
                    label: 'Title',
                    name: 'title',
                    inputType: 'text',
                    importance: true,
                    value: data.title || ''
                },
                {
                    label: 'Gender',
                    name: 'gender',
                    inputType: 'text',
                    importance: false,
                    value: data.gender || ''
                },
                {
                    label: 'Date of Birth',
                    name: 'dob',
                    inputType: 'text',
                    importance: true,
                    value: data.dob || ''
                },
                {
                    label: 'Hobby',
                    name: 'hobby',
                    inputType: 'text',
                    importance: false,
                    value: data.hobby || ''
                },
                {
                    label: 'Location',
                    name: 'location',
                    inputType: 'text',
                    importance: false,
                    value: data.location || ''
                },
                {
                    label: 'Objective',
                    name: 'objective',
                    inputType: 'text',
                    importance: true,
                    value: data.objective || '',
                    maxWords: 100
                },
                ];

            case 'Education':
                return [{
                    label: 'School',
                    name: 'school',
                    inputType: 'text',
                    importance: true,
                    value: data.school || ''
                },
                {
                    label: 'Major',
                    name: 'major',
                    inputType: 'text',
                    importance: true,
                    value: data.major || ''
                },
                {
                    label: 'GPA',
                    name: 'gpa',
                    inputType: 'text',
                    importance: false,
                    value: data.gpa || ''
                },
                {
                    label: 'skip',
                    name: 'skip',
                    inputType: 'text',
                    importance: false,
                    value: ''
                },
                {
                    label: 'Start Year',
                    name: 'startYear',
                    inputType: 'number',
                    importance: true,
                    value: data.startYear || ''
                },
                {
                    label: 'End Year',
                    name: 'endYear',
                    inputType: 'number',
                    importance: true,
                    value: data.endYear || ''
                },
                ];

            case 'Work Experience':
                return [{
                    label: 'Company',
                    name: 'company',
                    inputType: 'text',
                    importance: true,
                    value: data.company || ''
                },
                {
                    label: 'Title',
                    name: 'title',
                    inputType: 'text',
                    importance: true,
                    value: data.title || ''
                },
                {
                    label: 'Start Year',
                    name: 'startYear',
                    inputType: 'number',
                    importance: true,
                    value: data.startYear || ''
                },
                {
                    label: 'End Year',
                    name: 'endYear',
                    inputType: 'number',
                    importance: true,
                    value: data.endYear || ''
                },
                {
                    label: 'Detail',
                    name: 'detail',
                    inputType: 'text',
                    importance: true,
                    value: data.detail || '',
                    maxWords: 100
                },
                ];

            case 'Activity':
                return [{
                    label: 'Title',
                    name: 'title',
                    inputType: 'text',
                    importance: true,
                    value: data.title || ''
                },
                {
                    label: 'skip',
                    name: 'skip',
                    inputType: 'text',
                    importance: false,
                    value: ''
                },
                {
                    label: 'Start Year',
                    name: 'startYear',
                    inputType: 'number',
                    importance: true,
                    value: data.startYear || ''
                },
                {
                    label: 'End Year',
                    name: 'endYear',
                    inputType: 'number',
                    importance: true,
                    value: data.endYear || ''
                },
                {
                    label: 'Detail',
                    name: 'detail',
                    inputType: 'text',
                    importance: false,
                    value: data.detail || '',
                    maxWords: 100
                },
                ];

            case 'Certification':
                return [{
                    label: 'Year',
                    name: 'year',
                    inputType: 'number',
                    importance: true,
                    value: data.year || ''
                },
                {
                    label: 'Detail',
                    name: 'detail',
                    inputType: 'text',
                    importance: true,
                    value: data.detail || '',
                    maxWords: 50
                },
                ];

            case 'Award':
                return [{
                    label: 'Year',
                    name: 'year',
                    inputType: 'number',
                    importance: true,
                    value: data.year || ''
                },
                {
                    label: 'Detail',
                    name: 'detail',
                    inputType: 'text',
                    importance: true,
                    value: data.detail || '',
                    maxWords: 80
                },
                ];

            case 'Language':
                return [{
                    label: 'Language',
                    name: 'lang',
                    inputType: 'text',
                    importance: true,
                    value: data.lang || ''
                },];

            case 'Social Link':
                return [{
                    label: 'Link',
                    name: 'link',
                    inputType: 'text',
                    importance: true,
                    value: data.link || ''
                },];

            case 'Email Address':
                return [{
                    label: 'Email',
                    name: 'email',
                    inputType: 'email',
                    importance: true,
                    value: data.email || ''
                },];

            case 'Phone Number':
                return [{
                    label: 'Number',
                    name: 'numbers',
                    inputType: 'text',
                    importance: true,
                    value: data.numbers || ''
                },];

            default:
                return [];
        }
    }

    function limitWords(textarea, maxWords) {
        const words = textarea.value.split(/\s+/); // Split by whitespace
        const wordCount = words.length;

        if (wordCount > maxWords) {
            // Remove excess words
            const truncatedWords = words.slice(0, maxWords);
            textarea.value = truncatedWords.join(" ");
            textarea.setCustomValidity(`Exceeded word limit. Maximum ${maxWords} words allowed.`);
        } else {
            textarea.setCustomValidity("");
        }

        // Update word count display
        document.getElementById("wordCountDisplay").innerText = `${wordCount} / ${maxWords} words`;
    }
</script>