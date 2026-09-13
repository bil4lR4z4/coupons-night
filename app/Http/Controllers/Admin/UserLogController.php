<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLog;
use App\Models\User;

use Carbon\Carbon;

class UserLogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = User::orderBy('id', 'desc');

            if ($request->search['value']) {
                $search = $request->search['value'];

                $query->where(function ($q) use ($search) {
                    $q->where('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
                });
            }

            $total = $query->count();

            $logs = $query->offset($request->start)
                        ->limit($request->length)
                        ->get();

            $data = [];

            foreach ($logs as $row) {

                $data[] = [
                    'username' => $row->username,
                    'email'    => $row->email,
                    'action'   => "<a href='" . route('admin.user.activity.details', $row->id) . "' class='btn btn-primary btn-sm'>Details</a>",
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $data
            ]);
        }

        return view('admin.users.activity');
    }

    public function details(Request $request, $id)
    {
        if ($request->ajax()) {

            $query = UserLog::where('user_id', $id);
        
            if ($request->search['value']) {
                $search = $request->search['value'];

                $query->where(function ($q) use ($search) {
                    $q->where('user_logs.action', 'like', "%{$search}%")
                    ->orWhere('user_logs.detail', 'like', "%{$search}%");
                });
            }

            $total = $query->count();

            $logs = $query->offset($request->start)
                        ->limit($request->length)
                        ->get();

            $data = [];

            foreach ($logs as $row) {

                $data[] = [
                    'action'   => $row->action,
                    'detail'   => $row->detail,
                    'date'     => Carbon::parse($row->created_at)->format('F d, Y h:i A'),
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $total,
                "recordsFiltered" => $total,
                "data" => $data,
                "id" => $id
            ]);
        }

        return view('admin.users.activity_details', compact('id'));
    }
}