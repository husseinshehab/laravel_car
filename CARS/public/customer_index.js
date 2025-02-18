let currentPage = 1;
const itemsPerPage = 9;
const items = document.querySelectorAll('.gallery-item'); // Select all gallery items

// Function to load the current page items
function loadPage(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    items.forEach((item, index) => {
        if (index >= startIndex && index < endIndex) {
            item.style.display = 'table-cell'; // Show items in the current page
        } else {
            item.style.display = 'none'; // Hide other items
        }
    });

    // Disable or enable pagination buttons
    document.getElementById('prevButton').disabled = page === 1;
    document.getElementById('nextButton').disabled = endIndex >= items.length;
}

// Functions to load previous and next pages
function loadPrevPage() {
    if (currentPage > 1) {
        currentPage--;
        loadPage(currentPage);
    }
}

function loadNextPage() {
    if (currentPage * itemsPerPage < items.length) {
        currentPage++;
        loadPage(currentPage);
    }
}

// Initial load of the first page
loadPage(currentPage);
