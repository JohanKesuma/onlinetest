<?= $this->session->flashdata('message'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>
    </h1>

</div>
<!-- /.container-fluid -->

<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nomor Induk Siswa</th>
                <th scope="col">Nama</th>
                <th scope="col">Paket Soal</th>
                <th scope="col">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($daftarSiswa as $ds): ?>
            <tr>
                <th scope="row"><?= $no; ?>
                </th>
                <td><?= $ds['identity_number']; ?>
                </td>
                <td><?= $ds['name']; ?>
                </td>
                <td>
                <?= $ds['qname'] ?>
                </td>
                <td>
                    <?= $ds['nilai']; ?>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>