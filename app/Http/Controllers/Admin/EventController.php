<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\UserLog;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'full_description' => 'required|string',
            'icon' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'full_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'image_square' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'required|in:enable,disable',
        ]);

        $iconName = null;
        $fullImageName = null;
        $squareImageName = null;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = time() . '_icon_' . uniqid() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/events'), $iconName);
        }

        if ($request->hasFile('full_image')) {
            $fullImage = $request->file('full_image');
            $fullImageName = time() . '_full_' . uniqid() . '.' . $fullImage->getClientOriginalExtension();
            $fullImage->move(public_path('uploads/events'), $fullImageName);
        }

        if ($request->hasFile('image_square')) {
            $squareImage = $request->file('image_square');
            $squareImageName = time() . '_square_' . uniqid() . '.' . $squareImage->getClientOriginalExtension();
            $squareImage->move(public_path('uploads/events'), $squareImageName);
        }

        $event = Event::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'full_description' => $request->full_description,
            'icon' => $iconName,
            'full_image' => $fullImageName,
            'image_square' => $squareImageName,
            'show_in_header' => $request->has('show_in_header') ? 1 : 0,
            'status' => $request->status,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Create Event',
            'detail'  => "Event created successfully | Name: {$event->name}, Status: {$event->status}",
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event added successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'full_description' => 'required|string',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'full_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'image_square' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'required|in:enable,disable',
        ]);

        $iconName = $event->icon;
        $fullImageName = $event->full_image;
        $squareImageName = $event->image_square;

        if ($request->hasFile('icon')) {
            if ($event->icon && file_exists(public_path('uploads/events/' . $event->icon))) {
                unlink(public_path('uploads/events/' . $event->icon));
            }

            $icon = $request->file('icon');
            $iconName = time() . '_icon_' . uniqid() . '.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads/events'), $iconName);
        }

        if ($request->hasFile('full_image')) {
            if ($event->full_image && file_exists(public_path('uploads/events/' . $event->full_image))) {
                unlink(public_path('uploads/events/' . $event->full_image));
            }

            $fullImage = $request->file('full_image');
            $fullImageName = time() . '_full_' . uniqid() . '.' . $fullImage->getClientOriginalExtension();
            $fullImage->move(public_path('uploads/events'), $fullImageName);
        }

        if ($request->hasFile('image_square')) {
            if ($event->image_square && file_exists(public_path('uploads/events/' . $event->image_square))) {
                unlink(public_path('uploads/events/' . $event->image_square));
            }

            $squareImage = $request->file('image_square');
            $squareImageName = time() . '_square_' . uniqid() . '.' . $squareImage->getClientOriginalExtension();
            $squareImage->move(public_path('uploads/events'), $squareImageName);
        }

        $event->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'full_description' => $request->full_description,
            'icon' => $iconName,
            'full_image' => $fullImageName,
            'image_square' => $squareImageName,
            'show_in_header' => $request->has('show_in_header') ? 1 : 0,
            'status' => $request->status,
        ]);

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Update Event',
            'detail'  => "Event updated successfully | Name: {$event->name}, Status: {$event->status}",
        ]);

        return redirect()->back()->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->icon && file_exists(public_path('uploads/events/' . $event->icon))) {
            unlink(public_path('uploads/events/' . $event->icon));
        }

        if ($event->full_image && file_exists(public_path('uploads/events/' . $event->full_image))) {
            unlink(public_path('uploads/events/' . $event->full_image));
        }

        if ($event->image_square && file_exists(public_path('uploads/events/' . $event->image_square))) {
            unlink(public_path('uploads/events/' . $event->image_square));
        }

        $event->delete();

        UserLog::create([
            'user_id' => auth()->id(),
            'action'  => 'Delete Event',
            'detail'  => "Event deleted successfully | Name: {$event->name}",
        ]);
        
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}