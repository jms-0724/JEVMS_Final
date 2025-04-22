document.addEventListener("DOMContentLoaded", () => {

    document.getElementById('logout2').addEventListener('click', function() {
        fetch('system/logout.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'logout=1'
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          console.log('You Clicked Me');
          window.location.href = './../index.php';
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      });
    // document.querySelector("#fiscalList").addEventListener("click", (event)=> {
    //     $("#confirmUtil3").modal('show'); // Show the modal
    // })
    // document.getElementById("proceedUpd2").addEventListener("click", ()=> {
        
    // })
    // Call tbody after page load
    const tbody = document.querySelector("#fiscalList");
    tbody.addEventListener("click", function(event) {
        if (event.target.classList.contains("activateBTN")) {
            
            const btn = event.target;
            selectedRow = btn.closest("tr"); // Store the closest table row
            $("#confirmUtil3").modal('show'); // Show the confirmation modal
        } 
    });
    
    // Attach click event to the confirmation button in the modal
    document.getElementById("proceedUpd2").addEventListener("click", function() {
        // Get the fiscal ID and current fiscal status from the selected row
        let fiscalList3 = selectedRow.querySelector(".fiscalList").id; // ID of the fiscal year
        let fiscal_status = selectedRow.querySelector(".status2").textContent; // Current status
    
        // Fetch request to send data to PHP
        fetch('edit/archivefiscal.php', {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams({
                fiscal_desc: fiscalList3,
                upd_status: fiscal_status,
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            console.log(data);
    
            if (data === "Success") {
                // Show success modal and hide the confirmation modal
                $("#success2").modal('show');
                $("#confirmUtil3").modal("hide");
    
                // Reset the form if necessary
                // document.getElementById("fiscalArchive").reset(); // Uncomment if there's a form to reset
    
                // Call display() to refresh the table
                display(); // Assuming this function refreshes the fiscal year table
            } else {
                // Show failure modal and display error message
                $("#failed1").modal('show');
                $("#confirmUtil3").modal("hide");
                document.getElementById("error1").textContent = data; // Assuming there's an element to show errors
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    });
    
    // Generate Fiscal Year Value for Add Fiscal Year
    function generateFYValue(){
        let currentFY = document.getElementById("add_fiscal");
        let fiscalName = "F.Y-";
        currentFY.value = fiscalName;
        
        currentFY.addEventListener("input", ()=> {
            let currentFYValue = currentFY.value;
            let yearSubstring = currentFYValue.substring(4,8);
            
            if (currentFYValue.startsWith(fiscalName) && currentFY.length >= 8){

                if(!isNaN(yearSubstring) && yearSubstring.length === 4){
                    console.log(yearSubstring);
                } else {
                    console.log("Invalid Format")
                }
            } else {
                console.log("Incomplete fiscal year input.");
            }
            
            //Get Year from Fiscal Name Substring
        })
    }
    generateFYValue();
    // date
    function DatesforFiscal(){

        let year = new Date().getFullYear();
        // January 1
        let beginDate = new Date(year, 0, 2);
        const formattedDate1 = beginDate.toISOString().split('T')[0];

        // December 31  
        let endDate = new Date(year, 11, 32);
        const formattedDate2 = endDate.toISOString().split('T')[0];

        document.getElementById("startDate").value = formattedDate1;
        document.getElementById("endDate").value = formattedDate2;
    }
    DatesforFiscal();

    function display(){
        document.getElementById('searchFiscal').value = "";
        fetch('search/searchfiscal.php', {
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
            document.getElementById("fiscalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchfiscal.php',{
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
            document.getElementById("fiscalList").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchFiscal').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })

    // Submit Event Listener
    document.getElementById('addFiscalForm').addEventListener("submit", (e)=> {
        let select2Element = $("#mySelect2").val();
        e.preventDefault();
        if(select2Element === "hide" || select2Element === null){
            console.log("Select2 dropdown is empty.");
        } else {
            $("#confirmUtil").modal("show");
            $("#addFiscalYear").modal("hide");
        }
       
        
    })
    document.getElementById('backAdd').addEventListener("click", ()=> {
       
        $("#confirmUtil").modal("hide");
        $("#addFiscalYear").modal("show");
    })

    document.getElementById("proceedAdd").addEventListener("click", ()=> {
           
        let add_fiscal = document.getElementById("add_fiscal").value;
        let startDate = document.getElementById("startDate").value;
        let endDate = document.getElementById("endDate").value
        

        fetch('add/addfiscal.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                add_fiscal:add_fiscal,
                startDate:startDate,
                endDate:endDate
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then(data => {
            console.log(data);
            if(data === "Success"){
                console.log(data);
                $("#success1").modal('show');
                $("#confirmUtil").modal("hide");
                document.getElementById("addFiscalForm").reset();
                display();
            } else {
                $("#failed1").modal('show');
                $("#confirmUtil").modal("hide");
                document.getElementById("error1").textContent = data
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
   });

   document.getElementById('backUpd').addEventListener("click", ()=> {
       
    $("#confirmUtil2").modal("hide");
    $("#archiveFiscal").modal("show");
    });
    document.getElementById('fiscalArchive').addEventListener("submit", (e)=> {
    e.preventDefault();
    $("#confirmUtil2").modal("show");
    $("#archiveFiscal").modal("hide");
    })

   document.getElementById("proceedUpd").addEventListener("click", ()=> {
           
    
    let fiscal_desc = document.getElementById("fiscalList2").value;
    let upd_status = document.getElementById("status2").value;
    let fID = document.getElementById("fID").value;
    console.log(fiscal_desc + " " + upd_status);
    

    fetch('edit/archivefiscal.php', {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: new URLSearchParams({
            fiscal_desc:fiscal_desc,
            upd_status:upd_status,

        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        return response.text();
    })
    .then(data => {
        console.log(data);
        if(data === "Success"){
            $("#success2").modal('show');
            $("#confirmUtil2").modal("hide");
            document.getElementById("fiscalArchive").reset();
            $('#fiscalList2').val(null).trigger('change');
            display();
        } else {
            $("#failed1").modal('show');
            $("#confirmUtil2").modal("hide");
            document.getElementById("error1").textContent = data
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
    });
});

   $('#fiscalList2').select2({
    placeholder: 'Select an option',
    dropdownParent: $('#archiveFiscal'),
    allowClear: true,
    ajax: {
        url: 'fetch/select2js/fiscalyearstatus.php', // Replace with the path to your PHP script
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
    },

});


})

   //Dynamically Fill Fields
   function editFiscal(uid){
    fetch('fetch/fetchfiscal.php',{
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
        
        let tbl_fiscal = JSON.parse(data);
        document.getElementById('fID').textContent = tbl_fiscal.fiscal_id;
        $("#archiveFiscal").modal('show');
    })
    .catch(error => {
        console.error('Error:', error);
    });  
   
}