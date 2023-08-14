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
                    Os suprimentos comercializados pela POLIPRINT, são especialmente formulados e testados pelos melhores
                    fabricantes mundiais para que forneçam a melhor qualidade de imagem, melhor vida para impressora, baixo
                    custo de manutenção e mais impressões
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
                <h2 class="section-heading text-uppercase">Vantagens de comprar Suprimentos com a PoliPrint</h2>


            </div>
            <section class="page-section" id="services">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-print fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Qualidade Superior para Resultados Impecáveis:</h4>
                            <p class="text-muted">
                                Nossos suprimentos são projetados para produzir impressões de alta qualidade, com cores
                                vibrantes e detalhes nítidos. Cada página impressa ganha vida, desde relatórios importantes
                                até materiais promocionais envolventes.
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
                            <h4 class="my-3">Desempenho Confíavel e Duradouro</h4>
                            <p class="text-muted">
                                Ao optar pelos Suprimentos PoliPrint, você está escolhendo confiabilidade. Nossos produtos
                                são cuidadosamente desenvolvidos para funcionar perfeitamente com suas impressoras.
                            </p>
                            </br></BR>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=s2">Saiba
                                Mais</a>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Ecologicamente Conscientes</h4>
                            <p class="text-muted">
                                A PoliPrint valoriza o meio ambiente. Nossos suprimentos são produzidos com práticas
                                ecológicas, demonstrando nosso compromisso com a sustentabilidade. 
                            </p>
                            </BR></BR></BR>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=e1">Saiba
                                Mais</a>

                        </div>
                    </div>
                </div>
            </section>
            <div class="row container" style=''>
                <div style="width: 50%; background-color: #0d6efd; color:#fff;"
                    class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">Potencialize sua Impressão com os Suprimentos PoliPrint</h3>
                    <p class="card-text mb-auto">
                        Quando se trata de garantir a melhor qualidade de impressão e o funcionamento ideal de suas
                        impressoras, os suprimentos certos fazem toda a diferença. Ao escolher os Suprimentos PoliPrint,
                        você está investindo em vantagens que fazem a sua impressão decolar:
                    </p>
                    <a href="?" class="btn btn-primary btn-xl text-uppercase">
                        Conheça nossos Equipamentos
                    </a>
                </div>
                <div style="width: 50%; margin-left:-25px;" class="col-auto d-none d-lg-block">
                    <img style="width: 100%;" src='assets/img/atendimento-exclusivo-banner-ee244a49.jpeg' />
                </div>

            </div>

    </body>

<?php } ?>