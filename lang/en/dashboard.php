<?php

return [
    'dashboard-page' => 'Dashboard',
    'unknown' => 'Unknown',
    'no_status' => 'No status',

    'sidebar-nav' => [
        [
            'slug'=> route('dashboard-users.index'),
            'name'=>'Users',
        ],
        [
            'slug'=> route('index', ['locale' => app()->getLocale()]),
            'name'=>'Back to site',
        ],
    ],

    'index' => [
        'title' => 'Dashboard',
        'logged_in' => 'Logged in:',
        'site_info' => 'Site information',
        'info_name' => 'Information name',
        'count' => 'Count',
        'total_users' => 'Total users',
        'active_users' => 'Active users',
        'role' => 'Role',
        'full_name' => 'Full name',
    ],

    'users' => [
        'title' => 'Users',
        'search_placeholder' => 'Search user names...',
        'assigned_username' => 'Assigned username',
        'edited_username' => 'Edited username',
        'full_name' => 'Full name',
        'role' => 'Role',
        'status' => 'Status',
        'reset' => 'Reset',
        'change' => 'Change',
        'no_data' => 'No data to display',
        'update_error' => 'Error while updating user',
        'user_not_found' => 'User was not found.',
        'update_success' => 'User has been updated successfully.',
    ],

    'search' => [
        'title' => 'Search statistics',
        'sort' => 'Sort:',
        'most_searches' => 'Most searches',
        'least_searches' => 'Least searches',
        'input_title' => 'Search by text input',
        'search_name' => 'Search name',
        'search_type' => 'Search type',
        'search_count' => 'Search count',
        'load_error' => 'Error loading data.',
    ],

    'questionsPage' => [
        'title' => 'Questions',
        'filterByType' => 'Filter by type',
        'sortByDate' => 'Sort by date',
        'newestFirst' => 'Newest first',
        'oldestFirst' => 'Oldest first',
        'noQuestions' => 'No questions found.',
        'search_messages' => 'Search messages',
        'search' => 'Search',
        'all_types' => 'All types',
    ],

    'questionDetails' => [
        'back_to_list' => 'Back to list',
        'inbox' => 'Inbox',
        'mark_read_success' => 'Question marked as read.',
    ],
];
