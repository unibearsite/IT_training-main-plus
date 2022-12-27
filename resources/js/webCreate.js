document.addEventListener('DOMContentLoaded', function() {

    flatpickr.l10ns.ja.firstDayOfWeek = 0;

    flatpickr('#datetimepicker', {
        wrap: true,
        enableTime: true,
        dateFormat: 'Y/m/d H:i',
        minuteIncrement: 1,
        locale: 'ja',
        clickOpens: false,
        allowInput: true,
        monthSelectorType: 'static'
    });
});

$(function() {
    $('body').fadeIn(700);
});


// 多重クリック対策
$(function() {
    $('form').submit(function() {
        $(this).find('input[type="submit"], button[type="submit"]').prop('disabled', 'true');
    });
});


// 直接書かれたCSSを無効化
$(function() {
    $('body .posts-container img').removeAttr('style');
    $('body .posts-container h2').removeAttr('style');
    $('body .posts-container h3').removeAttr('style');
    $('body .posts-container h4').removeAttr('style');
    // $('body .curriculum-container th').removeAttr('style');
    // $('body .curriculum-container span').removeAttr('style');
    // $('body .curriculum-container p').removeAttr('style');
});




// 進捗の分子
$(function() {
    const circle = document.querySelectorAll('.progress-circle');
    const progress_container = document.querySelector('.p-container' + i);
    for (var i = 1; i <= circle.length; i++) {
        var clearLength = document.querySelectorAll('.clear' + i).length;
        $('.child' + i).append(clearLength);
    }
});


// ********** モーダル **********
// お問い合わせ
$(document).on('click', '.contactForm-btn', function() {
    const title = $('input[name="title"]').val();
    const name = $('input[name="user_name"]').val();
    const message = $('textarea[name="message"]').val();

    $('.modal-title').text(title).val(title);
    $('.modal-name').text(name).val(name);
    $('.modal-message').text(message).val(message);
});
// メンタリング
$(document).on('click', '.meetingForm-btn', function() {
    const name = $('input[name="user_name"]').val();
    const perpose = $('select[name="perpose"]').val();
    const date1 = $('input[name="date1"]').val();
    const date2 = $('input[name="date2"]').val();
    const date3 = $('input[name="date3"]').val();
    const message = $('textarea[name="message"]').val();

    $('.modal-name').text(name).val(name);
    $('.modal-perpose').text(perpose).val(perpose);
    $('.modal-date1').text(date1).val(date1);
    $('.modal-date2').text(date2).val(date2);
    $('.modal-date3').text(date3).val(date3);
    $('.modal-message').text(message).val(message);
});
// ウィークリー
// $(document).on('click', '.reportForm-btn', function() {
//     const name = $('input[name="user_name"]').val();
//     const course_name = $('select[name="course_name"]').val();
//     const now_lesson = $('select[name="now_lesson"]').val();
//     const time = $('input[name="time"]').val();
//     const learn = $('input[name="learn"]').val();
//     const trouble = $('input[name="trouble"]').val();
//     const comment = $('textarea[name="comment"]').val();

//     $('.modal-name').text(name).val(name);
//     $('.modal-course_name').text(course_name).val(course_name);
//     $('.modal-now_lesson').text(now_lesson).val(now_lesson);
//     $('.modal-time').text(time).val(time);
//     $('.modal-learn').text(learn).val(learn);
//     $('.modal-trouble').text(trouble).val(trouble);
//     $('.modal-comment').text(comment).val(comment);
// });

// トップボタン
$(function() {
    //ボタンを非表示にする
    $('#topBtn').hide();
    //画面をスクロールしたとき
    window.addEventListener('scroll', function() {
        //50pxより多くスクロールした場合
        if ($(this).scrollTop() > 100) {
            //ボタンをフェードインさせる
            $('#topBtn').fadeIn();
            //それ以外の場合
        } else {
            //ボタンをフェードアウトさせる
            $('#topBtn').fadeOut();
        }
    });
    //id属性がtopBtnの要素をクリックすると
    $(document).on('click', '#topBtn', function() {
        //画面の上から0pxの所まで500ミリ秒（0.5秒）かけてアニメーションしながらスクロールする
        $('html, body').animate({ scrollTop: 0 }, 400);
    });
});

// コードの解答
//アコーディオンをクリックした時の動作
$(document).on('click', '.title', function() {
    console.log('abc');
    var findElm = $(this).next(".box"); //直後のアコーディオンを行うエリアを取得し
    $(findElm).slideToggle(); //アコーディオンの上下動作

    if ($(this).hasClass('close')) { //タイトル要素にクラス名closeがあれば
        $(this).removeClass('close'); //クラス名を除去し
    } else { //それ以外は
        $(this).addClass('close'); //クラス名closeを付与
    }
});