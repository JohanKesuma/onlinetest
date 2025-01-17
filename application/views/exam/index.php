<div class="m-3">

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card shadow bg-primary text-white">
                <div class="card-body" >
                    <h4 style="margin-bottom: 0px" class="float-left">Soal <?= $questions_index + 1; ?>/<?= count($questions) ?></h4>
                    <h4 style="margin-bottom: 0px" class="float-right">Waktu : <span id="time"></span>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-2">
        <div class="col-sm-12">
            <div class="card shadow" style="">
                <div class="card-body" >
                    <?php if ($questions[$questions_index]['image'] != '') : ?>
                    <div style="overflow-x: auto; white-space: nowrap;">
                    <img style="min-width: 500px;" class="img-fluit w-100" src="<?= base_url('assets/img/'.$questions[$questions_index]['image']) ?>"
                        alt="">
                    </div>
                    
                    <?php endif; ?>
                    <!-- <h5 class="card-title">Soal <?= $questions_index + 1; ?>
                    </h5> -->
                    <p class="card-text"></p>
                    <div class="form-group">
                        <div class="p-2" style="border: 1px solid rgba(0, 0, 0, .2); border-radius: 5px;min-height: 100px;">
                            <?= $questions_index + 1 .'. '. $questions[$questions_index]['text']; ?>
                        </div>
                        <!-- <textarea class="form-control bg-white" id="exampleFormControlTextarea1" rows="6"
                            readonly><?= $questions[$questions_index]['text']; ?></textarea> -->
                    </div>
                    <form id='answer_form'
                        action="<?= base_url('exam/next'); ?>"
                        method="post">
                        <?php foreach ($questions[$questions_index]['answers'] as $key => $answers) : ?>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="answer"
                                            aria-label="Radio button for following text input"
                                            value='<?= $answers['answers_id'] ?>'>
                                    </div>
                                </div>
                                <div style="height: auto;" class="form-control bg-white">
                                    <?php if ($answers['image'] != ''): ?>
                                        <div class="mb-1" style="overflow-x: auto; white-space: nowrap;">
                                                <img class="img-fluid" style="min-width: 200px;"
                                                src="<?= base_url('assets/img/answers/'.$answers['answers_id'].'/').$answers['image']; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div style="height: auto;"><?= $answers['text'] ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php if($questions_index == (count($questions) - 1)): ?>
                        <button type="submit" class="btn btn-outline-primary float-right">Selesai</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-outline-primary float-right">Next</button>
                        <?php endif; ?>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <script>
        var time;

        function startTimer(duration, display) {
            var start = Date.now(),
                diff,
                minutes,
                seconds;

            function timer() {
                // get the number of seconds that have elapsed since 
                // startTimer() was called
                diff = duration - (((Date.now() - start) / 1000) | 0);

                // does the same job as parseInt truncates the float
                minutes = (diff / 60) | 0;
                seconds = (diff % 60) | 0;

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (diff <= 0) {
                    // add one second so that the count down starts at the full duration
                    // example 05:00 not 04:59
                    start = Date.now() + 1000;
                    onTimeOut();
                }
            };
            // we don't want to wait a full second before the timer starts
            timer();
            time = setInterval(timer, 1000);
        }

        window.onload = function() {
            var fiveMinutes = <?= $remaining_time ?> ,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };

        function onTimeOut() {
            clearInterval(time);
            var answer_form = $('#answer_form');

            var inputs = answer_form.find("input");

            inputs.prop("disabled", true);
            answer_form.submit();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
        < /div>