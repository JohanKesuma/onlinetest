<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><a
            href="<?= $parentUrl; ?>"><img class="pb-1 img-fluid"
                src="<?= base_url('assets/img/back32.png') ?>">
        </a><?= $title; ?>
    </h1>


</div>
<!-- /.container-fluid -->

<div class="row" style="overflow-x: auto; white-space: nowrap;">
    <div class="col">
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

</div>