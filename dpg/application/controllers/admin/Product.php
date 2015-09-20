<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('product_model', 'kategori_model'));
    }

    function index() {
        $data['record'] = $this->product_model->select_all()->result();
        $this->template->load('dashboard', 'admin/product/data', $data);
    }

    function add() {
        $data['kategori'] = $this->kategori_model->select_all()->result();
        $this->template->load('dashboard', 'admin/product/add', $data);
    }

    function insert() {
        $config = array(
            'upload_path' => './pictures/', // Lokasi file yang di upload
            'allowed_types' => 'gif|jpg|png', // Jenis file yang di ijinkan
            'file_name' => 'file_' . date('dmYHis'), // Codeigniter otomatis akan merename file
            'file_ext_tolower' => TRUE, // mengubah extensi menjadi huruf kecil
            'overwrite' => TRUE, // Jika bernilai TRUE maka file dengan nama yang sama akan ditimpa
            'max_size' => 1000, // Maksimal ukuran file dalam Kilobyte, jika di isi 0 maka tidak terhingga
            'max_width' => 1850, // maksimal panjang gambar dalam ukuran pixel
            'max_height' => 1850, // maksimal lebar gambar dalam ukuran pixel  
            'min_width' => 10, // minimal panjang gambar dalam ukuran pixel  
            'min_height' => 7, // minimal lebar gambar dalam ukuran pixel   
            'max_filename' => 0,
            'remove_spaces' => TRUE // Jika filename mengandung karakter spasi maka akan diganti dengan garisbawah (underline)
        );
        $this->load->library('upload', $config);
////////////////////////////////////////////////////////////////////////
        $this->form_validation->set_rules('nama_product', 'Nama_product', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        if ($this->form_validation->run() == FALSE && !$this->upload->do_upload()) {
            $hasil = $this->upload->display_errors(); //Menampilkan pesan error
            $data = array(
                'correct' => 'salah',
                'message_nama_product' => form_error('nama_product'),
                'message_harga' => form_error('harga'),
                'message_kategori' => form_error('kategori'),
                'message_userfile' => $hasil
            );
            echo json_encode($data);
        } else {     
                $hasil = $this->upload->data(); //Menampilkan pesan sukses  
//            print_r($hasil);
//            die();
            $this->product_model->insert($hasil['file_name']);
            /////////////////////////////////////////////////////////////////////////////////////////
        }
    }

    function edit() {
        $id = $this->uri->segment(4);
        $data['row'] = $this->db->get_where('product', array('product_id' => $id))->row_array();
        $data['kategori'] = $this->kategori_model->select_all()->result();
        $this->template->load('dashboard', 'admin/product/edit', $data);
    }

    function delete() {
        $id = $_GET['product_id'];
        $this->product_model->delete($id);
    }

    public function upload_file() {
        
    }

}
