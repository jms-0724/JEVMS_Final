document.addEventListener("DOMContentLoaded", ()=> {

// Function to fetch and display help data by topic ID
// function loadHelpContent(help_topic_id, targetElementId = "helpResults") {
//     // Show loading message
//     document.getElementById(targetElementId).innerHTML = '<p>Loading...</p>';

//     // Fetch data from server
//     fetch('get_help_data.php?help_topic_id=' + help_topic_id)
//         .then(response => response.json())
//         .then(data => {
//             if (data.error) {
//                 document.getElementById(targetElementId).innerHTML = '<p>' + data.error + '</p>';
//             } else {
//                 let helpHTML = `
//                     <div class="help-topic">
//                         <h3>${data.topic}</h3>
//                     </div>
//                 `;
//                 data.items.forEach(item => {
//                     helpHTML += `
//                         <div class="help-item">
//                             <p class="help-item-text">${item.help_text}</p>
//                         </div>
//                     `;
//                 });

//                 document.getElementById(targetElementId).innerHTML = helpHTML;
//             }
//         })
//         .catch(error => {
//             document.getElementById(targetElementId).innerHTML = '<p>Error fetching help data.</p>';
//         });
// }

// // Handle search input event for live filtering
// document.getElementById('searchInfo1').addEventListener('input', function () {
//     const searchQuery = this.value.trim(); // Get the search query

//     if (searchQuery) {
//         loadHelpContent(searchQuery); // Pass the query to the fetch function
//     } else {
//         document.getElementById("helpResults").innerHTML = ''; // Clear if search input is empty
//     }
// });

// // Function to fetch and display help text
// function loadHelpText2(event, help_topic_id, linkElement) {
//     // Prevent the default link behavior
//     event.preventDefault();

//     // Get the placeholder element for the help text
//     const helpTextDiv = document.getElementById("helpText-" + help_topic_id);

//     // Check if the help text is already loaded
//     if (helpTextDiv.innerHTML.trim() !== "") {
//         return; // If already loaded, do nothing
//     }

//     // Display a loading message while fetching the help text
//     helpTextDiv.innerHTML = '<p>Loading...</p>';

//     // Fetch the help text via AJAX/Fetch
//     fetch('get_help_data.php?help_topic_id=' + help_topic_id)
//         .then(response => response.json())
//         .then(data => {
//             if (data.error) {
//                 helpTextDiv.innerHTML = '<p>' + data.error + '</p>';
//             } else {
//                 // Generate HTML for the help text
//                 let helpHTML = `
//                     <div class="help-item">
//                         <p class="help-item-text">${data.topic}</p>
//                     </div>
//                 `;
//                 data.items.forEach(item => {
//                     helpHTML += `
//                         <div class="help-item">
//                             <p class="help-item-text">${item.help_text}</p>
//                         </div>
//                     `;
//                 });

//                 // Insert the help text into the placeholder div
//                 helpTextDiv.innerHTML = helpHTML;
//             }
//         })
//         .catch(error => {
//             helpTextDiv.innerHTML = '<p>Error fetching help data.</p>';
//         });
// }



    // 

    document.getElementById('searchInfo2').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const helpContent = document.querySelectorAll('#helpContent p');
    
        // Clear previous highlights
        helpContent.forEach(item => {
            const originalText = item.textContent; // Preserve original text
            item.innerHTML = ''; // Clear the current HTML
    
            if (query) {
                let startIndex = 0;
                const lowerText = originalText.toLowerCase();
                let firstMatch = true; // Track the first match to scroll to it
    
                // Loop through all matches
                while (lowerText.indexOf(query, startIndex) !== -1) {
                    const matchIndex = lowerText.indexOf(query, startIndex);
    
                    // Append text before the match
                    item.appendChild(document.createTextNode(originalText.slice(startIndex, matchIndex)));
    
                    // Append highlighted match
                    const mark = document.createElement('mark');
                    mark.classList.add('highlight');
                    mark.textContent = originalText.slice(matchIndex, matchIndex + query.length);
                    item.appendChild(mark);
    
                    // Scroll to the first match in the visible viewport
                    if (firstMatch) {
                        mark.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstMatch = false;
                    }
    
                    // Update start index after match
                    startIndex = matchIndex + query.length;
                }
    
                // Append remaining text after the last match
                item.appendChild(document.createTextNode(originalText.slice(startIndex)));
            } else {
                // No query, reset content without highlighting
                item.textContent = originalText;
            }
        });
    });
    
    
    
    
    
    display();
    function display(){
        document.getElementById('searchInfo1').value = "";
        fetch('help/searchhelp.php', {
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
            document.getElementById("helpResults").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        });
    }

    //Display Searched Values
    function displaySearch(search){
        fetch('help/searchhelp.php',{
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
            document.getElementById("helpResults").innerHTML = data;
        })
        .catch(error => {
            console.error("Fetch error:", error);
        })
    }
    //Keyup Event Listener
    document.getElementById('searchInfo1').addEventListener('keyup',(event)=>{
        let data = event.target.value;
        if(data){
            displaySearch(data);
        } else{
            display();
        }
    })

    
}); //End of Document ready

// Function to fetch and display help content based on the topic clicked
function fetchHelpText(help_id) {
    fetch('help/searchhelptext.php?help_topic_id=' + help_id)
    .then(response => response.text())
    .then(data => {
        document.getElementById('helpContent').innerHTML = data; // Load the content into helpContent div
    })
    .catch(error => console.error('Error:', error));
}
