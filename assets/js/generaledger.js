document.addEventListener("DOMContentLoaded", () => {

    document.getElementById("ledgerLink").addEventListener("click", function(event) {
        // Get the input values
        const fromDate = document.getElementById("fromDate3").value;
        const toDate = document.getElementById("toDate3").value;
        const category = document.getElementById("AccTitles2").value; // Assuming this is the category dropdown

        // Check if any of the required fields are empty
        if (!fromDate || !toDate || !category) {
            event.preventDefault(); // Prevent navigation
            $("#failedLink").modal('show');
        }
    });

function defaultValues(){

    const fromDate = document.getElementById("fromDate3").value;
    const toDate = document.getElementById("toDate3").value;

    const link2 = document.getElementById("ledgerLink2");
    link2.href = constructLink2(fromDate, toDate);
}
    // Call default values
    setTimeout(()=> {
        defaultValues();
    },1000)
// Initialize Select2 for the dropdowns
function initializeSelect2() {
    $('#AccTitles2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles4.php',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { term: params.term };
            },
            processResults: function(data) {
                return { results: data };
            },
            cache: true
        }
    });

    // Set default value after initialization
    $('#AccTitles2').val('2').trigger('change'); // Set this to your desired default value
}

// Call Select2 initialization
initializeSelect2();

