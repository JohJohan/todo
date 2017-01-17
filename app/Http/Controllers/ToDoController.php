<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Session;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todo.index')->withTodos($todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $this->validate($request, array(
            'title'        => 'required|max:255',
            'slug'         => 'required|alpha_dash|min:5|max:25|unique:posts,slug',
            'category_id'  => 'required|integer',
            'body'         => 'required'
        ));
        // Store Database
        $post = New Post;

        $post->title            = $request->title;
        $post->slug             = $request->slug;
        $post->body             = $request->body;

        $post->save();


        Session::flash('success', 'The post has been saved.');

        // Redirect
        return redirect()->route('todo.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todo.show')->withTodo($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);


        return view('todo.edit')->with('todo', $todo);
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
        $post = Post::find($id);
        // validate check if slug already is, else post but not the slug.
        if($request->input('slug') == $post->slug){
            $this->validate($request, array(
                'title'    => 'required|max:255',
                'category_id'  => 'required|integer',
                'body'     => 'required'
            ));
        } else{
            $this->validate($request, array(
                'title'    => 'required|max:255',
                'slug'     => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'  => 'required|integer',
                'body'     => 'required'
            ));
        }

        // Store
        $post->title           = $request->input('title');
        $post->slug            = $request->input('slug');
        $post->category_id     = $request->input('category_id');
        $post->body            = $request->input('body');

        $post->save();

        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        Session::flash('success', 'this post has been saved');

        // Redirect with flash to show
        return redirect()->route('todo.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();
        $post->delete();

        Session::flash('success', 'The post is deletead');

        return redirect()->route('todo.index');
    }
}
