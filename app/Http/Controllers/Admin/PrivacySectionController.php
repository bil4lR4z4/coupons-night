<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PrivacySection;
use Illuminate\Http\Request;
use App\Models\UserLog;

class PrivacySectionController extends Controller
{
    public function index()
    {
        $sections = PrivacySection::orderBy('sort_order', 'asc')->get();
        return view('admin.privacy.index', compact('sections'));
    }

    public function create()
    {
        if (PrivacySection::count() > 0) {
            return redirect()->route('admin.privacy.editAll');
        }

        return view('admin.privacy.create');
    }

    public function store(Request $request)
    {
        if (PrivacySection::count() > 0) {
            return redirect()->route('admin.privacy.editAll')
                ->with('success', 'Privacy sections already exist. Please update them.');
        }

        $this->validateSections($request);
        $this->saveSections($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Privacy sections',
            'detail'  => "Privacy sections created successfully",
        ]);

        return redirect()->back()
            ->with('success', 'Privacy sections added successfully.');
    }

    public function editAll()
    {
        $sections = PrivacySection::orderBy('sort_order', 'asc')->get();
        return view('admin.privacy.edit', compact('sections'));
    }

    public function updateAll(Request $request)
    {
        $this->validateSections($request);

        PrivacySection::truncate();

        $this->saveSections($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Privacy sections',
            'detail'  => "Privacy sections updated successfully",
        ]);

        return redirect()->back()
            ->with('success', 'Privacy sections updated successfully.');
    }

    private function validateSections(Request $request)
    {
        $request->validate([
            'question' => 'required|array',
            'question.*' => 'required|string|max:255',
            'answer' => 'required|array',
            'answer.*' => 'required|string',
            'sort_order' => 'nullable|array',
            'sort_order.*' => 'nullable|integer',
        ]);
    }

    private function saveSections(Request $request)
    {
        foreach ($request->question as $index => $question) {
            PrivacySection::create([
                'title' => $question,
                'description' => $request->answer[$index] ?? null,
                'sort_order' => $request->sort_order[$index] ?? 0,
                'status' => 'enable',
            ]);
        }
    }

    public function frontend()
    {
        $sections = PrivacySection::where('status', 'enable')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('privacy-policy', compact('sections'));
    }
}