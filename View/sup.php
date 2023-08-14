<style>
    .card-custom {
        overflow: hidden;
        min-height: 450px;
        box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
    }

    .card-custom-img {
        height: 200px;
        min-height: 200px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        border-color: inherit;
    }

    /* First border-left-width setting is a fallback */
    .card-custom-img::after {
        position: absolute;
        content: '';
        top: 161px;
        left: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-top-width: 40px;
        border-right-width: 0;
        border-bottom-width: 0;
        border-left-width: 545px;
        border-left-width: calc(575px - 5vw);
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: inherit;
    }

    .card-custom-avatar img {
        border-radius: 50%;
        box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
        position: absolute;
        top: 100px;
        left: 1.25rem;
        width: 100px;
        height: 100px;
    }
</style>
<?PHP

if (isset($_SESSION["permissaoF"])) {

    ?>
    <!-- Masthead-->
    <!-- Masthead-->
    <header class="masthead" style='margin-top:-50px;'>
        <div class="container">
            <div class="masthead-subheading" style="color:#000; background-color: rgb(255, 255, 255, 0.5);">
                </BR><b>Tenha confiança total em nossa equipe de Suporte Técnico. Resolvemos seus problemas de forma ágil e precisa, para que você possa retomar suas atividades sem preocupações. Sua satisfação é nossa garantia</b></BR></br>
            </div>
        </div>
    </header>
    </head>

    <body>
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Service Desk - Poliprint-AM
                    </h2>
                    <h3 class="section-subheading text-muted">Nosso TIME está a disposição dos nossos clientes.</h3>
                </div>
                <div class="row" style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <a href='http://admsmart-poliprintam.ddns.net:27015/' target="_BLANK">
                                <img class="mx-auto rounded-circle" src="assets/img/chamado_tecnico.png" alt="..." />
                                <h4>Chamado Técnico</h4>
                                <p class="text-muted">Nossa empresa oferece uma plataforma completa de suporte.</p>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <p class="large text-muted">.</p>
                    </div>
                </div>
            </div>
        </section>


    <?php } ?>