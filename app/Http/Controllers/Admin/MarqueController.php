<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserLog;

class MarqueController extends Controller
{
    public function index()
    {
        $marques = Marque::all();
        return view('admin.marque.index', compact('marques'));
    }

    public function save(Request $request)
    {
        $ids = $request->id ?? [];
        $names = $request->name ?? [];

        $existingIds = [];

        foreach ($names as $key => $name) {

            if (empty(trim($name))) {
                continue;
            }

            if (!empty($ids[$key])) {
                $marque = Marque::find($ids[$key]);

                if ($marque) {
                    $marque->update([
                        'name' => $name,
                    ]);

                    $existingIds[] = $marque->id;
                }
            }
            else {
                $new = Marque::create([
                    'name' => $name,
                ]);

                $existingIds[] = $new->id;
            }
        }

        Marque::whereNotIn('id', $existingIds)->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update',
            'detail'  => "Marque updated successfully",
        ]);
        return redirect()->route('admin.marque.index')
            ->with('success', 'Marque synced successfully.');
    }
}