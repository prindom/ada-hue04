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
function showFavs(data) {

    $.each(data, function (key, value) {
        $elem = $("<div class='movie'>");
        console.log(value);

        $("#favs-container").append($elem);
    });

    $("#favs-container").removeClass("d-none");
}