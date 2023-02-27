<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenism extends CI_Controller
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
        $data['title'] = "Jenis Material";
        $data['jenism'] = $this->admin->get('jenism');
        $this->template->load('templates/dashboard', 'jenism/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_jenism', 'Nama jenism', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $this->template->load('templates/dashboard', 'jenism/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('jenism', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('jenism');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('jenism/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Unit";
            $data['jenism'] = $this->admin->get('jenism', ['id_jenism' => $id]);
            $this->template->load('templates/dashboard', 'jenism/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenism', 'id_jenism', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('jenism');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('jenism/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('jenism', 'id_jenism', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('jenism');
    }
}
