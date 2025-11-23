<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;

class TextController extends Controller
{
    public function view(Request $request) {
        $text = Text::latest()->first();
        
        // text가 없으면 기본값 생성
        if (!$text) {
            $text = Text::create([
                'text1' => 'Welcome to Povoko Studio',
                'text2' => 'We create amazing content',
                'background_video_1' => null,
                'background_video_2' => null,
                'background_video_3' => null,
                'background_video_4' => null,
            ]);
        }
        
        return view('index', compact('text'));
    }

    public function operationView(Request $request) {
        $text = Text::latest()->first();
        
        // text가 없으면 기본값 생성
        if (!$text) {
            $text = Text::create([
                'text1' => 'Welcome to Povoko Studio',
                'text2' => 'We create amazing content',
                'background_video_1' => null,
                'background_video_2' => null,
                'background_video_3' => null,
                'background_video_4' => null,
            ]);
        }
        
        return view('admin.operation', compact('text'));
    }

    public function operation(Request $request) {
        $text = Text::latest()->first();
        
        // Validation
        $request->validate([
            'text1' => 'required',
            'text2' => 'required',
            'background_video_1' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:204800',
            'background_video_2' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:204800',
            'background_video_3' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:204800',
            'background_video_4' => 'nullable|file|mimes:mp4,mov,avi,wmv,webm|max:204800',
        ]);
        
        $data = [
            'text1' => $request->text1,
            'text2' => $request->text2,
        ];
        
        // 4개의 비디오 처리
        for ($i = 1; $i <= 4; $i++) {
            $fieldName = "background_video_{$i}";
            
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                
                if ($file->isValid()) {
                    // 기존 파일 삭제
                    if ($text->$fieldName && \Storage::disk('public')->exists($text->$fieldName)) {
                        \Storage::disk('public')->delete($text->$fieldName);
                    }
                    
                    // 새 파일 저장
                    $data[$fieldName] = $file->store('videos', 'public');
                } else {
                    // 파일이 유효하지 않으면 기존 값 유지
                    $data[$fieldName] = $text->$fieldName;
                }
            } else {
                // 파일이 업로드되지 않았으면 기존 값 유지
                $data[$fieldName] = $text->$fieldName;
            }
        }
    
        $text->update($data);

        return back()->with('success', 'Updated successfully!');
    }
}
