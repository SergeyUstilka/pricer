<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">Username</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Главная</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Товары <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="" href="{{route('admin.product.index')}}">
                        <span class="fa fa-arrow-right">&nbsp;</span>Товары ({{count($products)}})
                    </a></li>
                <li><a class="" href="{{route('admin.category.index')}}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Категории ({{count($categories)}})
                    </a></li>
                <li><a class="" href="{{route('admin.shop.index')}}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Магазины ({{count($shops)}})
                    </a></li>
            </ul>
        </li>
        <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Загрузка товаров</a></li>
        <li>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button href="#" type="submit" style="background: none;border: none"><em class="fa fa-power-off">&nbsp;</em> Logout</button>
            </form>
        </li>
    </ul>
</div><!--/.sidebar-->
