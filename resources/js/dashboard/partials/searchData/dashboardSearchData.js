/**
 * Initializes the sorting functionality for search statistics in the dashboard.
 * 
 * This function performs the following tasks:
 * 1. Listens for changes on the search data sort dropdown.
 * 2. Sends an AJAX GET request to the server with the selected sort option.
 * 3. On successful response, updates the search data table body with the returned HTML.
 * 4. Handles errors by logging them to the console and displaying an error message in the UI.
 */


export function initDashboardsearchData() {
    $('#searchDataSort').on('change', function () {
            let formData = {
                searchDataSort: $('#searchDataSort').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: "/dashboard-search-stats",
                method: 'GET',
                data: formData,
                success: function (response) {
                    $('.table_dashboardGeneralTbody--searchData').html(response);
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    $('.table_dashboardGeneralTbody--searchData').html('<p>Greška pri učitavanju podataka.</p>');
                }
            });
        });
}