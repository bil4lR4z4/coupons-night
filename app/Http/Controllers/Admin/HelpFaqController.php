<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HelpFaq;
use Illuminate\Http\Request;
use App\Models\UserLog;

class HelpFaqController extends Controller
{
    public function index()
    {
        $faqs = HelpFaq::orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.help_faqs.index', compact('faqs'));
    }

public function create()
{
    // Agar FAQs already hain to edit page par bhej do
    if (HelpFaq::count() > 0) {
        return redirect()->route('admin.help-faqs.edit');
    }

    return view('admin.help_faqs.create');
}

public function store(Request $request)
{
    // Dobara save allow na karo
    if (HelpFaq::count() > 0) {
        return redirect()->route('admin.help-faqs.edit')
            ->with('error', 'FAQs already exist. Please update them.');
    }

    if ($request->has('question') && is_array($request->question)) {

        foreach ($request->question as $key => $question) {

            if (!empty(trim($question))) {

                HelpFaq::create([
                    'title' => $question,
                    'description' => $request->answer[$key] ?? null,
                    'sort_order' => $request->sort_order[$key] ?? 0,
                    'status' => 'enable',
                ]);
            }
        }
    }

    UserLog::create([
        'user_id' => auth()->id(),
        'action' => 'Store Help Faqs',
        'detail' => "Help Faqs stored successfully",
    ]);

    return redirect()->route('admin.help-faqs.edit')
        ->with('success', 'FAQs saved successfully.');
}

    public function edit()
    {
        $faqs = HelpFaq::orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.help_faqs.edit', compact('faqs'));
    }

public function update(Request $request)
{
    HelpFaq::truncate();

    if ($request->has('question') && is_array($request->question)) {

        foreach ($request->question as $key => $question) {

            if (!empty(trim($question))) {

                HelpFaq::create([
                    'title'       => $question,
                    'description' => $request->answer[$key] ?? null,
                    'sort_order'  => $request->sort_order[$key] ?? 0,
                    'status'      => 'enable',
                ]);
            }
        }
    }

    UserLog::create([
        'user_id' => auth()->id(),
        'action'  => 'Update Help Faqs',
        'detail'  => "Help Faqs updated successfully",
    ]);

    return redirect()->route('admin.help-faqs.edit')
        ->with('success', 'FAQs updated successfully.');
}


    public function frontendHelp()
{
    $helpFaqs = HelpFaq::where('status', 'enable')
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'asc')
        ->get();

    return view('help', compact('helpFaqs'));
}
}