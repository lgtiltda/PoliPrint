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
                O Gerenciamento Eletrônico de Documentos (GED) é a chave para otimizar seus fluxos de trabalho e elevar a produtividade da sua empresa. Veja como essa abordagem moderna pode transformar sua gestão documental.
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
                            <h4 class="my-3">Transforme sua Empresa com Gerenciamento Eletrônico de Documentos (GED)</h4>
                            <p class="text-muted">
                            Produtividade Aprimorada: Diga adeus à papelada e processos morosos. O GED automatiza fluxos de trabalho, agilizando tarefas como aprovações, assinaturas eletrônicas e compartilhamento de informações, resultando em maior produtividade e menos gargalos.
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
                            <h4 class="my-3">Simplifique sua Rotina com Gerenciamento Eletrônico de Documentos (GED)</h4>
                            <p class="text-muted">
                            Acesso em Qualquer Lugar: Não importa onde você esteja, tenha acesso instantâneo a documentos importantes. Digitalize e armazene papéis físicos, transformando-os em versões eletrônicas que podem ser facilmente acessadas de qualquer dispositivo.
                            </p>
                            </br></BR></br>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=s2">Saiba
                                Mais</a>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-primary"></i>
                                <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Alcance Novos Horizontes com o Gerenciamento Eletrônico de Documentos (GED)</h4>
                            <p class="text-muted">
                            Fluxos de Trabalho Simplificados: Simplifique processos internos ao digitalizar, armazenar e compartilhar documentos de forma eletrônica. Com o GED, a colaboração se torna mais fluida e os projetos avançam com rapidez e precisão.
                            </p>
                            </BR></BR>
                            <a class="btn btn-primary btn-xl text-uppercase" href="?pg=e1">Saiba
                                Mais</a>

                        </div>
                    </div>
                </div>
            </section>
            <div class="row container" style=''>
                <div style="width: 50%; background-color: #0d6efd; color:#fff;"
                    class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">Simplifique e Revolucione com o Gerenciamento Eletrônico de Documentos (GED)</h3>
                    <p class="card-text mb-auto">
                    Eficiência Total: Elimine processos manuais demorados. Com o GED, você converte documentos físicos em versões digitais acessíveis, acelerando tarefas e facilitando a colaboração entre equipes.
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