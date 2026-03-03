<?php

namespace App\Http\Controllers;

use App\Models\SystemRequest;
use App\Models\Notification;
use App\Http\Requests\StoreSystemRequest;
use App\Enums\UserRole;
use App\Enums\RequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SystemRequestController extends Controller
{
    // get all requests
    public function index()
    {
        $user = auth()->user();

        // check if user is manager
        if ($user->role === UserRole::MANAGER) {
            $requests = SystemRequest::with('user')->latest()->get();
        } else {
            $requests = SystemRequest::where('created_by', $user->id)->latest()->get();
        }

        return view('requests.index', compact('requests'));
    }

    // create request
    public function create()
    {
        return view('requests.create');
    }

    // store request
    public function store(StoreSystemRequest $request)
    {
        // create request
        SystemRequest::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => RequestStatus::PENDING,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('requests.index')->with('success', 'تم إرسال الطلب بنجاح.');
    }

    // update status
    public function updateStatus(Request $request, SystemRequest $systemRequest)
    {
        // authorize
        Gate::authorize('manageStatus', $systemRequest);

        // validate
        $request->validate([
            'status' => ['required', 'in:approved,rejected']
        ]);

        // update status
        $systemRequest->update([
            'status' => $request->status,
            'approved_by' => auth()->id(),
        ]);

        $statusText = $request->status === 'approved' ? 'الموافقة على' : 'رفض';
        Notification::create([
            'user_id' => $systemRequest->created_by,
            'message' => "تم $statusText طلبك: {$systemRequest->title}",
        ]);

        return redirect()->route('requests.index')->with('success', 'تم تحديث حالة الطلب وإرسال الإشعار.');
    }
}
