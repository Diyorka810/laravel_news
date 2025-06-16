<?php

namespace App\Http\Controllers;
use App\Models\UserPost;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class UserPostController extends Controller{
    public function index(){
        $userPosts = UserPost::orderBy('id', 'asc')->get();
        return view('userPost.index', compact('userPosts'));
    }

    public function create(){
        return view('userPost.create');
    }

    public function store(StoreUserPostRequest $request)
    {
        $data = $request->validated();
        if (!$request->hasFile('image_file')) {
            return back()
                ->withErrors(['image_file' => 'Выберите изображение'])
                ->withInput();
        }

        $file = $request->file('image_file');
        $timestamp = Carbon::now()->format('Ymd_His');
        $ext = $file->getClientOriginalExtension();
        $filename = $timestamp . '.' . $ext;
        $path = $file->storeAs('posts', $filename, 'public');

        $data['user_id'] = Auth::id();
        $data['image_link'] = $path;
        UserPost::create($data);

        return redirect()->route('userPost.index');
    }

    public function show(UserPost $userPost){
        return view('userPost.show', compact('userPost'));
    }

    public function edit(UserPost $userPost){
        return view('userPost.edit', compact('userPost'));
    }

    public function update(UpdateUserPostRequest $request, UserPost $userPost)
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($userPost->image_link) {
                Storage::disk('public')->delete($userPost->image_link);
            }

            $timestamp = Carbon::now()->format('Ymd_His');
            $ext = $request->file('image_file')->getClientOriginalExtension();
            $filename = $timestamp . '.' . $ext;

            $path = $request->file('image_file')->storeAs('posts', $filename, 'public');
            $data['image_link'] = $path;
        }

        $userPost->update($data);

        return redirect()
            ->route('userPost.index')
            ->with('success', 'Post updated');
    }

    public function destroy(UserPost $userPost){
        if ($userPost->image_link) {
            Storage::disk('public')->delete($userPost->image_link);
        }
        $userPost->delete();
        return redirect()->route('userPost.index');
    }
}
