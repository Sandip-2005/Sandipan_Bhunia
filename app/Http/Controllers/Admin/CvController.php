<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::orderBy('sort_order')->orderBy('id', 'desc')->get();
        return view('admin.cvs.index', compact('cvs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label'            => 'required|string|max:255',
            'google_drive_url' => 'nullable|url|max:500',
            'is_public'        => 'boolean',
            'sort_order'       => 'integer',
        ]);

        // File required only when no Google Drive URL is provided
        if (!$request->filled('google_drive_url')) {
            $request->validate(['cv_file' => 'required|file|max:5120']);
        }

        $data = [
            'label'            => $request->label,
            'is_public'        => $request->boolean('is_public', true),
            'sort_order'       => $request->input('sort_order', 0),
            'google_drive_url' => $request->input('google_drive_url') ?: null,
        ];

        if ($request->hasFile('cv_file')) {
            $file         = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension    = $file->getClientOriginalExtension();
            $filename     = 'cv_' . time() . '_' . uniqid() . '.' . $extension;
            $fileSize     = $file->getSize();

            $uploadPath = public_path('uploads/cv');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);

            $data['filename']      = $filename;
            $data['original_name'] = $originalName;
            $data['extension']     = $extension;
            $data['file_size']     = $fileSize;
        } else {
            // Drive-only CV — store placeholder values
            $data['filename']      = 'google_drive';
            $data['original_name'] = $request->label;
            $data['extension']     = 'pdf';
            $data['file_size']     = 0;
        }

        Cv::create($data);

        return redirect()->route('admin.cvs.index')->with('success', 'CV saved successfully!');
    }

    public function update(Request $request, Cv $cv)
    {
        $request->validate([
            'label'            => 'required|string|max:255',
            'cv_file'          => 'nullable|file|max:5120',
            'google_drive_url' => 'nullable|url|max:500',
            'is_public'        => 'boolean',
            'sort_order'       => 'integer',
        ]);

        $data = [
            'label'            => $request->label,
            'is_public'        => $request->boolean('is_public', true),
            'sort_order'       => $request->input('sort_order', 0),
            'google_drive_url' => $request->input('google_drive_url') ?: null,
        ];

        if ($request->hasFile('cv_file')) {
            // Delete old local file if it exists
            @unlink(public_path('uploads/cv/' . $cv->filename));

            $file         = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension    = $file->getClientOriginalExtension();
            $filename     = 'cv_' . time() . '_' . uniqid() . '.' . $extension;
            $fileSize     = $file->getSize();

            $uploadPath = public_path('uploads/cv');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);

            $data['filename']      = $filename;
            $data['original_name'] = $originalName;
            $data['extension']     = $extension;
            $data['file_size']     = $fileSize;
        }

        $cv->update($data);

        return redirect()->route('admin.cvs.index')->with('success', 'CV updated successfully!');
    }

    public function destroy(Cv $cv)
    {
        $path = public_path('uploads/cv/' . $cv->filename);
        if (file_exists($path)) {
            @unlink($path);
        }

        $cv->delete();

        return redirect()->route('admin.cvs.index')->with('success', 'CV deleted successfully!');
    }
}
