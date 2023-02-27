<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Purchase Order
                </h4><br>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('barangpo/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input PO Masuk
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
                    <th>No Transaksi</th>
                    <th>Tanggal Masuk</th>
                    <th>Customer</th>
                    <th>Nama Barang</th>
                    <th>Purchase Order</th>
                    <th>User</th>
                    <?php if (is_admin()) : ?>
                    <th>Aksi</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalpo = 0;
                if ($barangpo) :
                    foreach ($barangpo as $bp) :
                        $totalpo += $bp['jumlah_po'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $bp['id_po_masuk']; ?></td>
                            <td><?= $bp['tanggal_masuk']; ?></td>
                            <td><?= $bp['nama_supplier']; ?></td>
                            <td><?= $bp['nama_barang']; ?></td>
                            <td><?= $bp['jumlah_po'] . ' ' . $bp['nama_satuan']; ?></td>
                            <td><?= $bp['nama']; ?></td>
                              <?php if (is_admin()) : ?>
                                <td>                    
                                    <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('barang_po/delete/') . $bp['id_po_masuk'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>  <?php endif; ?>
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