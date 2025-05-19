<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageTextController extends Controller
{
    public function extractTextFromImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        $storedPath = $file->storeAs('temp', $filename, 'private');
        $fullPath = storage_path('app/private/' . $storedPath);

        $fullPath = storage_path("app/private/{$storedPath}");
        if (!file_exists($fullPath)) {
            \Log::error("Uploaded file not found: $fullPath");
            return response()->json(['error' => 'File not saved properly'], 500);
        }

        $script = base_path('scripts/img_to_text.py');
        $escapedPath = str_replace("\\", "/", $fullPath);
        exec("python " . escapeshellarg($script) . " " . escapeshellarg($escapedPath) . " 2>&1", $output, $returnCode);

        \Log::info('OCR return code: ' . $returnCode);
        \Log::info('OCR output: ' . print_r($output, true));
        \Log::info("OCR return code: {$returnCode}");
        \Log::info("OCR output: " . print_r($output, true));

        if ($returnCode !== 0) {
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            return response()->json(['error' => 'OCR failed', 'output' => $output], 500)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        return response()->json(['text' => mb_convert_encoding(implode("\n", $output), 'UTF-8', 'UTF-8')], 200, [], JSON_UNESCAPED_UNICODE);
    }
}