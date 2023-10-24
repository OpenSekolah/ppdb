<?php

namespace App\Http\Controllers\Managers\Ppdb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PpdbDatapdfController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        return $user->getPdf();
    }
}
