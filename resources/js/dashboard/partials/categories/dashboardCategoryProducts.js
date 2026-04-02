/**
 * Initializes the dashboard category management functionality.
 *
 * This function:
 * 1. Listens for input on the category search field and sends AJAX GET requests after a typing delay.
 * 2. Dynamically renders category rows in a table with editable fields including name, slug, and status.
 * 3. Sends AJAX POST requests to create new categories from the create form, including CSRF token for security.
 * 4. Sends AJAX PUT requests to update existing categories when the "Save" button is clicked.
 * 5. Sends AJAX DELETE requests to remove selected categories after confirmation.
 * 6. Refreshes the category list after create, update, or delete actions so the table always shows current values.
 */
export function initDashboardCategoryProducts() {
    const root = $('.dashboardCategoryProducts');

    if (!root.length) {
        return;
    }

    // Configuration and state variables
    const searchDelayMs = 450;
    let searchTimeoutId = null;

    const searchUrl = root.data('search-url') || '/dashboard-category-products/search';
    const storeUrl = root.data('store-url') || '/dashboard-category-products';
    const updateUrlTemplate = root.data('update-url-template') || '/dashboard-category-products/__CATEGORY_ID__';
    const deleteUrlTemplate = root.data('delete-url-template') || '/dashboard-category-products/__CATEGORY_ID__';

    const noDataLabel = root.data('no-data-label') || 'No categories to display';
    const saveLabel = root.data('save-label') || 'Save';
    const deleteLabel = root.data('delete-label') || 'Delete';
    const activeLabel = root.data('active-label') || 'Active';
    const inactiveLabel = root.data('inactive-label') || 'Inactive';
    const confirmDeleteLabel = root.data('confirm-delete') || 'Delete?';
    const saveErrorLabel = root.data('save-error') || 'Error while saving category changes.';
    const deleteErrorLabel = root.data('delete-error') || 'Error while deleting category.';
    const createErrorLabel = root.data('create-error') || 'Error while creating category.';

    const $tableBody = root.find('.dashboardCategoryProducts_tableBody');
    const $searchInput = root.find('.dashboardCategoryProducts_controlsSearchInput');

    function escapeHtml(value) {
        return $('<div>').text(value ?? '').html();
    }

    function renderRows(categories) {
        $tableBody.empty();

        if (!categories.length) {
            $tableBody.html(`<tr><td colspan="6" class="text-center">${escapeHtml(noDataLabel)}</td></tr>`);
            return;
        }

        categories.forEach((category) => {
            const statusOptions = `
                <option value="1" ${category.is_active ? 'selected' : ''}>${escapeHtml(activeLabel)}</option>
                <option value="0" ${!category.is_active ? 'selected' : ''}>${escapeHtml(inactiveLabel)}</option>
            `;

            $tableBody.append(`
                <tr class="dashboardCategoryProducts_tableRow" data-category-id="${category.id}">
                    <td class="dashboardCategoryProducts_tableCell--id">${category.id}</td>
                    <td>
                        <input
                            type="text"
                            class="dashboardCategoryProducts_tableInput--name form-control"
                            maxlength="120"
                            value="${escapeHtml(category.name)}">
                    </td>
                    <td>
                        <input
                            type="text"
                            class="dashboardCategoryProducts_tableInput--slug form-control"
                            maxlength="140"
                            value="${escapeHtml(category.slug)}">
                    </td>
                    <td>
                        <select class="dashboardCategoryProducts_tableSelect--status form-select">
                            ${statusOptions}
                        </select>
                    </td>
                    <td class="dashboardCategoryProducts_tableCell--count">${category.products_count}</td>
                    <td class="dashboardCategoryProducts_tableCell--actions">
                        <button type="button" class="btn btn-secondary dashboardCategoryProducts_tableButton--save">${escapeHtml(saveLabel)}</button>
                        <button type="button" class="btn btn-outline-danger dashboardCategoryProducts_tableButton--delete ms-2">${escapeHtml(deleteLabel)}</button>
                    </td>
                </tr>
            `);
        });
    }

    function fetchCategories(query = '') {
        $.ajax({
            url: searchUrl,
            method: 'GET',
            dataType: 'json',
            data: { query },
            success: function (response) {
                renderRows(response.categories || []);
            },
            error: function () {
                $tableBody.html(`<tr><td colspan="6" class="text-center">${escapeHtml(noDataLabel)}</td></tr>`);
            }
        });
    }

    $searchInput.on('keyup', function () {
        const query = $(this).val();

        if (searchTimeoutId) {
            clearTimeout(searchTimeoutId);
        }

        searchTimeoutId = setTimeout(function () {
            fetchCategories(query);
        }, searchDelayMs);
    });

    root.find('.dashboardCategoryProducts_createButton').on('click', function () {
        const name = (root.find('.dashboardCategoryProducts_createInput--name').val() || '').trim();
        const slug = (root.find('.dashboardCategoryProducts_createInput--slug').val() || '').trim();
        const statusVal = root.find('.dashboardCategoryProducts_createInput--status').val();

        if (!name) {
            return;
        }

        $.ajax({
            url: storeUrl,
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                name: name,
                slug: slug || null,
                is_active: Number(statusVal) === 1,
            }),
            success: function () {
                root.find('.dashboardCategoryProducts_createInput--name').val('');
                root.find('.dashboardCategoryProducts_createInput--slug').val('');
                root.find('.dashboardCategoryProducts_createInput--status').val('1');
                fetchCategories($searchInput.val());
            },
            error: function () {
                console.log(createErrorLabel);
            }
        });
    });

    $(document).on('click', '.dashboardCategoryProducts_tableButton--save', function () {
        const row = $(this).closest('.dashboardCategoryProducts_tableRow');
        const categoryId = row.data('category-id');
        const name = (row.find('.dashboardCategoryProducts_tableInput--name').val() || '').trim();
        const slug = (row.find('.dashboardCategoryProducts_tableInput--slug').val() || '').trim();
        const isActive = Number(row.find('.dashboardCategoryProducts_tableSelect--status').val()) === 1;

        if (!name || !categoryId) {
            return;
        }

        const updateUrl = updateUrlTemplate.replace('__CATEGORY_ID__', categoryId);

        $.ajax({
            url: updateUrl,
            method: 'PUT',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                name: name,
                slug: slug || null,
                is_active: isActive,
            }),
            success: function () {
                fetchCategories($searchInput.val());
            },
            error: function () {
                console.log(saveErrorLabel);
            }
        });
    });

    $(document).on('click', '.dashboardCategoryProducts_tableButton--delete', function () {
        const row = $(this).closest('.dashboardCategoryProducts_tableRow');
        const categoryId = row.data('category-id');

        if (!categoryId) {
            return;
        }

        if (!window.confirm(confirmDeleteLabel)) {
            return;
        }

        const deleteUrl = deleteUrlTemplate.replace('__CATEGORY_ID__', categoryId);

        $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                fetchCategories($searchInput.val());
            },
            error: function () {
                console.log(deleteErrorLabel);
            }
        });
    });

    fetchCategories('');
}
