
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1; // Start at page 1
    const limit = 10; // Records per page
    
    function fetchAuditLogs(page = 1, search = '', filter = '') {
        // Send an AJAX request to fetch the audit logs
        const formData = new FormData();
        formData.append('page', page);
        formData.append('search', search);
        formData.append('filterAudit', filter);

        fetch('search/searchaudit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Clear the current table rows
            const tableBody = document.getElementById('displayAudit');
            tableBody.innerHTML = '';

            // Populate the table with new data
            data.data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.audit_timestamp}</td>
                    <td>${row.audit_description}</td>
                    <td>${row.audit_action}</td>
                    <td>${row.uid}</td>
                `;
                tableBody.appendChild(tr);
            });

            // Update pagination
            updatePagination(data.currentPage, data.totalPages);
        })
        .catch(error => console.error('Error fetching audit logs:', error));
    }

    function updatePagination(currentPage, totalPages) {
        const paginationElement = document.getElementById('pagination');
        paginationElement.innerHTML = '';

        // Previous button
        if (currentPage > 1) {
            const prevButton = `<li class="page-item">
                <a class="page-link" href="#" data-page="${currentPage - 1}">&laquo;</a>
            </li>`;
            paginationElement.innerHTML += prevButton;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const activeClass = (i === currentPage) ? 'active' : '';
            const pageButton = `<li class="page-item ${activeClass}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`;
            paginationElement.innerHTML += pageButton;
        }

        // Next button
        if (currentPage < totalPages) {
            const nextButton = `<li class="page-item">
                <a class="page-link" href="#" data-page="${currentPage + 1}">&raquo;</a>
            </li>`;
            paginationElement.innerHTML += nextButton;
        }

        // Add click event listeners to pagination links
        document.querySelectorAll('#pagination a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = parseInt(this.getAttribute('data-page'));
                fetchAuditLogs(page);
            });
        });
    }

    // Initial load
    fetchAuditLogs();

    // Search and filter
    document.getElementById('searchAudit').addEventListener('input', function() {
        const search = this.value;
        const filter = document.getElementById('filterAudit').value;
        fetchAuditLogs(1, search, filter); // Reset to page 1 on search
    });

    document.getElementById('filterAudit').addEventListener('change', function() {
        const search = document.getElementById('searchAudit').value;
        const filter = this.value;
        fetchAuditLogs(1, search, filter); // Reset to page 1 on filter change
    });
});
