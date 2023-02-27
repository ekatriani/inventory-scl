<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Produksi";
        $data['produksi'] = $this->admin->get('produksi');
        $this->template->load('templates/dashboard', 'produksi/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_produksi', 'Nama Produksi', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $this->template->load('templates/dashboard', 'produksi/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('produksi', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('produksi');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('produksi/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $data['produksi'] = $this->admin->get('produksi', ['id_produksi' => $id]);
            $this->template->load('templates/dashboard', 'produksi/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('produksi', 'id_produksi', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('produksi');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('produksi/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('produksi', 'id_produksi', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('produksi');
    }
}
