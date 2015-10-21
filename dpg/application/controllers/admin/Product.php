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

    function validation_product() {
        $this->form_validation->set_rules('nama_product', 'Nama_product', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $config = array(
            'upload_path' => './pictures/',
            'allowed_types' => 'gif|jpg|png', // Jenis file yang di ijinkan
            'file_name' => 'file_' . date('dmYHis'), // Codeigniter otomatis akan merename file
            'file_ext_tolower' => TRUE, // mengubah extensi menjadi huruf kecil
            'overwrite' => TRUE, // Jika bernilai TRUE maka file dengan nama yang sama akan ditimpa
            'max_size' => 3000, // Maksimal ukuran file dalam Kilobyte, jika di isi 0 maka tidak terhingga
            'max_width' => 3000, // maksimal panjang gambar dalam ukuran pixel
            'max_height' => 3000, // maksimal lebar gambar dalam ukuran pixel  
            'min_width' => 10, // minimal panjang gambar dalam ukuran pixel  
            'min_height' => 7, // minimal lebar gambar dalam ukuran pixel      
            'remove_spaces' => TRUE
        );
        $this->upload->initialize($config);
    }

    function add() {
        $data['kategori'] = $this->kategori_model->select_all()->result();
        $this->template->load('dashboard', 'admin/product/add', $data);
    }

    function insert() {
        $this->validation_product();
        if ($this->form_validation->run() == TRUE && $this->upload->do_upload("gambar")) {
            $hasil = $this->upload->data(); //Menampilkan pesan sukses  
            $this->product_model->insert($hasil);
        } else {
            $hasil = $this->upload->display_errors(); //Menampilkan pesan error
            $data = array(
                'correct' => 'salah',
                'message_nama_product' => form_error('nama_product'),
                'message_harga' => form_error('harga'),
                'message_kategori' => form_error('kategori'),
                'message_gambar' => $hasil
            );
            echo json_encode($data);
        }
    }

    function edit() {
        $id = $this->uri->segment(4);
        $data['row'] = $this->db->get_where('product', array('product_id' => $id))->row_array();
        $data['kategori'] = $this->kategori_model->select_all()->result();
        $this->template->load('dashboard', 'admin/product/edit', $data);
    }

    function update() {
        $this->validation_product();
        if ($this->form_validation->run() == TRUE && $this->upload->do_upload("gambar")) {
            $hasil = $this->upload->data(); //Menampilkan pesan sukses  
            $this->product_model->update($hasil);
        } else {
            $hasil = $this->upload->display_errors(); //Menampilkan pesan error
            $data = array(
                'correct' => 'salah',
                'message_nama_product' => form_error('nama_product'),
                'message_harga' => form_error('harga'),
                'message_kategori' => form_error('kategori'),
                'message_gambar' => $hasil
            );
            echo json_encode($data);
        }
    }

    function upload() {
        $config = array(
            'upload_path' => './pictures/',
            'allowed_types' => 'gif|jpg|png', // Jenis file yang di ijinkan
            'file_name' => 'file_' . date('dmYHis'), // Codeigniter otomatis akan merename file
            'file_ext_tolower' => TRUE, // mengubah extensi menjadi huruf kecil
            'overwrite' => TRUE, // Jika bernilai TRUE maka file dengan nama yang sama akan ditimpa
            'max_size' => 3000, // Maksimal ukuran file dalam Kilobyte, jika di isi 0 maka tidak terhingga
            'max_width' => 3000, // maksimal panjang gambar dalam ukuran pixel
            'max_height' => 3000, // maksimal lebar gambar dalam ukuran pixel  
            'min_width' => 10, // minimal panjang gambar dalam ukuran pixel  
            'min_height' => 7, // minimal lebar gambar dalam ukuran pixel      
            'remove_spaces' => TRUE
        );
        $this->upload->initialize($config);
        $id = $this->input->post('product_id');
        if ($this->upload->do_upload("gambar")) {
            $hasil = $this->upload->data(); //Menampilkan pesan sukses  
            $this->product_model->upload($hasil, $id);
        } else {
            $hasil = $this->upload->display_errors(); //Menampilkan pesan error
            echo $hasil;
        }
    }

    function refresh() {
        $gambarUpload = $this->input->post('gambarUpload');
        echo "<img src='" . base_url() . "pictures/" . $gambarUpload . "' width='134px' height='134px' alt='no image found'/>";
    }

    function delete() {
        $id = $_GET['product_id'];
        $this->product_model->delete($id);
    }

}

