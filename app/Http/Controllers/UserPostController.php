<?php

namespace App\Http\Controllers;
use App\Models\UserPost;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\PostImageService;


class UserPostController extends Controller{

    public function __construct(private PostImageService $images) {}

    public function index(){
        $userPosts = UserPost::latest('id')->get();
        return view('userPost.index', compact('userPosts'));
    }

    public function create(){
        return view('userPost.create');
    }

    public function store(StoreUserPostRequest $request)
    {
        $path = $this->images->store($request->file('image_file'));

        UserPost::create([
            ...$request->safe()->except('image_file'),
            'user_id'    => Auth::id(),
            'image_link' => $path,
        ]);

        return to_route('userPost.index');
    }

    public function show(UserPost $userPost){
        return view('userPost.show', compact('userPost'));
    }

    public function edit(UserPost $userPost){
        return view('userPost.edit', compact('userPost'));
    }

    public function update(UpdateUserPostRequest $request, UserPost $userPost)
    {
        $update = $request->safe()->except('image_file');

        if ($request->hasFile('image_file')) {
            $update['image_link'] = $this->images->replace(
                $request->file('image_file'),
                $userPost->image_link
            );
        }

        $userPost->update($update);

        return to_route('userPost.index')->with('success', 'Post updated');
    }

    public function destroy(UserPost $userPost)
    {
        $this->images->delete($userPost->image_link);
        $userPost->delete();

        return redirect()->route('userPost.index');
    }
}
