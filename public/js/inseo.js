$(document).ready(function () {
    if (type != 'd73ecaaa-b3d2-4c96-b37e-868c6a8ff7e5') {
        $('#fmunit').show();
        document.getElementById("unit").required = true;
    } else {
        document.getElementById("unit").required = false;
        $('#fmunit').hide();
    }
});

$('#type').on('change', function (e) {
    var type = e.target.value;

    if (type != 'd73ecaaa-b3d2-4c96-b37e-868c6a8ff7e5') {
        $('#fmunit').show();
        document.getElementById("unit").required = true;
        $('#unit').prop('selectedIndex', 0);
    } else {
        document.getElementById("unit").required = false;
        $('#unit').prop('selectedIndex', 0);
        $('#fmunit').hide();
    }
});
