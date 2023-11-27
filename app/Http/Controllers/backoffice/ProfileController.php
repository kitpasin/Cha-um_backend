<?php

namespace App\Http\Controllers\backoffice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    public function index(Request $request) {

        return response()->json([
            'message' => 'ok'
        ]);
    }
}
