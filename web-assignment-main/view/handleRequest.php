<script>
    // Function to update CV data 
    function updateCVData(cvID, formData) {
        // Append cvID to formData
        formData.append('cvID', cvID);

        // Make an AJAX request using fetch
        return fetch(`service/cvService/updateCV.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(result => {
                // Handle the response
                console.log(result);
                if (result.error) {
                    throw result.error;
                } else {
                    alert(`CV data updated successfully`);
                    closePopup();
                    // Reload the window
                    location.reload();
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
                alert(`Error: ${error}`);
            });
    }

    function deleteCVForSubmitError(formData) {
        // Make an AJAX request using fetch
        return fetch(`service/cvService/deleteCV.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(result => {
                // Handle the response
                console.log(result);
                if (result.error) {
                    throw result.error;
                } else {

                }
            })
            .catch(error => {
                // Handle errors
                alert(`Error: ${error}`);
            });
    }

    // Function to update CV image
    function uploadImg(cvID, formData) {
        // Append cvID to formData
        formData.append('cvID', cvID);

        // Make an AJAX request using fetch
        return fetch(`service/cvService/uploadImg.php`, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(result => {
                // Handle the response
                console.log(result);
                if (result.error) {
                    throw result.error;
                } else {
                    alert(`Image uploaded successfully`);
                    closePopup();
                    // Reload the window
                    location.reload();
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
                alert(`Error: ${error}`);
            });
    }

    // Function to update data
    function updateData(id, url, formData) {
        // Append id to formData
        formData.append('id', id);

        // Make an AJAX request using fetch
        return fetch(url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(result => {
                // Handle the response
                console.log(result);
                if (result.error) {
                    throw result.error;
                } else {
                    alert(`updated successfully`);
                    closePopup();
                    // Reload the window
                    location.reload();
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
                alert(`Error: ${error}`);
            });
    }

    // Function to delete data
    function deleteData(id, url) {
        const formData = new FormData();
        // Append id to formData
        formData.append('id', id);

        // Make an AJAX request using fetch
        return fetch(url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(result => {
                // Handle the response
                console.log(result);
                if (result.error) {
                    throw result.error;
                } else {
                    alert(`deleted successfully`);
                    closePopup();
                    // Reload the window
                    location.reload();
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
                alert(`Error: ${error}`);
            });
    }

    // Function to add new data
    function addData(cvID, url, formData) {
        // Append cvID to formData
        formData.append('cvID', cvID);

        // Make an AJAX request using fetch
        return fetch(url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(result => {
                // Handle the response
                console.log(result);
                if (result.error) {
                    throw result.error;
                } else {
                    alert(`updated successfully`);
                    closePopup();
                    // Reload the window
                    location.reload();
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
                alert(`Error: ${error}`);
            });
    }
</script>