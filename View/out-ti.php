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
    <header class="masthead" style='margin-top:-50px;'>
        <div class="container">
            <div class="masthead-subheading" style="color:#000; background-color: rgb(255, 255, 255, 0.5);">
                </BR><b>
                    Locação de notebooks e desktops </br>
                    Opte por alternativas de terceirização de notebooks e desktops para impulsionar o desempenho da sua
                    equipe e assegurar máxima disponibilidade para o seu empreendimento.
                </b></BR></br>
            </div>
            <a class="btn btn-primary btn-xl text-uppercase" href="https://wa.me/5592988184669" target="_blank">Converse
                conosco no Whatsapp</a>
        </div>
    </header>
    </head>

    <body>
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Vantagens de contratar a PoliPrint</h2>
                <h3 class="section-subheading text-muted">
                    Foque no seu negócio enquanto nós cuidamos dos equipamentos
                </h3>

            </div>
            <section class="page-section" id="services">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-print fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Redução de custos</h4>
                            <p class="text-muted">
                                Manutenção do seu fluxo financeiro, permitindo investimentos contínuos na expansão do seu
                                empreendimento.
                            </p>
                            </br>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=s1">Saiba
                                Mais</a>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Gestão dos ativos</h4>
                            <p class="text-muted">
                                Nossa principal responsabilidade é supervisionar e controlar o conjunto de seus
                                computadores.
                            </p>
                            </br>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=s2">Saiba
                                Mais</a>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Assistência.</h4>
                            <p class="text-muted">Segurança contra danos imprevistos, assegurando proteção e substituição do equipamento, se reparos forem necessários.
                                .</p>
                            </BR>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=e1">Saiba
                                Mais</a>

                        </div>
                    </div>
                </div>
            </section>
            <div class="row container" style=''>
                <div style="width: 50%; background-color: #0d6efd; color:#fff;"
                    class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">Outsourcing de Notebooks e Computadores</h3>
                    <p class="card-text mb-auto">
                    Assumimos o gerenciamento completo da sua infraestrutura tecnológica, permitindo que você concentre-se nas operações essenciais. Desde a formalização do contrato até a devolução do equipamento</p>
                    <a href="?" class="btn btn-primary btn-xl text-uppercase">
                        Conheça nossos Equipamentos
                    </a>
                </div>
                <div style="width: 50%; margin-left:-25px;" class="col-auto d-none d-lg-block">
                    <img style="width: 100%;" src='assets/img/MICROLASER_Imagens-Blog-02.png' />
                </div>

            </div>

    </body>

<?php } ?>