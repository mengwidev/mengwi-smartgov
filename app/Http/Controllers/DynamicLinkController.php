<?php

namespace App\Http\Controllers;

use App\Models\DynamicLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DynamicLinkController extends Controller
{
    public function redirectToOriginalLink(string $custom_slug): RedirectResponse
    {
        $dynamicLink = DynamicLink::where('custom_slug', $custom_slug)->first();

        if (!$dynamicLink) {
            abort(404, 'Link not found');
        }

        return redirect()->to($dynamicLink->original_link);
    }

    public function downloadQrCode($id)
    {
        $dynamicLink = DynamicLink::findOrFail($id);
        $filePath = storage_path("app/public/{$dynamicLink->qr_code_filename}");

        if (!file_exists($filePath)) {
            abort(404, 'QR Code not found');
        }

        return Response::download($filePath, basename($filePath));
    }
}
