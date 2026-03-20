/**
 * Initializes dashboard product management features:
 * - Product search with AJAX
 * - Product table rendering
 * - Price, category, and status updates
 */
export function initDashboardProduct() {
    const searchDelayMs = 1000;
    const letters = 2;
    let searchTimeoutId = null;

    const productRoot = $('.dashboard_Product');

    if (!productRoot.length) {
        return;
    }

    const fetchUrl = productRoot.data('fetch-url') || '/dashboard-products/search';
    const updateUrlTemplate = productRoot.data('update-url-template') || '/dashboard-products/__PRODUCT_ID__';

    $('.dashboard_ProductSearch').on('keyup', function () {
        const query = $(this).val();

        if (searchTimeoutId) {
            clearTimeout(searchTimeoutId);
        }

        if (query.length <= letters) {
            $('.table_dashboardGeneralTbody--products').empty();
            return;
        }

        searchTimeoutId = setTimeout(function () {
            $.ajax({
                url: fetchUrl,
                method: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function (response) {
                    const tbody = $('.table_dashboardGeneralTbody--products');
                    const changeLabel = tbody.data('change-label') || 'Change';
                    const noDataLabel = tbody.data('no-data-label') || 'No data to display';

                    tbody.empty();

                    if (response.products.length > 0) {
                        response.products.forEach(product => {
                            const selectedCategoryId = product.categories && product.categories.length > 0
                                ? product.categories[0].id
                                : '';

                            tbody.append(`
                                <tr>
                                    <td class="table_dashboardGeneralTbodyTdata--id">${product.id}</td>
                                    <td>${product.name}</td>
                                    <td>${product.slug}</td>
                                    <td>
                                        <input type="number"
                                            min="0"
                                            step="0.01"
                                            value="${product.price}"
                                            class="table_dashboardGeneralTbodyTdata--price form-control d-inline w-100" />
                                    </td>
                                    <td>
                                        <select class="table_dashboardGeneralTbodyTdata--category form-select" data-product-id="${product.id}">
                                            <option value="">-</option>
                                            ${response.categories.map(category => `
                                                <option value="${category.id}" ${selectedCategoryId == category.id ? 'selected' : ''}>
                                                    ${category.name}
                                                </option>`).join('')}
                                        </select>
                                    </td>
                                    <td>
                                        <select class="table_dashboardGeneralTbodyTdata--status form-select" data-product-id="${product.id}">
                                            ${response.statuses.map(status => `
                                                <option value="${status.id}" ${product.status_id == status.id ? 'selected' : ''}>
                                                    ${status.name}
                                                </option>`).join('')}
                                        </select>
                                    </td>
                                    <td><button type="button" class="btn btn-secondary btn-apply-product">${changeLabel}</button></td>
                                </tr>
                            `);
                        });
                    } else {
                        tbody.html(`<tr><td colspan="8" class="text-center">${noDataLabel}</td></tr>`);
                    }
                }
            });
        }, searchDelayMs);
    });

    $(document).on('click', '.btn-apply-product', function () {
        const row = $(this).closest('tr');
        const productId = row.find('.table_dashboardGeneralTbodyTdata--id').text().trim();
        const price = row.find('.table_dashboardGeneralTbodyTdata--price').val();
        const categoryId = row.find('.table_dashboardGeneralTbodyTdata--category').val();
        const statusId = row.find('.table_dashboardGeneralTbodyTdata--status').val();

        const updateUrl = updateUrlTemplate.replace('__PRODUCT_ID__', productId);

        $.ajax({
            url: updateUrl,
            method: 'PUT',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                price: price,
                category_id: categoryId || null,
                status_id: statusId || null,
            }),
            success: function () {
                $('.dashboard_ProductSearch').trigger('keyup');
            },
            error: function () {
                const message = $('.table_dashboardGeneralTbody--products').data('update-error') || 'Error while updating product';
                console.log(message);
            }
        });
    });
}
