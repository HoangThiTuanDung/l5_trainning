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

        if ($(e.target).attr('data-type') != undefined) {
            data.re_learn = $(e.target).attr('data-type');
        }
        
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
            if (resp.msg === 'complete') {
                window.location.href = '/lessons/' + lesson_id + '/result';
            }
            $('.panel-body').empty();
            $('.panel-body').append(resp.msg);
            $('.btn-next-word').attr('disabled', true);
        });
    });

    $('.panel-body').on('click', '#btn-filter', function (e) {
        e.preventDefault();
        var errors = [];
        var category = $('#category').val();
        var flag = $('#frm-search').find('.flag:checked').val();
        var data = {category: category, flag: flag, _token: token};

        if (category == undefined ||category == 0) {
            errors.push('Please choose category before filter!');
        }

        if (flag == undefined) {
            errors.push('Please choose word status before filter!');
        }

        $('.panel-body #results').empty();
        $('.panel-body #display-errors').empty();

        if (errors.length == 0) {
            $.ajax({
                url: '/words/search',
                method: 'GET',
                data: data,
                dataType: 'JSON',
                statusCode:{
                    400: function () {
                        alert('Error, Please reload page!');
                    },
                    401: function () {
                        alert('Please login!');
                        window.location.href = "/";
                    },
                    422: function (resp) {
                        var errors = displayError(resp.responseJSON.errors);
                        $('.panel-body #display-errors').append(errors);
                    }
                }
            }).done(function (resp) {
                $('.panel-body #results').append(resp.results);
            });
        } else {
            var displayErrors = displayError(errors);
            $('.panel-body #display-errors').append(displayErrors);
        }
    });
});

function displayError (errors)
{
    var html = '';
    html += '<div class="alert alert-warning">';
    html += '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>';
    html += '<strong>You have ' + errors.length + ' error: </strong>';
    html += '<ul>';

    if (errors.length > 0) {
        if ($.isArray(errors)) {
            $.each(errors, function (index, error) {
                html += '<li>' + error + '</li>';
            });
        } else {
            html += '<li>' + errors + '</li>';
        }
    }

    html += '</ul>';
    html += '</div>';

    return html;
}
