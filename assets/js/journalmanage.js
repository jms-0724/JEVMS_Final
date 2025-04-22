document.addEventListener("DOMContentLoaded", ()=> {

    function noAddButtons (){
        let fiscStatus =  document.getElementById("fStatus").textContent;
        let addJEV = document.getElementById("addJEV");
        if (fiscStatus === "Closed"){
            addJEV.style.display = "none";
        } else {
            addJEV.style.display = "block";
        }
     }
     noAddButtons();

    document.getElementById("printJEVList").addEventListener("click", function(event) {
        // Get the input values
        const fromDate = document.getElementById("fromDate").value;
        const toDate = document.getElementById("toDate").value;
        const category = document.getElementById("jCategory").value; // Assuming this is the category dropdown

        // Check if any of the required fields are empty
        if (!fromDate || !toDate || !category) {
            event.preventDefault(); // Prevent navigation
            $("#failedLink").modal('show');
        }
    });

    document.getElementById("printSummary").addEventListener("click", function(event) {
        // Get the input values
        const fromDate = document.getElementById("fromDate").value;
        const toDate = document.getElementById("toDate").value;
        const category = document.getElementById("jCategory").value; // Assuming this is the category dropdown

        // Check if any of the required fields are empty
        if (!fromDate || !toDate || !category) {
            event.preventDefault(); // Prevent navigation
            $("#failedLink").modal('show');
        }
    });

    function keyPress() {
        const amountInput = document.getElementById("add_journal_amount");
    
        // Remove any previous event listeners to avoid duplicate attachments
        amountInput.removeEventListener("keypress", handleKeyPress);
        amountInput.addEventListener("keypress", handleKeyPress);

    }
    
    function handleKeyPress(event) {
        if (event.key === "Enter") {
            console.log("Enter is Pressed");
            event.preventDefault();
            addforKeypress();
        }
    }
    
    function addforKeypress() {
        const addButton = document.getElementById("addJEntry");
    
        // Ensure the click event is attached only once
        addButton.removeEventListener("click", addforKeypress);
        addButton.addEventListener("click", addforKeypress);
    }
    
        keyPress();
        function addforKeypress(){

                const field1 = document.getElementById("add_journal_title");
                const field2 = document.getElementById("add_journal_amount");
                
                if (field1.value === "" || field2.value === "") {
                    $("#failed4").modal("show");
                } else {
                    let journalTable = document.getElementById("journalBody");
                    let accountTitle = $('#add_journal_title').select2('data')[0];
                    let accountTitleValue = accountTitle.text.trim();
                    let amount = document.getElementById("add_journal_amount").value.trim();
                    let amountDecimal = parseFloat(amount).toFixed(2);
                    let accountTitleId = accountTitle.id;
                    let normal = accountTitle.normal_balance;
                    let account_code = accountTitle.account_code;
            
                    
        // Check for duplicate entry based on the account code (for both Debit and Credit)
        let found = false;
        for (let i = 0; i < journalTable.rows.length; i++) {
            let row = journalTable.rows[i];
            let cellCode = row.cells[0].innerText;
        
            // If a duplicate entry is found
            if (cellCode === accountTitleId) {
                // Update the debit amount (cell 2)
                let currentDebitAmount = parseFloat(row.cells[2].innerText) || 0;
                let currentCreditAmount = parseFloat(row.cells[3].innerText) || 0;
        
                // If the current credit amount is greater than 0, subtract the new amount from the debit
                if (currentCreditAmount > 0) {
                    row.cells[2].innerText = (currentDebitAmount - parseFloat(amount)).toFixed(2);
                    row.cells[3].innerText = (currentCreditAmount + parseFloat(amount)).toFixed(2);
                } else {
                    // Otherwise, just add the amount to the debit side
                    row.cells[2].innerText = (currentDebitAmount + parseFloat(amount)).toFixed(2);
                }
        
                found = true;
                break;
            }
        }
            
                    if (!found) {
                        // If no duplicates found, add a new row
                        let newRow = journalTable.insertRow();
                        newRow.setAttribute("class", "journal_items");
                        let cell0 = newRow.insertCell(0);
                        let cell1 = newRow.insertCell(1);
                        let cell2 = newRow.insertCell(2);
                        let cell3 = newRow.insertCell(3);
                        let cell4 = newRow.insertCell(4);
            
                        cell0.textContent = accountTitleId;
                        cell1.textContent = accountTitleValue;
                        cell1.setAttribute("id", account_code);
                        
                        // Create action buttons
                        let editButton = document.createElement('button');
                        let removeButton = document.createElement('button');
                        editButton.textContent = "Edit";
                        removeButton.textContent = "Remove";
                        editButton.classList.add("btn", "btn-secondary", "text-white", "editRow");
                        removeButton.classList.add("btn", "btn-danger", "text-white", "deleteRow");
            
                        // Append buttons to the last cell
                        cell4.appendChild(removeButton);
                        // cell4.appendChild(editButton);
            
                        // Style the buttons
                        editButton.style.marginRight = "5px";
                        editButton.style.backgroundColor = "#004d68";
                        removeButton.style.backgroundColor = "#004d68";
            
                        // // Set the amount in the appropriate cell based on normal balance
                        // if (normal === "Credit") {
                        //     cell3.textContent = amountDecimal;
                        //     cell3.setAttribute("class", normal);
                        //     cell3.setAttribute("data-value", amountDecimal);
                        // } else {
                        //     cell2.textContent = amountDecimal;
                        //     cell2.setAttribute("class", "Debit");
                        //     cell2.setAttribute("data-value", amountDecimal);
                        // }
        
                        cell2.textContent = amountDecimal;
                        cell2.setAttribute("class", "Debit");
                        cell2.setAttribute("data-value", amountDecimal);
            
                        // Reset the form after adding the entry
                        document.getElementById("addJournalEntryForm2").reset();
                        $('#add_journal_title').val(null).trigger('change');
                    }
            
                    // Add event listeners for removal and editing of entries
                    attachRowEventListeners();
            
                    // Calculate total after adding a new entry or updating an existing one
                    calculateTotal();
                }
            
                function readOnly() {
                    document.getElementById("add_journal_number").readOnly = true;
                    document.getElementById("add_journal_category").readOnly = true;
                    document.getElementById("add_journal_description").readOnly = true;
                }
            
                readOnly();

            
            // Function to attach event listeners for edit and remove buttons in the journal table
            function attachRowEventListeners() {
                // Removal
                let deleteButtons = document.querySelectorAll('.deleteRow');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        let row = event.target.parentNode.parentNode;
                        row.parentNode.removeChild(row);
                        calculateTotal();
                    });
                });
            
                let currentRow; // To store the row being edited
        
                // Use event delegation to handle click events on dynamically added .editRow buttons
                document.getElementById('journalBody').addEventListener('click', function(event) {
                    // Check if the clicked element is an edit button
                    if (event.target.classList.contains('editRow')) {
                        currentRow = event.target.closest('tr'); // Assign the row being edited
                        
                        if (!currentRow) {
                            console.error("No row found for editing.");
                            return; // Exit if the row is not found
                        }
                
                        console.log("Editing row: ", currentRow); // Log the current row for debugging
                
                        // Get the debit and credit cells from the current row
                        let debit = currentRow.querySelector(".Debit");
                        let credit = currentRow.querySelector(".Credit");
                        let JEVamount;
                
                        // Set the JEV amount and entry type based on whether it's a debit or credit entry
                        if (debit && debit.textContent.trim() !== "") {
                            JEVamount = debit.textContent.trim();
                            document.getElementById("jevAmount").value = JEVamount;
                            document.getElementById("jevAmount").setAttribute("data-bs-entry", "Debit");
                        } else if (credit && credit.textContent.trim() !== "") {
                            JEVamount = credit.textContent.trim();
                            document.getElementById("jevAmount").value = JEVamount;
                            document.getElementById("jevAmount").setAttribute("data-bs-entry", "Credit");
                        }
                
                        // Show the modal after setting the values
                        $("#editEntry").modal("show");
                        $("#createJournals1").modal("hide");
                    }
                });
                
                // Save the edited value and update the table
                document.getElementById("saveEdit").addEventListener('click', function() {
                    // Ensure currentRow is defined
                    if (!currentRow) {
                        console.error("No row selected for editing.");
                        return; // Exit if no row is selected
                    }
                
                    // Get the selected account title and account code from Select2
                    let accountTitle = $('#edit_journal_title').select2('data')[0].text; // Get the selected account title text
                    let accountCode = $('#edit_journal_title').val(); // Get the selected account code value
                    let JEVamount = document.getElementById("jevAmount").value.trim();
                    let entryType = document.getElementById("jevAmount").getAttribute("data-bs-entry");
                
                    // Check for duplicate account codes in other rows
                    let duplicateFound = false;
                    document.querySelectorAll("#journalBody tr").forEach(function(row) {
                        let rowAccountCode = row.querySelector("td:nth-child(1)").textContent.trim(); // Get account code from the row
                        if (row !== currentRow && rowAccountCode === accountCode) {
                            duplicateFound = true; // A duplicate was found in another row
                            return false;
                        }
                    });
                
                    if (duplicateFound) {
                        alert("This account code is already used in another entry.");
                        return; // Exit if duplicate account code found
                    }
                
                    // Convert the value to a number and ensure it's valid
                    if (!isNaN(JEVamount) && JEVamount !== "") {
                        JEVamount = parseFloat(JEVamount).toFixed(2); // Format the input value as a float
                    } else {
                        $("#failed7").modal('show');
                        return;
                    }
                
                    // Update the account title in the current row
                    let accountTitleCell = currentRow.querySelector("td:nth-child(2)"); // Assuming 2nd cell holds the account title
                    if (accountTitleCell) {
                        accountTitleCell.textContent = accountTitle;
                    }
                
                    // Update the account code in the current row (if needed)
                    let accountCodeCell = currentRow.querySelector("td:nth-child(1)"); // Assuming 1st cell holds the account code
                    if (accountCodeCell) {
                        accountCodeCell.textContent = accountCode;
                    }
                
                    // Update the correct column in the current row based on the entry type
                    if (entryType === "Debit") {
                        let debitCell = currentRow.querySelector(".Debit");
                        if (debitCell) {
                            debitCell.textContent = JEVamount;
                        }
                    } else if (entryType === "Credit") {
                        let creditCell = currentRow.querySelector(".Credit");
                        if (creditCell) {
                            creditCell.textContent = JEVamount;
                        }
                    }
                
                    // Log the updated row to ensure it was successful
                    console.log("Updated row: ", currentRow);
                
                    // Close the modal
                    $("#createJournals1").modal("show");
                    $("#editEntry").modal("hide");
                
                    // Recalculate totals after editing
                    calculateTotal();
                });
                
                
                
            }
        }
    function readyField(){
        let foot1 = document.getElementById("Dr");
            let foot2 = document.getElementById("Cr");
            let value1 = 0.00;
            let value2 = 0.00;
            value1 = parseFloat(value1);
            value1 = value1.toFixed(2);
            value2 = parseFloat(value2);
            value2 = value2.toFixed(2);
            foot1.textContent = value1;
            foot2.textContent = value2;
    }
    readyField();

