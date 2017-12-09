<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */


    protected $except = [
        '/admin/article/add',
        '/admin/uploadFile',
        '/admin/article/update',
        '/admin/product/add',
        '/admin/product/update',
        '/language',
        '/language-chooser',
        '/addToCart',
        '/makeOrder',
        '/admin/updateNs',
        '/accountRefresh',
    ];
}
