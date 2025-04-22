document.addEventListener("DOMContentLoaded", ()=> {

    // Set Default Values for Date Values
    function defaultValues(){
        let fromDate2 = document.getElementById("fromDate2").value;
        let toDate2 = document.getElementById("toDate2").value;
        let link = document.getElementById("printIncome");
        let link2 = document.getElementById("printBalance");
        let link3 = document.getElementById("printTrial");
        link.href = constructLink(fromDate2, toDate2);
        link2.href = constructLink2(fromDate2, toDate2);
        link3.href = constructLink3(fromDate2, toDate2);
    }
    // Call default values
    setTimeout(()=> {
        defaultValues();
    },1000)
    
    function hideButton() {
        let button = document.getElementById("addtrial");
    
        // Get the current year properly
        let year = new Date().getFullYear();
    
        // Use correct string interpolation in template literals
        let start = new Date(`${year}-12-01`);
        let end = new Date(`${year}-12-31`);
        let today = new Date();
    
        // Show the button if today is within the range
        if (today >= start && today <= end) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    }
    
    hideButton();
    
    // Max Date
    function noFuture() {
        const currentDate = new Date().toISOString().split('T')[0];
        const enddateElement = document.getElementById("endDate");
    
        if (!enddateElement) {
            console.error("Element with ID 'endDate' not found.");
            return; // Exit if end date element is not found
        }
    
        const enddate = enddateElement.textContent;
        const endDate = new Date(enddate);
    
        // Compare end date and current date
        if (endDate < new Date()) {
            // If end date is in the past, set max attribute to end date
            document.getElementById("fromDate2").setAttribute('max', endDate.toISOString().split('T')[0]);
            document.getElementById("toDate2").setAttribute('max', endDate.toISOString().split('T')[0]);
        } else {
            // If end date is in the future, set max attribute to current date
            document.getElementById("fromDate2").setAttribute('max', currentDate);
            document.getElementById("toDate2").setAttribute('max', currentDate);
        }
    }
    
    noFuture();

            // Function to set max date to today
            function noPast() {
                let startDate = document.getElementById("startDate").textContent;
                const startDateValue = new Date(startDate).toISOString().split('T')[0];
                document.getElementById("fromDate2").setAttribute('min', startDateValue);
                document.getElementById("toDate2").setAttribute('min', startDateValue);
            }
            noPast();
    // Select JS
    $('#add_journal_title2').select2({
        dropdownParent: $('#addTrial'),
        placeholder: 'Select an option',
        allowClear: true,
        ajax: {
            url: 'fetch/select2js/titles2.php', // Replace with the path to your PHP script
            dataType: 'json',
            delay: 250, // Delay in milliseconds between keystrokes and when the request is sent
            data: function(params) {
                return {
                    term: params.term // Search term
                };
            },
            processResults: function(data) {
                return {
                    results: data // The data needs to be in an array of objects with 'id' and 'text' keys
                };
            },
            cache: true
        }
    });
    function display(){
        document.getElementById('searchTrial').value = "";
        fetch('search/searchtrial.php', {
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
            document.getElementById("displayTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchtrial.php',{
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
            document.getElementById("displayTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchTrial').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })

    document.getElementById("addTrialForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#confirmTrial").modal('show');
        $("#addTrial").modal('hide');
    })
    document.getElementById("backAddTrial").addEventListener("click", ()=> {
        $("#confirmTrial").modal('hide');
        $("#addTrial").modal('show');
    })

    document.getElementById("proceedAddTrial").addEventListener("click", ()=> {
    
        let add_journal_title2 = document.getElementById("add_journal_title2").value;
        let add_balance_type = document.getElementById("add_balance_type").value;
        let add_start_balance = document.getElementById("add_start_balance").value;
    
        fetch('add/addtrial.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                add_journal_title2:add_journal_title2,
                add_balance_type:add_balance_type,
                add_start_balance:add_start_balance
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            if(data = "Success"){
                $("#success").modal('show');
                $("#confirmTrial").modal('hide');
                document.getElementById("addTrialForm").reset();
                displayFilter();
            } else if (data = "Failed"){
                $("#failed6").modal('show');
                $("#confirmAdd").modal('hide');
            } else if (data = "No Statement Prepared") {
                $("#failed5").modal('show');
                $("#confirmAdd").modal('hide');
            }  else {
                $("#failed").modal('show');
                $("#confirmAdd").modal('hide');
            }
        })
    });
    // Current Date
    function currentDate(){
        const date = new Date();
        const formattedDate = date.toISOString().split('T')[0];
        const enddateElement = document.getElementById("endDate");
    
        const enddate = enddateElement.textContent;
        const endDate = new Date(enddate);

        if (endDate < new Date()) {
            document.getElementById("toDate2").value = endDate.toISOString().split('T')[0];
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            const year = endDate.getFullYear();
            let month = months[endDate.getMonth()];
            const day = endDate.getDate();
            document.getElementById("date2").textContent = month + " " + day + ", " + year
        } else {
            document.getElementById("toDate2").value = formattedDate;
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
            const year = date.getFullYear();
            let month = months[date.getMonth()];
            const day = date.getDate();
            document.getElementById("date2").textContent = month + " " + day + ", " + year
        }

        // document.getElementById("toDate2").value = formattedDate;

        // const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        // const year = date.getFullYear();
        // let month = months[date.getMonth()];
        // const day = date.getDate();
        // document.getElementById("date2").textContent = month + " " + day + ", " + year
     }
     currentDate();

     function pastDate(){
        const startDate = document.getElementById("startDate").textContent;
        const startDateValue = new Date(startDate);
        const date = new Date();
        const oneweek = new Date();
        // startDateValue.setDate(date.getDate());
        const formattedDate = startDateValue.toISOString().split('T')[0];
        document.getElementById("fromDate2").value = formattedDate;

        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = startDateValue.getFullYear();
        let month = months[startDateValue.getMonth()];
        const day = startDateValue.getDate();
        document.getElementById("date1").textContent = month + " " + day + ", " + year
     }
     pastDate();
    //  Filter Based on Date
    function displayFilter(fromDate2, toDate2){
        console.log(fromDate2, toDate2);
        fetch('search/searchtrial.php',{
            method: "POST",
            body: new URLSearchParams({
                fromDate2:fromDate2,
                toDate2:toDate2
            })
            
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            document.getElementById("displayTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }

    document.getElementById('fromDate2').addEventListener('input',(event)=>{
        let fromDate2 = event.target.value;
        let fromDateValue = new Date(fromDate2);
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = fromDateValue.getFullYear();
        let month = months[fromDateValue.getMonth()];
        const day = Value.getDate();
        document.getElementById("date1").textContent = month + " " + day + ", " + year;
        let toDate2 = document.getElementById("toDate2").value;

        let link = document.getElementById("printIncome");
        link.href = constructLink(fromDate2, toDate2);

        
        let link2 = document.getElementById("printBalance");
        link2.href = constructLink2(fromDate2, toDate2);

        let link3 = document.getElementById("printTrial");
        link3.href = constructLink3(fromDate2, toDate2);
        if(fromDate2 || toDate2){
            displayFilter(fromDate2, toDate2);
            displayFilter2(fromDate2, toDate2);
        } else {
            display();
            display2();
        }
    })
    document.getElementById('toDate2').addEventListener('input',(event)=>{
        let fromDate2 = document.getElementById("fromDate2").value;
        let toDate2 = event.target.value;
        let toDateValue = new Date(toDate2);
        const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
        const year = toDateValue.getFullYear();
        let month = months[toDateValue.getMonth()];
        const day = toDateValue.getDate();
        document.getElementById("date2").textContent = month + " " + day + ", " + year;

        let link = document.getElementById("printIncome");
        link.href = constructLink(fromDate2, toDate2);

        let link2 = document.getElementById("printBalance");
        link2.href = constructLink2(fromDate2, toDate2);
        let link3 = document.getElementById("printTrial");
        link3.href = constructLink3(fromDate2, toDate2);


        
        if(fromDate2 || toDate2){
            displayFilter(fromDate2, toDate2);
            displayFilter2(fromDate2, toDate2);
        } else {
            display();
            display2();
        }
    })

    function constructLink(fromDate, toDate){
        return 'reports/incomestatement.php?date_from=' + encodeURIComponent(fromDate) + '&date_to=' + encodeURIComponent(toDate);
    }

    function constructLink2(fromDate, toDate){
        return 'reports/balance.php?date_from=' + encodeURIComponent(fromDate) + '&date_to=' + encodeURIComponent(toDate);
    }

    function constructLink3(fromDate, toDate){
        return 'reports/trialbalance.php?date_from=' + encodeURIComponent(fromDate) + '&date_to=' + encodeURIComponent(toDate);
    }


    function display2(){
        document.getElementById('searchTrial').value = "";
        fetch('search/searchtotaltrial.php', {
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
            document.getElementById("totalTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    
    display2();

    function displayFilter2(fromDate2, toDate2){
        console.log(fromDate2, toDate2);
        fetch('search/searchtotaltrial.php',{
            method: "POST",
            body: new URLSearchParams({
                fromDate2:fromDate2,
                toDate2:toDate2
            })
            
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data=>{
            document.getElementById("totalTrial").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
})