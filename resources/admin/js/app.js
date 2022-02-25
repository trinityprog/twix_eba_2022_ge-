import $ from "jquery";
import Alpine from 'alpinejs';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

require('inputmask');

window.Alpine = Alpine;
window.$ = $;
window.jQuery = $;

Alpine.start()

$(document).ready(() => {
    if($('#rules_input').length) {
        $('#rules_input').change(function () {
            $(this).siblings('span').text(this.files[0].name)
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).closest('.image_wrapper').find('img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    if($('.image').length) {
        $('.image').change(function () {
            $(this).siblings('span').text(this.files[0].name).css({textTransform: 'none'})
            readURL(this);
        });
    }


    if($('#answer').length) {
        ClassicEditor
            .create(document.querySelector('#answer'))
            .catch(error => {
                console.error(error);
            });
    }

    if($('input[name=search_by_phone]').length || $('input[name=phone]').length) {
        Inputmask({
            mask: document.querySelector('meta[name=inputmask]').attributes.content.value,
            clearIncomplete: true
        }).mask(document.querySelectorAll('input[name=search_by_phone], input[name=phone]'))
    }

    if($('#status').length && $('#comment-group').length) {
        $('#status').change(function() {
            if($(this).val() == 2)
                $('#comment-group').removeClass('hidden');
            else
                $('#comment-group').addClass('hidden');
        })
    }
})
