document.addEventListener('DOMContentLoaded', function () {
    const popoverTrigger = document.getElementById('notificationBell');
    let notificationsLoaded = false; // Track if notifications are already loaded

    // Initialize the popover
    new bootstrap.Popover(popoverTrigger, {
        content: 'Loading notifications...',
        html: true,
        placement: 'bottom'
    });

    // Add event listener for showing the popover
    popoverTrigger.addEventListener('show.bs.popover', function () {
        if (notificationsLoaded) return; // Prevent re-fetching if already loaded

        fetch('search/searchnotification.php')
            .then(response => response.json())
            .then(data => {
                let notifications = data.notifications.map(notification => 
                    `<a href="#" id="notification-${notification.notification_id}" class="notification-link" style="display: block; text-decoration: none; color: inherit;">
                        <div><strong>${notification.notification_text}</strong><br>${notification.datetime}</div>
                    </a>`
                ).join('<hr>');

                const popoverInstance = bootstrap.Popover.getInstance(popoverTrigger);
                popoverInstance.setContent({ '.popover-body': notifications || 'No new notifications' });
                notificationsLoaded = true; // Set to true after loading
            })
            .catch(error => console.error('Error loading notifications:', error));
    });

    // Use event delegation for the notification links
    document.addEventListener('click', function (event) {
        const notificationLink = event.target.closest('.notification-link'); // Capture the clicked link with the 'notification-link' class 
        if (notificationLink) {
            console.log(notificationLink);
            const notificationId = notificationLink.id.split('-')[1]; // Extract ID from element
            
            const notificationText = notificationLink.querySelector('div').innerText; // Get the notification text
            let substringNotif = notificationText.substring(21,28);
            document.getElementById("searchJournal").value = substringNotif;
            console.log('Notification text:', substringNotif); // Log the notification text
            // Trigger the search directly
            displaySearch(substringNotif);
            markAsRead(notificationId);
            event.preventDefault(); // Prevent default action
        }
    });

    function markAsRead(notificationId) {
        console.log('Marking notification as read:', notificationId); // Log when function is called
        fetch('edit/editnotification.php'  , {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ notification_id: notificationId }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log('Notification marked as read');
                // Optionally, update the UI here

                const notificationElement = document.getElementById(`notification-${notificationId}`);

                if (notificationElement) {
                    // Option 1: Remove the notification from the popover
                    notificationElement.remove();
    
                    // Option 2 (Alternative): Style the notification as read
                    // notificationElement.style.color = '#ccc'; // Grey out text to indicate it’s read
    
                    // Optionally, add a "Read" indicator or strike-through text
                    // notificationElement.querySelector('div').innerHTML = '<strike>Read</strike>';
                }
                // Update the notification count
            updateNotificationCount();
            fetchNotifications();
            } else {
                console.error('Failed to mark notification as read:', data.error);
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    }

    function fetchNotifications() {
        fetch('search/searchnotification.php')
            .then(response => response.json())
            .then(data => {
                let notifications = data.notifications.map(notification => 
                    `<a href="#" id="notification-${notification.notification_id}" class="notification-link" style="display: block; text-decoration: none; color: inherit;">
                        <div><strong>${notification.notification_text}</strong><br>${notification.datetime}</div>
                    </a>`).join('<hr>');
    
                const popoverInstance = bootstrap.Popover.getInstance(popoverTrigger);
                popoverInstance.setContent({ '.popover-body': notifications || 'No new notifications' });
            })
            .catch(error => console.error('Error loading notifications:', error));
    }

    const notificationBell = document.getElementById('notificationBell');

    function updateNotificationCount() {
        fetch('search/notifcount.php')
            .then(response => response.json())
            .then(data => {
                if (data.unread_count > 0) {
                    notificationBell.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ffffff" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                                </svg><span class="badge bg-danger top-0 start-100 translate-middle">${data.unread_count}</span>`;
                } else {
                    notificationBell.innerHTML =  ` <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#ffffff" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                                </svg>`; // Remove badge if no unread notifications
                }
            })
            .catch(error => console.error('Error fetching notification count:', error));
    }

    // Call the function to update the notification count
    updateNotificationCount();

    // Optionally, you can set an interval to refresh the count periodically
    setInterval(updateNotificationCount, 60000); // Update every minute

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
        //Keyup Event Listener
    // document.getElementById('searchJournal').addEventListener('keyup',(event)=>{
    //     let data = event.target.value;
    //     if(data){
    //         displaySearch(data);
    //     } else{
    //         display();
    //     }
    // })
});
    