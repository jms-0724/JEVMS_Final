document.addEventListener("DOMContentLoaded", ()=> {

    const modals = ['addSignatories', 'archiveSignatory', 'updSignatories'];
    modals.forEach(modalId => {
        const modalElement = document.querySelector(modalId);
        if (modalElement) {
            new bootstrap.Modal(modalElement);
        }
    });

    function capitalizeFirstLetterOfEachWord(name) {
        return name
            .split(' ') // Split the string into an array of words
            .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()) // Capitalize each word
            .join(' '); // Join the words back into a single string
    }
    function display(){
        document.getElementById('searchSignatories').value = "";
        fetch('search/searchsignatories.php', {
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
            document.getElementById("displaySignatories").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    display();
    //Display Searched Values
    function displaySearch(search){
        fetch('search/searchsignatories.php',{
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
            document.getElementById("displaySignatories").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchSignatories').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })

    document.getElementById("addSigForm").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#confirmAddSig").modal('show');
        $("#addSignatories").modal('hide');
       })
       document.getElementById("backAdd").addEventListener("click", ()=> {
            $("#confirmAddSig").modal('hide');
            $("#addSignatories").modal('show');
       })
       document.getElementById("proceedAdd").addEventListener("click", ()=> {
            let add_sigfname = document.getElementById("add_sigfname").value;
            let add_sigmname = document.getElementById("add_sigmname").value;
            let add_siglname = document.getElementById("add_siglname").value;
            let add_sigposition = document.getElementById("add_sigposition").value;
    
            add_sigfname = capitalizeFirstLetterOfEachWord(add_sigfname);
            add_sigmname = capitalizeFirstLetterOfEachWord(add_sigmname);
            add_siglname = capitalizeFirstLetterOfEachWord(add_siglname);
            add_sigposition = capitalizeFirstLetterOfEachWord(add_sigposition);
    
            fetch('add/addsignatory.php', {
                method: "POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: new URLSearchParams({
                    add_sigfname:add_sigfname,
                    add_sigmname:add_sigmname,
                    add_siglname:add_siglname,
                    add_sigposition:add_sigposition
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
                    $("#successSig1").modal('show');
                    $("#confirmAddSig").modal('hide');
                    document.getElementById("addSigForm").reset();
                    display();
                    dynamicOption();
                } else if (data === "Failed in Inserting User"){
                    document.getElementById("errorSig").textContent = data;
                    $("#failed").modal('show');
                    $("#confirmAddSig").modal('hide');
                } else if (data === "Failed in Inserting User Info") {
                    document.getElementById("errorSig").textContent = data;
                    $("#failed").modal('show');
                    $("#confirmAddSig").modal('hide');
                } else if (data === "Username already exists") {
                    document.getElementById("errorSig").textContent = data;
                    $("#failed").modal('show');
                    $("#confirmAddSig").modal('hide');
                } else {
                    document.getElementById("errorSig").textContent = data;
                    $("#failed").modal('show');
                    $("#confirmAddSig").modal('hide');
                }
            })
       });

       // Update user info
document.getElementById("updSigForm").addEventListener("submit", (e)=> {
    e.preventDefault();
    $("#confirmEditSig").modal('show');
    $("#updSignatories").modal('hide');
   })
   document.getElementById("backAdd2").addEventListener("click", ()=> {
        $("#confirmEditSig").modal('hide');
        $("#updSignatories").modal('show');
   });
   
document.getElementById("proceedUpdate2").addEventListener("click", ()=> {
    
    let uID = document.getElementById("sigID").textContent;
    let upd_sigfname = document.getElementById("upd_sigfname").value;
    let upd_sigmname = document.getElementById("upd_sigmname").value;
    let upd_siglname = document.getElementById("upd_siglname").value;
    let upd_sigposition = document.getElementById("upd_sigposition").value;

    // Capitalize first letter of each name
    upd_sigfname = capitalizeFirstLetterOfEachWord(upd_sigfname);
    upd_sigmname = capitalizeFirstLetterOfEachWord(upd_sigmname);
    upd_siglname = capitalizeFirstLetterOfEachWord(upd_siglname);
    upd_sigposition = capitalizeFirstLetterOfEachWord(upd_sigposition);

    fetch('edit/editsignatory.php', {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: new URLSearchParams({
            sigID: uID,
            upd_sigfname:  upd_sigfname,
            upd_sigmname:  upd_sigmname,
            upd_siglname:  upd_siglname,
            upd_sigposition: upd_sigposition
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
            $("#successSig2").modal('show');
            $("#confirmEditSig").modal('hide');
            console.log(data);
            display();
        } else if (data === "Failed"){
            $("#failed").modal('show');
            $("#confirmEditSig").modal('hide');
            console.log(data);
        } else if (data === "No Rows Updated") {
            $("#failed").modal('show');
            $("#confirmEditSig").modal('hide');
            console.log(data);
        }  else {
            $("#failed").modal('show');
            $("#confirmEditSig").modal('hide');
            console.log(data);
        }
    })
})

       // Update user info
       document.getElementById("archiveFormSig").addEventListener("submit", (e)=> {
        e.preventDefault();
        $("#confirmEditSig2").modal('show');
        $("#archiveSignatory").modal('hide');
       })
       document.getElementById("backAdd3").addEventListener("click", ()=> {
            $("#confirmEditSig2").modal('hide');
            $("#archiveSignatory").modal('show');
       });
       
    document.getElementById("proceedUpdate3").addEventListener("click", ()=> {
        
        // let uID = document.getElementById("sigID").textContent;
        let signatories = document.getElementById("signatories").value;
        let archivedSig = document.getElementById("archivedSig").value;
        let add_sigdate = document.getElementById("add_sigdate").value;
    
    
        fetch('edit/archivesignatory.php', {
            method: "POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: new URLSearchParams({
                signatoryID: signatories,
                signatoryStatus:  archivedSig,
                add_sigdate: add_sigdate,
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
                $("#successSig3").modal('show');
                $("#confirmEditSig2").modal('hide');
                console.log(data);
                display();
            } else if (data === "Failed"){
                document.getElementById("errorSig").textContent = data;
                $("#failed").modal('show');
                $("#confirmEditSig2").modal('hide');
                console.log(data);
            } else if (data === "No Rows Updated") {
                $("#failedRows").modal('show');
                $("#confirmEditSig2").modal('hide');
                console.log(data);
            }  else {
                document.getElementById("errorSig").textContent = data;
                $("#failed").modal('show');
                $("#confirmEditSig2").modal('hide');
                console.log(data);
            }
        })
    })
       function dynamicOption(){
        fetch('fetch/signatory.php', {
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
            document.getElementById("signatories").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }
    dynamicOption();
});

  //Dynamically Fill Fields
  function editSignatory(uid){
    fetch('fetch/fetchsignatory.php',{
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
        let tbl_signatory = JSON.parse(data);
        document.getElementById("sigID").textContent = tbl_signatory.signatory_id;
        document.getElementById("upd_sigfname").value = tbl_signatory.signatory_fname;
        // document.getElementById("up_pword").value = tbl_user.password;
        document.getElementById("upd_sigmname").value = tbl_signatory.signatory_mname;
        document.getElementById("upd_siglname").value = tbl_signatory.signatory_lname;
        document.getElementById("upd_sigposition").value = tbl_signatory.signatory_position;
        const editModal = new bootstrap.Modal(document.getElementById("updSignatories"));
        editModal.show();
    })
    .catch(error => {
        console.error('Error:', error);
    });  
  }