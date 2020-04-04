<div class="container my-3">
    <div class="row">

        <div class="col">
            <div class="card shadow bg-primary text-white">
                <div class="card-body justify-content-center">

                    <!-- Header -->
                    <div class="row mx-3 d-flex flex-column">
                        <h4>
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
                            <h5 class="card-title"><?= $user['name'] ?> /
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
                                            <textarea class='form-control' rows="6"
                                                readonly><?= $answer['text'] ?></textarea>
                                            <?php foreach ($answer['answers'] as $a): ?>
                                            <div class="card <?php if ($a['is_true'] == 1) {
    echo 'bg-success';
} elseif ($a['answers_id'] == $answer['user_answer_id']) {
    echo 'bg-danger';
} ?>">
                                                <div class="card-body">
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