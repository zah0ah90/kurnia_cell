<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>HARGA JUAL SATUAN</th>
            <th>HARGA MODAL SATUAN</th>
            <th>QTY</th>
            <th>TIME</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($tabel as $row) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row->nama_barang ?></td>
            <td><?= $row->harga_jual_satuan ?></td>
            <td><?= $row->harga_modal_satuan ?></td>
            <td><?= $row->qty ?></td>
            <td><?= $row->add_date ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>