// Initialize Select2
function initializeSelect2() {
    $('#add_journal_title').select2({
        dropdownParent: $('#createJournals1'),
        placeholder: 'Select an option',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles3.php',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    term: params.term || '',
                    // c_id: $('#add_journal_category').val() || ''
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []
                };
            },
            cache: true
        },
        templateResult: formatOption,
        templateSelection: formatSelection
    });

    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        return $('<span>' + option.text + '</span>' +
            '<span class="custom-attributes" ' +
            'data-account-code="' + option.account_code + '" ' +
            'data-account-type="' + option.account_type + '" ' +
            'data-normal-balance="' + option.normal_balance + '">' +
            '</span>');
    }
    
    function formatSelection(option) {
        if (!option.id) {
            return option.text;
        }
        return option.text;
    }
}

function initializeSelect2JS() {
    $('.upd_acct_titles').select2({
        dropdownParent:$("#editEntry2"),
        placeholder: 'Select an account',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles3.php', // Your server-side endpoint
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    term: params.term || '', // Search term
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []
                };
            },
            cache: true
        }
    });
}

function initializeEditAdd() {
    $('#edit_journal_title').select2({
        dropdownParent:$("#editEntry"),
        placeholder: 'Select an account',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles3.php', // Your server-side endpoint
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    term: params.term || '', // Search term
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []
                };
            },
            cache: true
        }
    });
}



