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
                    Eleve sua Eficiência com Outsourcing de Impressoras e Multifuncionais! Nossas soluções garantem
                    agilidade para sua equipe e otimizam a gestão do seu negócio.
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
                <h2 class="section-heading text-uppercase">Vantagens</h2>
                <h3 class="section-subheading text-muted">
                    Solução completa em conjunto com o aluguel de impressoras e multifuncionais para o seu negócio
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
                            <h4 class="my-3">Economia</h4>
                            <p class="text-muted">
                                Conte com equipamentos atualizados e garanta os melhores resultados, sem a necessidade de um
                                novo investimento.
                            </p>
                            </br></br>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=s1">Saiba
                                Mais</a>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Produtividade</h4>
                            <p class="text-muted">
                                Confie em soluções de terceirização para notebooks e desktops,
                                assegurando desempenho para sua
                                equipe e total disponibilidade para seu empreendimento.

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
                            <h4 class="my-3">Monitoramento.</h4>
                            <p class="text-muted">Maior controle da sua operação, eliminando desperdícios e estoques com
                                suprimentos e peças.
                                .</p>
            </BR></BR>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=e1">Saiba
                                Mais</a>

                        </div>
                    </div>
                </div>
            </section>
            <div class="row container" style=''>
                <div style="width: 50%; background-color: #0d6efd; color:#fff;" class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">Outsourcing de Impressoras e Multifuncionais</h3>
                    <p class="card-text mb-auto">
                    Aprimore a velocidade e supervisão nas etapas de impressão, abrangendo desde a reprodução de documentos e escaneamento de arquivos, até soluções completas incorporadas ou adaptadas para cada segmento.
                    </p>
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