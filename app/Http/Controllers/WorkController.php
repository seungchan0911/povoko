<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    public function upload(Request $request) {
        if (!$request->hasFile('thumbnail')) {
            return back()->with('error', 'No thumbnail file selected.');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|file|mimes:jpeg,png,jpg,gif,webp,svg|max:20480',
            'video' => 'nullable'
        ]);

        $thumbnailPath = null;
        $file = $request->file('thumbnail');
        
        if ($file->isValid()) {
            try {
                $thumbnailPath = $file->store('thumbnails', 'public');
                
                if (!$thumbnailPath) {
                    return back()->with('error', 'Failed to save file to storage.');
                }
            } catch (\Exception $e) {
                return back()->with('error', 'File upload failed: ' . $e->getMessage());
            }
        } else {
            return back()->with('error', 'Invalid file uploaded. Error code: ' . $file->getError());
        }

        try {
            Work::create([
                'thumbnail' => $thumbnailPath,
                'video' => $request->video,
                'title' => $request->title,
                'content' => $request->content,
            ]);
            
            return back()->with('success', 'Work uploaded successfully! File saved at: ' . $thumbnailPath);
        } catch (\Exception $e) {
            return back()->with('error', 'Database error: ' . $e->getMessage());
        }
    }

    public function admin_view() {
        return view('admin.works');
    }

    public function view() {
        $works = Work::inRandomOrder()->get();

        return view('works', compact('works'));
    }

    public function show($id) {
        $work = Work::findOrFail($id);
        return view('work-detail', compact('work'));
    }
    
    public function delete($id) {
        $work = Work::findOrFail($id);
        
        // 파일 삭제
        if ($work->thumbnail && \Storage::disk('public')->exists($work->thumbnail)) {
            \Storage::disk('public')->delete($work->thumbnail);
        }
        
        // DB에서 삭제
        $work->delete();
        
        return redirect()->route('works')->with('success', '삭제되었습니다.');
    }
}
