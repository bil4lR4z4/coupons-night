<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TermsSection;
use Illuminate\Http\Request;
use App\Models\UserLog;


class TermsSectionController extends Controller
{
    public function index()
    {
        $sections = TermsSection::orderBy('sort_order', 'asc')->get();
        return view('admin.terms.index', compact('sections'));
    }

    public function create()
    {
        if (TermsSection::count() > 0) {
            return redirect()->route('admin.terms.editAll');
        }

        return view('admin.terms.create');
    }

    public function store(Request $request)
    {
        if (TermsSection::count() > 0) {
            return redirect()->route('admin.terms.editAll')
                ->with('success', 'Terms FAQs already exist. Please update them.');
        }

        $this->validateFaqs($request);
        $this->saveFaqs($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Terms FAQs',
            'detail'  => "Terms FAQs created successfully",
        ]);

        return redirect()->back()->with('success', 'Terms FAQs added successfully.');
    }

    public function editAll()
    {
        $sections = TermsSection::orderBy('sort_order', 'asc')->get();
        return view('admin.terms.edit', compact('sections'));
    }

    public function updateAll(Request $request)
    {
        $this->validateFaqs($request);

        TermsSection::truncate();

        $this->saveFaqs($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Terms FAQs',
            'detail'  => "Terms FAQs updated successfully",
        ]);

        return redirect()->back()
            ->with('success', 'Terms FAQs updated successfully.');
    }

    private function validateFaqs(Request $request)
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

    private function saveFaqs(Request $request)
    {
        foreach ($request->question as $index => $question) {
            TermsSection::create([
                'title' => $question,
                'description' => $request->answer[$index] ?? null,
                'sort_order' => $request->sort_order[$index] ?? 0,
                'status' => 'enable',
            ]);
        }
    }

    public function frontend()
    {
        $sections = TermsSection::where('status', 'enable')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('terms-of-service', compact('sections'));
    }
}