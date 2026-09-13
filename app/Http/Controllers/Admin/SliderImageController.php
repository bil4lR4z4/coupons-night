<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SliderImage;
use Illuminate\Http\Request;
use App\Models\UserLog;

class SliderImageController extends Controller
{
public function index()
{
    $sliders = SliderImage::where('type', 'slider')
        ->orderBy('sort_order')
        ->get();

    $banners = SliderImage::where('type', 'banner')
        ->orderBy('sort_order')
        ->get();

    return view('admin.slider-images.index', compact('sliders', 'banners'));
}

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:slider,banner',
            'page_url' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'status' => 'required|in:enable,disable',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:255',
        ]);

        $count = 0;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/slider-images'), $imageName);

                SliderImage::create([
                    'type' => $request->type,
                    'page_url' => $request->page_url,
                    'title' => $request->title,
                    'image' => $imageName,
                    'sort_order' => 0,
                    'status' => $request->status,
                    'button_text' => $request->button_text,
                ]);
                $count++;
            }
        }

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Slider Images',
            'detail'  => "Slider/Banner images uploaded successfully | Type: {$request->type}, Total Images: {$count}",
        ]);
        return redirect()->back()->with('success', 'Images added successfully.');
    }

    public function edit($id)
    {
        $sliderImage = SliderImage::findOrFail($id);
        return view('admin.slider-images.edit', compact('sliderImage'));
    }

    public function update(Request $request, $id)
    {
        $sliderImage = SliderImage::findOrFail($id);

        $request->validate([
            'type' => 'required|in:slider,banner',
            'page_url' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'status' => 'required|in:enable,disable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'nullable|string|max:255',
        ]);

        $imageName = $sliderImage->image;

        if ($request->hasFile('image')) {
            if ($sliderImage->image && file_exists(public_path('uploads/slider-images/' . $sliderImage->image))) {
                unlink(public_path('uploads/slider-images/' . $sliderImage->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/slider-images'), $imageName);
        }

        $sliderImage->update([
            'type' => $request->type,
            'page_url' => $request->page_url,
            'title' => $request->title,
            'image' => $imageName,
            'status' => $request->status,
            'button_text' => $request->button_text,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Slider Image',
            'detail'  => "Slider image updated successfully | Type: {$request->type}",
        ]);

        return redirect()->route('admin.slider-images.index')->with('success', 'Image updated successfully.');
    }

    public function delete($id)
    {
        $sliderImage = SliderImage::findOrFail($id);

        if ($sliderImage->image && file_exists(public_path('uploads/slider-images/' . $sliderImage->image))) {
            unlink(public_path('uploads/slider-images/' . $sliderImage->image));
        }

        $sliderImage->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Slider Image',
            'detail'  => "Slider image deleted successfully | Type: {$sliderImage->type}",
        ]);

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function updateOrder(Request $request)
{
    foreach ($request->order as $index => $id) {

        SliderImage::where('id', $id)->update([
            'sort_order' => $index + 1
        ]);
    }

    return response()->json([
        'success' => true
    ]);
}
}