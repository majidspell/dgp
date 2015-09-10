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
            $pesan = array(
                'message1' => 'data berhasil diupdate'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('kategori', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
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
