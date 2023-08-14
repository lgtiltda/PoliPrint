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
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="]
        container">
            <a class="navbar-brand" href="#page-top"><img src="assets/img/poliprint_semfundo.png"
                    style="width: 150px; height: 35px;" alt="..." /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Soluções
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Outsourcing de Impressão, Laser, Térmica e Jato de Tinta
                                    <hr>
                                </a>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Outsourcing de TI (Locação de Notebook e Desktop)
                                    <hr>
                                </a>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">Venda de Computadores</a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Venda de Impressoras/Mulfuncionais
                                </a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">Venda de Suprimentos</a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Digitalização de Documentos / GED
                                </a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Impressão de Dados Variáveis
                                </a>
                                <hr>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Equipamentos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Impressoras
                                    <hr>
                                </a>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Multifuncionais
                                    <hr>
                                </a>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Ploter</a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Scanners
                                </a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Notebooks</a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Desktop
                                </a>
                                <hr>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Para sua Empresa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Governo
                                    <hr>
                                </a>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Indústria
                                    <hr>
                                </a>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Varejo</a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Saúde
                                </a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Logística</a>
                                <hr>
                            </li>
                            <li>
                                <a style="color: blueviolet;" class="dropdown-item" href="#">
                                    Educação
                                </a>
                                <hr>
                            </li>



                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#about">Institucional</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Suporte</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" style='margin-top:-50px;'>
        <div class="container">
            <div class="masthead-subheading" style="color:#000; background-color: rgb(255, 255, 255, 0.5);">
                </BR><b>Reduza Custos e Otimize sua Impressão com Nossos Serviços de Outsourcing.
                    </br> PoliPrint A Melhor</br> da Região Norte</b></BR></br>
            </div>
            <a class="btn btn-primary btn-xl text-uppercase" href="https://wa.me/5592988184669" target="_blank">Converse
                conosco no Whatsapp</a>
        </div>
    </header>
    </head>

    <body>

        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Soluções</h2>
                    <h3 class="section-subheading text-muted">
                        Outsourcing de Impressão, Laser, Térmica e Jato de Tinta,
                        Outsourcing de TI (Locação de Notebook e Desktop),
                        Venda de Computadores,
                        Venda de Impressoras/Mulfuncionais,
                        Venda de Suprimentos,
                        Digitalização de Documentos / GED,
                        Impressão de Dados Variáveis.
                    </h3>

                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Outsourcing de impressoras e multifuncionais</h4>
                        <p class="text-muted">
                            Aproveite as vantagens oferecidas pelas opções de terceirização de serviços de impressão e
                            dispositivos multifuncionais, assegurando eficiência para sua equipe e aprimoramento para a
                            administração de sua empresa.
                        </p>
                        <a class="btn btn-primary btn-xl text-uppercase" href="?pg=s1">Saiba Mais</a>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Outsourcing de TI (Locação de Notebook e Desktop)</h4>
                        <p class="text-muted">

                        </p>
                        <a class="btn btn-primary btn-xl text-uppercase" href="">Saiba Mais</a>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3">Aumente a Segurança do Documento,</h4>
                        <p class="text-muted">Sempre que utiliza impressoras ou equipamentos multifuncionais, cria
                            imagens
                            da informação que imprime. Essas imagens são gravadas no disco rígido da impressora ou
                            memória
                            flash. Disponibilizamos de software que retém esses documentos, até que o funcionário que os
                            enviou vá até o equipamento para a liberação através de senha.</p>
                        <a class="btn btn-primary btn-xl text-uppercase" href="">Saiba Mais</a>

                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Produtos</h2>
                    <h3 class="section-subheading text-muted">Impressoras e Multifuncionais, Poliprint em soluções em
                        Color,
                        .</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img style="width: 300px;" class="img-fluid" src="assets/img/impressoras.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Impressoras e Multifuncionais</div>
                                <div class="portfolio-caption-subheading text-muted">Contamos com uma grande variedade
                                    de
                                    impressoras multifuncionais que proporcionam flexibilidade e funcoes avancadas para
                                    copiar, imrprimir, digitalizar e enviar fax; tudo em apenas uma impressora
                                    multifuncional, ideal tanto para uso pessoal quanto para alta utilização em grupos
                                    de
                                    trabalho.</div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/solucao.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Poliprint em soluções em Color</div>
                                <div class="portfolio-caption-subheading text-muted">A impressão em cores chama a
                                    atenção,
                                    aumenta a produtividade e melhora a comunicação. A ampla linha de impressoras
                                    coloridas,
                                    produtos multifuncionais em cores e copiadoras coloridas premiadas que podem ajudar
                                    a
                                    impulsionar as vendas do seu negócio e, ao mesmo tempo, reduzir custo da impressão
                                    em
                                    cores.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img style="width: 400px;" class="img-fluid" src="assets/img/suprimentos.PNG" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Suprimentos</div>
                                <div class="portfolio-caption-subheading text-muted">
                                    Os suprimentos comercializados pela POLIPRINT, são especialmente formulados e
                                    testados
                                    pelos melhores fabricantes mundiais para que forneçam a melhor qualidade de imagem,
                                    melhor vida para impressora, baixo custo de manutenção e mais impressões
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- About-->
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
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg"
                                alt="..." /></div>
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
                        <a href="?" style="color:#000;">
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
        <!-- Team-->
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
        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <h1 class="section-heading text-uppercase">Nossas Marcas</h1>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg"
                                alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg"
                                alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg"
                                alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg"
                                alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">FALE CONOSCO</h2>
                    <h3 class="section-subheading text-muted">SOLICITE UM ORÇAMENTO OU TIRE SUA DÚVIDA.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="SEU NOME *"
                                    data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">DIGITE SEU NOME COMPLETO.
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="SEU E-MAIL *"
                                    data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">DIGITE SEU E-MAIL.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">E-MAIL INVÁLIDO.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="SEU NÚMERO DE CELULAR *"
                                    data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">DIGITE SEU NÚMERO DE
                                    CELULAR.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="SUA MENSAGEM *"
                                    data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">ESCREVA SUA MENSAGEM.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">FORMULÁRIO ENVIADO COM SUCESSO!</div>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage">
                        <div class="text-center text-danger mb-3">ERRO AO ENVIAR MENSAGEM!</div>
                    </div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled"
                            id="submitButton" type="submit">ENVIAR MENSAGEM</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; LGTI.LTDA 2023</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <!--                <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a> -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg"
                            alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Impressoras Multifuncionais</h2>
                                    <p class="item-intro text-muted">Contamos com uma grande variedade de impressoras
                                        multifuncionais que proporcionam flexibilidade e funcoes avancadas para copiar,
                                        imrprimir, digitalizar e enviar fax; tudo em apenas uma impressora
                                        multifuncional,
                                        ideal tanto para uso pessoal quanto para alta utilização em grupos de trabalho.
                                    </p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/impressoras.jpg" alt="..." />
                                    <p></p>
                                    <button class="btn btn-primary btn-xl text-uppercase">
                                        <i class="fas fa-xmark me-1"></i>
                                        SOLICITE UM ORÇCAMENTO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg"
                            alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Poliprint em soluções em Color</h2>
                                    <p class="item-intro text-muted">A impressão em cores chama a atenção, aumenta a
                                        produtividade e melhora a comunicação. A ampla linha de impressoras coloridas,
                                        produtos multifuncionais em cores e copiadoras coloridas premiadas que podem
                                        ajudar
                                        a impulsionar as vendas do seu negócio e, ao mesmo tempo, reduzir custo da
                                        impressão
                                        em cores.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/solucao.jpg" alt="..." />
                                    <button class="btn btn-primary btn-xl text-uppercase" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        SOLICITAR UM ORÇAMENTO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg"
                            alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Suprimentos</h2>
                                    <p class="item-intro text-muted">Os suprimentos comercializados pela POLIPRINT, são
                                        especialmente formulados e testados pelos melhores fabricantes mundiais para que
                                        forneçam a melhor qualidade de imagem, melhor vida para impressora, baixo custo
                                        de
                                        manutenção e mais impressões</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/suprimentos.png" alt="..." />
                                    <button class="btn btn-primary btn-xl text-uppercase" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        SOLICITAR UM ORÇAMENTO
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>