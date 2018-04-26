$(document).ready(function () {
    console.log("buongiorno");
    $("#login").submit(function (e) {
        console.log("hey");
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: window.location.href + "Controller.php",
            data: {
                login: $("[name='login_id']").val()
            },
            dataType: "json",
            success: function (data) {
                showFavs(data);
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

// TODO get Movies
function showFavs(logindata) {
    console.log("logindata:");
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

    $("#login-container").hide();

    $("#favs-container").removeClass("d-none");
}