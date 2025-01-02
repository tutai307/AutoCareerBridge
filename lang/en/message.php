<?php

return [
    'login_success' => 'Login successful',
    'update_info' => 'Please update your information',
    'register_success' => 'Registration successful',
    'email_exist' => 'Email already registered',
    'date_start_than_end' => 'Start date must be less than end date',
    'date_end_than_start' => 'End date must be greater than start date',

    'admin' => [
        'not_found' => 'Data not found',
        'add_success' => 'Added successfully',
        'update_success' => 'Updated successfully',
        'add_fail' => 'Addition failed',
        'update_fail' => 'Update failed',
        'delete_success' => 'Deleted successfully',
        'fields' => [
            'change_status' => 'Status updated successfully',
            'has_majors' => 'The field already has majors so it cannot be deleted',
            'has_company' => 'The field is being used by the company',
        ],

        'majors' => [
            'has_university' => 'The major is being used by the university',
        ],
    ],
    'university' => [
        'collaboration' => [
            'not_found' => 'Data not found',
            'not_permission' => 'You do not have permission',
            'revoke_success' => 'Revoke successfully',
            'change_status_success' => 'Status updated successfully',
            'change_status_fail' => 'Status update failed',
            'university_not_found' => 'University not found',
            'company_not_found' => 'Company not found',
        ]
    ],
    'company' => [
        'collaboration' => [
            'not_found' => 'Data not found',
            'not_permission' => 'You do not have permission',
            'revoke_success' => 'Revoke successfully',
            'change_status_success' => 'Status updated successfully',
            'change_status_fail' => 'Status update failed'
        ]
    ],
    'errors' => [
        'back' => 'Return to the previous page',
        '400' => [
            'bad_request' => '🚫 Bad request',
            'detail' => '⚠️ Your request results in an error',
        ],
        '403' => [
            'forbidden' => '🚷 You do not have access',
            'detail' => '🔒 Please contact the administrator to grant access',
        ],
        '404' => [
            'not_found' => '❓ Page not found',
            'detail' => '🔍 The page you are looking for does not exist!',
        ],
        '500' => [
            'internal_server_error' => '💥 Internal Server Error',
            'detail' => '🔥 Error 500. Our server is having trouble, please try again later.',
        ],
        '503' => [
            'service_unavailable' => '⛔ Service Unavailable',
            'detail' => '📡 Error 503. Our server is having trouble, please try again later.',
        ]
    ],
];
