<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index() {
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('admins.posts.index', compact('posts'));
    }
    public function create() {
        return view('admins.posts.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $post = Post::create([
                'title' => $request->get('title', ''),
                'content' => $request->get('content', ''),
                'status' => $request->get('status', ''),
                'summary' => $request->get('summary', ''),
                'slug' => $request->get('slug', ''),

            ]);
            // Create path image
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/posts');
                $post->image()->create(['path' => $path]);
            }

            DB::commit();

            return redirect()->route('admin.posts.index')->with('success', 'Tạo post mới thành công!');

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'errors' => ['error' => $e->getMessage()],
            ], 500);
        }
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return redirect()->back()->with('error', 'Bài viết không tồn tại');
        }
        return view('admins.posts.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $post = Post::findOrFail($slug);
        $post->title = $request->input('title');
        $post->summary = $request->input('summary-update');
        $post->content = $request->input('content-update');
        $post->status = $request->input('status-update');
        $post->slug = $request->input('slug');

        // Process uploaded images
        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->delete();
            }

            // Save new image
            $path = $request->file('image')->store('public/posts');
            $post->image()->create(['path' => $path]);
        }

        $post->save();
        if ($request->ajax()) {
            return response()->json([
                'success' => 'Cập nhật post thành công!',
            ]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật post thành công!');
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            // Delete image
            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->delete();
            }

            $post->delete();

            return redirect()->route('admin.posts.index')->with('success', 'Xóa post thành công!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
