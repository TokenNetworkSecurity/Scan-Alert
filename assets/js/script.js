$('select[name="grade"]').on('change', function(){
    $("#submit-btn").show(1000);
    $.ajax({
        type: "GET",
        url: "functions.php",
        data: {
            todo: 'print_subjects_by_grade',
            grade: $('select[name="grade"]').val()
        },
        success: function(data){
            console.log('Ok');
            var jsonData = JSON.parse(data);
            //document.getElementById("messages").innerHTML = jsonData.result;
            $('.custom-select#subject').html(jsonData.subject_options);
            $('#subjects-container').show(500);
        }
    });
});

var count = 0;
$('#show-answers').on('click', function(){
    if (count % 2 == 0){
        $('.answer').show(1000);
        //$('#ans-style').html('.answer { display:block; }');
        $(this).text('Hide answers');
        $(this).attr('id', 'hide-answers');
    } else {
        $('.answer').hide(1000);
        //$('#ans-style').html('.answer { display:none; }');
        $(this).text('Show answers');
        $(this).attr('id', 'show-answers');
    }
    goTo('header', 500);
    count++;
});

var i = 0;
$('.ham').on('click', function(){
    if (i % 2 == 0){
        $('.header-nav__item').show(250);
    } else {
        $('.header-nav__item').hide(250);
    }
    i++;
});

function goTo(elem, time){
    $("html, body").animate({
        scrollTop: $(elem).offset().top},
        time
    );
}

$(function() {
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;

        var links = this.el.find('.article-title');
        links.on('click', {
            el: this.el,
            multiple: this.multiple
        }, this.dropdown)
    }

    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el;
        $this = $(this),
        $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
            $el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
        };
    }
    var accordion = new Accordion($('.accordion-container'), false);
});

