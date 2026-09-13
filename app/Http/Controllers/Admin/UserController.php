<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserLog;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Setting;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('trash', 0)->where('role', 'manager')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.action');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,NULL,id,trash,0',
            'email'    => 'required|email|unique:users,email,NULL,id,trash,0',
            'password'   => 'required|min:6|same:confirm_password',
            'status'     => 'required|in:active,blocked',
            'designation'     => 'required|in:Administrator,Developer,SEO,Content Writer, Data Entry (Coupons)',
        ]);

        $existingUser = User::where(function($q) use ($request) {
            $q->where('email', $request->email)
            ->orWhere('username', $request->username);
        })->where('trash', 1)->first();

        if ($existingUser) {
            $existingUser->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'username'   => $request->username,
                'email'      => $request->email,
                'status'     => $request->status,
                'password'   => Hash::make($request->password),
                'role'       => 'manager',
                'trash'      => 0,
                'designation'     => $request->designation,
            ]);

            $user = $existingUser;

        } else {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'username'   => $request->username,
                'email'      => $request->email,
                'status'     => $request->status,
                'password'   => Hash::make($request->password),
                'role'       => 'manager',
                'designation'     => $request->designation,
            ]);
        }

        Permission::create([
            'user_id'            => $user->id,
            'coupon'             => $request->coupon ?? 0,
            'category'           => $request->category ?? 0,
            'network'            => $request->network ?? 0,
            'store'              => $request->store ?? 0,
            'store_report'       => $request->store_report ?? 0,
            'store_approval'     => $request->store_approval ?? 0,
            'product'            => $request->product ?? 0,
            'blog'               => $request->blog ?? 0,
            'store_general_faqs' => $request->store_general_faqs ?? 0,
            'best_coupon'        => $request->best_coupon ?? 0,
            'message'            => $request->message ?? 0,
            'event'              => $request->event ?? 0,
            'user'               => $request->user ?? 0,
            'user_activity'      => $request->user_activity ?? 0,
            'submitted_offer'    => $request->submitted_offer ?? 0,
            'theme_setting'      => $request->theme_setting ?? 0,
            'site_setting'       => $request->site_setting ?? 0,
            'home_setting'       => $request->home_setting ?? 0,
            'term'               => $request->term ?? 0,
            'help'               => $request->help ?? 0,
            'affiliate'          => $request->affiliate ?? 0,
            'disclaimer'         => $request->disclaimer ?? 0,
            'privacy'            => $request->privacy ?? 0,
            'faqs'               => $request->faqs ?? 0,
            'slider'             => $request->slider ?? 0,
            'marque'             => $request->marque ?? 0,
            'upcoming_event'     => $request->upcoming_event ?? 0,
            'geo_restriction'    => $request->geo_restriction ?? 0,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create User',
            'detail'  => "A new user account was created. Username: {$user->username}, Email: {$user->email}",
        ]);

        return back()->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $edit = User::with('permission')->find($id);
        if(!$edit){
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }
        return view('admin.users.action', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:users,username,'.$id,
            'email'      => 'required|email|unique:users,email,'.$id,
            'status'     => 'required|in:active,blocked',

            'password' => 'nullable|min:6',
            'confirm_password' => 'required_with:password|same:password',
            'designation'     => 'required|in:Administrator,Developer,SEO,Content Writer, Data Entry (Coupons)',

        ]);
        $user = User::findOrFail($id);

        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'status'     => $request->status,
            'designation'     => $request->designation,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        Permission::updateOrCreate(
            ['user_id' => $user->id],
            [
                'coupon'             => $request->coupon ?? 0,
                'category'           => $request->category ?? 0,
                'network'            => $request->network ?? 0,
                'store'              => $request->store ?? 0,
                'store_report'       => $request->store_report ?? 0,
                'store_approval'     => $request->store_approval ?? 0,
                'product'            => $request->product ?? 0,
                'blog'               => $request->blog ?? 0,
                'store_general_faqs' => $request->store_general_faqs ?? 0,
                'best_coupon'        => $request->best_coupon ?? 0,
                'message'            => $request->message ?? 0,
                'event'              => $request->event ?? 0,
                'user'               => $request->user ?? 0,
                'user_activity'      => $request->user_activity ?? 0,
                'submitted_offer'    => $request->submitted_offer ?? 0,
                'theme_setting'      => $request->theme_setting ?? 0,
                'site_setting'       => $request->site_setting ?? 0,
                'home_setting'       => $request->home_setting ?? 0,
                'term'               => $request->term ?? 0,
                'help'               => $request->help ?? 0,
                'affiliate'          => $request->affiliate ?? 0,
                'disclaimer'         => $request->disclaimer ?? 0,
                'privacy'            => $request->privacy ?? 0,
                'faqs'               => $request->faqs ?? 0,
                'slider'               => $request->slider ?? 0,
                'marque'               => $request->marque ?? 0,
                'upcoming_event'     => $request->upcoming_event ?? 0,
                'geo_restriction'    => $request->geo_restriction ?? 0,
            ]
        );

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update User',
            'detail'  => "User updated successfully [Username: {$user->username}, Email: {$user->email}]",
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }
        $user->trash=1;
        $user->save();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete User',
            'detail'  => "User deleted successfully [Username: {$user->username}, Email: {$user->email}]",
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        if ($request->isMethod('post')) {

            $request->validate([
                'login' => 'required',
                'password' => 'required',
            ]);

            $remember = $request->has('remember');
            $user = User::where('email', $request->login)
                ->orWhere('username', $request->login)
                ->first();

            if (!$user) {
                return back()->withErrors([
                    'login' => 'Invalid email/username or password.',
                ])->withInput();
            }
            if ($user->trash != 0) {
                return back()->withErrors([
                    'login' => 'Your account has been deleted.',
                ])->withInput();
            }

            if ($user->status == 'blocked') {
                return back()->withErrors([
                    'login' => 'Your account is blocked. Contact admin.',
                ])->withInput();
            }

            if ($user->status != 'active') {
                return back()->withErrors([
                    'login' => 'Your account is not active.',
                ])->withInput();
            }

            if (!Auth::attempt([
                filter_var($request->login, FILTER_VALIDATE_EMAIL)
                    ? 'email'
                    : 'username' => $request->login,

                'password' => $request->password,
            ], $remember)) {

                return back()->withErrors([
                    'login' => 'Invalid email/username or password.',
                ])->withInput();
            }

            $request->session()->regenerate();
            $time = Carbon::now()->format('Y-m-d H:i:s');
            $setting = Setting::first();
            // Mail::html("
            //         <h2>User Login Alert</h2>
            //         <p><strong>Name:</strong> {$user->first_name} {$user->last_name}</p>
            //         <p><strong>Username:</strong> {$user->username}</p>
            //         <p><strong>Email:</strong> {$user->email}</p>
            //         <p><strong>Login Time:</strong> {$time}</p>
            //     ", function ($mail) use ($setting) {
            //         $mail->to($setting->admin_email)
            //             ->subject('User Login Alert');
            //     });

            UserLog::create([
                    'user_id' => auth()->id(),
                    'action'  => 'login',
                    'detail'  => "User logged in successfully at " . Carbon::now()->format('Y-m-d H:i:s'),
                ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Login successful');
        }

        return view('auth.login');
    }

    public function logout(Request $request){
        $user = Auth::user();

        if ($user) {
            UserLog::create([
                'user_id' => $user->id,
                'action'  => 'Logout',
                'detail'  => "User logged out successfully at " . now()->toDateTimeString(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function profile(){
        return view('admin.users.profile');
    }

public function profileUpdate(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name'  => 'required|string|max:50',

        'email' => 'required|email|max:100|unique:users,email,' . auth()->id(),

        'username' => 'required|string|max:100|unique:users,username,' . auth()->id(),

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'old_password' => 'nullable|required_with:new_password',

        'new_password' => 'nullable|min:6|same:confirm_password',

        'confirm_password' => 'nullable|min:6'
    ]);

    $data = [

        'first_name' => $request->first_name,

        'last_name'  => $request->last_name,

        'username'   => $request->username,

        'email'      => $request->email,
    ];

    /*
    |--------------------------------------------------------------------------
    | Image Upload
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {

        // delete old image
        if ($user->image && file_exists(public_path($user->image))) {

            unlink(public_path($user->image));

        }

        $image = $request->file('image');

        $imageName = time() . '_' . rand(111,999) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/users'), $imageName);

        $data['image'] = 'uploads/users/' . $imageName;
    }

    /*
    |--------------------------------------------------------------------------
    | Password Update
    |--------------------------------------------------------------------------
    */

    $passwordChanged = false;

    if ($request->filled('new_password')) {

        if (!Hash::check($request->old_password, $user->password)) {

            return back()->withErrors([
                'old_password' => 'Old password is incorrect'
            ]);

        }

        $data['password'] = Hash::make($request->new_password);

        $passwordChanged = true;
    }

    User::where('id', $user->id)->update($data);

    UserLog::create([

        'user_id' => $user->id,

        'action'  => 'Profile Update',

        'detail'  => $passwordChanged
            ? "Profile updated with password change | Email: {$request->email}, Username: {$request->username}"
            : "Profile updated | Email: {$request->email}, Username: {$request->username}",

    ]);

    return back()->with('success','Profile updated successfully');
}
}