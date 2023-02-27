<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Hasil Produksi
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('hasilproduksi/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Data Baru
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive " id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Tanggal Masuk</th>
                    <th>Nama Part</th>
                    <th>Produksi</th>
                    <th>Proses 1</th>
                    <th>Proses 2</th>
                    <th>Proses 3</th>
                    <th>Proses 4</th>
                    <th>Planing</th>
                    <th>Actual</th>
                    <th>User</th>
                    <?php if (is_admin()) : ?><th>Hapus</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                if ($hasilproduksi) :
                    foreach ($hasilproduksi as $hpr) :
                        $total += $hpr['jumlah_permintaan'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $hpr['tanggal_masuk']; ?></td>
                            <td><?= $hpr['nama_barang']; ?></td>
                            <td><?= $hpr['nama_produksi']; ?></td>
                            <td><?= $hpr['proses1'] . ' ' . $hpr['nama_satuan']; ?></td>
                            <td><?= $hpr['proses2'] . ' ' . $hpr['nama_satuan']; ?></td>
                            <td><?= $hpr['proses3'] . ' ' . $hpr['nama_satuan']; ?></td>
                            <td><?= $hpr['proses4'] . ' ' . $hpr['nama_satuan']; ?></td>
                            <td><?= $hpr['jumlah_permintaan'] . ' ' . $hpr['nama_satuan']; ?></td>
                            <td><?= $hpr['jumlah_jadi'] . ' ' . $hpr['nama_satuan']; ?></td>
                            <td><?= $hpr['nama']; ?></td>
                              <?php if (is_admin()) : ?>
                                <td>
                                
                                    <!-- a href="<?= base_url('hasilproduksi/edit/') . $hpr['id_hasil_produksi'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></!-->
                              
                                    <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('hasilproduksi/delete/') . $hpr['id_hasil_produksi'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>  <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
