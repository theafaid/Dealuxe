<div class="sidebar" data-color="{{$layoutColor ?: 'primary'}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{config('site.front_app_url')}}" target="_blank" class="simple-text logo-normal">
                <img class="" src="/{{siteSettings('site_logo')}}"/>
            </a>
        </div>
        <ul class="nav">
            <li class="{{activeUrl('admin.dashboard.index')}}">
                <a href="{{route('admin.dashboard.index')}}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{__('admin.home')}}</p>
                </a>
            </li>
            <li class="{{activeUrl('admin.orders.index')}}">
                <a href="{{route('admin.orders.index')}}">
                    <i class="tim-icons icon-double-left"></i>
                    <p>{{__('admin.orders')}}</p>
                </a>
            </li>
            <li class="{{activeUrl('admin.categories.index')}}">
                <a href="{{route('admin.categories.index')}}">
                    <i class="tim-icons icon-app"></i>
                    <p>{{__('admin.categories')}}</p>
                </a>
            </li>
            <li class="{{activeUrl('admin.products.index')}}">
                <a href="{{route('admin.products.index')}}">
                    <i class="tim-icons icon-app"></i>
                    <p>{{__('admin.products')}}</p>
                </a>
            </li>
            <li class="{{activeUrl('admin.shipping-methods.index')}}">
                <a href="{{route('admin.shipping-methods.index')}}">
                    <i class="tim-icons icon-app"></i>
                    <p>{{__('admin.shipping_methods')}}</p>
                </a>
            </li>
            <li class="{{activeUrl('admin.admins.index')}}">
                <a href="{{route('admin.admins.index')}}">
                    <i class="tim-icons icon-user-run"></i>
                    <p>{{__('admin.users')}}</p>
                </a>
            </li>
            <li class="{{activeUrl('admin.admins.index')}}">
                <a href="">
                    <i class="tim-icons icon-app"></i>
                    <p>{{__('admin.site_settings')}}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
