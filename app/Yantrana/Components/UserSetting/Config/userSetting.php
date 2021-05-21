<?php

return [

    /* user setting data-types id
    ------------------------------------------------------------------------- */
    'datatypes'  => [
        'string' => 1,
        'bool'   => 2,
        'int'    => 3,
        'json'   => 4
	],

	 /* User Setting Items
	------------------------------------------------------------------------- */
	'items' => [
		'notification' => [
			// Receive Notification method
            'show_visitor_notification'  => [
                'key'           => 'show_visitor_notification',
                'data_type'     => 2,    // boolean
                'default'       => true,
			],
			'show_like_notification'  => [
                'key'           => 'show_like_notification',
                'data_type'     => 2,    // boolean
                'default'       => true,
			],
			'show_gift_notification'  => [
                'key'           => 'show_gift_notification',
                'data_type'     => 2,    // boolean
                'default'       => true,
			],
			'show_message_notification'  => [
                'key'           => 'show_message_notification',
                'data_type'     => 2,    // boolean
                'default'       => true,
            ],
			'show_user_login_notification'  => [
                'key'           => 'show_user_login_notification',
                'data_type'     => 2,    // boolean
                'default'       => true,
            ]
        ],
        'basic_search' => [
                'looking_for'  => [
                    'key'           => 'looking_for',
                    'data_type'     => 1,    // string
                    'default'       => 'all',
                ],
                'min_age'  => [
                    'key'           => 'min_age',
                    'data_type'     => 3,    // int
                    'default'       => 18,
                ],
                'max_age'  => [
                    'key'           => 'max_age',
                    'data_type'     => 3,    // int
                    'default'       => 30,
                ],
                'distance'  => [
                    'key'           => 'distance',
                    'data_type'     => 3,    // int
                    'default'       => null,
                ],
            ]
	]
];