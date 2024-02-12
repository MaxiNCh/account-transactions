<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request): AccountResource
    {
        return new AccountResource($request->user()->account);
    }
}
