<?php

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('kategori_model');
    }

    function index() {
        $data['record'] = $this->kategori_model->select_all()->result();
        $this->template->load('dashboard', 'admin/kategori/data', $data);
    }

    function add() {
        $data['parent'] = $this->kategori_model->select_parent()->result();
        $this->template->load('dashboard', 'admin/kategori/add', $data);
    }

    function insert() {
        $validate = $this->validate();
        if($validate['correct']=='benar'){
            /*sai: yg ini lanjutkan sendiri, cek insertny bener apa ngg*/
            $this->kategori_model->insert();
        }else{
            json_encode($validate);
        }
    }

    function validate() {
        return $this->kategori_model->validate();
    }

//    function post() {
//        if (isset($_POST['submit'])) {
//            $this->kategori_model->save();
//            redirect('admin/kategori');
//        } else {
//            $data['parent'] = $this->kategori_model->select_parent()->result();
//            $this->template->load('dashboard', 'admin/kategori/post', $data);
//        }
//    }

    function edit() {
        if (isset($_POST['submit'])) {
            $this->kategori_model->update();
            redirect('admin/kategori');
        } else {
            $id = $this->uri->segment(4);
            $data['parent'] = $this->kategori_model->select_parent()->result();
            $data['row'] = $this->kategori_model->get_kategori_id($id)->row_array();
            $this->template->load('dashboard', 'admin/kategori/edit', $data);
        }
    }

    function delete() {
        $id = $_GET['kategori_id'];
        $this->kategori_model->delete($id);
    }

//    function delete() {
//        $this->db->where('kategori_id', $this->uri->segment(4));
//        $this->db->delete('kategori');
//        redirect('admin/kategori');
//    }
}