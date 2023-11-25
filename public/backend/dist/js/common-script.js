$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function deleteRecord(route) {
    var formObj = document.frmListing;

    if (confirm("sure you want to delete this record")) {
        formObj._method.value = "delete";
        formObj.action = route;
        formObj.submit();
    }

    return false;
}
