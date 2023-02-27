<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Tambah Data Baru
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('hasilproduksi') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['id_hasil_produksi' => $id_hasil_produksi, 'user_id' => $this->session->userdata('login_session')['user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_hasil_produksi">ID Transaksi</label>
                    <div class="col-md-4">
                        <input value="<?= $id_hasil_produksi; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_hasil_produksi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tanggal_masuk">tanggal_masuk</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('tanggal_masuk', date('Y-m-d')); ?>" name="tanggal_masuk" id="tanggal_masuk" type="text" class="form-control date" placeholder="tanggal_masuk...">
                        <?= form_error('tanggal_masuk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="barang_id">Barang</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="barang_id" id="barang_id" class="custom-select">
                                <option value="" selected disabled>Pilih Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option <?= $this->uri->segment(3) == $b['id_barang'] ? 'selected' : '';  ?> <?= set_select('barang_id', $b['id_barang']) ?> value="<?= $b['id_barang'] ?>"><?= $b['id_barang'] . ' | ' . $b['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('barang/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="produksi_id">Produksi</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="produksi_id" id="produksi_id" class="custom-select">
                                <option value="" selected disabled>Pilih Produksi</option>
                                <?php foreach ($produksi as $pr) : ?>
                                    <option <?= $this->uri->segment(3) == $pr['id_produksi'] ? 'selected' : '';  ?> <?= set_select('produksi_id', $pr['id_produksi']) ?> value="<?= $pr['id_produksi'] ?>"><?= $pr['id_produksi'] . ' | ' . $pr['nama_produksi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-primary" href="<?= base_url('produksi/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('produksi_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_permintaan">Proses 1</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('proses1'); ?>" name="proses1" id="proses1" type="number" class="form-control" placeholder="Jumlah">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_permintaan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_permintaan">Proses 2</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('proses2'); ?>" name="proses2" id="proses2" type="number" class="form-control" placeholder="Jumlah">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_permintaan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="proses3">Proses 3</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('proses3'); ?>" name="proses3" id="proses3" type="number" class="form-control" placeholder="Jumlah">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_permintaan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="proses4">Proses 4</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('proses4'); ?>" name="proses4" id="proses4" type="number" class="form-control" placeholder="Jumlah">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_permintaan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_permintaan">Jumlah Permintaan</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('jumlah_permintaan'); ?>" name="jumlah_permintaan" id="jumlah_permintaan" type="number" class="form-control" placeholder="Jumlah Permintaan...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_permintaan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_permintaan">Jumlah Jadi</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('jumlah_jadi'); ?>" name="jumlah_jadi" id="jumlah_jadi" type="number" class="form-control" placeholder="Jumlah Jadi...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_jadi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                <div class="row form-group">
                    <div class="col offset-md-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>