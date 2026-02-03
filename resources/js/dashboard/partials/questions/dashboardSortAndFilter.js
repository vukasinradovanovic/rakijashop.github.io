/**
 * Initializes sorting and filtering functionality for dashboard questions.
 *
 * Listens for changes on #questionType and #questionSort, sends GET to the form action,
 * and replaces .dashboard_questionsList HTML with the partial returned by the server.
 */
export function initDashboardSortAndFilter() {
    const $form = $('#filterForm');
    const url = $form.attr('action') || window.location.pathname;
    const $list = $('.dashboard_questionsList');
    const emptyMsg = $list.data('emptyMsg') || 'Nema dostupnih pitanja.'; // Default message if none provided

    $('#questionType, #questionSort').on('change', function () {
        const formData = {
            questionType: $('#questionType').val(),
            questionSort: $('#questionSort').val()
            // CSRF not needed for GET
        };

        $.ajax({
            url: url,
            method: 'GET',
            data: formData,
            success: function (response) {
                $list.html(response);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                $list.html(`<div class="text-center text-bg-light text-muted py-5">${emptyMsg}</div>`);
            }
        });
    });
}