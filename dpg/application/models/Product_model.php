<?php

class Product_model extends CI_Model {

    function select_all() {
        $query = "SELECT product.product_id, product.nama_product, product.harga, kategori.nama_kategori
            FROM product, kategori
            WHERE product.kategori_id = kategori.kategori_id";
        return $this->db->query($query);
    }

    function insert($picture) {
        $data['nama_product'] = $this->input->post('nama_product');
        $data['nama_product_seo'] = seo_title($this->input->post('nama_product'));
        $data['harga'] = $this->input->post('harga');
        $data['kategori_id'] = $this->input->post('kategori');
        $data['picture'] = $picture;
        $query = $this->db->get_where('product', array('nama_product' => $data['nama_product']));
        if ($query->num_rows() > 0) {
            $this->db->where('nama_product', $data['nama_product']);
            $this->db->update('product', $data);
            $pesan = array(
                'message1' => 'data berhasil diupdate'
            );
            echo json_encode($pesan);
        } else {
            $this->db->insert('product', $data);
            $pesan = array(
                'message1' => 'data berhasil disimpan'
            );
            echo json_encode($pesan);
        }
    }

    function delete($id) {
        $this->db->where('product_id', $id);
        $this->db->delete('product');
    }

    function get_kategori_id($id) {
        return $this->db->get_where('kategori', array('kategori_id' => $id));
    }

}
