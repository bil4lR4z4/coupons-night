<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\UserLog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use App\Mail\CouponAdminMail;
use App\Mail\CouponUserMail;
class MessageController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
// dd($setting);
        return view('contact',compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:150',
            'subject'     => 'required|string|max:255',
            'message'    => 'required|string',
        ]);

       $message = Message::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'sbject'     => $request->subject,
            'message'    => $request->message,
        ]);

        $setting = Setting::first();

     Mail::to($setting->admin_email)
    ->send(new ContactAdminMail($message));

Mail::to($request->email)
    ->send(new ContactUserMail($message));

        return back()->with('success', 'Message sent successfully');
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {

            $query = Message::query();
            $totalData = Message::count();

            if (!empty($request->search['value'])) {
                $search = $request->search['value'];

                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('sbject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
                });
            }

            $totalFiltered = $query->count();

            $messages = $query->offset($request->start)
                            ->limit($request->length)
                            ->latest()
                            ->get();

            $data = [];

            foreach ($messages as $row) {

                $delete = route('admin.messages.delete', $row->id);

                $data[] = [
                    'name' => $row->first_name . ' ' . $row->last_name,
                    'email' => $row->email,
                    'subject' => $row->sbject,
                    'message' => $row->message,
                    'date' => $row->created_at->format('F d, Y'),
                    'action' => '
                        <button class="btn btn-sm btn-danger delete" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmDeleteModal" 
                            data-delete="'.$delete.'">
                            Delete
                        </button>
                    '
                ];
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $totalData,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ]);
        }

        return view('admin.messages.index');
    }

    public function delete($id){
        $message = Message::findOrFail($id);
        if (!$message) {
            return back()->with('error', 'Message not found!');
        }

        $message->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Message',
            'detail'  => "Message deleted successfully",
        ]);

        return back()->with('success', 'Message Deleted Successfully');
    }
}