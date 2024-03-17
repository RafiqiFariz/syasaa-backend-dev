<?php

namespace App\Filters\V1;

use App\Filters\APIFilter;

class UsersFilter extends APIFilter
{
    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'role_id' => ['eq', 'ne'],
    ];

    // ini ngga kepakai
    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
    ];
}
