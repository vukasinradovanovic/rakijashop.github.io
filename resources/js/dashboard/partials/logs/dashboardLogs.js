export function initDashboardLogs() {
    const root = $('.dashboard_Logs');

    if (!root.length) {
        return;
    }

    const searchDelayMs = 400;
    let searchTimeoutId = null;

    const searchUrl = root.data('search-url') || '/dashboard-errors/search';
    const $searchInput = root.find('.dashboard_LogsSearch');
    const $tbody = root.find('.table_dashboardGeneralTbody--logs');

    const guestLabel = $tbody.data('guest-label') || 'Guest';
    const noDataLabel = $tbody.data('no-data-label') || 'No data to display';

    function escapeHtml(value) {
        return $('<div>').text(value ?? '').html();
    }

    function renderRows(logs) {
        $tbody.empty();

        if (!logs.length) {
            $tbody.html(`<tr><td colspan="6" class="text-center">${escapeHtml(noDataLabel)}</td></tr>`);
            return;
        }

        logs.forEach((log) => {
            $tbody.append(`
                <tr>
                    <td>${log.id}</td>
                    <td>${escapeHtml(log.error_code)}</td>
                    <td>${escapeHtml(log.user_email || guestLabel)}</td>
                    <td>${escapeHtml(log.route_name || '-')}</td>
                    <td>${escapeHtml(log.request_path)}</td>
                    <td>${escapeHtml(log.created_at || '')}</td>
                </tr>
            `);
        });
    }

    function fetchLogs(query = '') {
        $.ajax({
            url: searchUrl,
            method: 'GET',
            dataType: 'json',
            data: { query },
            success: function (response) {
                renderRows(response.logs || []);
            },
            error: function () {
                renderRows([]);
            }
        });
    }

    $searchInput.on('keyup', function () {
        const query = $(this).val();

        if (searchTimeoutId) {
            clearTimeout(searchTimeoutId);
        }

        searchTimeoutId = setTimeout(function () {
            fetchLogs(query);
        }, searchDelayMs);
    });

    fetchLogs('');
}
