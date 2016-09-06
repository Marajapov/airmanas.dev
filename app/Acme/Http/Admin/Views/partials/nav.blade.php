    <!-- sidebar menu -->
    <div class="sidebar" data-color="blue" data-image="{{ asset('images/admin/img/sidebar-5.jpg') }}">
        <!--
            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag
        -->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Air Manas
                </a>
            </div>

            <ul id="mainNav" class="nav">
                <li>
                    <a href="{{ route('admin.home') }}" data-href="{{ route('admin.home') }}">
                        <i class="pe-7s-graph"></i>
                        <p>Главная</p>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.city.index') }}" data-href="{{ route('admin.city.index') }}">
                        <i class="pe-7s-keypad"></i>
                        <p>Города</p>
                    </a>
                </li>
                <li>
                
                <li>
                    <a href="{{ route('admin.user.index') }}" data-href="{{ route('admin.user.index') }}">
                        <i class="pe-7s-users"></i>
                        <p>Пользователи</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--  end sidebar menu -->

    <div class="main-panel">