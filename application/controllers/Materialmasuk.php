<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materialmasuk extends CI_Controller
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
        $data['title'] = "Material Masuk";
        $data['materialmasuk'] = $this->admin->getMaterialmasuk();
        $this->template->load('templates/dashboard', 'material_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('jenism_id', 'Jenis', 'required');
        $this->form_validation->set_rules('material_id', 'Material', 'required');
        $this->form_validation->set_rules('jumlah_material_masuk', 'Jumlah Material Masuk', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('jml_material_keluar', 'Jumlah Material Keluar', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('konversi', 'Konversi Part', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Material Masuk";
            $data['jenism'] = $this->admin->get('jenism');
            $data['material'] = $this->admin->get('material');
            $data['barang'] = $this->admin->get('barang');

            // Mendapatkan dan men-generate kode transaksi material masuk
            $kode = 'T-MM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('material_masuk', 'id_material_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_material_masuk'] = $kode . $number;

            $this->template->load('templates/dashboard', 'material_masuk/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('material_masuk', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('materialmasuk');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('materialmasuk/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('material_masuk', 'id_material_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('materialmasuk');
    }
}
