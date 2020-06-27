<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([Post::idDescending()->paginate(5)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = $request->validate([
            'title' => 'required|max:100|min:3',
            'body' => 'required|min:5',
            ]);
        $postData['user_id'] = auth()->id();

        try {
            return response(['post' => Post::create($postData)], 201);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response(['message' => $ex], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $postUpdateData = $request->validate([
            'title' => 'required|max:100|min:3',
            'body' => 'required|min:5',
        ]);

        $post = Post::user(auth()->id())->find($id);

        if (!$post) {
           return response(['message' => 'No such posts found'], 400);
        }

        try {
            $post->title = $postUpdateData['title'];
            $post->body = $postUpdateData['body'];
            return response(['message' => $post->save()], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response(['message' => $ex], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::user(auth()->id())->find($id);

        if (!$post) {
            return response(['message' => 'No such posts found'], 400);
        }

        try {
            return response(['message' => $post->delete()], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response(['message' => $ex], 400);
        }
    }
}
