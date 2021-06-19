<?php
namespace App\Domains\Support\Facades;

use Illuminate\Support\Facades\Facade;

class HttpResponseCode extends Facade
{
    //Client
    const CODE_400 = '400';
    const CODE_401 = '401';
    const CODE_403 = '403';
    const CODE_404 = '404';

    //Server
    const CODE_500 = '500';
    const CODE_502 = '502';

    //Success
    const CODE_200 = '200';
    const CODE_201 = '201';
}
