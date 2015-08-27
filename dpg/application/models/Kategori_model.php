<?php

class Kategori_model extends CI_Model {

    function select_all() {
        return $this->db->get('kategori');
    }

    function select_parent() {
        return $this->db->get_where('kategori', array('parent' => 0));
    }

    function insert() {
        $data['nama_kategori'] = $this->input->post('nama_kategori');
        $data['link'] = $this->input->post('link');
        $data['parent'] = $this->input->post('parent');
        $data['nama_kategori_seo'] = seo_title($this->input->post('nama_kategori'));
        $query = $this->db->get_where('kategori', array('nama_kategori' => $data['nama_kategori']));
        if ($query->num_rows() > 0) {
            $this->db->where('nama_kategori', $data['nama_kategori']);
            $this->db->update('kategori', $data);
            echo "data berhasil diupdate";
        } else {
            $this->db->insert('kategori', $data);
            echo "data berhasil disimpan";
        }
    }

    function validate() {
        $this->form_validation->set_rules('nama_kategori', 'Nama_kategori', 'required');
        $this->form_validation->set_rules('link', 'Link', 'required|valid_url');
        $this->form_validation->set_rules('parent', 'Parent', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'correct' => 'salah',
                'message_nama_kategori' => form_error('nama_kategori'),
                'message_link' => form_error('link'),
                'message_parent' => form_error('parent')
            );
            echo json_encode($data);
        } else {
            $data = array(
                'correct' => 'benar'
            );
            echo json_encode($data);
        }
    }

    function update() {
        $data = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
            'link' => $this->input->post('link'),
            'parent' => $this->input->post('parent'),
            'nama_kategori_seo' => seo_title($this->input->post('nama_kategori'))
        );
        $this->db->where('kategori_id', $this->input->post('kategori_id'));
        $this->db->update('kategori', $data);
    }

    function delete($id) {
        $this->db->where('kategori_id', $id);
        $this->db->delete('kategori');
    }

    function get_kategori_id($id) {
        return $this->db->get_where('kategori', array('kategori_id' => $id));
    }

}