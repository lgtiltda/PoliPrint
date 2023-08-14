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
    <header class="masthead" style='margin-top:-50px;'>
    <div class="container">
        <div class="masthead-subheading" style="color:#000; background-color: rgb(255, 255, 255, 0.5);">
            </BR><b>Conheça nossa história, valores e compromisso. Trabalhamos para oferecer excelência e inovação em tudo o que fazemos</b></BR></br>
        </div>
    </div>
</header>
</head>

    </head>

    <body>
    <section class="page-section" id="about">
                                    <div class="container">
                                        <div class="text-center">
                                            <h2 class="section-heading text-uppercase">Sobre nós</h2>
                                            <h3 class="section-subheading text-muted">A Empresa
                                                A POLIPRINT é uma empresa oriunda do Grupo Policópias, que hoje conta com mais de 30 anos no
                                                Brasil
                                                com a tradição e experiência em tudo que tange a engenharia do Documento.

                                                Nossa expertise na terceirização de serviços de Impressões de Dados Variáveis, outsourcing de
                                                impressão, digitalização, Cópias e Acabamento dentre outros. A POLIPRINT fundada em 2001 em
                                                Goiânia,
                                                é especializada em Impressões Eletrônicas e na otimização da Tecnologia da Informação. Em Manaus
                                                estamos há 3 anos sempre preocupados com os fatores críticos de sucesso de nossos Clientes.</h3>
                                        </div>
                                        <ul class="timeline">
                                            <li>
                                                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/1.jpg"
                                                        alt="..." /></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4>Missão</h4>
                                                        <h4 class="subheading"></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p class="text-muted">
                                                            Nossa missão é contribuir para o desenvolvimento tecnológico das
                                                            empresas, oferecendo produtos e serviços com qualidade para melhor
                                                            atender nossos clientes.
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-inverted">
                                                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/2.jpg"
                                                        alt="..." /></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4>Visão</h4>
                                                        <h4 class="subheading"></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p class="text-muted">
                                                            Ser uma das melhores prestadoras de serviço e produtos no Brasil,
                                                            buscando aprimoramento contínuo e inovando sempre com tecnologia de ponta.
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg"
                                                        alt="..." /></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4>Políticas Organizacionais</h4>
                                                        <h4 class="subheading"></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p class="text-muted">
                                                            Atuar na Tecnologia da Informação, fornecendo produtos e serviços
                                                            que atendam às necessidades e expectativas de nossos clientes,
                                                            tendo como princípio fundamental a melhoria contínua e inovação
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-inverted">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15936.029348159998!2d-60.0245473!3d-3.0927058!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x926c1aa7a32bb317%3A0x71c3e3acb25a6c8d!2sPoliprint%20-%20Impressoras%20e%20Copiadoras!5e0!3m2!1spt-BR!2sbr!4v1691963069166!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4>Localização</h4>
                                                        <h4 class="subheading"></h4>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p class="text-muted">
                                                            A matriz está localizada na Avenida Djalma Batista, número 39 – Bairro Chapada,
                                                            Manaus-Am aonde conta com Equipe de Vendas, Equipe de Produção e Qualidade,bem como
                                                            pessoal altamente qualificado para ajudá-lo a achar a melhor solução.
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-inverted">
                                                <a href="?pg=cont" style="color:#fff;">
                                                    <div class="timeline-image">
                                                        <h4>
                                                            SEJA
                                                            NOSSO
                                                            <br />
                                                            CLIENTE
                                                            </BR>
                                                            CLIQUE AQUI
                                                        </h4>
                                                </a>
                                    </div>
                                    </li>
                                    </ul>
                                    </div>
                                </section>
                 

    <?php } ?>