<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <a class="navbar-brand navbar-logo" href="<?php echo $this->router->generate( 'home' ); ?>">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link <?php echo $this->get_active_css( 'courses' ); ?>" href="<?php echo $this->router->generate( 'courses' ); ?>">Programm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $this->get_active_css( 'impressions' ); ?>" href="<?php echo $this->router->generate( 'impressions' ); ?>">Impressionen</a>
            </li>
        </ul>
    </div>
</nav>
