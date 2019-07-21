<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notFound()
    {
        return view('errors.404');
    }

    public function serverError()
    {
        return view('errors.500');
    }
}
