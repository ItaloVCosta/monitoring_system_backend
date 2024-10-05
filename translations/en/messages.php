<?php

return [
    'error' => [
        'server' => 'An error occurred while fetching server details.',
        'general' => 'An unexpected error occurred.',
    ],
    'http' => [
        'error' =>[
            '404' => [
                'server' => 'Server not found',
                'server_not_found' => 'The server with the given ID does not exist.',
                'route' => 'Route not found'
            ],
            '405' => 'Method not allowed' 
        ],
        'success' => [
            'created' => [
                'server' => 'Server created successfully',
            ],
            'updated' => [
                'server' => 'Server updated successfully',
            ],
            'deleted' => [
                'server' => 'Server deleted successfully',
            ]
        ]
    ]
];