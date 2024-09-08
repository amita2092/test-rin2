document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch notification count via AJAX
    function fetchNotificationCount() {
        fetch('/notification/count', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Necessary for Laravel to detect it as an AJAX request
            },
        })
        .then(response => response.json())
        .then(data => {
            // Update notification count element in the DOM
            document.getElementById('notification-count').innerText = data.count;
        })
        .catch(error => {
            console.error('Error fetching notification count:', error);
        });
    }

    // Call the function immediately
    fetchNotificationCount();

    // Poll every 30 seconds (30000 milliseconds)
    setInterval(fetchNotificationCount, 30000); // Adjust polling time as needed
});
