<div class="container my-3">
    <div class="row">

        <div class="col">
            <div class="card shadow bg-primary text-white">
                <div class="card-body justify-content-center">

                    <!-- Header -->
                    <div class="row mx-3 d-flex flex-column">
                        <h4 style="margin-bottom: 0px;text-align: center;">
                            Hasil Ujian <?= $quest_package_name; ?>
                        </h4>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body justify-content-center">

                    <!-- Nilai -->
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 style="margin-bottom: 0px" class="card-title"><?= $user['name'] ?> /
                                <?= $user['identity_number'] ?>
                            </h5>
                        </div>
                        <div class="card-body">

                            <h6>Jumlah Benar : <?= $exam['true_answers']; ?>
                                dari <?= $jumlah_soal; ?>
                                soal
                            </h6>

                            <h6>
                                Nilai : <?= $nilai; ?>
                            </h6>

                        </div>
                    </div>

                    <?php if ($exam['true_answers'] != $jumlah_soal) : ?>

                    <div class="card shadow mt-5">
                        <div class="card-body">
                            Review
                            <div class="row ml-1 mt-1">
                                <div class="col">
                                    <div class="row">
                                        <div class="mr-2 bg-success" style="width:50px;height:20px">
                                        </div> Jawaban Benar
                                    </div>

                                    <div class="row">
                                        <div class="mr-2 bg-danger" style="width:50px;height:20px">
                                        </div> Jawaban Anda
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">

                            <?php foreach ($answers_history as $answer): ?>
                            <?php if (!isset($answer['user_answer_id'])){ $answer['user_answer_id'] = NULL; } ?>
                            <?php $index = array_search($answer['user_answer_id'], array_column($answer['answers'], 'answers_id')); ?>
                            <?php if ($answer['answers'][$index]['is_true'] == 0 || $answer['user_answer_id'] == null): ?>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="card shadow">
                                        <div class="card-body justify-content-center">
                                            <?php if ($answer['image'] != '') : ?>
                                                <div style="overflow-x: auto; white-space: nowrap;">
                                                <img style="min-width: 500px;" class="img-fluit w-100" src="<?= base_url('assets/img/'.$answer['image']) ?>"
                                                    alt="">
                                                </div>
                                            
                                            <?php endif; ?>
                                            <div class="p-2" style="border: 1px solid rgba(0, 0, 0, .2); border-radius: 5px;min-height: 100px;">
                                                <?= $answer['text'] ?>
                                            </div>
                                            <!-- <textarea class='form-control' rows="6"
                                                readonly></textarea> -->
                                            <?php foreach ($answer['answers'] as $a): ?>
                                            <div class="card <?php if ($a['is_true'] == 1) {
                                                    echo 'bg-success';
                                                } elseif ($a['answers_id'] == $answer['user_answer_id']) {
                                                    echo 'bg-danger';
                                                } ?>">
                                                <div class="card-body">
                                                    <?php if ($a['image'] != ''): ?>
                                                        <div class="mb-1" style="overflow-x: auto; white-space: nowrap;">
                                                            <img class="img-fluid" style="min-width: 200px;"
                                                                src="<?= base_url('assets/img/answers/'.$a['answers_id'].'/').$a['image']; ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?= $a['text']; ?>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <?php endif; ?>

                            <?php endforeach; ?>

                        </div>

                    </div>
                    <?php endif; ?>


                    <a href="<?= base_url('auth/logout'); ?>"
                        class="btn btn-outline-danger float-right mt-2">Tutup</a>
                </div>
            </div>
        </div>
    </div>
</div>