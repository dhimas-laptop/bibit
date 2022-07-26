<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/API/bibit',
        '/API/bibit/delete',
        '/API/bibit/update',
        '/API/order',
        '/API/order/hapus',
        '/API/order-filter'
    ];
}
