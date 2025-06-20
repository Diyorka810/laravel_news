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
        $lang = app()->getLocale();

        $userPosts = UserPost::with('translations')->latest('id')->get();

        return view('userPost.index', compact('userPosts'));
    }

    public function create(){
        return view('userPost.create');
    }

    public function store(StoreUserPostRequest $request)
    {
        $data = $request->validated();

        $path = $this->images->store($data['image_file']);
        unset($data['image_file']);

        $post = UserPost::create([
            'user_id'     => Auth::id(),
            'image_link'  => $path,
            'is_published'=> true,
        ]);

        $post->translations()->create([
            'language' => $data['language'],
            'title'    => $data['title'],
            'content'  => $data['content'],
        ]);

        return to_route('userPost.index')->with('success', __('messages.post_created'));
    }

    public function show(UserPost $userPost){
        $translation = $userPost->translation();
        return view('userPost.show', compact('userPost', 'translation'));
    }

    public function edit(UserPost $userPost){
        $translation = $userPost->translation(request('lang'));
        return view('userPost.edit', compact('userPost', 'translation'));
    }

    public function update(UpdateUserPostRequest $request, UserPost $userPost)
    {
        if ($request->hasFile('image_file')) {
            $userPost->image_link = $this->images->replace(
                $request->file('image_file'),
                $userPost->image_link
            );
        }

        $userPost->translations()->updateOrCreate(
            ['language' => $request->input('language')],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]
        );

        $userPost->save();

        return to_route('userPost.index')->with('success', __('messages.post_created'));
    }

    public function destroy(UserPost $userPost)
    {
        $this->images->delete($userPost->image_link);
        $userPost->delete();

        return to_route('userPost.index')->with('success', 'Post deleted');
    }
}
