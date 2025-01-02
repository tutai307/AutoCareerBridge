// Notification
async function changeStatus(id) {
    fetch(`/notifications/seen?id=${id}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(err => {
            console.error(err);
        });
}

// Theme admin
$(function () {
    $("#datepicker").datepicker({
        autoclose: true,
        todayHighlight: true
    }).datepicker('update', new Date());
});

$(document).ready(function () {
    $(".booking-calender .fa.fa-clock-o").removeClass(this);
    $(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
});
// $('.my-select').selectpicker();

jQuery(document).ready(function () {
    setTimeout(function () {
        dlabSettingsOptions.version = 'light';
        new dlabSettings(dlabSettingsOptions);
    }, 1000)
    jQuery(window).on('resize', function () {
        dlabSettingsOptions.version = 'light';
        new dlabSettings(dlabSettingsOptions);
        jQuery('.dz-theme-mode').addClass('active');
    });
});

// change slug from name
function ChangeToSlug() {
    var title, slug;
    title = document.getElementById("name").value;
    slug = title.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    document.getElementById('slug').value = slug;
}


// ckediter
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
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
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

// Change status
let btn_change_status = $(".toggle-status-btn");
btn_change_status.on('click', function () {
    let id = $(this).data('id');
    let url = $(this).data('url');
    let token = $('meta[name="csrf-token"]').attr('content');
    let thisBtn = $(this);

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: token,
            id: id,
        },
        success: function (response) {
            if (response.code == 200) {
                if (response.status == 1) {
                    thisBtn.removeClass('btn-danger').addClass('btn-success').text("Hiển thị");
                } else {
                    thisBtn.removeClass('btn-success').addClass('btn-danger').text("Ẩn");
                }
            }
        }
    });
});

// Change hot
let btn_change_hot = $(".toggle-hot-btn");
btn_change_hot.on('click', function () {
    let id = $(this).data('id');
    let url = $(this).data('url');
    let token = $('meta[name="csrf-token"]').attr('content');
    let thisBtn = $(this);

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: token,
            id: id,
        },
        success: function (response) {
            if (response.code == 200) {
                if (response.hot == 1) {
                    thisBtn.removeClass('btn-danger').addClass('btn-success').text("Nổi bật");
                } else {
                    thisBtn.removeClass('btn-success').addClass('btn-danger').text("Không nổi bật");
                }
            }
        }
    });
});

// js change image
var openFile = function (file) {
    var input = file.target;
    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById('imagePreview');
        output.style.backgroundImage = "url(" + dataURL + ")";
    };
    reader.readAsDataURL(input.files[0]);
};

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUpload").on('change', function () {
    readURL(this);
});
// Xóa ajax
$(".btn-remove").on('click', function () {
    let type = $(this).data('type');
    let url = $(this).data('url');
    let token = $('meta[name="csrf-token"]').attr('content');
    let thisBtn = $(this);

    const message = $(this).data('message');
    const irreversibleAction = $(this).data('irreversible_action');
    const del = $(this).data('delete');
    const cancel = $(this).data('cancel');

    Swal.fire({
        title: message,
        text: irreversibleAction,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: del,
        cancelButtonText: cancel
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: type,
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                success: function (response) {
                    if (response.code == 200) {
                        thisBtn.closest("tr").remove();
                        toastr.success("", response.message)
                    }

                    if (response.code == 400) {
                        toastr.error("", response.message)
                    }
                },
                error: function (response) {
                    if (response.responseJSON.code == 400) {
                        toastr.error("", response.message)
                    }
                }
            })
        }
    });
})
// language
document.querySelector('.onchange-language').addEventListener('change', function (e) {
    var url = e.target.getAttribute('data-url-language');
    window.location.href = `${url}/` + e.target.value;
})

// logout
document.querySelector('.btn-logout').addEventListener('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: "Đăng xuất",
        text: "Bạn có muốn đăng xuất không ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#01a3ff",
        cancelButtonColor: "#fd5353",
        confirmButtonText: "Đăng xuất",
        cancelButtonText: "Thoát"
    }).then((result) => {
        if (result.isConfirmed) {
            let form = $(this).closest('form');
            form.submit();
        }
    });
});


