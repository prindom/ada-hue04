$(document).ready(function(){
    $("login").submit(function(e){
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: ajaxurl,
            data: {
                login_id: $("[name='login_id']").val(),
                action: ""
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