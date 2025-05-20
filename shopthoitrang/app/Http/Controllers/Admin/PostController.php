<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Image_Post;
use App\Models\ImagePost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function detailPost(Request $request)
    {
        $id_post = $request->query("id");
        $post = Posts::where("id_post", $id_post)->first();
        $images = Image_Post::join('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->join('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', '=', $post->id_post)
            ->get();
        $file_name_image_post = [];
        foreach ($images as $item) {
            $file_name_image_post[] = $item->file_name;
        }
        return view('user.detailpost', compact('post'),['file_name_image_post' => $file_name_image_post]);
    }
    public function listPost()
    {
        $posts = Posts::all();
        $postImages = [];
        foreach ($posts as $post) {
            $images = ImagePost::where('id_post', $post->id_post)->get();
            $imageNames = [];
            foreach ($images as $image) {
                $imageName = Image_Post::where('id_image_post', $image->id_image_post)->value('file_name');
                $imageNames[] = $imageName;
            }
            $postImages[$post->id_post] = $imageNames;
        }
        return view('admin.post.listpost', ['posts' => $posts, 'postImages' => $postImages]);
    }
    public function indexAddPost()
    {
        return view('admin.post.addpost');
    }
    public function addPost(Request $request)
    {

        $data = $request->all();
        $post = Posts::create([
            'title_post' => $data['title_post'],
            'content_post' => $data['content_post'],

        ]);
        $images = $request->file('images_post');
        $filenames = [];
        foreach ($images as $image) {
            $ex = $image->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $ex;
            $image->move('uploads/post/', $filename);
            $filenames[] = $filename;
        }
        $id_post = $post->id_post;
        foreach ($filenames as $filename) {
            $image_post = Image_Post::create(['file_name' => $filename]);
            $id_image_post = $image_post->id_image_post;
            ImagePost::create([
                'id_post' => $id_post,
                'id_image_post' => $id_image_post,
            ]);
        }
        return redirect()->route('post.listpost');
    }

    public function deletePost(Request $request)
    {
        $id_post = $request->get('id');
        Image_Post::select('images_posts.id_image_post')
            ->join('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->join('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', $id_post)->delete();
        ImagePost::where('id_post', $id_post)->delete();
        Posts::where('id_post', $id_post)->delete();
        return redirect()->route('post.listpost');
    }

    public function indexUpdatePost(Request $request)
    {
        $id_post = $request->get('id');
        $post = Posts::where('id_post', $id_post)->first();
        return view('admin.post.updatepost',     ['post' => $post]);
    }

    public function updatePost(Request $request)
    {
        $data = $request->all();
        $id_post = $data['id'];
        $post = Posts::where('id_post', $id_post)->first();
        $post->title_post = $data['title_post'];
        $post->content_post = $data['content_post'];
        $post->save();
        $image_posts = Image_Post::select('images_posts.*')
            ->leftJoin('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->leftJoin('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', $post->id_post)
            ->get();

        foreach ($image_posts as $image_post) {
            //Xoa ảnh cũ
            $image_cu = 'uploads/post/' . $image_post->file_name;
            if (File::exists($image_cu)) {
                File::delete($image_cu);
            }
        }
        //Xóa ảnh cũ của database
        Image_Post::select('images_posts.*')
            ->leftJoin('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->leftJoin('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', $post->id_post)
            ->delete();
        ImagePost::where('id_post', $id_post)->delete();
        $files = $request->file('images_post');
        if ($files) {
            foreach ($files as $file) {
                $ex = $file->getClientOriginalExtension(); //Lấy phần mở rộng .jpn,....
                $filename = time() . '_' . uniqid() . '.' . $ex;
                $file->move('uploads/post/', $filename);
                $image_post->file_name = $filename;
                $image_post_new = Image_Post::create(['file_name' => $image_post->file_name]);
                ImagePost::create([
                    'id_post' => $post->id_post,
                    'id_image_post' => $image_post_new->id_image_post,
                ]);
            }
        }
        return redirect()->route('post.listpost');
    }

    public function indexListPostUser(Request $request)
    {
        $posts = Posts::with('images')->latest()->take(2)->get();
        $postsnew = Posts::with('images')->latest()->paginate(5);
        return view('user.listpostuser', ['posts' => $posts, 'postsnew' => $postsnew]);
    }

    public function searchPost(Request $request){
        $data = $request->input('input-search'); // Lấy dữ liệu tìm kiếm từ request
        $posts = Posts::with('images')
        ->where('title_post', 'like', '%'.$data.'%')
        ->orWhere('content_post', 'like', '%'.$data.'%')
        ->get();// Tìm kiếm trong trường title_post
        return view('user.searchpost', ['posts' => $posts]); 
    }
}