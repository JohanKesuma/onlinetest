<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="row mx-3">

    <div class="col">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
                Pilih Paket
            </a>
            <?php foreach($questPackages as $q): ?>
                <a href="<?= base_url('admin/detailnilai/'.$q['package_id']); ?>" class="list-group-item list-group-item-action"><?= $q['name']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>

</div>

