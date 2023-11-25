var page = 2;
var is_more_data_available = true;
var selected_color_id = null;
var selected_size_id = null;

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $("#type").change(function () {
        page = 1;
        is_more_data_available = true;
        loadMore(true);
    });

    $("#price").change(function () {
        page = 1;
        is_more_data_available = true;
        loadMore(true);
    });

    $("#sort").change(function () {
        page = 1;
        is_more_data_available = true;
        loadMore(true);
    });
});

function loadMore(want_to_clear_list = false) {
    search_val = null;
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === "search") search_val = decodeURIComponent(tmp[1]);
        });

    var type = $("#type").val();
    var price = $("#price").val();
    var sort = $("#sort").val();
    var load_more = $("#load_more");
    var product_list = $("#product-list");

    if (is_more_data_available) {
        $.get(
            LOAD_MORE_URL,
            { type, price, sort, page, search_val },
            function (result) {
                if (want_to_clear_list) {
                    product_list.empty();
                }

                if (result) {
                    page++;
                    product_list.append(result);
                } else {
                    is_more_data_available = false;
                    load_more.html("No data to load");
                }
            }
        );
    }
}

function getSize(color_id, product_id) {
    selected_color_id = color_id;
    selected_size_id = null;

    $.get(GET_SIZES_URL, { color_id, product_id }, function (result) {
        $(".product-size-variation").removeClass("d-none");
        // $(".color_" + color_id).addClass("color-extra-active");
        $(".range-variant").empty();
        $(".range-variant").append(result);
    });
}

function selectSize(size_id) {
    selected_size_id = size_id;
}

function addToWishList(product_id) {
    $.ajax({
        url: ADD_TO_WISH_LIST,
        method: "POST",
        data: {
            product_id: product_id,
        },
        success: function (res) {
            if (res) {
                window.location.href = res;
            }
        },
    });
}
