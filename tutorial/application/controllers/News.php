<?php 

    class News extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('news_model');
            $this->load->helper('url_helper');
        }
        //load entire datas and display the datas by view
        public function index(){ 
            $data['news'] = $this->news_model->getNews();
            $data['title'] = 'News archive';
            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer');
        }
        //load data based on slug
        public function view ($slug = NULL) {
            $data['news_item'] = $this->news_model->getNews($slug);
            if (empty($data['news_item']))
            {
                show_404();
            }
            $data['title'] = $data['news_item']['title'];
            $this->load->view('templates/header', $data);
            $this->load->view('news/view', $data);
            $this->load->view('templates/footer');
        }

        public function create () {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $data['title'] = 'Create a news item';
            
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');
            }
            else {
                $this->news_model->insertNews();
                $this->load->view('news/success');
            }
        }
    }

?>