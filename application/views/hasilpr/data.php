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
                <a href="<?= base_url('hasilpr/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
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
                    <th>Proses</th>
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
                if ($hasilpr) :
                    foreach ($hasilpr as $hprs) :
                        $total += $hprs['jmlperm'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $hprs['tanggal_masuk']; ?></td>
                            <td><?= $hprs['nama_barang']; ?></td>
                            <td><?= $hprs['nama_produksi']; ?></td>
                            <td><?= $hprs['nama_proses']; ?></td>
                            <td><?= $hprs['jmlperm'] . ' ' . $hprs['nama_satuan']; ?></td>
                            <td><?= $hprs['jmljadi'] . ' ' . $hprs['nama_satuan']; ?></td>
                            <td><?= $hprs['nama']; ?></td>
                              <?php if (is_admin()) : ?>
                                <td>
                                
                                    <!-- a href="<?= base_url('hasilpr/edit/') . $hprs['id_hasilpr'] ?>" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></!-->
                              
                                    <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('hasilpr/delete/') . $hprs['id_hasilpr'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>  <?php endif; ?>
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
