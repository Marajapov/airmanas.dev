<div class="slider-wrapper col-lg-8 col-md-8">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{ asset('assets/images/Desert.jpg') }}" alt="...">
                <div class="carousel-caption">
                    Caption
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets/images/Jellyfish.jpg') }}" alt="...">
                <div class="carousel-caption">
                    Caption
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('assets/images/Lighthouse.jpg') }}" alt="...">
                <div class="carousel-caption">
                    Caption
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>