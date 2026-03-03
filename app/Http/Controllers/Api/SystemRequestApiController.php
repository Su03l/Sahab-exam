<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemRequest;
use App\Http\Resources\SystemRequestResource;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class SystemRequestApiController extends Controller
{
    // get all system requests
    public function index(Request $request)
    {
        $user = $request->user();

        // if user is manager get all system requests else get only user's system requests
        if ($user->role === UserRole::MANAGER) {
            $requests = SystemRequest::with('user')->latest()->get();
        } else {
            $requests = SystemRequest::where('created_by', $user->id)->latest()->get();
        }

        return SystemRequestResource::collection($requests);
    }
}
