<?php
declare(strict_types=1);

class ConfigDefault
{
    public const PASSWORD = '';
	public const SENTRY_ENABLE = false;
	public const SENTRY_KEY = '';

	public const MONTH_CALC_SPECIALS = [
	    /* 월 합계의 특정 항목 조회 목록
	    [
	        'use_place' => '',
            'note' => '',
        ],
	    */
    ];

	public const MONTH_CALC_GROUP_SUMMARY = [
	    /* 월 합계의 분류별 합산 목록
        [
            'group_name' => '',
            'group_list' => '',
            'note' => '',
        ],
	    */
    ];

	public const DB = [
		'default' => [
			'host' => 'localhost',
			'port' => 3306,
			'user' => '',
			'password' => '',
			'dbname' => '',
		]
	];
}

if (file_exists(__DIR__ . '/config.real.php')) {
	include_once __DIR__ . '/config.real.php';
} elseif (file_exists(__DIR__ . '/config.local.php')) {
	include_once __DIR__ . '/config.local.php';
} else {
	class Config extends ConfigDefault
	{
	}
}
