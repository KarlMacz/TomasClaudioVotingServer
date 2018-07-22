function openModal(id) {
    $('#' + id + '.modal').fadeIn(250);
}

function closeModal(id) {
    $('#' + id + '.modal').fadeOut(250);
}

function initializeInputFields() {
    $('body').on('change', '.file-control', function(e) {
        var files = '';
        var filename = '';
        var filenameLength = 0;
        var parent = $(this).parent();

        if(e.target.files.length > 0) {
            for(var i = 0; i < e.target.files.length; i++) {
                filenameLength = e.target.files[i].name.length;

                if(filenameLength > 25) {
                    filename = e.target.files[i].name.substring(0, 10) + '...' + e.target.files[i].name.substring(filenameLength - 10);
                } else {
                    filename = e.target.files[i].name;
                }

                files += (i !== 0 ? ', ' : '') + filename;
            }
        } else {
            files = '<strong>Choose a file</strong> or drag it here.';
        }

        parent.find('.file-control-label').html('<div class="text-center">' + files + '</div>');
    });

    $('body').on('change', '.image-control', function(e) {
        var thisInput = this;
        var parent = $(this).parent();

        parent.find('.image-preview').html('');

        if(e.target.files.length > 0) {
            for(var i = 0; i < e.target.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function(ez) {
                    parent.find('.image-preview').append('<img src="' + ez.target.result + '">');
                }

                reader.readAsDataURL(e.target.files[i]);
            }
        } else {
            parent.find('.image-preview').html('<div class="text-center"><strong>Choose an image</strong> or drag it here.</div>');
        }
    });
}

function initializeModals() {
    $('body').on('click', '.modal.dismiss-on-click > .modal-content', function() {
        closeModal($(this).parent().attr('id'));
    });

    $('body').on('click', '.modal-content-inner', function(e) {
        e.stopPropagation();
    });
}

function initializeNavbars() {
    $('body').on('click', '.navbar .dropdown > .item', function(e) {
        e.stopPropagation();

        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }

        return false;
    });
}

$(document).ready(function() {
    initializeInputFields();
    initializeModals();
    initializeNavbars();

    $('body').on('click', function() {
        $('.navbar .dropdown > .item').removeClass('active');
    });

    $('body').on('click', '.logout-button', function() {
        $('#logout-form').submit();

        return false;
    });
});
