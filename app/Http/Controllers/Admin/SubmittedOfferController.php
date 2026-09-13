<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubmittedOffer;
use App\Models\UserLog;

class SubmittedOfferController extends Controller
{
    public function index()
    {
        $offers = SubmittedOffer::latest()->get();

        return view('admin.submitted-offers.index', compact('offers'));
    }

    public function destroy($id)
    {
        $offer = SubmittedOffer::findOrFail($id);
        $offer->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete',
            'detail'  => "Submitted offer deleted successfully",
        ]);

        return redirect()
            ->back()
            ->with('success', 'Submitted offer deleted successfully.');
    }
}