<!--containers for favourite or recommended movies-->
<?php
if(isset($_SESSION["username"])){
    ?>
    <div class="main">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Deine Favoriten</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="carousel slide multi-item-carousel" id="theCarousel-1">
                            <div class="carousel-inner" id="favs-container">



                            </div>
                            <a class="left carousel-control" href="#theCarousel-1" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a class="right carousel-control" href="#theCarousel-1" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Diese Filme könnten dir auch gefallen</h3>
            </div>
            <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel slide multi-item-carousel" id="theCarousel-2">
                                <div class="carousel-inner" id="item-based-container">



                                </div>
                                <a class="left carousel-control" href="#theCarousel-2" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                <a class="right carousel-control" href="#theCarousel-2" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dir ähnliche Nutzer haben diese Filme gefallen</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="carousel slide multi-item-carousel" id="theCarousel-3">
                            <div class="carousel-inner" id="user-based-container">



                            </div>
                            <a class="left carousel-control" href="#theCarousel-3" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a class="right carousel-control" href="#theCarousel-3" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>



    <script>
        $(document).ready(function () {
            showFavs();
            showItemBased();
            showUserBased();
        });

    </script>

    <?php
}

?>