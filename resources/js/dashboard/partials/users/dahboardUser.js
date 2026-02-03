/**
 * Initializes the dashboard user management functionality.
 * 
 * This function:
 * 1. Listens for input on the user search field and sends AJAX GET requests to fetch matching users when the query length is greater than 2.
 * 2. Dynamically renders the search results in a table with editable fields including username, email, role, and status.
 * 3. Supports resetting the edited username via a checkbox.
 * 4. Sends AJAX PUT requests to update user details on the server when the "Apply" button is clicked, including CSRF token for security.
 * 5. Refreshes the user list after successful updates to reflect any changes.
 */

export function initDashboardUser() {

    // User search 
    $('.dashboard_UserSearch').on('keyup', function() {
        let query = $(this).val();
        if (query.length > 2){
            $.ajax({
                url:'/dashboardUsers/search',
                method: 'GET',
                data: { query: query},
                dataType: 'json',
                success: function(response) {
                    $('.table_dashboardGeneralTbody--users').empty();
                
                    if (response.users.length > 0) {
                        response.users.forEach(user => {
                            $('.table_dashboardGeneralTbody--users').append(`
                                <tr>
                                    <td class="table_dashboardGeneralTbodyTdata--id">${user.id}</td>
                                    <td>${user.default_username}</td>
                                    <td>
                                        <input type="text" 
                                            value="${user.edited_username ?? ''}" 
                                            class="table_dashboardGeneralTbodyTdata--editedUsername form-control d-inline w-50" />
                                        <input type="checkbox"     class="table_dashboardGeneralTbodyTdata--editedUsernameCheckbox ms-1"/>
                                            <label>Reset</label>
                                    </td>
                                    <td>${user.name}</td>
                                    <td>
                                        <input type="text" 
                                            value="${user.email}" 
                                            class="table_dashboardGeneralTbodyTdata--email form-control d-inline w-100" />
                                    </td>
                                    <td>
                                        <select class="table_dashboardGeneralTbodyTdata--role form-select" data-user-id="${user.id}">
                                            ${response.roles.map(role => `
                                                <option value="${role.id}" ${user.roles.some(r => r.id == role.id) ? 'selected' : ''}>
                                                    ${role.role_name}
                                                </option>`).join('')}
                                        </select>
                                    </td>
                                    <td>
                                        <select class="table_dashboardGeneralTbodyTdata--status form-select" data-user-id="${user.id}">
                                            ${response.statuses.map(status => `
                                                <option value="${status.id}" ${user.user_status_id == status.id ? 'selected' : ''}>
                                                    ${status.status}
                                                </option>`).join('')}
                                        </select>
                                    </td>
                                    <td><button type="submit" class="btn btn-secondary btn-apply-user">Promeni</button></td>
                                </tr>
                            `);
                        });
                    } else {
                        $('.table_dashboardGeneralTbody--users').html(
                            `<tr><td colspan="8" class="text-center">Nema informacija za prikaz</td></tr>`
                        );
                    }
                }
            });
        }
        else {
            $('.table_dashboardGeneralTbody--users').empty();
        }
    })    

    // Apply all changes when clicking button
    $(document).on('click', '.btn-apply-user', function() {
        let row = $(this).closest('tr');
        let userId = row.find('.table_dashboardGeneralTbodyTdata--id').html();
        let roleId = row.find('.table_dashboardGeneralTbodyTdata--role').val();
        let editedUsernameVal = row.find('.table_dashboardGeneralTbodyTdata--editedUsername').val();
        let emailVal = row.find('.table_dashboardGeneralTbodyTdata--email').val();
        let statusId = row.find('.table_dashboardGeneralTbodyTdata--status').val();
        let resetUsername = row.find('.table_dashboardGeneralTbodyTdata--editedUsernameCheckbox').is(':checked');

        if (resetUsername) {
            editedUsernameVal = null;
        }
    
        $.ajax({
            url: `/dashboard-users/${userId}`,
            method: 'PUT',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ 
                role_id: roleId,
                edited_username: editedUsernameVal,
                email: emailVal,
                status_id: statusId, 
            }),
            success: function(response) {
                console.log(response.message);
                $('.dashboard_UserSearch').trigger('keyup');
            },
            error: function(xhr) {
                console.log('Greška prilikom ažuriranja korisnika', xhr.responseText);
            }
        });
    });
}