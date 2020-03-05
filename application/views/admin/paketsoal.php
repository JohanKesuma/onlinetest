<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="container-fluid mb-3">
    <a href="<?= base_url('admin/tambahsiswa') ?>"
        class="btn btn-primary mb-4">Tambah Soal</a>
</div>

<div class="container">

    <?php
    $numOfCols = 2;
    $questPackagesChunk = array_chunk($questPackages, $numOfCols);
     ?>
    <?php foreach ($questPackagesChunk as $quest): ?>
    <div class="row mb-4">
        <?php foreach($quest as $q) : ?>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card" style="width: 25rem;">
                <img src="<?= base_url('assets/img/soal-bg.jpg') ?>"
                    class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= $q['name'] ?>
                    </h5>
                    <a href="<?= base_url('admin/packagedetail/'.$q['package_id']); ?>"
                        class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php endforeach; ?>
</div>