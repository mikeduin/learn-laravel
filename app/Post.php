<?php

namespace App;

// This class below is a MODEL
// cannot use dependency injection here as it doesn't have access to the laravel data
// you could however use a facade, or we pass a session as an argument and later inject it into controller
// and then pass it to this method
class Post
{
      public function getPosts($session)
      // a key in our session will hold all of our posts
      {
          if (!$session->has('posts')){
              $this->createDummyData($session);
          }
          return $session->get('posts');
      }

      // This next method retrieves a single post
      public function getPost($session, $id)
      {
          if (!$session->has('posts')){
              $this->createDummyData();
          }
          return $session->get('posts')[$id];
      }

      // This method pushes a new post on the array of posts
      public function addPost($session, $title, $content)
      {
          if (!$session->has('posts')){
              $this->createDummyData();
          }
          $posts = $session->get('posts');
          array_push($posts, ['title' => $title, 'content' => $content]);
          $session->put('posts', $posts);
      }

      // This method grabs a specific post in the array of posts, edits, and then puts back on the session
      public function editPost($session, $id, $title, $content)
      {
          $posts = $session->get('posts');
          $posts[$id] = ['title' => $title, 'content' => $content];
          $session->put('posts', $posts);
      }

      // when we first launch our app, we won't have a session/data in our session, so 'posts' would be empty
      // so for this case we will create another function that populates this with some dummy data

      private function createDummyData($session)
      {
        $posts = [
          [
            'title' => 'Learning Laravel',
            'content' => 'This blog post will get you right on track with Laravel!'
          ],
          [
            'title' => 'Something else',
            'content' => 'Some other content'
          ]
        ];
        // then, populate the session by 'put'ting the posts in the session and store them in the $posts variable
        $session->put('posts', $posts);
      }

}




?>
