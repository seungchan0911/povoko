<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;

class TextController extends Controller
{
    public function view(Request $request) {
        $text = Text::latest()->first();;
        
        return view('index', compact('text'));
    }

    public function operationView(Request $request) {
        $text = Text::latest()->first();;
        
        return view('admin.operation', compact('text'));
    }

    public function operation(Request $request) {
        $text = Text::latest()->first();
        
        // Validation
        $request->validate([
            'text1' => 'required',
            'text2' => 'required',
            'background_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:204800', // 200MB
        ]);
        
        $backgroundVideoPath = $text->background_video; // 기존 값 유지
        
        // 파일이 업로드되었으면 처리
        if ($request->hasFile('background_video')) {
            $file = $request->file('background_video');
            
            if ($file->isValid()) {
                // 기존 파일 삭제 (있다면)
                if ($text->background_video && \Storage::disk('public')->exists($text->background_video)) {
                    \Storage::disk('public')->delete($text->background_video);
                }
                
                // 새 파일 저장
                $backgroundVideoPath = $file->store('videos', 'public');
            }
        }
    
        $text->update([
            'text1' => $request->text1,
            'text2' => $request->text2,
            'background_video' => $backgroundVideoPath,
        ]);

        return back()->with('success', 'Updated successfully!');
    }
}
