<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div class="container">

    <?php $count = 1; ?>
    <?php foreach ($questions as $q): ?>
    <div class="row ml-1">
        <div class="col">
            <p><?= $count.'. '.$q['text'] ?>
            </p>
            <?php foreach ($q['answers'] as $answers) : ?>
            <div class="row ml-5">
                <p><?= $answers['text']; ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    <?php $count++; endforeach; ?>

</div>

<div class="container-fluid mt-3">
    <a href="<?= base_url('admin/tambahsoal/'.$packageId); ?>"
        class="btn btn-primary mb-4">Tambah Soal</a>
</div>