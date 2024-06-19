<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\ReplyComment;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\FlareClient\Report;

class ApiController extends Controller
{
    //

    public function findAllPost()
    {
        $posts = Post::with('user')->get();

        return response()->json(
            ['data' => $posts]
        );
    }


    public function findCommentById($id)
    {
        $comments = Comment::where('post_id', $id)->with('user', 'reply', 'reply.user')->get();
        return response()->json(
            ['data' => [
                'post_id' => $id,
                "comments" => $comments
            ]]
        );
    }


    public function addComment(Request $request)
    {
        $request->validate(
            [
                'comment' => 'required',
                'post_id' => 'required'
            ]
        );

        Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id
        ]);
        return response()->json(
            [
                'message' => 'success create comment'
            ],
            201
        );
    }


    public function reply(Request $request)
    {
        ReplyComment::create(
            [
                'comment' => $request->comment,
                'comment_id' => $request->comment_id,
                'user_id' => auth()->user()->id
            ]
        );
        return response()->json(
            [
                'message' => 'success create comment'
            ],
            201
        );
    }


    public function addPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'description' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi untuk file gambar
        ]);

        // Ambil user yang sedang login
        $user = $request->user();

        // Proses upload file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // buat nama file unik

            // Pindahkan file ke direktori tujuan
            $image->move("images", $imageName);

            // Simpan path gambar ke database
            $imagePath = 'images/' . $imageName;

            // Simpan data post ke database
            $post = Post::create([
                'description' => $request->description,
                'title' => $request->title,
                'image' => $imagePath,
                'user_id' => $user->id,
            ]);

            // Berikan respon sukses
            return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
        }

        return response()->json(['message' => 'Image upload failed'], 500);
    }


    public function shop()
    {
        $shops = Shop::all();
        return response()->json(
            ['data' => $shops]
        );
    }

    public function updateProf(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = $request->user();
        User::where('id', $user->id)->update(
            [
                'name' => $request->name,
                'email' => $request->email
            ]
        );
        return response()->json([
            'message' => 'suces'
        ], 200);
    }
}
