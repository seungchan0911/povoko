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
            'background_video_1' => 'nullable|url',
            'background_video_2' => 'nullable|url',
            'background_video_3' => 'nullable|url',
            'background_video_4' => 'nullable|url',
        ]);
        
        $data = [
            'text1' => $request->text1,
            'text2' => $request->text2,
            'background_video_1' => $request->background_video_1,
            'background_video_2' => $request->background_video_2,
            'background_video_3' => $request->background_video_3,
            'background_video_4' => $request->background_video_4,
        ];
    
        $text->update($data);

        return back()->with('success', 'Updated successfully!');
    }
}
