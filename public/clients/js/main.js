// CKEditor Configuration
CKEDITOR.config.versionCheck = false;
CKEDITOR.config.allowedContent = true;

$(document).ready(function () {
    $(".tinymce_editor_init").each(function () {
        var textareaID = $(this).attr("id");
        CKEDITOR.replace(textareaID, {
            // Loại bỏ các plugin không cần thiết để giao diện gọn hơn
            removePlugins: 'elementspath,save',

            // Thêm các plugin bổ sung để tăng tính năng
            extraPlugins: 'image,justify,colorbutton',

            // Tùy chỉnh thanh công cụ (toolbar)
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'document', items: ['Source'] }
            ],

            // Cấu hình file upload
            filebrowserUploadUrl: '/upload-handler-url', // URL xử lý upload file
            filebrowserUploadMethod: 'form',

            // Tắt đường dẫn phần tử ở góc dưới
            removeButtons: 'Subscript,Superscript',

            // Chiều cao của trình chỉnh sửa
            height: 300
        });
    });


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
});


// avatar user
// Hàm tạo màu HEX ngẫu nhiên
function getRandomColor() {
    return '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
}
// Lấy chữ cái đầu tiên từ tên
const avatarElement = document.getElementById("avatar");
if (avatarElement) {
    const name = avatarElement.dataset.avatar
    const firstLetter = name.charAt(0);
    avatarElement.textContent = firstLetter;

    avatarElement.style.backgroundColor = getRandomColor();
}

