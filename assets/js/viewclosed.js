document.addEventListener("DOMContentLoaded", ()=> {
    document.getElementById("viewDropdown").addEventListener("click", ()=> {
        $("#viewClosed").modal('show');
    })
    document.getElementById("viewClosedForm").addEventListener("submit", (e)=> {
        let fiscID = document.getElementById("fiscalID").value;
        document.getElementById("errorView").textContent = "No selected value";
        if(fiscID === ""){
            $("#failedView").modal('show');

        } else {
            e.preventDefault();
            $("#confirmView").modal('show');
            $("#viewClosed").modal('hide');
        }
       
       })
       document.getElementById("backAddView").addEventListener("click", ()=> {
            $("#confirmView").modal('hide');
            $("#viewClosed").modal('show');
       })
       
       document.getElementById("proceedViewFisc").addEventListener("click", ()=> {
            let fiscID = document.getElementById("fiscalID").value;
           
            fetch('edit/editviewcurrent.php', {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                    fiscalID:fiscID
                    // journal_category2:add_journal_category2

                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => {
                if(data === "Success"){
                    console.log(data);
                    $("#successView").modal('show');
                    $("#confirmView").modal('hide');
                    document.getElementById("viewClosedForm").reset();
                    document.getElementById("reload").addEventListener("click", ()=> {
                        location.reload();
                    })
                    
                } else if (data === "Failed in Inserting Accounts"){
                    $("#failedView").modal('show');
                    $("#confirmView").modal('hide');
                } else if (data === "Account Already Exists") {
                    $("#failedView").modal('show');
                    $("#confirmView").modal('hide');
                } else if (data === "Statement Not Prepared") {
                    $("#failedView").modal('show');
                    $("#confirmView").modal('hide');
                } else {
                    console.log(data);
                    document.getElementById("errorView").textContent = data;
                    $("#failedView").modal('show');
                    $("#confirmView").modal('hide');

                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
            });
       });

    function dynamicOption(){
        fetch('fetch/fetchclose.php', {
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
            document.getElementById("fiscalID").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption();


    function noAddButtons (){
        let fiscStatus =  document.getElementById("fStatus").textContent;
     
        if (fiscStatus === "Closed"){
         
        } else {
     
        }
     }
})