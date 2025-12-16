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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'video' => 'nullable'
        ]);

        try {
            // 디버깅: 무슨 데이터가 들어오는지 확인
            \Log::info('Upload Request Data:', [
                'has_file' => $request->hasFile('thumbnail'),
                'all_files' => $request->allFiles(),
                'all_input' => $request->all(),
            ]);
            
            $data = [
                'video' => $request->video,
                'title' => $request->title,
                'content' => $request->content,
            ];
            
            // 썸네일 파일 업로드 (S3에 저장)
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                if ($file->isValid()) {
                    $path = $file->store('images/thumbnails', 's3');
                    \Log::info('File uploaded to S3:', ['path' => $path]);
                    $data['thumbnail'] = $path;
                } else {
                    \Log::error('File is not valid');
                    return back()->with('error', '파일 업로드 실패: 유효하지 않은 파일');
                }
            } else {
                \Log::error('No file in request');
                return back()->with('error', '썸네일 이미지를 선택해주세요.');
            }
            
            \Log::info('Creating work with data:', $data);
            Work::create($data);
            
            return back()->with('success', 'Work uploaded successfully!');
        } catch (\Exception $e) {
            \Log::error('Upload exception:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
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
        
        // S3에 저장된 썸네일 삭제 (하지만 Pinterest URL은 실패하고 넘어감)
        if ($work->thumbnail && \Storage::exists($work->thumbnail)) {
            \Storage::delete($work->thumbnail);
        }
        
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'video' => 'nullable'
        ]);
        
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'video' => $request->video,
        ];
        
        // 썸네일 파일 업로드 (S3에 저장)
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            if ($file->isValid()) {
                // 기존 파일 삭제 (하지만 Pinterest URL은 실패하고 넘어감)
                if ($work->thumbnail && \Storage::exists($work->thumbnail)) {
                    \Storage::delete($work->thumbnail);
                }
                
                $data['thumbnail'] = $file->store('images/thumbnails', 's3');
            }
        } else {
            // 파일 업로드 안 하면 기존 값 유지 (Pinterest URL 그대로)
            $data['thumbnail'] = $work->thumbnail;
        }
        
        $work->update($data);
        
        return redirect()->route('works.show', $work->id)->with('success', '수정되었습니다.');
    }
}
