<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><a href="<?= $parentUrl; ?>"><img class="pb-1 img-fluid" src="<?= base_url('assets/img/back32.png') ?>"> </a><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="container">

    <?php $count = 1; ?>
    <?php foreach ($questions as $q): ?>
    <div class="row ml-1">
        <div class="col">
            <div class="row">
                <div class="col-sm-0">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Edit
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?= base_url('/admin/editsoal/'.$q['questions_id']) ?>">Edit Soal</a>
                            <a class="dropdown-item" href="#">Hapus</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-11">
                    <?= $count.'. '.$q['text'] ?>
                    <?php foreach ($q['answers'] as $answers) : ?>
                    <div class="row ml-5">
                        <p><?= $answers['text']; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>

    </div>
    <?php $count++; endforeach; ?>

</div>

<div class="container-fluid mt-3">
    <a href="<?= base_url('admin/tambahsoal/'.$packageId); ?>"
        class="btn btn-primary mb-4">Tambah Soal</a>
</div>