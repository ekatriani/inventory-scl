<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasilpr extends CI_Controller
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
        $data['title'] = "Data Produksi";
        $data['hasilpr'] = $this->admin->getHasilpr();
        $this->template->load('templates/dashboard', 'hasilpr/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('produksi_id', 'Produksi', 'required');
        $this->form_validation->set_rules('proses_id', 'Proses', 'required');
        $this->form_validation->set_rules('jmlperm', 'Jumlah Permintaan', 'required|trim|numeric|greater_than[0]');
        $this->form_validation->set_rules('jmljadi', 'Jumlah Jadi', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Produksi";
            $data['barang'] = $this->admin->get('barang');
            $data['produksi'] = $this->admin->get('produksi');
            $data['proses'] = $this->admin->get('proses');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-HPRS-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('hasilpr', 'id_hasilpr', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_hasilpr'] = $kode . $number;

            $this->template->load('templates/dashboard', 'hasilpr/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('hasilpr', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('hasilpr');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('hasilpr/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Produksi";
            $data['barang'] = $this->admin->get('barang');
            $data['produksi'] = $this->admin->get('produksi');
            $this->template->load('templates/dashboard', 'hasilpr/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            if (empty($_FILES['image']['name'])) {
                $insert = $this->admin->update('hasilpr', 'id_hasilpr', $id, $input);
                if ($insert) {
                    set_pesan('perubahan berhasil disimpan.');
                    redirect('hasilpr');
                } else {
                    set_pesan('perubahan tidak disimpan.');
                }
                redirect('hasilpr/edit' . $id);
            } else {
                if ($this->upload->do_upload('image') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if ($input['image'] != null) {
                        $old_image = 'assets/upload/' . $input['image'];
                        unlink($old_image);
                    }

                    $input['image'] = $this->upload->data('file_name');
                    $update = $this->admin->update('hasilpr', 'id_hasilpr', $id, $input);
                    if ($update) {
                        set_pesan('data berhasil disimpan');
                        redirect('hasilpr');
                    } else {
                        set_pesan('data gagal disimpan', false);
                        redirect('hasilpr/add');
                    }
                }
            }
        }
    }


    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('hasilpr', 'id_hasilpr', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('hasilpr');
    }
}
