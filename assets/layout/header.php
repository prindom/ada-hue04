<div class="container" id="logout-container">
    <form id="logout" class = "form-group">
        <input type = "submit" value ="logout" class="btn btn-danger form-control">
    </form>
</div>

<div id="loadingScreen"><img src="./assets/images/loading.gif" alt="..."></div>

<script>
    $(document).ready(function () {
       //setTimeout(loadingDone, 3000)
    });

    /*function loadingDone() {
        $('#loadingScreen').fadeOut();
        $('body').css('overflowY','auto')
    }*/
</script>