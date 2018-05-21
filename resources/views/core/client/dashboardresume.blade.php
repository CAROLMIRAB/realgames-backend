<div class="row transaction-resume" data-route="{{ route('dashboard.resume') }}">
    <div class="col-lg-3 col-xs-6 col" id="1" n="1">
        <div class="info-box bg-gray profit-box" >
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">{{ __('Usuarios') }}</span>
                <span class="number-user info-box-number">0</span>
                <div class="progress">
                    <div class="progress-bar p-number-user"></div>
                </div>
                  <span class="progress-description p-number-user-desc">
                  <span class="percent-user" style="width: 100%"></span> {{ __('') }}
                  </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6 col" id="2" n="2">
        <div class="info-box bg-gray profit-box" >
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">{{ __('Jugado del día') }}</span>
                <span class="played-day info-box-number">0</span>
                <div class="progress">
                    <div class="progress-bar p-played"></div>
                </div>
                  <span class="progress-description p-played-desc">
                  <span class="percent-played"></span> {{ __('de incremento en relación al día de ayer') }}
                  </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6 col" id="3" n="3">
        <div class="info-box bg-gray profit-box">
            <span class="info-box-icon"><i class="ion-ribbon-b"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('Ganado del día') }}</span>
                <span class="won-day info-box-number">0</span>
                <div class="progress">
                    <div class="progress-bar p-won"></div>
                </div>
                  <span class="progress-description p-won-desc">
                  <span class="percent-won"></span> {{ __('de incremento en relación al día de ayer') }}
                  </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6 col" id="4" n="4">
        <div class="info-box bg-gray profit-box">
            <span class="info-box-icon"><i class="ion-bag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('Profit del día') }}</span>
                <span class="profit info-box-number">0</span>
                <div class="progress">
                    <div class="progress-bar p-profit"></div>
                </div>
                  <span class="progress-description p-profit-desc">
                  <span class="percent-profit"></span> {{ __('de incremento en relación al día de ayer') }}
                  </span>
            </div>
        </div>
    </div>
</div>