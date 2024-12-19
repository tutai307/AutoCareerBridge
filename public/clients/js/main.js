// CKEditor Configuration
CKEDITOR.config.versionCheck = false;
CKEDITOR.config.allowedContent = true;

$(document).ready(function () {
    // CKEditor Initialization
    $(".tinymce_editor_init").each(function () {
        var textareaID = $(this).attr("id");
        CKEDITOR.replace(textareaID, {
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },  // Chỉ hiển thị một số nút cơ bản
                { name: 'paragraph', items: ['NumberedList', 'BulletedList'] }
            ]
        });
    });

    // Add Image Caption Functionality
    function addImageCaption(img) {
        var altText = $(img).attr('alt');
        if (altText) {
            var caption = $('<div>', {
                'class': 'image-caption',
                'text': altText,
                'css': {
                    'text-align': 'center',
                    'font-style': 'italic'
                }
            });
            $(img).after(caption);
        }
    }

    CKEDITOR.on('instanceReady', function (evt) {
        var editor = evt.editor;
        $(document).on("click", ".cke_dialog_ui_button_ok", function () {
            setTimeout(function () {
                var images = $(editor.document.$).find('img');
                images.each(function () {
                    if (!$(this).next().hasClass('image-caption')) {
                        addImageCaption(this);
                    }
                });
            }, 100);
        });
    });

    // Bootstrap Tooltip Initialization
    $('[data-bs-toggle="tooltip"]').tooltip();
});
