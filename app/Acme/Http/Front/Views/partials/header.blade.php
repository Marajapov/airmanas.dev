
<div class="header">
    <div class="top clearfix">
        <div class="logo col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <!-- 
        <a class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding navbar-brand" href="{{ route('front.home')}}">
            <img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{ asset('front/images/logo.png') }}" alt=""/>
        </a> -->

        <a class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding" href="index.php">
            <img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{ asset('assets/css/img/logo-flykg.png') }}" alt=""/>
        </a>

        </div>
        <div class="tel col-lg-7 col-md-7 col-sm-6 col-xs-9 no-padding hidden-xs">
            <h3 class="col-lg-12 text-right"><span class="tel-number">+996 (312) 89-56-20</span></h3>
            <h5 class="col-lg-12 text-right">саат 9:00 дөн 18:00 гө чейин</h5>
        </div>
        <div class="support col-lg-1 col-md-1 col-sm-2 col-xs-3 no-padding hidden-xs">
            <img class="col-lg-12 col-md-12 col-sm-12 col-xs-12" src="{{ asset('assets/images/call2.png') }}" alt=""/>
        </div>
    </div>

    <div class="navbar navbar-default">
        <div class="container no-padding">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <i class="fa fa-bars fa-2x"></i>
                </button>
                <div class="support col-xs-3 no-padding pull-left hidden-lg hidden-md hidden-sm visible-xs">
                    <a href="#" data-toggle="modal" data-target="#myModal"><i class="col-xs-12 fa fa-2x fa-phone"></i></a>
                </div>
            </div>

            <div class="collapse navbar-collapse navHeaderCollapse no-padding">
                <ul class="nav nav-justified navbar-nav navbar-left main-nav">
                    <li class="divider-vertical"><a href="{{ asset('') }}">Fly24</a></li>
                    <li class="divider-vertical"><a href="#">Маалыматтар жана кызматтар </a></li>
                    <li class="divider-vertical"><a href="#">КОМПАНИЯ ЖӨНҮНДӨ</a></li>
                    <li class="divider-vertical"><a href="#">Байланышуу</a></li>
                </ul>
            </div>

        </div>
    </div>

    <!-- modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Колдоо кызматы</h4>
                </div>
                <div class="modal-body">
                    <h3 class="col-lg-12 text-center"><span class="tel-number text-danger">+996 (312) 89-56-20</span></h3>
                    <h5 class="col-lg-12 text-center">саат 9:00 дөн 18:00 гө чейин</h5>
                </div>
            </div>
        </div>
    </div>

</div>