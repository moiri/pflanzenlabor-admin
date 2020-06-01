<div class="container">
    <?php $this->print_nav(); ?>
    <div class="card mt-3">
        <div class="card-body">
            <div class="lead text-center">
Admin Bereich fürs <a href="https://www.pflanzenlabor.ch" target="_blank">Pflanzenlabor</a>
            </div>
        </div>
    </div>
    <div class="card-deck mt-3 text-center">
        <?php $this->print_link("courses", "Programm"); ?>
        <?php $this->print_link("impressions", "Impressionen"); ?>
        <?php $this->print_link("orders", "Bestellungen"); ?>
    </div>
    <?php $this->print_footer(); ?>
</div>
