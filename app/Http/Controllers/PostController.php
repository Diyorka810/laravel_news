<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Services\PostImageService;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        private PostImageService $images,
        private PostService $posts
    ) {}

    public function index(Request $request)
    {
        $posts = Post::filtered($request)
            ->paginate(6)
            ->withQueryString();

        $categories = Category::with('translations')->get();

        return view('post.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $this->posts->createPost($data, $request->file('image_file'));

        return to_route('post.index')->with('success', __('messages.post_created'));
    }

    public function show(Post $post)
    {
        $translation = $post->translation();

        $images = $post->images()
            ->orderByDesc('is_cover')
            ->orderBy('id')
            ->get();

        return view('post.show', compact('post', 'translation', 'images'));
    }

    public function edit(Post $post)
    {
        $translation = $post->translation(request('lang'));
        $categories = Category::all();

        return view('post.edit', compact('post', 'translation', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        $this->posts->updatePost(
            $post,
            $data,
            $request->file('image_file') ?? [],
            $request->input('image_ids', []),
            $request->input('main_image')
        );

        return to_route('post.index')->with('success', __('messages.post_updated'));
    }

    public function destroy(Post $post)
    {
        $this->posts->deletePost($post);
        return to_route('post.index')->with('success', 'Post deleted');
    }
}
