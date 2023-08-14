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
                </BR><b>Explore os benefícios excepcionais da terceirização de equipamentos de TI. Converse conosco agora mesmo e assegure um desempenho ideal para potencializar seus negócios. Complete o formulário e aguarde nosso contato para conhecermos a fundo as necessidades da sua empresa. Seu sucesso começa aqui!</b></BR></br>
            </div>
        </div>
    </header>
    </head>

    <body>
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
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <select style="margin-top:20px; padding: 20px;;" class="form-control" id="interesse" type="text" placeholder="QUAL SEU INTERESSE? *"
                                    data-sb-validations="required">
                                    <option>Impressoras e Multificionais</option>
                                    <option>Notebook e Desktop's</option>
                                    <option>Ploter e Scanners</option>
                                    <option>Mais de uma Solução?</option>
                                </select>
                                <div class="invalid-feedback" data-sb-feedback="interesse:required">QUAL SEU INTERESSE?.</div>
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
        
    <?php } ?>