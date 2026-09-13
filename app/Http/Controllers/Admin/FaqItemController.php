<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FaqItem;
use Illuminate\Http\Request;
use App\Models\UserLog;


class FaqItemController extends Controller
{
    public function index()
    {
        $sections = FaqItem::orderBy('sort_order', 'asc')->get();

        return view('admin.faq.index', compact('sections'));
    }

    public function create()
    {
        if (FaqItem::count() > 0) {
            return redirect()->route('admin.faq.editAll');
        }

        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        if (FaqItem::count() > 0) {
            return redirect()
                ->route('admin.faq.editAll')
                ->with('success', 'FAQs already exist. Please update them.');
        }

        $this->validateFaqs($request);
        $this->saveFaqs($request);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQs added successfully.');
    }

    public function editAll()
    {
        $sections = FaqItem::orderBy('sort_order', 'asc')->get();

        return view('admin.faq.edit', compact('sections'));
    }

    public function updateAll(Request $request)
    {
        $this->validateFaqs($request);

        FaqItem::truncate();

        $this->saveFaqs($request);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'update',
            'detail'  => "FAQs updated successfully",
        ]);

        return redirect()
            ->back()
            ->with('success', 'FAQs updated successfully.');
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
            FaqItem::create([
                'title' => $question,
                'description' => $request->answer[$index] ?? null,
                'sort_order' => $request->sort_order[$index] ?? 0,
                'status' => 'enable',
            ]);
        }
    }

    public function frontend()
    {
        $sections = FaqItem::where('status', 'enable')
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('faqs', compact('sections'));
    }
}