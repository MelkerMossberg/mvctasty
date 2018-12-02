<?php

    class Posts extends Controller {
        public function __construct(){

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
            $this->commentModel = $this->model('Comment');
        }

        public function index(){
            if (!isLoggedIn()){
                redirect('users/login');
            }

            //Get posts
            $posts = $this->postModel->getPosts();
            $data = [
                'posts' => $posts
            ];
            $this->view('posts/index', $data);
        }

        public function add(){
            if (!isLoggedIn()){
                redirect('users/login');
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Format ingredients
                $ingredients = explode("|",trim($_POST['ingredients']));
                $ingredArr = [];
                foreach($ingredients as $key => $value){
                    $ingredArr[$key] = '<li class="list-group-item">'.$value.'</li>';
                }
                $ingredients = implode(" ", $ingredArr);

                //Format instructions
                $instructions = explode("|",trim($_POST['instructions']));
                $instrArr = [];
                foreach($instructions as $key => $value){
                    $instrArr[$key] = '<li>'.$value.'</li>';
                }
                $instructions = implode(" ", $instrArr);


                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'img_url' => trim($_POST['img_url']),
                    'ingredients' => $ingredients,
                    'instructions' => $instructions,
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'img_url_err' => '',
                    'ingredients_err' => '',
                    'instructions_err' => '',
                    'body_err' => ''
                ];


                //Validate the data
                if (empty($data['title'])) {
                    $data['title_err'] = 'Please enter a title';
                }
                if (empty($data['body'])) {
                    $data['body_err'] = 'Please enter body text';
                }
                if (empty($data['img_url'])) {
                    $data['img_url'] = 'Please enter image url';
                }

                //Make sure no errors
                if (empty($data['title_err']) && empty($data['body_err']) && empty($data['img_url_err'])){
                    //Validated
                    if ($this->postModel->addPost($data)){
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    //Load view with errors
                    $this->view('posts/add', $data);
                }

            } else{
                $data = [
                    'title' => '',
                    'body' => '',
                    'img_url' => '',
                    'ingredients' => '',
                    'instructions' => ''
                ];
                $this->view('posts/add', $data);
                }
        }

        public function edit($id){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                //Validate the data
                if (empty($data['title'])) {
                    $data['title_err'] = 'Please enter a title';
                }

                if (empty($data['body'])) {
                    $data['body_err'] = 'Please enter body text';
                }

                //Make sure no errors
                if (empty($data['title_err']) && empty($data['body_err'])){
                    //Validated
                    if ($this->postModel->updatePost($data)){
                        flash('post_message', 'Post Updated');
                        redirect('posts');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    //Load view with errors
                    $this->view('posts/edit', $data);
                }

            } else{
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                //Check for owner
                if ($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }
                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'body' => $post->body
                ];
                $this->view('posts/edit', $data);
            }
        }

        public function show($id){
            if (!isLoggedIn()){
                redirect('users/login');
            }

            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            $comments = $this->commentModel->getComments($id);
            $data = [
                'post' => $post,
                'user' => $user,
                'comments' => $comments
            ];
            $this->view('posts/show', $data);
        }

        public function delete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Get existing post from model
                $post = $this->postModel->getPostById($id);

                // Check for owner
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }

                if($this->postModel->deletePost($id)){
                    flash('post_message', 'Post Removed');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                redirect('posts');
            }
        }

        public function addComment($id){

            if (!isLoggedIn()){
                redirect('users/login');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'post_id' => $id,
                    'body_err' => ''
                ];

                //Validate the data
                if (empty($data['body'])) {
                    $data['body_err'] = 'Please add text before submitting';
                }

                //Make sure no errors
                if (empty($data['body_err'])){
                    //Validated
                    if ($this->commentModel->addComment($data)){
                        flash('comment_message', 'Comment Added');
                        redirect('posts/show/'.$id);
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    //Load view with errors
                    $this->view('posts/show/'.$id , $data);
                }

            } else{
                $data = [
                    'body' => ''
                ];
                $this->view('posts/show/'.$id , $data);
            }
        }

        public function deleteComment($page_id, $comment_id){
            if($this->commentModel->delete($comment_id)){
                flash('post_message', 'Comment Removed');
                redirect('posts/show/'.$page_id);
            } else {
                die('Something went wrong');
            }
        }


    }