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
                if(data.found === true)
                location.reload();
                else {
                    $('#login-container').append('<div class="alert alert-danger" role="alert">\n' +
                        '  <a href="#" class="alert-link">Für diesen Nutzer sind leider keine Filmvorschläge verfügbar :/</a>' +
                        '</div>')
                }

            },
            error: function (data) {
                console.log(data);
            },
            complete: function (data) {
            }
        })
    });

    $("#logout").submit(function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: window.location.href + "Controller.php",
            data: {"method": "logout"},
            dataType: "json",
            success: function (data) {
                location.reload();
                $("#login-container").show();
                $("#logout-container").hide();
            },
            error: function (data) {
                console.log(data)
            },
            complete: function (data) {
                console.log(data);

            }
        })
    });

});

function showFavs() {
    console.log("showFavs");
    $.ajax({
        method: "POST",
        url: window.location.href + "Controller.php",
        data: {"method": "getFavourites"},
        dataType: "json",
        success: function (data) {
            let i = 0;
            $.each(data.favorites, function (key, value) {
                let active = "";

                if (i === 0) active = "active";

                let title = value.name;
                let year = title.match(/(\()([1-9])([0-9])([0-9])([0-9])(\))/g);
                year = title.match(/([1-9])([0-9])([0-9])([0-9])/g);
                year = year[0];
                let name = title.substr(0,title.length-7);
                name = name.replace(/ /g, '+');
                getSrc(name, year, function(src){
                    let $elem = $('<div class="item '+ active +'"><div class="col-md-4">\n' +
                        '                <div class="thumbnail">' +
                        '                   <img src="'+ src +'" alt="..." height="200">\n' +
                        '                    <div class="caption">\n' +
                        '                        <h3>' + value.name + '</h3>\n' +
                        '                        <p>Bewertung: ' + value.rating + ' Sterne</p>\n' +
                        '                    </div>' +
                        '                    </div></div></div> ');
                    $("#favs-container").append($elem);
                });





                i++;
            });


        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {
            console.log("favsDone");
        }
    });

}

function showUserBased() {
    console.log("showUserBased");

    $.ajax({
        method: "POST",
        url: window.location.href + "Controller.php",
        data: {"method": "getUserBased"},
        dataType: "json",
        success: function (data) {
            let i = 0;
            $.each(data.recommendations, function (key, value) {
                let active = "";

                if (i === 0) active = "active";
                    let title = value;
                    let year = title.match(/(\()([1-9])([0-9])([0-9])([0-9])(\))/g);
                    year = title.match(/([1-9])([0-9])([0-9])([0-9])/g);
                    year = year[0];
                    let name = title.substr(0,title.length-7);
                    name = name.replace(/ /g, '+');
                    getSrc(name, year, function(src) {

                        let $elem = $('<div class="item ' + active + '"><div class="col-md-4">\n' +
                            '                <div class="thumbnail">' +
                            '                   <img src="'+src+'" alt="..." height="200">\n' +
                            '                    <div class="caption">\n' +
                            '                        <h3>' + value + '</h3>\n' +
                            '                    </div>' +
                            '                    </div></div></div> ');

                        $("#user-based-container").append($elem);

                    });


                i++;
            });

        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {
            console.log("userDone");
            setTimeout(carousel,1000);
        }

    });

}


function showItemBased() {
    console.log("showItemBased");
    console.log("in");
    $.ajax({
        method: "POST",
        url: window.location.href + "Controller.php",
        data: {"method": "getItemBased"},
        dataType: "json",
        success: function (data) {
            let i = 0;
            $.each(data.recommendations, function (key, value) {
                let reasons = "<p>Weil dir folgende Filme gefallen haben </p>" +
                    "<ul>";
                $.each(value.reasons, function (subkey, subvalue) {


                    reasons += '<li>'+subvalue+'</li>';


                });

                reasons += ".</ul>";
                let active = "";

                if (i === 0) active = "active";

                    let title = value.name;
                    let year = title.match(/(\()([1-9])([0-9])([0-9])([0-9])(\))/g);
                    year = title.match(/([1-9])([0-9])([0-9])([0-9])/g);
                    year = year[0];
                    let name = title.substr(0,title.length-7);
                    name = name.replace(/ /g, '+');
                    getSrc(name, year, function(src) {

                        let $elem = $('<div class="item ' + active + '"><div class="col-md-4">\n' +
                            '                <div class="thumbnail">' +
                            '                   <img src="'+src+'" alt="..." height="500">\n' +
                            '                    <div class="caption">\n' +
                            '                        <h3>' + value.name + '</h3>\n' +
                            '                        <p>' + reasons + '</p>\n' +
                            '                    </div>' +
                            '                    </div></div></div> ');


                        $("#item-based-container").append($elem);

                    });
                i++;
            });

        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {
            console.log("itemDone");
        }
    });

}



function carousel() {

    console.log("in");

    $('.multi-item-carousel').carousel({
        interval: false
    });

    $('.multi-item-carousel .item').each(function(){
        let next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        if (next.next().length>0) {
            next.next().children(':first-child').clone().appendTo($(this));
        } else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });
}

function getSrc(name, year, callback){
    $.ajax({
        method: "GET",
        url: 'http://www.omdbapi.com/?t='+ name +'&y='+ year +'&apikey=7c130ecc',
        dataType: "json",
        success: function (data) {
            if(!data.imdbID) data.imdbID = 'tt0076759';

                getImage(data.imdbID, function(src){
                    callback(src);
                });


        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {

        }
    });

}

function getImage(id, callback){
    $.ajax({
        method: "GET",
        url: 'https://api.themoviedb.org/3/movie/'+ id +'?api_key=355fa6da60ddfc07f6199b375c55f0f5',
        dataType: "json",
        success: function (data) {
            let src = "https://image.tmdb.org/t/p/w500"+data.poster_path;
            callback(src);
        },
        error: function (data) {
            console.log("error:", data);
        },
        complete: function (data) {

        }
    });
}