$('#statuspay').on('click', function (e) {
    var pay = e.target.checked;

    if (pay != false) {
        $('#fmpay').show();
    } else {
        $('#fmpay').hide();
    }
});
