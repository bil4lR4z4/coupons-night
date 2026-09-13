<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DisclaimerSection;
use Illuminate\Http\Request;
use App\Models\UserLog;

class DisclaimerSectionController extends Controller
{
    public function index()
    {
        $sections = DisclaimerSection::orderBy('sort_order', 'asc')->get();
        return view('admin.disclaimer.index', compact('sections'));
    }

    public function create()
    {
        if (DisclaimerSection::count() > 0) {
            return redirect()->route('admin.disclaimer.editAll');
        }

        return view('admin.disclaimer.create');
    }

    public function store(Request $request)
    {
        if (DisclaimerSection::count() > 0) {
            return redirect()->route('admin.disclaimer.editAll')
                ->with('success', 'Disclaimer sections already exist. Please update them.');
        }

        $this->validateSections($request);
        $this->saveSections($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Disclaimer sections',
            'detail'  => "Disclaimer sections created successfully",
        ]);
        
        return redirect()->back()
            ->with('success', 'Disclaimer sections added successfully.');
    }

    public function editAll()
    {
        $sections = DisclaimerSection::orderBy('sort_order', 'asc')->get();
        return view('admin.disclaimer.edit', compact('sections'));
    }

    public function updateAll(Request $request)
    {
        $this->validateSections($request);

        DisclaimerSection::truncate();

        $this->saveSections($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Disclaimer sections',
            'detail'  => "Disclaimer sections updated successfully",
        ]);
        return redirect()->back()
            ->with('success', 'Disclaimer sections updated successfully.');
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
            DisclaimerSection::create([
                'title' => $question,
                'description' => $request->answer[$index] ?? null,
                'sort_order' => $request->sort_order[$index] ?? 0,
                'status' => 'enable',
            ]);
        }
    }

    public function frontend()
    {
        $sections = DisclaimerSection::where('status', 'enable')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('disclaimer', compact('sections'));
    }
}