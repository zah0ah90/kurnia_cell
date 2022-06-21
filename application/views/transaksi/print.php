<div style="width: 230px;">
    <div style="text-align:center;margin-top: 5px;">


        ------------------------------------- </div>
    <table style="font-size: 12px;">
        <thead>

            <tr>
                <td>Nama:</td>
                <td>: <?= $this->session->userdata('nama') ?></td>
            </tr>
            <tr>
                <td>Tanggal:</td>
                <td>: <?= $bukanDetail->add_date ?></td>
            </tr>

        </thead>
    </table>
    <div style="text-align:center;">
        -------------------------------------
    </div>
    <table style="font-size: 12px;text-align: center;">
        <thead>
            <tr>
                <td style="width:10px;">No</td>
                <td style="width:80px;" style="text-align: start;"> Nama</td>
                <td style="width:40px;">Qty</td>
                <td>Harga</td>
                <td>Total Harga</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($detail as $as) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td style="text-align: start;"><?= $as->nama_barang ?></td>
                <td style="text-align:center;"><?= $as->qty ?></td>
                <td><?= $as->harga_jual_satuan ?></td>
                <td><?= $as->harga_jual_satuan * $as->qty ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div style="text-align:center;">
        -------------------------------------
    </div>
    <table style="font-size: 12px;">
        <thead>
            <tr>
                <td>Total Harga</td>
                <td>: <?= $bukanDetail->total_harga_jual ?></td>
            </tr>

        </thead>
    </table>
    <div style="text-align:center;">
        -------------------------------------
    </div>
    <br>
    <br>
    <br>



</div>


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    window.print();
    setTimeout(function() {
        window.close();
    }, 20000);
});
</script>