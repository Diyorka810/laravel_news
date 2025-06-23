<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Services\PostImageService;


class PostController extends Controller{

    public function __construct(private PostImageService $images) {}

    public function index(Request $request){
        $categoryId = $request->input('category');
        $search = $request->input('q');

        $query = Post::with('translations');
        if ($categoryId) {
            $ids = Category::where('id', $categoryId)
                       ->orWhere('parent_id', $categoryId)
                       ->pluck('id');

            $query->whereIn('category_id', $ids);
        }

        if ($search) {
            $query->whereHas('translations', fn ($q) => $q->search($search));
        }

        $posts = $query->latest('id')->get();
        $categories = Category::all();

        return view('post.index', compact('posts', 'categories', 'categoryId', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $path = $this->images->store($data['image_file']);
        unset($data['image_file']);

        $post = Post::create([
            'user_id'     => Auth::id(),
            'category_id' => $data['category_id'],
            'image_link'  => $path,
            'is_published'=> true,
        ]);

        $post->translations()->create([
            'language' => $data['language'],
            'title'    => $data['title'],
            'content'  => $data['content'],
        ]);

        return to_route('post.index')->with('success', __('messages.post_created'));
    }

    public function show(Post $post){
        $translation = $post->translation();
        return view('post.show', compact('post', 'translation'));
    }

    public function edit(Post $post){
        $translation = $post->translation(request('lang'));
        $categories = Category::all();

        return view('post.edit', compact('post', 'translation', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->hasFile('image_file')) {
            $post->image_link = $this->images->replace(
                $request->file('image_file'),
                $post->image_link
            );
        }

        $post->category_id = $data['category_id'];

        $post->translations()->updateOrCreate(
            ['language' => $request->input('language')],
            [
                'title'   => $request->input('title'),
                'content' => $request->input('content'),
            ]
        );

        $post->save();

        return to_route('post.index')->with('success', __('messages.post_created'));
    }

    public function destroy(Post $post)
    {
        $this->images->delete($post->image_link);
        $post->delete();

        return to_route('post.index')->with('success', 'Post deleted');
    }
}
