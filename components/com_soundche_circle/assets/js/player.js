(function ($) {
    Number.prototype.toMMSS = function () {

        var minutes = Math.round(this / 60);
        var seconds = Math.round(this % 60);

        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
        return minutes + ':' + seconds;
    };


    var app = function () {
        var audio,
            runTextInteraval,
            volume = 0.5;


        function runningTitle(element) {
            var text = element.siblings('.title').children();
            var widthOffset = -(text.width() - 175);
            var width = 0;

            var moveText = function () {
                text.css({
                    'text-indent': width + 'px'
                });

                width -= 1;
                console.log('width' + width);
                console.log('offsetWidth' + widthOffset);

                if (width < widthOffset) {
                    width = 0;
                }

                runTextInteraval = setTimeout(function () {
                    moveText();
                }, 100)
            };

            moveText();
        }


        function play() {
            var audio = $(this).parent().siblings('audio');
            $('.audio-container').find('.title').children().css('text-indent', '0px');
            pause();
            audio.trigger('play');
            $(this).toggleClass("play pause");
            timeLine(audio);
            clearTimeout(runTextInteraval);
            runningTitle(audio);
        }

        function pause() {
            console.log('pause');
            var cont = $('.audio-container');
            $('audio').trigger('pause');
            cont.find('.playPause.pause').toggleClass("pause play");
        }

        function timeLine(el) {
            el[0].addEventListener('timeupdate', function () {
                var width = $('.time-line').width();
                var expired = el.prop('currentTime');
                var duration = el.prop('duration');
                var current = ( expired * width ) / duration;

                el.siblings('.time').find('.current-time').text(expired.toMMSS());

                el.siblings('.time-line').slider({
                    min: 0,
                    max: duration,
                    value: expired,
                    slide: function (event, ui) {
                        el.prop('currentTime', ui.value);
                    }
                });
            });

            setInterval(function () {

                }, 1000
            );
        }

        function volumeControl(e, ui) {
            e.target.parentElement.getElementsByTagName('audio')[0].volume = ui.value / 100;
        }


        //this.init = function () {
        var audioContainer = $('.container');
        audioContainer.on('click', '.play', play);
        audioContainer.on('click', '.pause', pause);
        $('.volume-control').click(volumeControl)


        $('audio').prop('volume', volume);

        $('.volume-control').slider({
            min: 0,
            max: 100,
            value: volume * 100,
            slide: volumeControl
        });

        $('.time-line').slider();
        //};


        $('audio').bind('progress', function () {
            var maxduration = this.duration;
            var currentBuffer = this.buffered.end(0);
            var percentage = 100 * currentBuffer / maxduration;
            //console.log('buffer :' + percentage);
            $(this).siblings('.time-line').find('.bufferBar').css('width', percentage + '%');
        });
    };


    $(document).ready(app);

})(jQuery);