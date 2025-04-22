document.addEventListener("DOMContentLoaded", () => {
    const restoreForm = document.getElementById('sqlRestoreForm');
    const fileInput = document.getElementById('sqlFile');
    const restoreBtn = document.getElementById('restoreBtn');
    const restoreStatus = document.getElementById('restoreStatus'); // Assuming you have an element to show status

    // Trigger modal on form submission
    restoreForm.addEventListener('submit', function(e) {
        e.preventDefault();
        $("#confirmUtil4").modal('show');
    });

    // Proceed with restore after confirming
    document.getElementById("proceedRestore").addEventListener("click", () => {
        if (!fileInput.files.length) {
            $("#noFile").modal('show');  // Show no file selected modal
            return;
        }

        var formData = new FormData();
        formData.append('sql_file', fileInput.files[0]);
        formData.append('restore', true);

        // Disable the button and show loading status
        restoreBtn.disabled = true;
        restoreStatus.innerHTML = "<p>Restoring database, please wait...</p>";

        // Send the request using Fetch API
        fetch('utility/restoredb.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            restoreBtn.disabled = false; // Enable the button after response

            // Check if the response is OK (status 200)
            if (response.ok) {
                return response.text(); // Get response as text
            } else {
                throw new Error('Error occurred while restoring the database.');
            }
        })
        .then(data => {
            if (data === "Success") {
                restoreStatus.innerHTML = "<p>Database restored successfully!</p>";
                $("#successModal").modal('show');  // Show success modal (make sure to have this)
                restoreForm.reset();  // Reset the form after success
            } else if (data === "Failed") {
                restoreStatus.innerHTML = "<p>Database restore failed. Please check the logs for details.</p>";
                $("#errorModal").modal('show');  // Show error modal
            } else {
                restoreStatus.innerHTML = `<p>${data}</p>`; // Handle unexpected response
            }
        })
        .catch(error => {
            restoreStatus.innerHTML = "<p>Error in network or server.</p>";
            $("#errorModal").modal('show');  // Show error modal
            console.error('Error:', error);
        });
    });
});