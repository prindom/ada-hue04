$(document).ready(function () {
    $("#login").submit(function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: window.location.href + "Controller.php",
            data: {
                login: $("[name='login_id']").val()
            },
            dataType: "json",
            success: function (data) {
                //showFavs(data);
                //showUserBased(data);
                showItemBased(data);
                $("#login-container").hide();
            },
            error: function (data) {
                alert("error");
            },
            complete: function (data) {
                //console.log(data);

            }
        })
    })
});

function showFavs(logindata) {
    console.log("favs logindata:");
    console.log(logindata);
    $.ajax({
        method: "POST",
        url: window.location.href + "Controller.php",
        data: {"method": "getFavourites"},
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data, function (key, value) {
                let $elem = $("<div class='movie'>");
                $elem.append("<p>" + value.name + "</p>");
                $elem.append("<p>" + value.rating + " of 1 Points</p>");
                $("#favs-container").append($elem);
            });
        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {

        }
    });

    $("#favs-container").removeClass("d-none");
}

function showUserBased(logindata) {

}

function showItemBased(logindata) {
    console.log("itembased logindata:");
    console.log(logindata);
    $.ajax({
        method: "POST",
        url: window.location.href + "Controller.php",
        data: {"method": "getItemBased"},
        dataType: "json",
        success: function (data) {
            console.log(data);
            $.each(data.data, function (key, value) {

                let $elem = $("<div class='movie'>");
                $elem.append("<p>" + value.product_name + "</p>");

                let reasons = "<p>Because you liked ";
                $.each(value.reasons, function (subkey, subvalue) {
                    console.log(subvalue);
                    reasons += subvalue.product_name+",";
                });

                reasons += ".</p>";

                $elem.append($(reasons));

                $("#item-based-container").append($elem);
            });
        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {

        }
    });

    $("#item-based-container").removeClass("d-none");
}