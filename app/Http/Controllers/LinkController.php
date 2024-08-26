<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    // Display all links
    public function index()
    {
        $links = Link::all();
        return view('shortener', compact('links'));
    }

    // Store a newly created link and generate QR code
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
            'custom_slug' => 'required|string|unique:links,shortened_url',
        ]);

        $shortenedUrl = url('/link/' . $request->custom_slug);
        $qrCodeFilename = time() . '-' . Str::random(6) . '-' . $request->custom_slug . '.png';

        // Generate QR code
        $result = Builder::create()
            ->data($shortenedUrl)
            ->size(300)
            ->margin(10)
            ->build();

        $result->saveToFile(storage_path('app/public/qr-codes/' . $qrCodeFilename));

        // Create a new link record
        $link = Link::create([
            'original_url' => $request->original_url,
            'shortened_url' => $shortenedUrl,
            'qr_code_filename' => $qrCodeFilename,
        ]);

        return redirect()->back()->with('success', 'Link shortened and QR code generated!');
    }

    // Show the form for editing the specified link
    public function edit($id)
    {
        $link = Link::findOrFail($id);
        return view('edit', compact('link'));
    }

    // Update the specified link in storage
    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        $request->validate([
            'original_url' => 'required|url',
            'custom_slug' => 'required|string|unique:links,shortened_url,' . $id,
        ]);

        $shortenedUrl = url('/link/' . $request->custom_slug);

        $link->update([
            'original_url' => $request->original_url,
            'shortened_url' => $shortenedUrl,
        ]);

        return redirect()->route('links.index')->with('success', 'Link updated successfully!');
    }

    // Remove the specified link from storage
    public function destroy($id)
    {
        $link = Link::findOrFail($id);

        // Delete the QR code
        Storage::delete('public/qr-codes/' . $link->qr_code_filename);

        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link deleted successfully!');
    }

    // Download the QR code image
    public function download($id)
    {
        $link = Link::findOrFail($id);
        $filePath = storage_path('app/public/qr-codes/' . $link->qr_code_filename);

        return response()->download($filePath);
    }

    // Redirect to the original URL
    public function show($custom_slug)
    {
        $link = Link::where('shortened_url', url('/link/' . $custom_slug))->firstOrFail();
        return redirect($link->original_url);
    }
}
