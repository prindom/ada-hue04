<!--header when user is logged in -->
<div class="container" id = "welcome-container">
    <div class="container">
    <p class="col-sm-10 welcome-text-container">Hello, User <?php echo $_SESSION["username"]?></p>
    <div class="col-sm-2" id="logout-container">
        <form id="logout" class = "form-group">
            <input type = "submit" value ="logout" class="btn btn-danger form-control">
        </form>
    </div>
</div>
</div>

<!--loading animation-->
<div id="loadingScreen"><img src="./assets/images/loading.gif" alt="..."></div>

<script>
    $(document).ready(function () {
       setTimeout(loadingDone, 1000)
    });

    function loadingDone() {
        $('#loadingScreen').fadeOut();
        $('body').css('overflowY','auto')
    }
</script>