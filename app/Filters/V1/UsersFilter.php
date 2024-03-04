<?php

namespace App\Filters\V1;

use App\Filters\APIFilter;

class UsersFilter extends APIFilter
{
    protected $safeParams = [
        'name' => ['eq', 'ne'],
        'email' => ['eq', 'ne'],
        'roleId' => ['eq', 'ne'],
    ];

    protected $columnMap = [
        'roleId' => 'role_id',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
    ];
}
