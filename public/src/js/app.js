/**
 * Created by van on 05/07/2016.
 */
$(function () {
    $('.btn-next-word').attr('disabled', true);

    $('.panel-body').on('click', '.btn-answer', function (e) {
        var word_id = $(e.target).attr('data-word');
        var word_answer_id = $(e.target).attr('data-answer');
        var lesson_id = $(e.target).attr('data-lesson');
        var data = {word_id: word_id, word_answer_id: word_answer_id, lesson_id: lesson_id, _token: token};

        $.ajax({
            url: '/lessons/answer',
            method: 'POST',
            data: data,
            dataType: 'JSON',
            statusCode:{
                400: function () {
                    alert('Error, Please reload page!');
                },
                401: function () {
                    alert('Please login!');
                    window.location.href = "/";
                }
            }
        }).done(function (resp) {
            $('.panel-body .word-answers').find('button.btn-success').removeClass('btn-success').addClass('btn-primary');
            $('.btn-next-word').attr('disabled', false);
            $(e.target).removeClass('btn-primary').addClass('btn-success');
            alert(resp.msg);
        });
    });

    $('.panel-body').on('change', '.answer-option', function () {
        $('.btn-next-word').attr('disabled', false);
    });

    $('.panel-body').on('click', '.btn-next-word', function (e) {
        var cur_word = $(e.target).attr('data-word-number');
        var lesson_id = $(e.target).attr('data-lesson-id');
        var answerIsChecked = $('.panel-body .word-answers').find('input[type="radio"]:checked');

        if (answerIsChecked.length < 0) {
            $('.btn-next-word').attr('disabled', true);
        } else {
            var word_answer_id = answerIsChecked.val();
        }
        var word_id = $(e.target).attr('data-word-id');
        var data = {cur_word: cur_word, lesson_id: lesson_id, word_id: word_id, word_answer_id: word_answer_id, _token: token};

        $.ajax({
            url: '/lessons/answer',
            method: 'POST',
            data: data,
            dataType: 'JSON',
            statusCode:{
                400: function () {
                    alert('Error, Please reload page!');
                },
                401: function () {
                    alert('Please login!');
                    window.location.href = "/";
                }
            }
        }).done(function (resp) {
            $('.panel-body').empty();
            $('.panel-body').append(resp.msg);
            $('.btn-next-word').attr('disabled', true);
        });
    });
});
