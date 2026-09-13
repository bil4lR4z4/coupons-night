<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GeneralFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLog;

class GeneralFaqController extends Controller
{
    public function index()
    {
        $generalFaqs = GeneralFaq::with(['creator', 'updater'])->orderBy('sort_order')->latest()->get();
        return view('admin.general-faqs.index', compact('generalFaqs'));
    }

    public function create()
    {
        return view('admin.general-faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:enable,disable',
        ]);

        GeneralFaq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Add General FAQ',
            'detail'  => "Added General FAQ: {$request->question}",
        ]);

        return redirect()->route('admin.general-faqs.index')->with('success', 'General FAQ added successfully.');
    }

    public function edit($id)
    {
        $generalFaq = GeneralFaq::findOrFail($id);
        return view('admin.general-faqs.edit', compact('generalFaq'));
    }

    public function update(Request $request, $id)
    {
        $generalFaq = GeneralFaq::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:enable,disable',
        ]);

        $generalFaq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update General FAQ',
            'detail'  => "Updated General FAQ: {$request->question}",
        ]);

        return redirect()->back()->with('success', 'General FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $generalFaq = GeneralFaq::findOrFail($id);
        $generalFaq->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete General FAQ',
            'detail'  => "Deleted General FAQ: {$generalFaq->question}",
        ]);

        return redirect()->route('admin.general-faqs.index')->with('success', 'General FAQ deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $generalFaq = GeneralFaq::findOrFail($id);

        $request->validate([
            'status' => 'required|in:enable,disable',
        ]);

        $generalFaq->update([
            'status' => $request->status,
            'updated_by' => Auth::id(),
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update General FAQ Status',
            'detail'  => "Updated General FAQ Status: {$generalFaq->question}",
        ]);
        
        return redirect()->back()->with('success', 'General FAQ status updated successfully.');
    }
}