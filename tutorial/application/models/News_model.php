<?php
    // defines a model class for datas
    class News_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }
        
        public function getNews ($slug = FALSE) {
            if ($slug === FALSE) {
                $query = $this->db->get('news');
                return $query->result_array();
            }
            $query = $this->db->get_where('news', array('slug' => $slug));
            return $query->row_array();
        }

        public function insertNews () {
            $this->load->helper();
            $slug = url_title($this->input->post('title'), 'dash', TRUE);
            $data = array (
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'text' => $this->input->post('text')
            );
            return $this->db->insert('news', $data);
        }
    }
?>