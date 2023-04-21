<div class="sc-bottom-bar">
    <a href="{{ route('account') }}" class="sc-menu-item sc-current">
        <i data-feather="home"></i>
    </a>
    <a class="sc-menu-item" href="{{route('vtu')}}">
        <i data-feather="repeat"></i>
    </a>
    <div id="popMenu" class="pop-menu">
        <a class="sc-menu-item floating-btn"
            onclick="document.getElementById('popMenu').classList.toggle('active');">
            <i data-feather="settings"></i>
        </a>

        <div class="items-wrapper">
            <a href="{{route('logout')}}" class="menu-item">
                <i data-feather="log-out"></i>
                <span class="menu-text">Logout</span>
            </a>
            <a href="{{route('news')}}" class="menu-item">
                <i data-feather="share-2"></i>
                <span class="menu-text">Posts</span>
            </a>
            <a href="{{route('editAccount')}}" class="menu-item">
                <i data-feather="user"></i>
                <span class="menu-text">Profile</span>
            </a>
            @if (Auth::user()->influencer)
              <a href="{{route('influencerAccount')}}" class="menu-item">
                  <i data-feather="bar-chart-2"></i>
                  <span class="menu-text">Influencer</span>
              </a>
            @endif
        </div>
    </div>

    <a href="javascript:void(0);" data-toggle="push-menu" role="button" class="sc-menu-item">
        <i data-feather="list"></i>
    </a>
</div>
