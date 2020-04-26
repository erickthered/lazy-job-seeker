<?php

namespace App\Interfaces\Search\Request;

use Illuminate\Http\Request;

interface AdapterInterface
{
    public static function adapt(Request $request);
}