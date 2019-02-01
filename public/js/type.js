$("body").on("click", ".btn-add-type", function () {
    var id = $(this).parent("div").data('id');
    var type_id = document.getElementById('type_'+id).value;

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: urlType,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { event_id: id, type_id: type_id },
    }).done(function (data) {
        $("ol#"+data.eventid).append("<li>"+data.type+"</li>");
    });
});

$("body").on("click", ".btn-del-type", function () {
    var id = $(this).parent("div").data('id');
    var type_id = $(this).data('id');

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: urlTypeDel,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { event_id: id, type_id: type_id },
    }).done(function (data) {
        $("li#" + data.eventid + "_" + data.type).detach();
    });
});