// Event handler for category change
$('#add_journal_category').on('change', function() {

    fetch('fetch/description.php', {
        method: 'POST',
        body: new  URLSearchParams({
            category_id: $(this).val()
        })
    })
    //Ensure response is ok
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        document.getElementById("J_Desc").innerHTML = data;
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
    // $('#add_journal_title').select2('destroy').empty(); // Clear previous data
    // initializeSelect2(); // Reinitialize Select2 with updated category
    
});

// Call the function to initialize Select2 on page load
initializeSelect2();
initializeSelect2JS();
initializeEditAdd();
    

    function dynamicOption2(){
        fetch('fetch/category2.php', {
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
            document.getElementById("add_journal_category").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption2();

    function dynamicOption3(){
        fetch('fetch/description.php', {
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
            document.getElementById("J_Desc").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption3();

    function dynamicOption4(){
        fetch('fetch/category2.php', {
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
            document.getElementById("jCategory").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption4();

    // function dynamicOption5(){
    //     fetch('fetch/category2.php', {
    //         method: 'POST',
    //     })
    //     //Ensure response is ok
    //     .then(response => {
    //         if (!response.ok) {
    //             throw new Error("Network response was not ok");
    //         }
    //         return response.text();
    //     })
    //     .then(data => {
    //         document.getElementById("upd_journal_category4").innerHTML = data;
    //     })
    //     .catch(error => {
    //         console.error("Fetch error:", error);
    //     });
    // }
    // dynamicOption5();
    
    document.getElementById("saveEntry").addEventListener("click", ()=> {

        let DrSide = document.getElementById("Dr").textContent;
        let DrSideValue = parseFloat(DrSide);
        let dateValue = document.getElementById("add_journal_date").value;
        console.log(DrSide);

        let CrSide = document.getElementById("Cr").textContent;
        let CrSideValue = parseFloat(CrSide);
        console.log(CrSide);

        // let tables = document.querySelector("#journalBody");
        // let rows = tables.querySelectorAll("tr");
        // let values = [];
        // let duplicates = [];

        // rows.forEach(row => {
        //     let cellText = row.querySelector("td").textContent.trim();
            
        //     if (values.includes(cellText)) {
        //         duplicates.push(cellText);
        //     } else {
        //         values.push(cellText);
        //     }
        // });

        if (DrSideValue === 0.00 || CrSideValue === 0.00){
            $("#failed2").modal('show');
        }
        else if (DrSideValue != CrSideValue){
            $("#failed3").modal('show');
        } else if (dateValue = "" || dateValue === null) {
            $("#failed4").modal('show');
         } //else if (duplicates.length > 0){
        //     $("#failed5").modal('show');
        // }
        else {
            $("#confirmEntry").modal("show");
            $("#createJournals1").modal("hide");
        }
        
    })
    document.getElementById("backAdd").addEventListener("click", ()=> {
        $("#confirmEntry").modal("hide");
        $("#createJournals1").modal("show");
    })
    // Adds Journal Data to database
    document.getElementById("proceedAdd").addEventListener("click", ()=> {
        let add_journal_date = document.getElementById("add_journal_date").value;
        let add_journal_number = document.getElementById("add_journal_number").value;
        let add_journal_description = document.getElementById("add_journal_description").value;
        let add_journal_category = document.getElementById("add_journal_category").value;
        let arrayData = [];

        let journal_rows = document.querySelectorAll(".journal_items");

        journal_rows.forEach(row => {
            let account_code = row.getElementsByTagName("td")[1].getAttribute("id");
            let journal_debit = row.getElementsByTagName("td")[2].textContent;
            let journal_debit_main = row.getElementsByTagName("td")[2];
            let journal_credit = row.getElementsByTagName("td")[3].textContent;
            let journal_credit_main = row.getElementsByTagName("td")[3];

            if (journal_debit === ""){
                let amount = journal_credit;
                let placement = journal_credit_main.getAttribute("class");
                arrayData.push({
                    account_code: account_code,
                    journal_amount: amount,
                    journal_placement:placement
                })
            } else if(journal_credit === "") {
                let amount = journal_debit;
                let placement = journal_debit_main.getAttribute("class");
                arrayData.push({
                    account_code: account_code,
                    journal_amount: amount,
                    journal_placement:placement
                })
            }

            
        })
        console.log(arrayData);
        let sendtoDB = {
            add_journal_date:add_journal_date,
            add_journal_number:add_journal_number,
            add_journal_description:add_journal_description,
            add_journal_category:add_journal_category,
            journal_array:arrayData,
        }
        console.log(sendtoDB);

        fetch("add/addjournal2.php", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body:JSON.stringify(sendtoDB),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=> {
            // Logs Data Recieved
            console.log(data);
            if(data === "Success"){
                let journalTable = document.getElementById("journalBody");
                $("#success1").modal("show");
                $("#confirmEntry").modal("hide");


                document.getElementById("add_journal_description").value = "";
                document.getElementById("add_journal_category").value = "";

                document.getElementById("addJournalEntryForm2").reset();
                while(journalTable.firstChild){
                    journalTable.removeChild(journalTable.firstChild);
                }
                display();
                calculateTotal();
                setTimeout( ()=>{
                    JEVNumber();
                },1000)
                function readOnlyRemove(){
                    
                    document.getElementById("add_journal_category").readOnly = false;
                    document.getElementById("add_journal_description").readOnly = false;
        
                }
                readOnlyRemove();
                // window.open("reports/jevprint.php","_blank");

            } else {
                console.log();
                $("#failed1").modal("show");
                document.getElementById("error1").textContent = data;
                
            }
        })

    })
    //  function currentDate(){
    //     const date = new Date();
    //     const formattedDate = date.toISOString().split('T')[0];
    //     document.getElementById("fromDate").value = formattedDate;
    //  }
    //  currentDate();
     function startDate(){
        const startDate = document.getElementById("startDate").textContent;
        const date = new Date(startDate);
        const formattedDate = date.toISOString().split('T')[0];
        document.getElementById("fromDate").value = formattedDate;
     }
     startDate();
     function JEVNumber() {
        const startDate = document.getElementById("startDate").textContent;
        const startDateValue = new Date(startDate);
        const date = new Date();
        const yearLast = startDateValue.getFullYear().toString().slice(-2);
        const hyphen = "-";
        let autoincrementvalue;
        let journalbody = document.getElementById("journalList");
        
        if (!journalbody || journalbody.querySelector('td[colspan="5"]') ) {
            // No records found, set the initial value to "0001"
            const JEVNumber = yearLast + hyphen + "0001";
            document.getElementById('add_journal_number').value = JEVNumber;
            
            // Add event listener for button click
            document.getElementById('addJEV').addEventListener("click", () => {
                let JEVValue = document.getElementById("add_journal_number").value;
            });
            
            return;  // Stop further execution since there are no records
        } else {
            let highestNumber = 0;
    
            // Iterate through each row to find the highest journal number
            Array.from(journalbody.children).forEach(row => {
                let pastvalue = row.getElementsByTagName("td")[1].textContent;
                let pastNumber = parseInt(pastvalue.substring(3, 7));
                if (pastNumber > highestNumber) {
                    highestNumber = pastNumber;
                }
            });
    
            autoincrementvalue = highestNumber + 1;
            let formattedNumber = autoincrementvalue.toString().padStart(4, '0');
            let JEVNumber = yearLast + hyphen + formattedNumber;
    
            // Set the generated JEV number in the input field
            document.getElementById('add_journal_number').value = JEVNumber;
    
            // Add event listener for button click
            document.getElementById('addJEV').addEventListener("click", () => {
                let JEVValue = document.getElementById("add_journal_number").value;
                console.log(JEVValue);
            });
        }
    }
    
    
      setTimeout(function() {
         JEVNumber();
        }, 1000)
     

    function JEVNum(){
        fetch('fetch/fetchjournalnum.php', {
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
            document.getElementById("add_journal_number").value = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }

    // setTimeout(function() {
    //     JEVNum();
    //    }, 1000)
    function display(){
        document.getElementById('searchJournal').value = "";
        fetch('search/searchjournal.php', {
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
            document.getElementById("journalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchjournal.php',{
            method: "POST",
            body: new URLSearchParams({
                search:search
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            document.getElementById("journalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

    function displayC(titleAcc){
        fetch('search/searchjournal.php',{
            method: "POST",
            body: new URLSearchParams({
                titleAcc:titleAcc
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            console.log(data);
            document.getElementById("journalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

        // No future Date
        function noFuture(){
        const currentDate = new Date().toISOString().split('T')[0];
        const enddate = document.getElementById("endDate").textContent;
        const endDate = new Date(enddate);
         // Compare end date and current date
         if (endDate > new Date()) {
            // If end date is in the past, set max attribute to current date
            document.getElementById("fromDate").setAttribute('max', currentDate);
            document.getElementById("toDate").setAttribute('max', currentDate);
            document.getElementById("add_journal_date").setAttribute('max', currentDate);
        } else {
            // If end date is in the future, set max attribute to end date
            document.getElementById("fromDate").setAttribute('max', endDate.toISOString().split('T')[0]);
            document.getElementById("toDate").setAttribute('max', endDate.toISOString().split('T')[0]);
            document.getElementById("add_journal_date").setAttribute('max', endDate.toISOString().split('T')[0]);
        }
    
        }
        noFuture();

                // Function to set max date to today
        function noPast() {
            let startDate = document.getElementById("startDate").textContent;
            const startDateValue = new Date(startDate).toISOString().split('T')[0];
            document.getElementById("fromDate").setAttribute('min', startDateValue);
            document.getElementById("toDate").setAttribute('min', startDateValue);
            document.getElementById("add_journal_date").setAttribute('min', startDateValue);
        }
        noPast();
           // Centralized function to update links
function updateLinks() {
    const fromDate = document.getElementById("fromDate").value;
    const toDate = document.getElementById("toDate").value;
    const jCategoryValue = document.getElementById("jCategory").value;

    const link = document.getElementById("printJEVList");
    link.href = constructLink(fromDate, toDate, jCategoryValue);

    const link2 = document.getElementById("printSummary");
    link2.href = constructLink2(fromDate, toDate, jCategoryValue);
}

// Function to update the display based on filter values
function updateDisplay() {
    const fromDate = document.getElementById("fromDate").value;
    const toDate = document.getElementById("toDate").value;

    if (fromDate || toDate) {
        displayFilter(fromDate, toDate);
    } else {
        display();
    }
}

// Keyup Event Listener for #jCategory
document.getElementById('jCategory').addEventListener('input', (event) => {
    const data = event.target.value;
    updateLinks();
    if (data) {
        displayC(data);
    } else {
        display();
    }
});

// Keyup Event Listener for #searchJournal
document.getElementById('searchJournal').addEventListener('keyup', (event) => {
    const data = event.target.value;
    if (data) {
        displaySearch(data);
    } else {
        display();
    }
});

// Change Event Listener for #fromDate
document.getElementById('fromDate').addEventListener('change', (event) => {
    updateLinks();
    updateDisplay();
});

// Change Event Listener for #toDate
document.getElementById('toDate').addEventListener('change', (event) => {
    updateLinks();
    updateDisplay();
});

// Functions to construct the URLs
function constructLink(fromDate, toDate, jCategoryValue) {
    return 'reports/generaljournal.php?date_from=' + encodeURIComponent(fromDate) + '&date_to=' + encodeURIComponent(toDate) + '&category_id=' + encodeURIComponent(jCategoryValue);
}

function constructLink2(fromDate, toDate, jCategoryValue) {
    return 'reports/summaryreport.php?date_from=' + encodeURIComponent(fromDate) + '&date_to=' + encodeURIComponent(toDate) + '&category_id=' + encodeURIComponent(jCategoryValue);
}

// Other functions (e.g., displayFilter, displaySearch, display, displayC) remain the same

    // document.getElementById("nextJItems").addEventListener("click", ()=> {
    //     const jevNumber = document.getElementById("add_journal_number").value;
    //     const jevDescription = document.getElementById("add_journal_description").value;
    //     const jevCategory = document.getElementById("add_journal_category").value;
    //     if(jevNumber === "" || jevDescription === "" || jevCategory === "") {
    //         alert("Please Complete The Required Values");
    //     } else {  
    //         $("#createJournals1").modal("hide");
    //         $("#createJournals2").modal("show");

    //         // Set Default Values
    //         let foot1 = document.getElementById("Dr");
    //         let foot2 = document.getElementById("Cr");
    //         let value1 = 0.00;
    //         let value2 = 0.00;
    //         value1 = parseFloat(value1);
    //         value1 = value1.toFixed(2);
    //         value2 = parseFloat(value2);
    //         value2 = value2.toFixed(2);
    //         foot1.textContent = value1;
    //         foot2.textContent = value2;
    //     }
    // })
    // For Normal Balance
    document.getElementById("addJEntry").addEventListener("click", () => {
        const field1 = document.getElementById("add_journal_title");
        const field2 = document.getElementById("add_journal_amount");
        
        if (field1.value === "" || field2.value === "") {
            $("#failed5").modal("show");
            document.getElementById("add_journal_number").readOnly = false;
            document.getElementById("add_journal_category").readOnly = false;
            document.getElementById("add_journal_description").readOnly = false;
        } else {
            let journalTable = document.getElementById("journalBody");
            let accountTitle = $('#add_journal_title').select2('data')[0];
            let accountTitleValue = accountTitle.text.trim();
            let amount = document.getElementById("add_journal_amount").value.trim();
            let amountDecimal = parseFloat(amount).toFixed(2);
            let accountTitleId = accountTitle.id;
            let normal = accountTitle.normal_balance;
            let account_code = accountTitle.account_code;
    
            
// Check for duplicate entry based on the account code (for both Debit and Credit)
let found = false;
for (let i = 0; i < journalTable.rows.length; i++) {
    let row = journalTable.rows[i];
    let cellCode = row.cells[0].innerText;

    // If a duplicate entry is found
    if (cellCode === accountTitleId) {
        // Update the debit amount (cell 2)
        let currentDebitAmount = parseFloat(row.cells[2].innerText) || 0;
        let currentCreditAmount = parseFloat(row.cells[3].innerText) || 0;

        // If the current credit amount is greater than 0, subtract the new amount from the debit
        if (currentCreditAmount > 0) {
            row.cells[2].innerText = (currentDebitAmount - parseFloat(amount)).toFixed(2);
            row.cells[3].innerText = (currentCreditAmount + parseFloat(amount)).toFixed(2);
        } else {
            // Otherwise, just add the amount to the debit side
            row.cells[2].innerText = (currentDebitAmount + parseFloat(amount)).toFixed(2);
        }

        document.getElementById("add_journal_amount").value = "";
        $('#add_journal_title').val(null).trigger('change');
        found = true;
        break;
    }
}
    
            if (!found) {
                // If no duplicates found, add a new row
                let newRow = journalTable.insertRow();
                newRow.setAttribute("class", "journal_items");
                let cell0 = newRow.insertCell(0);
                let cell1 = newRow.insertCell(1);
                let cell2 = newRow.insertCell(2);
                let cell3 = newRow.insertCell(3);
                let cell4 = newRow.insertCell(4);
    
                cell0.textContent = accountTitleId;
                cell1.textContent = accountTitleValue;
                cell1.setAttribute("id", account_code);
                
                // Create action buttons
                let editButton = document.createElement('button');
                let removeButton = document.createElement('button');
                editButton.textContent = "Edit";
                removeButton.textContent = "Remove";
                editButton.classList.add("btn", "btn-secondary", "text-white", "editRow");
                removeButton.classList.add("btn", "btn-danger", "text-white", "deleteRow");
    
                // Append buttons to the last cell
                cell4.appendChild(removeButton);
                cell4.appendChild(editButton);
    
                // Style the buttons
                editButton.style.marginRight = "5px";
                editButton.style.backgroundColor = "#004d68";
                removeButton.style.backgroundColor = "#004d68";
    
                // // Set the amount in the appropriate cell based on normal balance
                // if (normal === "Credit") {
                //     cell3.textContent = amountDecimal;
                //     cell3.setAttribute("class", normal);
                //     cell3.setAttribute("data-value", amountDecimal);
                // } else {
                //     cell2.textContent = amountDecimal;
                //     cell2.setAttribute("class", "Debit");
                //     cell2.setAttribute("data-value", amountDecimal);
                // }

                cell2.textContent = amountDecimal;
                cell2.setAttribute("class", "Debit");
                cell2.setAttribute("data-value", amountDecimal);
    
                // Reset the form after adding the entry
                document.getElementById("addJournalEntryForm2").reset();
                $('#add_journal_title').val(null).trigger('change');
            }
    
            // Add event listeners for removal and editing of entries
            attachRowEventListeners();
    
            // Calculate total after adding a new entry or updating an existing one
            calculateTotal();

            function readOnly() {
                document.getElementById("add_journal_number").readOnly = true;
                document.getElementById("add_journal_category").readOnly = true;
                document.getElementById("add_journal_description").readOnly = true;
            }
        
            readOnly();
        }
    
        
    });
    
    // Function to attach event listeners for edit and remove buttons in the journal table
    function attachRowEventListeners() {
        // Removal
        let deleteButtons = document.querySelectorAll('.deleteRow');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                let row = event.target.parentNode.parentNode;
                row.parentNode.removeChild(row);
                calculateTotal();
            });
        });
    
        let currentRow; // To store the row being edited

        // Use event delegation to handle click events on dynamically added .editRow buttons
        document.getElementById('journalBody').addEventListener('click', function(event) {
            // Check if the clicked element is an edit button
            if (event.target.classList.contains('editRow')) {
                currentRow = event.target.closest('tr'); // Assign the row being edited
                
                if (!currentRow) {
                    console.error("No row found for editing.");
                    return; // Exit if the row is not found
                }
        
                console.log("Editing row: ", currentRow); // Log the current row for debugging
        
                // Get the debit and credit cells from the current row
                let debit = currentRow.querySelector(".Debit");
                let credit = currentRow.querySelector(".Credit");
                let JEVamount;
        
                // Set the JEV amount and entry type based on whether it's a debit or credit entry
                if (debit && debit.textContent.trim() !== "") {
                    JEVamount = debit.textContent.trim();
                    document.getElementById("jevAmount").value = JEVamount;
                    document.getElementById("jevAmount").setAttribute("data-bs-entry", "Debit");
                } else if (credit && credit.textContent.trim() !== "") {
                    JEVamount = credit.textContent.trim();
                    document.getElementById("jevAmount").value = JEVamount;
                    document.getElementById("jevAmount").setAttribute("data-bs-entry", "Credit");
                }
        
                // Show the modal after setting the values
                $("#editEntry").modal("show");
                $("#createJournals1").modal("hide");
            }
        });
        
        // Save the edited value and update the table
        document.getElementById("saveEdit").addEventListener('click', function() {
            // Ensure currentRow is defined
            if (!currentRow) {
                console.error("No row selected for editing.");
                return; // Exit if no row is selected
            }
        
            // Get the selected account title and account code from Select2
            let accountTitle = $('#edit_journal_title').select2('data')[0].text; // Get the selected account title text
            let accountCode = $('#edit_journal_title').val(); // Get the selected account code value
            let JEVamount = document.getElementById("jevAmount").value.trim();
            let entryType = document.getElementById("jevAmount").getAttribute("data-bs-entry");
        
            // Check for duplicate account codes in other rows
            let duplicateFound = false;
            document.querySelectorAll("#journalBody tr").forEach(function(row) {
                let rowAccountCode = row.querySelector("td:nth-child(1)").textContent.trim(); // Get account code from the row
                if (row !== currentRow && rowAccountCode === accountCode) {
                    duplicateFound = true; // A duplicate was found in another row
                    return false;
                }
            });
        
            if (duplicateFound) {
                $("#failed7").modal('show');
                return; // Exit if duplicate account code found
            }
        
            // Convert the value to a number and ensure it's valid
            if (!isNaN(JEVamount) && JEVamount !== "") {
                JEVamount = parseFloat(JEVamount).toFixed(2); // Format the input value as a float
            } else {
                alert("Please enter a valid number.");
                return;
            }
        
            // Update the account title in the current row
            let accountTitleCell = currentRow.querySelector("td:nth-child(2)"); // Assuming 2nd cell holds the account title
            if (accountTitleCell) {
                accountTitleCell.textContent = accountTitle;
            }
        
            // Update the account code in the current row (if needed)
            let accountCodeCell = currentRow.querySelector("td:nth-child(1)"); // Assuming 1st cell holds the account code
            if (accountCodeCell) {
                accountCodeCell.textContent = accountCode;
            }
        
            // Update the correct column in the current row based on the entry type
            if (entryType === "Debit") {
                let debitCell = currentRow.querySelector(".Debit");
                if (debitCell) {
                    debitCell.textContent = JEVamount;
                }
            } else if (entryType === "Credit") {
                let creditCell = currentRow.querySelector(".Credit");
                if (creditCell) {
                    creditCell.textContent = JEVamount;
                }
            }
        
            // Log the updated row to ensure it was successful
            console.log("Updated row: ", currentRow);
        
            // Close the modal
            $("#createJournals1").modal("show");
            $("#editEntry").modal("hide");
        
            // Recalculate totals after editing
            calculateTotal();
        });
        
        
        
    }
    
    // Calculate Total
    function calculateTotal(){
        let foot1 = document.getElementById("Dr");
        let foot2 = document.getElementById("Cr");
        let journalTable = document.getElementById("journalBody");
        let rows = journalTable.getElementsByClassName("journal_items");
        let totalDebit = 0;
        let totalCredit = 0;

        Array.from(rows).forEach(row=> {
            let debit = row.querySelector(".Debit");
            let credit = row.querySelector(".Credit");

            if(debit){
                totalDebit += parseFloat(debit.textContent);
            } else if(credit){
                totalCredit += parseFloat(credit.textContent);
            } 
        })

        foot1.textContent = totalDebit.toFixed(2);
        foot2.textContent = totalCredit.toFixed(2);
    }

    document.getElementById("addJEntry2").addEventListener("click", ()=> {
        const field1 = document.getElementById("add_journal_title");
        const field2 = document.getElementById("add_journal_amount");
        
        if (field1.value === "" || field2.value === "") {
            $("#failed5").modal("show");
            document.getElementById("add_journal_number").readOnly = false;
            document.getElementById("add_journal_category").readOnly = false;
            document.getElementById("add_journal_description").readOnly = false;
        } else {
            let journalTable = document.getElementById("journalBody");
            let accountTitle = $('#add_journal_title').select2('data')[0];
            let accountTitleValue = accountTitle.text.trim();
            let amount = document.getElementById("add_journal_amount").value.trim();
            let amountDecimal = parseFloat(amount).toFixed(2);
            let accountTitleId = accountTitle.id;
            let normal = accountTitle.normal_balance;
            let account_code = accountTitle.account_code;
    
// Check for duplicate entry based on the account code (Credit Side Only)
let found = false;
for (let i = 0; i < journalTable.rows.length; i++) {
    let row = journalTable.rows[i];
    let cellCode = row.cells[0].innerText;

    // If a duplicate entry is found
    if (cellCode === accountTitleId) {
        // // Update the credit amount (cell 3)
        // let currentCreditAmount = parseFloat(row.cells[3].innerText) || 0;
        // row.cells[3].innerText = (currentCreditAmount + parseFloat(amountDecimal)).toFixed(2);

        // If there's a value in the debit side, subtract the amount
        let currentDebitAmount = parseFloat(row.cells[2].innerText) || 0;
        if (currentDebitAmount > 0) {
            row.cells[2].innerText = (currentDebitAmount - parseFloat(amountDecimal)).toFixed(2);
        } else {
            // row.cells[2].innerText = "0.00";
            // Update the credit amount (cell 3)
            let currentCreditAmount = parseFloat(row.cells[3].innerText) || 0;
            row.cells[3].innerText = (currentCreditAmount + parseFloat(amountDecimal)).toFixed(2);

        }
        document.getElementById("add_journal_amount").value = "";
        $('#add_journal_title').val(null).trigger('change');
        found = true;
        break;
    }
}


            if (!found) {
                // If no duplicates found, add a new row
                let newRow = journalTable.insertRow();
                newRow.setAttribute("class", "journal_items");
                let cell0 = newRow.insertCell(0);
                let cell1 = newRow.insertCell(1);
                let cell2 = newRow.insertCell(2);
                let cell3 = newRow.insertCell(3);
                let cell4 = newRow.insertCell(4);
    
                cell0.textContent = accountTitleId;
                cell1.textContent = accountTitleValue;
                cell1.setAttribute("id", account_code);
                
                // Create action buttons
                let editButton = document.createElement('button');
                let removeButton = document.createElement('button');
                editButton.textContent = "Edit";
                removeButton.textContent = "Remove";
                editButton.classList.add("btn", "btn-secondary", "text-white", "editRow");
                removeButton.classList.add("btn", "btn-danger", "text-white", "deleteRow");
    
                // Append buttons to the last cell
                cell4.appendChild(removeButton);
                cell4.appendChild(editButton);
    
                // Style the buttons
                editButton.style.marginRight = "5px";
                editButton.style.backgroundColor = "#004d68";
                removeButton.style.backgroundColor = "#004d68";
    
                // // Set the amount in the appropriate cell based on normal balance
                // if (normal === "Credit") {
                //     cell3.textContent = amountDecimal;
                //     cell3.setAttribute("class", normal);
                //     cell3.setAttribute("data-value", amountDecimal);
                // } else {
                //     cell2.textContent = amountDecimal;
                //     cell2.setAttribute("class", "Debit");
                //     cell2.setAttribute("data-value", amountDecimal);
                // }
    
                    cell3.textContent = amountDecimal;
                    cell3.setAttribute("class", "Credit");
                    cell3.setAttribute("data-value", amountDecimal);

                    document.getElementById("addJournalEntryForm2").reset();
                    $('#add_journal_title').val(null).trigger('change');
                } else {
                // Reset the form after adding the entry
                document.getElementById("addJournalEntryForm2").reset();
                $('#add_journal_title').val(null).trigger('change');
                    

            }
    
            // Add event listeners for removal and editing of entries
            attachRowEventListeners();
    
            // Calculate total after adding a new entry or updating an existing one
            calculateTotal();
            function readOnly() {
                document.getElementById("add_journal_number").readOnly = true;
                document.getElementById("add_journal_category").readOnly = true;
                document.getElementById("add_journal_description").readOnly = true;
            }
        
            readOnly();
        }
    
        
    });

    function editButttonsSQL() {
        let tableBody = document.getElementById("viewJTable2");
    
        // Attach event listener to the table body for event delegation
        tableBody.addEventListener('click', function(event) {
            // Check if the clicked element is an edit button
            if (event.target.classList.contains('editRow1')) {
                let row = event.target.closest('tr'); // Get the closest row to the clicked button
                let debit = row.querySelector(".Debit");
                let credit = row.querySelector(".Credit");
                let JEVamount;
    
                // Check if debit exists and retrieve its value
                if (debit && debit.textContent.trim() !== "") {
                    JEVamount = debit.textContent.trim(); // Use trim() to remove extra whitespace
                    document.getElementById("jevAmount2").value = JEVamount;
                    document.getElementById("jevAmount2").setAttribute("data-bs-entry", "Debit");
                } 
                // Check if credit exists and retrieve its value
                else if (credit && credit.textContent.trim() !== "") {
                    JEVamount = credit.textContent.trim(); // Use trim() to remove extra whitespace
                    document.getElementById("jevAmount2").value = JEVamount;
                    document.getElementById("jevAmount2").setAttribute("data-bs-entry", "Credit");
                }
    
                // Show the modal for editing
                $("#updEntry2").modal("show");   
                $("#editEntry2").modal("hide");

                document.getElementById("saveEdit2").addEventListener("click",()=> {

                    let JEVamount = document.getElementById("jevAmount2").value.trim();
                    let entryType = document.getElementById("jevAmount2").getAttribute("data-bs-entry");
                    
                    if (entryType === "Debit") {
                        debit.textContent = JEVamount;
                        console.log(JEVamount);
                    } else if (entryType === "Credit" && debit === null) {
                        console.log(credit.textContent);
                        credit.textContent = JEVamount;
                        console.log(JEVamount);
                    }
            
                    $("#editEntry2").modal('show');
                    $("#updEntry2").modal('hide');
                    calculateTotal3();
                    document.getElementById("editTabularData2").reset()
                })
            
            }
        });
    }
    
    // Initialize the edit buttons
    editButttonsSQL();

    // Save Updated Entries
    document.getElementById("saveEntry2").addEventListener("click", ()=> {
        let DR3 = document.getElementById("Dr3").textContent;
        let CR3 = document.getElementById("Cr3").textContent;

         // Get all account codes in #viewJTable2
    const accountCodes = Array.from(document.querySelectorAll("#viewJTable2 .account-code")).map(td => td.textContent.trim());

    // Check for duplicate account codes
    const uniqueCodes = new Set(accountCodes);
    if (uniqueCodes.size !== accountCodes.length) {
        $("#failed8").modal('show');
        return;
    }
        // Validate if Debit and Credit are Equal
        if (DR3 === CR3){
            $("#confirmEntryUPD").modal('show');
            $("#editEntry2").modal('hide');
        } else if (DR3 === "0" || CR3 === "0"){
            $("#failed9").modal('show');
        } else {
            $("#failed2").modal('show');
            
        }
        
    })
    
    document.getElementById("backAdd2").addEventListener("click", ()=> {
        $("#confirmEntryUPD").modal('hide');
        $("#editEntry2").modal('show');
    })
    
    let journalTable = document.getElementById('viewJTable2');
    
    // Listen for changes in any input fields inside the table body
    journalTable.addEventListener('keyup', function(event) {
        // Check if the changed element is a Debit or Credit field
        if (event.target.classList.contains('Debit') || event.target.classList.contains('Credit')) {
            calculateTotal3(); // Recalculate totals whenever a value changes
            
        }
    });

    document.getElementById("proceedAdd2").addEventListener("click", () => {
        let upd_journal_id = document.getElementById("jNumber1").textContent;
        let journal_rows = document.querySelectorAll(".jItems2");
        let arrayData = [];
    
        journal_rows.forEach(row => {
            // let journal_item_id = row.getAttribute("id");
            let account_code = row.getElementsByTagName("td")[0].textContent;
            
            // Access the input elements inside the cells
            let journal_debit_input = row.getElementsByTagName("td")[2].querySelector("input");
            let journal_credit_input = row.getElementsByTagName("td")[3].querySelector("input");
    
            let journal_item_id = row.getElementsByTagName("td")[0].getAttribute("id");
            // Retrieve the values from the input fields
            let journal_debit = journal_debit_input ? journal_debit_input.value.trim() : "";
            let journal_credit = journal_credit_input ? journal_credit_input.value.trim() : "";
    
            if (!journal_debit && journal_credit) {
                let amount = journal_credit;
                let placement = journal_credit_input.getAttribute("class");
                arrayData.push({
                    journal_item_id:journal_item_id,
                    account_code: account_code,
                    journal_amount: amount,
                    journal_placement: placement
                });
            } else if (!journal_credit && journal_debit) {
                let amount = journal_debit;
                let placement = journal_debit_input.getAttribute("class");
                arrayData.push({
                    journal_item_id:journal_item_id,
                    account_code: account_code,
                    journal_amount: amount,
                    journal_placement: placement
                });
            }
        });
    
        console.log(arrayData);
    
        let sendtoDB = {
            upd_journal_id: upd_journal_id,
            journal_array: arrayData,
        };
    
        console.log("Sending to DB:", sendtoDB); // Log to check structure
    
        fetch("edit/editjournal2.php", {
            method: "POST",
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(sendtoDB),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            if (data === "Success") {
                $("#success5").modal("show");
                $("#confirmEntryUPD").modal("hide");
                display();
                calculateTotal3();
            } else {
                $("#failed1").modal("show");
                document.getElementById("error1").textContent = data;
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    });
    
    

    
}) //End of Ready
function calculateTotal2(){
    let foot1 = document.getElementById("Dr2");
    let foot2 = document.getElementById("Cr2");
    let journalTable = document.getElementById("viewJTable");
    let rows = journalTable.getElementsByClassName("jItems");
    let totalDebit = 0;
    let totalCredit = 0;

    Array.from(rows).forEach(row=> {
        let debit = row.querySelector(".Debit");
        let credit = row.querySelector(".Credit");

        if(debit){
            totalDebit += parseFloat(debit.textContent);
        } else if(credit){
            totalCredit += parseFloat(credit.textContent);
        } 
    })

    foot1.textContent = totalDebit.toFixed(2);
    foot2.textContent = totalCredit.toFixed(2);
}
function calculateTotal3() {
    let totalDebit = 0;
    let totalCredit = 0;

    // Get all rows with class 'jItems2' within the table
    let rows = document.querySelectorAll('.jItems2');
    
    rows.forEach(function (row) {
        let debitField = row.querySelector('.Debit');
        let creditField = row.querySelector('.Credit');

        // If there's a Debit field, add its value to totalDebit
        if (debitField && debitField.value) {
            totalDebit += parseFloat(debitField.value) || 0;
        }

        // If there's a Credit field, add its value to totalCredit
        if (creditField && creditField.value) {
            totalCredit += parseFloat(creditField.value) || 0;
        }
    });

    // Update the totals in the footer
    document.getElementById('Dr3').textContent = totalDebit.toFixed(2);
    document.getElementById('Cr3').textContent = totalCredit.toFixed(2);
}
function viewEntry(uid){
    fetch('fetch/fetchjournal.php',{
        method: 'POST',
        headers: {'Content-type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            uid: uid
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP-Error: " + response.status);
        } 
        return response.text();
    })
    .then(data => {
        $("#viewEntry").modal('show');
        document.getElementById("viewJTable").innerHTML = data
        let foot1 = document.getElementById("Dr2");
        let foot2 = document.getElementById("Cr2");
        let value1 = 0.00;
        let value2 = 0.00;
        value1 = parseFloat(value1);
        value1 = value1.toFixed(2);
        value2 = parseFloat(value2);
        value2 = value2.toFixed(2);
        foot1.textContent = value1;
        foot2.textContent = value2;
        calculateTotal2();

        
        return fetch('search/searchjev.php', {
            method:'POST',
            headers: {'Content-type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({
                uid: uid,
            })
        });
    })
    .then(response2 => {
        if (!response2.ok) {
            throw new Error("HTTP-Error: " + response2.status);
        } 
        return response2.text();
    })
    .then(data2 =>{
        let tbl_jev = JSON.parse(data2);
        console.log(data2);
        document.getElementById("jevNum").textContent = tbl_jev.journal_voucher_no;
        document.getElementById("jevDate").textContent = tbl_jev.journal_date;
        document.getElementById("jevType").textContent = tbl_jev.category_name;

        document.getElementById("printJEV1").href = `reports/jevvoucher.php?voucher_id=${tbl_jev.journal_voucher_id}`;
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }

  function initializeSelect2JS() {
    // Ensure Select2 is initialized
    $('.upd_acct_titles').select2({
        dropdownParent: $("#editEntry2"),  // Parent container (for modals)
        placeholder: 'Select an account',  // Placeholder text
        allowClear: true,                  // Allow clearing the selection
        ajax: {
            url: 'fetch/select2js/titles3.php', // Your server-side endpoint
            dataType: 'json',
            delay: 250,  // Delay for debounce
            data: function(params) {
                return {
                    term: params.term || '',  // Search term from user input
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []  // Results array for Select2
                };
            },
            cache: true
        }
    });
}

// Reinitialize Select2 for dynamically added elements, if necessary
$(document).on('shown.bs.modal', '#editEntry2', function() {
    initializeSelect2JS(); // Initialize/reinitialize Select2 when the modal is shown


});

$(document).on('select2:select', '.upd_acct_titles', function(e) {
    const selectedData = e.params.data; // Get the selected data
    const accountCode = selectedData.id; // Assuming account code is the value of the selected option
    const accountCodeElement = $(this).closest('tr').find('.account-code'); // Find the account code element in the same row
    
    // Update the account code text
    accountCodeElement.text(accountCode);
    
    console.log('Change event triggered with value:', accountCode);
});


  function viewEntry2(uid){
    fetch('fetch/fetcheditjournal.php',{
        method: 'POST',
        headers: {'Content-type':'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            uid: uid
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP-Error: " + response.status);
        } 
        return response.text();
    })
    .then(data => {
        $("#editEntry2").modal('show');
        document.getElementById("viewJTable2").innerHTML = data
        let foot3 = document.getElementById("Dr3");
        let foot4 = document.getElementById("Cr3");
        let value1 = 0.00;
        let value2 = 0.00;
        value1 = parseFloat(value1);
        value1 = value1.toFixed(2);
        value2 = parseFloat(value2);
        value2 = value2.toFixed(2);
        foot3.value = value1;
        foot4.value = value2;
        calculateTotal3();
        initializeSelect2JS();

        
        return fetch('search/searchjev.php', {
            method:'POST',
            headers: {'Content-type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({
                uid: uid,
            })
        });
    })
    .then(response2 => {
        if (!response2.ok) {
            throw new Error("HTTP-Error: " + response2.status);
        } 
        return response2.text();
    })
    .then(data2 =>{
        let tbl_jev = JSON.parse(data2);

        document.getElementById("jNumber1").textContent = tbl_jev.journal_voucher_id
        // document.getElementById("jevNum1").textContent = tbl_jev.journal_voucher_no;
        // document.getElementById("upd_journal_date").value = tbl_jev.journal_date;
        // document.getElementById("upd_journal_category4").value = tbl_jev.category_id;

        document.getElementById("printJEV1").href = `reports/jevvoucher.php?voucher_id=${tbl_jev.journal_voucher_id}`;
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }



  
  