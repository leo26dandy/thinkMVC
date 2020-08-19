<?php 
class Pages extends Controller {
    private $postModel;

    public function __construct()
    {
        // $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'title' => 'index in Pages Controller',
            'post' => $posts
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['headline' => 'about in Pages Controller'];
        $this->view('pages/about', $data);
    }
}
?>