function display(){
    document.getElementById('searchLedger').value = "";
    fetch('search/searchledger.php', {
        method: 'POST',
    })
    //Ensure response is ok
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        document.getElementById("displayLedger").innerHTML = data;
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
}
display();
    // Function to set max date to today
    function noFuture() {
        
        const currentDate = new Date().toISOString().split('T')[0];
        const enddate = document.getElementById("endDate").textContent;
        const endDate = new Date(enddate)

         // Compare end date and current date
         if (endDate > new Date()) {
            // If end date is in the future, set max attribute to current date
            document.getElementById("fromDate3").setAttribute('max', currentDate);
            document.getElementById("toDate3").setAttribute('max', currentDate);
        } else {
            // If end date is in the future, set max attribute to end date
            document.getElementById("fromDate3").setAttribute('max', endDate.toISOString().split('T')[0]);
            document.getElementById("toDate3").setAttribute('max', endDate.toISOString().split('T')[0]);
        }
    }
    noFuture();

        // Function to set max date to today
        function noPast() {
            let startDate = document.getElementById("startDate").textContent;
            const startDateValue = new Date(startDate).toISOString().split('T')[0];
            document.getElementById("fromDate3").setAttribute('min', startDateValue);
            document.getElementById("toDate3").setAttribute('min', startDateValue);
        }
        noPast();

    // Function to construct URL link for the ledger report
    function constructLink(fromDate, toDate, accountCode) {
        return `reports/genledger.php?date_from=${encodeURIComponent(fromDate)}&date_to=${encodeURIComponent(toDate)}&account_code=${encodeURIComponent(accountCode)}`;
    }
        // Function to construct URL link for the ledger report
    function constructLink2(fromDate, toDate) {
        return `reports/genledger2.php?date_from=${encodeURIComponent(fromDate)}&date_to=${encodeURIComponent(toDate)}`;
    }

    // Function to display the ledger data
    function displayFilterDate(fromDate, toDate) {
        console.log(fromDate, toDate);
        fetch('search/searchledger2.php', {
            method: "POST",
            body: new URLSearchParams({ fromDate3: fromDate, toDate3: toDate })
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.text();
        })
        .then(data => document.getElementById("displayLedger").innerHTML = data)
        .catch(error => console.error("Fetch error:", error));
    }

    // Event listeners for date inputs
    document.getElementById('fromDate3').addEventListener('input', handleDateInput);
    document.getElementById('toDate3').addEventListener('input', handleDateInput);

    function handleDateInput() {
        const fromDate = document.getElementById("fromDate3").value;
        const toDate = document.getElementById("toDate3").value;
        const selectedOption = $('#AccTitles2').select2('data')[0];
        const accountCode = selectedOption ? selectedOption.id : null; // Get account code from the ID

        if (fromDate && toDate && accountCode) {
            const link = document.getElementById("ledgerLink");
            link.href = constructLink(fromDate, toDate, accountCode);

            
            displayFilterDate(fromDate, toDate);
        } else if (fromDate && toDate){
            const link2 = document.getElementById("ledgerLink2");
            link2.href = constructLink2(fromDate, toDate);
        } else {
            displayFilterInit();
        }
    }

    // Function to display initial filter state
    function displayFilterInit() {
        const selectedValue = $('#AccTitles2').val();
        document.getElementById("disp1").textContent = selectedValue;

        const selectedOption = $('#AccTitles2').select2('data')[0];
        const accountCode = selectedOption ? selectedOption.id : ''; // Use ID for account code
        document.getElementById("disp2").textContent = accountCode;

        fetch('search/searchledger2.php', {
            method: "POST",
            body: new URLSearchParams({ fromFilter: selectedValue })
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.text();
        })
        .then(data => document.getElementById("displayLedger").innerHTML = data)
        .catch(error => console.error("Fetch error:", error));
    }

    // Event listener for the Select2 dropdown change
    $('#AccTitles2').on('change', function() {
        const selectedOption = $(this).select2('data')[0];
        
        document.getElementById("disp1").textContent = selectedOption ? selectedOption.text : '';

        const fromDate = document.getElementById("fromDate3").value;
        const toDate = document.getElementById("toDate3").value;
        const accountCode = selectedOption ? selectedOption.id : ''; // Get account code from ID

        const link = document.getElementById("ledgerLink");
        link.href = constructLink(fromDate, toDate, accountCode);

        if (selectedOption) {
            displayFilter(selectedOption.id);
        } else {
            displayFilterInit();
        }
    });

    // Function to display filtered ledger based on selected filter
    function displayFilter(fromFilter) {
        fetch('search/searchledger2.php', {
            method: "POST",
            body: new URLSearchParams({ fromFilter })
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.text();
        })
        .then(data => {
            console.log(data);
            document.getElementById("displayLedger").innerHTML = data;
            const selectedOption = $('#AccTitles2').select2('data')[0];
            const accountCode = selectedOption ? selectedOption.id : ''; // Get account code from ID
            document.getElementById("disp2").textContent = accountCode || '';
        })
        .catch(error => console.error("Fetch error:", error));
    }

    // Function to set current date
    function currentDate() {
        const date = new Date();
        const formattedDate = date.toISOString().split('T')[0];
        const enddateElement = document.getElementById("endDate");
    
        const enddate = enddateElement.textContent;
        const endDate = new Date(enddate);

        if (endDate < new Date()) {
            document.getElementById("toDate3").value = endDate.toISOString().split('T')[0];
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            const year = endDate.getFullYear();
            let month = months[endDate.getMonth()];
            const day = endDate.getDate();
        } else {
            document.getElementById("toDate3").value = formattedDate;
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            const year = date.getFullYear();
            let month = months[date.getMonth()];
            const day = date.getDate();
        }
    }
    currentDate();

    // Function to set past date
    function pastDate() {
        const startDateText = document.getElementById("startDate").textContent;
        const formattedDate = new Date(startDateText).toISOString().split('T')[0];
        document.getElementById("fromDate3").value = formattedDate;
    }
    pastDate();

    // Keyup Event Listener for the search input
    document.getElementById('searchLedger').addEventListener('keyup', (event) => {
        const data = event.target.value;
        if (data) {
            displaySearch(data);
        } else {
            display();
        }
    });

    // Function to search ledger
    function displaySearch(search) {
        fetch('search/searchledger2.php', {
            method: "POST",
            body: new URLSearchParams({ search })
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.text();
        })
        .then(data => document.getElementById("displayLedger").innerHTML = data)
        .catch(error => console.error("Fetch error:", error));
    }
});
