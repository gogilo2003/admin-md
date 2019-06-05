tinymce.init({
    plugins: 'code link image lists table paste preview print anchor fullscreen',
    selector: ".tinymce",
    toolbar: 'styleselect | bold italic underline strikethrough removeformat | alignleft aligncenter alignright alignjustify lists | cut copy paste | bullist numlist | outdent indent blockquote | subscript superscript | undo redo | link unlink image table| code print preview fullscreen',
    menubar: false,
    allow_conditional_comments: false,
    content_css: contentCSS,
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', images_upload_url);

        xhr.onload = function () {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        formData.append('_token', '{{ csrf_token() }}');

        xhr.send(formData);
    }
});

// $('input[type=file]').bootstrapFileInput();


$(document).ready(function () {
    $('.selectpicker').selectpicker({
        "style": "btn btn-link",
        "liveSearch": true,
        "size": 5
    });
    $('.navbar .dropdown-toggle').dropdownHover();

    let icons = {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }

    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true,
        icons
    });
    $('.timepicker').datetimepicker({
        locale: 'en',
        format: 'LT',
        icons
    });

    $(".datepicker").datetimepicker({
        format: 'YYYY-MM-DD',
        icons
    });

    $('.typeahead').typeahead()

    $('.datatable').dataTable();

})
