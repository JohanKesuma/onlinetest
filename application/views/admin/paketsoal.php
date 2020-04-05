<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="container-fluid mb-3">
    <a href="<?= base_url('admin/tambahpaket') ?>"
        class="btn btn-primary mb-4">Tambah Paket</a>
</div>

<div class="container">

    <?php
    $numOfCols = 2;
    $questPackagesChunk = array_chunk($questPackages, $numOfCols);
     ?>
    <?php foreach ($questPackagesChunk as $quest): ?>
    <div class="row mb-4">
        <?php foreach ($quest as $q) : ?>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <img src="<?= base_url('assets/img/soal-bg.jpg') ?>"
                    class="card-img-top">
                <div class="card-body">
                    <?php if ($q['is_active'] == 1): ?>
                        <h5 class="card-title text-success float-right">Open</h5>
                    <?php else : ?>
                        <h5 class="card-title text-danger float-right">Close</h5>
                    <?php endif; ?>
                    <h5 class="card-title"><?= $q['name'] ?>
                    </h5>

                    <div class="row">
                        <div class="col-sm-2 mr-3">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Edit
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php if ($q['is_active'] == 1): ?>
                                    <a href="<?= base_url('admin/togglePackage/'.$q['package_id'].'/0') ?>"
                                        class="dropdown-item">Tutup paket</a>
                                <?php else : ?>
                                    <a href="<?= base_url('admin/togglePackage/'.$q['package_id'].'/1') ?>"
                                        class="dropdown-item">Buka paket</a>
                                <?php endif; ?>
                                    <a href="<?= base_url('admin/editpaket/'.$q['package_id']); ?>"
                                        class="dropdown-item">Edit</a>
                                    <a href="javascript:downloadQrCode('https://api.qrserver.com/v1/create-qr-code/?data=<?= base_url('auth/index/'.$q['package_id']); ?>&size=512x512','<?= $q['name']; ?>')"
                                        class="dropdown-item">Unduh QR
                                        Code</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" data-target="#hapusModal" data-toggle="modal"
                                        data-url="<?= base_url('admin/hapuspaket/'.$q['package_id']); ?>"
                                        class="dropdown-item text-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?= base_url('admin/packagedetail/'.$q['package_id']); ?>"
                                class="btn btn-primary">Lihat</a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endforeach; ?>
</div>

<!-- Hapus Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">Anda yakin?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a id="hapusButton" class="btn btn-danger" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    function downloadQrCode(url, name) {
        fetch(url)
            .then(resp => resp.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                console.log(url);

                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                // the filename you want
                a.download = name;
                // document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(e => console.log(e));

    }
    window.onload = function() {
        $('#hapusModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var url = $(e.relatedTarget).data('url'); // url untuk hapus siswa
            console.log(url);
            $('#hapusButton').attr('href', url); // ganti value href
        });


    }
</script>