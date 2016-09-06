<div class="row">
    <header>
        <nav class="navbar navbar-default">
            <div class="container navbar-top">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('front.home')}}">
                        <img src="{{ asset('front/images/logo.png') }}" alt=""/>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About "Air Manas"<i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">О компании</a></li>
                                <li><a href="#">HR</a></li>
                                <li><a href="#">Карго</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Вопросы и ответы</a></li>
                        <li><a href="#">Контакты</a></li>
                        <li>
                            <div class="row">
                                 <form class="form-search" action="#" method="get">
                                    <div class="form-group navbar-search">
                                        <i class="fa fa-search"></i>
                                        <input type="text" name="search" class="form-control" placeholder="Поиск" />
                                    </div>                              
                                </form>
                            </div>
                        </li>
                        <li>
                            <div class="pull-right">
                                <!-- <li @if(app()->getlocale() == 'kg') class="active" @endif><a href="/locale/kg">кырг <span></span></a></li> -->
                                <li @if(app()->getlocale() == 'ru') class="active" @endif><a href="/locale/ru">Русский <span></span></a></li>
                                <li>/</li>
                                <li @if(app()->getlocale() == 'en') class="active" @endif><a href="/locale/en">English <span></span></a></li>
                                        
                            </div>    
                        </li>
                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <nav class="navbar">
          <div class="container navbar-bottom">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a class="dashed-border" href="#"><i class="fa fa-anchor" aria-hidden="true"></i>For Passengers</a></li>
                <li><a class="dashed-border" href="#"><i class="fa fa-coffee" aria-hidden="true"></i>Air Cafe</a></li>
                <li><a href="#"><i class="fa fa-asterisk" aria-hidden="true"></i>Contacts</a></li>
              </ul>
            </div>
          </div>
        </nav>
    </header>
</div>