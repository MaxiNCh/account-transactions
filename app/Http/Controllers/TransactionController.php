<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionController extends Controller
{
    public function __construct(protected TransactionService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
        ]);

        $user = $request->user();

        return new JsonResource($this->service->list($user->account, $request->input('search', '')));
    }
}
