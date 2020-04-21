<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //Test print.
    public function print($value) 
    {
      return 'value is: ' . $value;
    }

}
