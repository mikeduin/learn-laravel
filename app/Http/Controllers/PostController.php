<?php

namespace App\Http\Controllers;

// this is added manually so we can access the Post model
use App\Post;

// this is added by default
use Illuminate\Http\Request;

// this was added manually because we use 'Store' in our getIndex function
use Illuminate\Session\Store;

// Creating this controller extends the default Controller which gives us features like easy validation
// It also imports some namespaces that we commonly use like Request

class PostController extends Controller
{
    // In this controller we create methods called 'actions' which we link up in the routes file
    // We can use dependency injection in the controller because Laravel will add it in a certain way that
    // gives it access to the service container; we pass $session here because getPosts() needs it in the model
    public function getIndex(Store $session)
    {
        // use our post model by instantiating it as a Post() object
        $post = new Post();
        // this calls getPosts() from our Post model
        $posts = $post->getPosts($session);
        return view('blog.index', ['posts' => $posts]);
    }

    // This is the same as above, but presents the posts for view on the admin page
    public function getAdminIndex(Store $session)
    {
        $post = new Post();
        $posts = $post->getPosts($session);
        return view('admin.index', ['posts' => $posts]);
    }

    // This is used to get a single Post
    public function getPost(Store $session, $id)
    {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('blog.post', ['post' => $post]);
    }

    // This returns the view that allows an admin to create a new post
    public function getAdminCreate()
    {
        return view('admin.create');
    }

    // This fetches a single post and then loads the admin edit view
    public function getAdminEdit(Store $session, $id)
    {
        $post = new Post();
        $post = $post->getPost($session, $id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    // This is the action triggered whenever the admin or user submits the create post form
    public function postAdminCreate(Store $session, Request $request)
    {
        // We don't have to inject the validator like we did in the routes file because, since we we extend
        // the Controller at the top, Laravel gives us utilities which make our life easier - one of which is
        // related to validation. We call $this, referring to the controller, and the validate method,
        // and just call the $request with the rules and we are done
        // If this doesn't fulfill our rules it will automatically return to the previous page with the errors
        // populated in the session. All the checking for fails, redirecting, etc in the routes now happens
        // automatically.
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post();
        $post->addPost($session, $request->input('title'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Post created, Title is: '
        . $request->input('title'));
    }

    public function postAdminUpdate(Store $session, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = new Post();
        $post->editPost($session, $request->input('id'), $request->input('title'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: '
        . $request->input('title'));
    }


}
