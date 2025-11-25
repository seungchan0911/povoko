<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    public function upload(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|url',
            'video' => 'nullable'
        ]);

        try {
            Work::create([
                'thumbnail' => $request->thumbnail,
                'video' => $request->video,
                'title' => $request->title,
                'content' => $request->content,
            ]);
            
            return back()->with('success', 'Work uploaded successfully!');
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
        $work->delete();
        
        return redirect()->route('works')->with('success', '삭제되었습니다.');
    }
    
    public function edit($id) {
        $work = Work::findOrFail($id);
        return view('admin.works-edit', compact('work'));
    }
    
    public function update(Request $request, $id) {
        $work = Work::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|url',
            'video' => 'nullable'
        ]);
        
        $work->update([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $request->thumbnail,
            'video' => $request->video,
        ]);
        
        return redirect()->route('works.show', $work->id)->with('success', '수정되었습니다.');
    }
}
