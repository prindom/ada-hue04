$(document).ready(function(){
    console.log("buongiorno");
    $("#login").submit(function(e){
        console.log("hey");
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: window.location.href + "Controller.php",
            data: {
                login: $("[name='login_id']").val()
            },
            dataType: "json",
            success: function(data){alert("Login successfull");
            },
            error: function (data) {
                alert("error");
            },
            complete: function (data) {
                console.log(data);

            }
        })
    })
});