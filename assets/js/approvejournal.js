document.addEventListener("DOMContentLoaded" , ()=> {

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

    document.getElementById("saveEntry3").addEventListener('click' ,()=> {

        let add_journal_date2 =  document.getElementById("add_journal_date2").value;
        let jevStatus = document.getElementById("upd_jStatus").value;
        if (add_journal_date2 === "" || jevStatus === ""){
            $("#failed6").modal('show');
        } else {
            $("#confirmStatus").modal('show');
            $("#editEntry3").modal('hide');
        }
       
    })
    document.getElementById("backStatus").addEventListener('click' ,()=> {
        $("#confirmStatus").modal('hide');
        $("#editEntry3").modal('show');
    })

    document.getElementById("proceedStatus").addEventListener('click' ,()=> {

        let jevID = document.getElementById("jNumber2").textContent;
        let add_journal_date2 =  document.getElementById("add_journal_date2").value;
        let jevStatus = document.getElementById("upd_jStatus").value;
        console.log(jevID, jevStatus, add_journal_date2);

        fetch('edit/editjournalstatus.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                jevID:jevID,
                jevStatus:jevStatus,
                add_journal_date2: add_journal_date2
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
                console.log(data);
                $("#success6").modal('show');
                $("#confirmStatus").modal('hide');
            
                display();
                console.log(data);
            } else if (data = "JEV Entry is Rejected"){
                $("#success6").modal('show');
                $("#confirmStatus").modal('hide');
            } else if (data = "No Statement Prepared") {
                $("#success6").modal('show');
                $("#confirmStatus").modal('hide');
            }  else {
                $("#failed1").modal("show");
                document.getElementById("error1").textContent = data;
                $("#confirmStatus").modal('hide');
                console.log(data);
            }
        })
    })

    // function noPast() {
    //     let startDate = document.getElementById("startDate").textContent;
    //     const startDateValue = new Date(startDate).toISOString().split('T')[0];
    //     let jevDate2 = document.getElementById("jevDate2").textContent;
    //     let jevDate2Value = new Date(jevDate2).toISOString().split('T')[0];
    //     document.getElementById("add_journal_date2").setAttribute('min', startDateValue);
    // }
    // noPast();
    
    function noFuture(){
        const currentDate = new Date().toISOString().split('T')[0];
        const enddate = document.getElementById("endDate").textContent;
        const endDate = new Date(enddate);
         // Compare end date and current date
         if (endDate > new Date()) {
            // If end date is in the past, set max attribute to current date
            document.getElementById("add_journal_date2").setAttribute('max', currentDate);
        } else {
            // If end date is in the future, set max attribute to end date
            document.getElementById("add_journal_date2").setAttribute('max', endDate.toISOString().split('T')[0]);
        }
    
        }
        noFuture();


})
function viewEntry3(uid){
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
        $("#editEntry3").modal('show');
        // document.getElementById("viewJTable").innerHTML = data
        // let foot1 = document.getElementById("Dr2");
        // let foot2 = document.getElementById("Cr2");
        // let value1 = 0.00;
        // let value2 = 0.00;
        // value1 = parseFloat(value1);
        // value1 = value1.toFixed(2);
        // value2 = parseFloat(value2);
        // value2 = value2.toFixed(2);
        // foot1.textContent = value1;
        // foot2.textContent = value2;
        // calculateTotal2();

        
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

        document.getElementById("jNumber2").textContent = tbl_jev.journal_voucher_id;
        document.getElementById("jevNum2").textContent = tbl_jev.journal_voucher_no;
        document.getElementById("jevDate2").textContent = tbl_jev.journal_date;
        document.getElementById("jevType2").textContent = tbl_jev.category_name;
        document.getElementById("jevStatus").textContent = tbl_jev.journal_status;

        document.getElementById("printJEV1").href = `reports/jevvoucher.php?voucher_id=${tbl_jev.journal_voucher_id}`;

        function noPast2() {
            let startDate = document.getElementById("startDate").textContent;
            const startDateValue = new Date(startDate).toISOString().split('T')[0];
            let jevDate2 = document.getElementById("jevDate2").textContent;
            let jevDate2Value = new Date(jevDate2).toISOString().split('T')[0];
            document.getElementById("add_journal_date2").setAttribute('min', jevDate2Value);
        }
        noPast2();
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }