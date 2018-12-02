<?php
  class Pages extends Controller {
    public function __construct(){

    }
    
    public function index(){
        if (isLoggedIn()){
            redirect('posts');
        }
      $data = [
        'title' => 'Food Freaks MVC',
        'description' => 'This is a social forum where you can share your recipes with frends.</br>Register to join the forum!'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'Food, Friends, Lonely on my local server. I could not have described it better. Join today. </br> We
 have no GDPR policy.'
      ];

      $this->view('pages/about', $data);
    }
  }