<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AffiliateSection;
use Illuminate\Http\Request;
use App\Models\UserLog;

class AffiliateSectionController extends Controller
{
    public function index()
    {
        $sections = AffiliateSection::orderBy('sort_order', 'asc')->get();
        return view('admin.affiliate.index', compact('sections'));
    }

    public function create()
    {
        if (AffiliateSection::count() > 0) {
            return redirect()->route('admin.affiliate.editAll');
        }

        return view('admin.affiliate.create');
    }

    public function store(Request $request)
    {
        if (AffiliateSection::count() > 0) {
            return redirect()->route('admin.affiliate.editAll')
                ->with('success', 'Affiliate sections already exist. Please update them.');
        }

        $this->validateSections($request);
        $this->saveSections($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Affiliate sections',
            'detail'  => "Affiliate sections created successfully",
        ]);

        return redirect()->back()
            ->with('success', 'Affiliate sections added successfully.');
    }

    public function editAll()
    {
        $sections = AffiliateSection::orderBy('sort_order', 'asc')->get();
        return view('admin.affiliate.edit', compact('sections'));
    }

    public function updateAll(Request $request)
    {
        $this->validateSections($request);

        AffiliateSection::truncate();

        $this->saveSections($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Affiliate sections',
            'detail'  => "Affiliate sections updated successfully",
        ]);
        return redirect()->back()
            ->with('success', 'Affiliate sections updated successfully.');
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
            AffiliateSection::create([
                'title' => $question,
                'description' => $request->answer[$index] ?? null,
                'sort_order' => $request->sort_order[$index] ?? 0,
                'status' => 'enable',
            ]);
        }
    }

    public function frontend()
    {
        $sections = AffiliateSection::where('status', 'enable')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('affiliate-disclosure', compact('sections'));
    }
}