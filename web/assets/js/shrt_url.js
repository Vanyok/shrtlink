$(document).ready(function () {
    $('.datepicker').datepicker({
        dateFormat: "yy-mm-dd"
    })
});

function createLink() {
    $.ajax({
        url: ajax_url,
        dataType: "json",
        type: 'POST',
        data: $("#link-form").serialize(),
        success: function (data) {
            if (data.status == "ok") {
                $("#result").html(data.html);
                $("#status").show();
            }
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}