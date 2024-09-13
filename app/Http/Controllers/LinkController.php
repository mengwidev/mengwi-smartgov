<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    // Display all links ============================================================================================================================
    public function index()
    {
        $links = Link::orderBy('id', 'desc')->get();
        return view('shortener', compact('links'));
    }
    // ==============================================================================================================================================
    // Store a newly created link and generate QR code ==============================================================================================
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        $shortenedUrl = $this->generateShortenedUrl($request->custom_slug);
        $qrCodeFilename = $this->generateQrCode($shortenedUrl, $request->custom_slug);

        $this->createLinkRecord($validatedData['original_url'], $shortenedUrl, $qrCodeFilename);

        return redirect()->back()->with('success', 'Link shortened and QR code generated!');
    }
    // ==============================================================================================================================================
    // Show the form for editing the specified link =================================================================================================
    public function edit($id)
    {
        $link = Link::findOrFail($id);
        return view('edit', compact('link'));
    }
    // ==============================================================================================================================================
    // Update the specified link in storage =========================================================================================================
    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $oldSlug = $link->shortened_url;

        $validatedData = $this->validateUpdateRequest($request, $id);

        $newShortenedUrl = $this->generateShortenedUrl($validatedData['shortened_url']);

        if ($oldSlug !== $newShortenedUrl) {
            $newQrCodeFilename = $this->generateQrCode($newShortenedUrl, $validatedData['shortened_url']);
            $this->deleteOldQrCode($link->qr_code_filename);
            $link->qr_code_filename = $newQrCodeFilename;
        }

        $this->updateLinkRecord($link, $validatedData['original_url'], $newShortenedUrl);

        return redirect()->route('links.index')->with('status', 'Link updated successfully.');
    }
    // ==============================================================================================================================================
    // Remove the specified link from storage =======================================================================================================
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $this->deleteOldQrCode($link->qr_code_filename);
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link deleted successfully!');
    }
    // ==============================================================================================================================================
    // Download the QR code image ===================================================================================================================
    public function download($id)
    {
        $link = Link::findOrFail($id);
        $filePath = storage_path('app/public/qr-codes/' . $link->qr_code_filename);

        return response()->download($filePath);
    }
    // ==============================================================================================================================================
    // Redirect to the original URL =================================================================================================================
    public function show($custom_slug)
    {
        $link = Link::where('shortened_url', url('/link/' . $custom_slug))->firstOrFail();
        return redirect($link->original_url);
    }
    // ==============================================================================================================================================
    // Validate the request for storing a new link ==================================================================================================
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'original_url' => 'required|url',
            'custom_slug' => 'required|string|unique:links,shortened_url',
        ]);
    }
    // ==============================================================================================================================================
    // Validate the request for updating an existing link ===========================================================================================
    private function validateUpdateRequest(Request $request, $id)
    {
        return $request->validate([
            'original_url' => 'required|url|max:255',
            'shortened_url' => 'required|unique:links,shortened_url,' . $id,
        ]);
    }
    // ==============================================================================================================================================
    // Generate a shortened URL =====================================================================================================================
    private function generateShortenedUrl($customSlug)
    {
        return url('/link/' . $customSlug);
    }
    // ==============================================================================================================================================
    // Generate a QR code and save it to a file =====================================================================================================
    private function generateQrCode($shortenedUrl, $customSlug)
    {
        $qrCodeFilename = time() . '-' . Str::random(6) . '-' . $customSlug . '.png';
        $result = Builder::create()
            ->data($shortenedUrl)
            ->size(300)
            ->margin(10)
            ->build();

        $result->saveToFile(storage_path('app/public/qr-codes/' . $qrCodeFilename));

        return $qrCodeFilename;
    }
    // ==============================================================================================================================================
    // Create a new link record in the database =====================================================================================================
    private function createLinkRecord($originalUrl, $shortenedUrl, $qrCodeFilename)
    {
        Link::create([
            'original_url' => $originalUrl,
            'shortened_url' => $shortenedUrl,
            'qr_code_filename' => $qrCodeFilename,
        ]);
    }
    // ==============================================================================================================================================
    // Update an existing link record in the database ===============================================================================================
    private function updateLinkRecord($link, $originalUrl, $shortenedUrl)
    {
        $link->original_url = $originalUrl;
        $link->shortened_url = $shortenedUrl;
        $link->updated_at = now();
        $link->save();
    }
    // ==============================================================================================================================================
    // Delete an old QR code file ===================================================================================================================
    private function deleteOldQrCode($qrCodeFilename)
    {
        $filePath = storage_path("app/public/qr-codes/{$qrCodeFilename}");
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    // ==============================================================================================================================================
}
