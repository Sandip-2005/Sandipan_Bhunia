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
            'label' => 'required|string|max:255',
            'cv_file' => 'required|file|max:5120',
            'is_public' => 'boolean',
            'sort_order' => 'integer'
        ]);

        if ($request->hasFile('cv_file')) {
            $file = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = 'cv_' . time() . '_' . uniqid() . '.' . $extension;
            $fileSize = $file->getSize();

            $uploadPath = public_path('uploads/cv');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            Cv::create([
                'label' => $request->label,
                'filename' => $filename,
                'original_name' => $originalName,
                'extension' => $extension,
                'file_size' => $fileSize,
                'is_public' => $request->boolean('is_public', true),
                'sort_order' => $request->input('sort_order', 0)
            ]);

            return redirect()->route('admin.cvs.index')->with('success', 'CV uploaded successfully!');
        }

        return back()->with('error', 'Failed to upload CV.');
    }

    public function update(Request $request, Cv $cv)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'cv_file' => 'nullable|file|max:5120',
            'is_public' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = [
            'label' => $request->label,
            'is_public' => $request->boolean('is_public', true),
            'sort_order' => $request->input('sort_order', 0)
        ];

        if ($request->hasFile('cv_file')) {
            // Delete old file
            $oldPath = public_path('uploads/cv/' . $cv->filename);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }

            // Upload new file
            $file = $request->file('cv_file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = 'cv_' . time() . '_' . uniqid() . '.' . $extension;
            $fileSize = $file->getSize();

            $uploadPath = public_path('uploads/cv');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $filename);

            $data['filename'] = $filename;
            $data['original_name'] = $originalName;
            $data['extension'] = $extension;
            $data['file_size'] = $fileSize;
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
