<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses extends CI_Controller
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
        $data['title'] = "Proses";
        $data['proses'] = $this->admin->get('proses');
        $this->template->load('templates/dashboard', 'proses/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_proses', 'Nama proses', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $this->template->load('templates/dashboard', 'proses/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('proses', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('proses');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('proses/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $data['proses'] = $this->admin->get('proses', ['id_proses' => $id]);
            $this->template->load('templates/dashboard', 'proses/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('proses', 'id_proses', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('proses');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('proses/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('proses', 'id_proses', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('proses');
    }
}
