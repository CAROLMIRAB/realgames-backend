<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin-lte/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->username }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{ __('Online') }}</a>
            </div>
        </div>
        @if(\Auth::user()->rol == 1)
            <form action="{{ route('users.search') }}" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="{{ __('Buscar') }}">
                    <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
        @else
            <form action="{{ route('clients.searchclients') }}" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="{{ __('Buscar') }}">
                    <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
        @endif
        <ul class="sidebar-menu">
            <li class="header">{{ __('MENÚ') }}</li>
            {!! \Utils::buildMenu() !!}
        </ul>
    </section>
</aside>