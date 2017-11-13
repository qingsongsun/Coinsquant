<div class="m-purchase-progress">
    <div class="row">
        <div class="col-xs-6 col-sm-4 fund-number">
            <div class="fund-value" data-count="150"></div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="fund-key">基础目标</div>
                </div>

                <div class="col-xs-6">
                    <div class="fund-key">基础目标</div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-4 fund-number">
            <div class="fund-value" data-count="150"></div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="fund-key">基础目标</div>
                </div>

                <div class="col-xs-6">
                    <div class="fund-key">基础目标</div>
                </div>
            </div>
        </div>

        <div class="col-xs-6 col-sm-2 fund-number">
            <div class="fund-value" data-count="150"></div>
            <div class="fund-key">参与人数</div>
        </div>

        <div class="col-xs-6 col-sm-2 fund-number">
            <div class="fund-value" data-count="150"></div>
            <div class="fund-key">支持次数</div>
        </div>
    </div>

    <div class="progress-base">
        <div class="progress-value" style="width: 10%;"></div>
    </div>

    <div class="fund-countdown">
        截止倒计时：
        <span class="blue" id="day">00</span>天
        <span class="blue" id="hour">00</span>时
        <span class="blue" id="min">00</span>分
        <span class="blue" id="sec">00</span>秒
    </div>

    <div class="p-btn purchase-btn">立即参与</div>
</div>

<script>
    $(function () {
        // 数字跳动
        var countFlag = true;
        $(window).on('scroll', function () {
            var windowSt = $(window).scrollTop();
            var sectionSt = $('#anchor-3').scrollTop();

            if (windowSt > sectionSt - 100 && countFlag) {
                countFlag = false;

                $('.fund-value').each(function () {
                    var $this = $(this),
                        countTo = $this.attr('data-count');

                    $({countNum: 0}).animate({
                        countNum: countTo
                    }, {
                        duration: 3000,
                        easing: 'linear',
                        step: function () {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.text(this.countNum);
                        }
                    });
                });
            }
        });

        // 倒计时
        (function (target) {
            var timer;
            var targetDate = new Date(target);
            var res = {
                day: 0,
                hour: 0,
                min: 0,
                sec: 0,
            };

            var addZero = function (number) {
                number = parseInt(number);

                if (number < 0) {
                    return 0;
                } else if (number < 10) {
                    return '0' + String(number);
                } else {
                    return number;
                }
            }

            var updateTime = function () {
                var time = targetDate - new Date();
                if (time <= 0) {
                    clearInterval(timer);
                }

                res.day = addZero(time / 1000 / 60 / 60 / 24);
                res.hour = addZero(time / 1000 / 60 / 60 % 24);
                res.min = addZero(time / 1000 / 60 % 60);
                res.sec = addZero(time / 1000 % 60);

                for (key in res) {
                    $('#' + key).text(res[key]);
                }
            }

            updateTime();
            timer = setInterval(function () {
                updateTime();
            }, 1000);
        })("2017/11/11");
    });
</script>