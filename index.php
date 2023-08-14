<?php
session_start();
date_default_timezone_set('America/Manaus');

//ADICIONANDOS ARQUIVOS DA ARQUITETURA DE CONTROLE, MODELOS E ACESSOS AO BANCO DE DADOS
require_once("Controller/UsuariosController.php");
require_once("Model/Usuarios.php");

require_once("Controller/NotasController.php");
require_once("Model/Notas.php");

require_once("Controller/PedidosController.php");
require_once("Model/Pedidos.php");

require_once("Controller/ServicoController.php");
require_once("Model/Servicos.php");

require_once("Util/conn.php");



//INICIALIZAÇÃO DAS CONTROLLER'S
$notasController = new NotasController();
$usuarioController = new UsuarioController();
$pedidosController = new PedidosController();
$servicoController = new ServicoController();
//FIM DAS CONTROLLERS


$banco = new Banco(); //INSTANCIA DO ACESSO AO BANCO DE DADOS


//INICIO DO BLOCO DE SUBMIT FORM
if (filter_input(INPUT_POST, "btnSubmitPedir", FILTER_SANITIZE_STRING)) {
  //ESTÁ FUNÇÃO DEVE CADASTRAR UMA NOTA NO BANCO DE DADOS E ORDENAR DE 1 A 999 CASO O PEDIDO SEJA PARA ENTREGA NO BALCAO E REDIRECIONAR PARA A PAGINA DE CONSTRUIR O PEDIDO
  $status = 1;
  $usuario1 = filter_input(INPUT_POST, "txtCodCliente", FILTER_SANITIZE_NUMBER_INT);
  $tipoentrega = filter_input(INPUT_POST, "txtTipoEntrega", FILTER_SANITIZE_NUMBER_INT);
  $func = $_SESSION["codF"];

  $data_hoje2 = date('d/m/Y');

  $t = explode("/", $data_hoje2);
  $dia = $t[0];
  $mes = $t[1];
  $ano = $t[2];


  if ($tipoentrega == 1) {
    $sqlNotas = "SELECT * FROM notas WHERE tipo_pedido = 1 ORDER BY cod DESC LIMIT 1";
    $ordem = 0;

    $dataTableNotas = $banco->ExecuteQuery($sqlNotas);
    foreach ($dataTableNotas as $resultadonotas) {
      $ordem = $resultadonotas['ordem'];
      if ($ordem < 999) {
        $ordem = $ordem + 1;
      } elseif ($ordem == 999) {
        $ordem = 1;
      }
    }

  } else {
    $ordem = 0;
  }


  $notas = new Notas();
  $notas->setStatus($status);
  $notas->setUsuario($usuario1);
  $notas->setDia($dia);
  $notas->setMes($mes);
  $notas->setAno($ano);
  $notas->setFunc($func);
  $notas->setOrdem($ordem);
  $notas->setTipo_entrega($tipoentrega);
  $notas->setCod_usuarios($func);

  //var_dump($notas);

  if ($notasController->Cadastrar($notas)) {
    header("location: index.php?pagina=carinhocompras");
  } else {
    $resultado = " <div class='alert alert-danger' role='alert'><span>Houve um herro ao cadastrar novo Orçamento!</span> </div>";
  }
}


if (filter_input(INPUT_POST, "btnSubmit", FILTER_SANITIZE_STRING)) {

  $erros = Validar();

  $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING);
  $usuario2 = filter_input(INPUT_POST, "txtLogin", FILTER_SANITIZE_STRING);
  $permissao = filter_input(INPUT_POST, "txtPermissao", FILTER_SANITIZE_NUMBER_INT);
  $cpf = filter_input(INPUT_POST, "txtCpf", FILTER_SANITIZE_STRING);
  $celular = filter_input(INPUT_POST, "txtCelular", FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_STRING);
  $endereco = filter_input(INPUT_POST, "txtEndereco", FILTER_SANITIZE_STRING);
  $numero = filter_input(INPUT_POST, "txtNumero", FILTER_SANITIZE_STRING);
  $bairro = filter_input(INPUT_POST, "txtBairro", FILTER_SANITIZE_STRING);
  $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING);
  $senha = md5($senha);

  if (empty($erros)) {

    $usuario = new Usuarios();


    $nulo = "";
    $usuario->setNome($nome);
    $usuario->setUsuario($usuario2);
    $usuario->setPermissao($permissao);
    $usuario->setCpf($cpf);
    $usuario->setCelular($celular);
    $usuario->setEmail($email);
    $usuario->setRua($endereco);
    $usuario->setNumero($numero);
    $usuario->setBairro($bairro);
    $usuario->setSenha($senha);
    $usuario->setFoto($nulo);


    if (!filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {

      if ($usuarioController->Cadastrar($usuario)) {

        $cod = 0;
        $nome = "";
        $usuario = "";
        $rg = "";
        $cpf = "";
        $email = "";
        $foto = "";
        $permissao = 0;
        $rua = "";
        $bairro = "";
        $numero = "";
        $celular = "";
        $senha = "";

        $comissao = 0;
        $listaUsuariosBusca = $usuarioController->RetornarUsuarios("", 1, 1);

        header("Location: index.php?pagina=usuarios&msgget=1");

        //$resultado = " <div class='alert alert-success' role='alert'><span>Usuario cadastrado com sucesso!</span> </div>";
      } else {
        $resultado = " <div class='alert alert-danger' role='alert'><span>Houve um erro ao cadastrar Usuario!</span> </div>";
      }
    }
  }
}

function Validar()
{
  $listaErros = [];

  $usuarioController = new UsuarioController();


  if (strlen(filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_STRING)) < 1) {
    $listaErros[] = "- Nome inválido.";
  }

  if (strlen(filter_input(INPUT_POST, "txtLogin", FILTER_SANITIZE_STRING)) < 1) {
    $listaErros[] = "- Usuario inválido.";
  }



  return $listaErros;
}
//FIM DO BLOCO DE SUBMIT FORM


//FUNÇÃO PARA INICIAR LOGIN 
if (filter_input(INPUT_POST, "btnEntrar", FILTER_SANITIZE_STRING)) {
  $usuarioController = new UsuarioController();
  $user = filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_STRING);
  $pass = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING);
  $permissao = 1;

  $resultado = $usuarioController->AutenticarUsuario($user, $pass, $permissao);

  if ($resultado != null) {
    if (filter_input(INPUT_POST, "ckManterLogado", FILTER_SANITIZE_STRING)) {
      $_SESSION["entrarAdminE"] = true;
    }


    $_SESSION["permissaoF"] = $resultado->getPermissao();
    $_SESSION["codF"] = $resultado->getCod();
    $_SESSION["nomeF"] = $resultado->getNome();
    $_SESSION["cod_orgaoF"] = $resultado->getCod_orgao();
    $_SESSION["funcaoF"] = $resultado->getFuncao();
    $_SESSION["fotoF"] = $resultado->getFoto();


    if ($resultado->getPermissao() == 1) {
      header("Location: index.php?");
    } else if ($resultado->getPermissao() == 2) {

      header("Location: index.php?pagina=homefunc");
    } else if ($resultado->getPermissao() == 3) {

      header("Location: index.php?pagina=hometelao");
    }
  } else {
    $rextorno = "<div class=\"alert alert-danger\" role=\"alert\">Usuário ou senha inválido.</div>";
  }
}
?>
<html lang='pt' data-bs-theme='light'>
<head>
  <title>PoliPrint | Impressoras e Copiadoras | Manaus</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/img/Logo-Poliprint4.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <script src="./index_files/color-modes.js.download"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta  name="author" content="">
  <meta name="generator" content="">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
  <link href="./index_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Favicons -->
  <link rel="icon" href="interface/img/logo.ico" sizes="32x32" type="image/png">
  <link rel="icon" href="interface/img/logo.ico" sizes="16x16" type="image/png">
  <link rel="manifest" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/safari-pinned-tab.svg"
    color="#712cf9">
  <meta name="theme-color" content="#712cf9">
  <!-- Custom styles for this template -->
  <link href="./index_files/sidebars.css" rel="stylesheet">
</head>
<body>
                             <!-- Navigation-->
                             <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
                                <div class="]
        container">
                                    <a class="navbar-brand" href="?"><img src="assets/img/poliprint_semfundo.png"
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
                                                <a class="nav-link dropdown-toggle" href="?pg=soluc" id="navbarDropdownMenuLink" role="button"
                                                    data-mdb-toggle="dropdown" aria-expanded="true">
                                                    Soluções
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=out-imp">
                                                            Outsourcing de Impressão, Laser, Térmica e Jato de Tinta
                                                            <hr>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=out-ti">
                                                            Outsourcing de TI (Locação de Notebook e Desktop)
                                                            <hr>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=vend-comp">Venda de Computadores</a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=vend-imp">
                                                            Venda de Impressoras/Mulfuncionais
                                                        </a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=vend-sup">Venda de Suprimentos</a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=dig-doc">
                                                            Digitalização de Documentos / GED
                                                        </a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=dad-var">
                                                            Impressão de Dados Variáveis
                                                        </a>
                                                        <hr>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="?pg=equip" id="navbarDropdownMenuLink" role="button"
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
                                                <a class="nav-link dropdown-toggle" href="?pg=emp" id="navbarDropdownMenuLink" role="button"
                                                    data-mdb-toggle="dropdown" aria-expanded="false">
                                                    Para sua Empresa
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=gov">
                                                            Governo
                                                            <hr>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=ind">
                                                            Indústria
                                                            <hr>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=var">
                                                            Varejo</a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=saud">
                                                            Saúde
                                                        </a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=log">
                                                            Logística</a>
                                                        <hr>
                                                    </li>
                                                    <li>
                                                        <a style="color: blueviolet;" class="dropdown-item" href="?pg=edu">
                                                            Educação
                                                        </a>
                                                        <hr>
                                                    </li>



                                                </ul>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="?pg=inst">Institucional</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?pg=sup">Suporte</a></li>
                                            <li class="nav-item"><a class="nav-link" href="?pg=cont">Contato</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav> 
  <?PHP
  if (!isset($_SESSION["permissaoF"])) {
    ?>
    <!-- TELA DE LOGIN -->
    <section class="vh-100" style="background-color: #393f81; width: 100%;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="interface/img/logo-sem-fundo.png" alt="login form" class="img-fluid"
                    style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form method="post" name="frmCadastro" id="frmCadastro" novalidate enctype="multipart/form-data">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">

                          Faça seu login</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Conecte-se através do seu usuário e
                        senha!</h5>

                      <div class="form-outline mb-4">
                        <input name='txtUsuario' type="email" id="form2Example17" class="form-control form-control-lg" />
                        <label class="form-label" for="form2Example17">Usúario</label>
                      </div>

                      <div class="form-outline mb-4">
                        <input name='txtSenha' type="password" id="form2Example27" class="form-control form-control-lg" />
                        <label class="form-label" for="form2Example27">Senha</label>
                      </div>

                      <div class="pt-1 mb-4">
                        <input type="submit" name="btnEntrar" id="btnEntrar" value="Login"
                          class="btn btn-dark btn-lg btn-block" />
                      </div>

                      <a class="small text-muted" href="#!">Forgot password?</a>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                          style="color: #393f81;">Register here</a></p>
                      <a href="#!" class="small text-muted">Terms of use.</a>
                      <a href="#!" class="small text-muted">Privacy policy</a>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FIM TELA DE LOGIN -->
    <?PHP
  } else {
    ?>
    
    <?php 
    require_once("Util/ResquestPagePrincipal.php");
  }
  ?>
<!-- Clients-->
<div class="py-5">
                                    <div class="container" style=''>
                                        <div class="row align-items-center">
                                            <h1 class="section-heading text-uppercase">Nossas Marcas</h1>
                                            <div class="col-md-2 col-sm-6 my-2">
                                                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/hplogo.png"
                                                        alt="..." aria-label="HP Logo" /></a>
                                            </div>
                                            <div class="col-md-2 col-sm-6 my-2">
                                                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/brotherlogo.png"
                                                        alt="..." aria-label="BROTHER Logo" /></a>
                                            </div>
                                            <div class="col-md-2 col-sm-6 my-2">
                                                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/OKILOGO.png"
                                                        alt="..." aria-label="OKI Logo" /></a>
                                            </div>
                                            <div class="col-md-2 col-sm-6 my-2">
                                                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/epsonlogo.png"
                                                        alt="..." aria-label="EPSON Logo" /></a>
                                            </div>
                                            <div class="col-md-2 col-sm-6 my-3">
                                                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/canonlogo.png"
                                                        alt="..." aria-label="CANON Logo" /></a>
                                            </div>
                                            
                                            <div class="col-md-2 col-sm-6 my-3">
                                                <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/nddlogo.png"
                                                        alt="..." aria-label="NDD Logo" /></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Footer-->
                                <footer class="footer py-4">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 text-lg-start">Copyright &copy; LGTI.LTDA 2023</div>
                                            <div class="col-lg-4 my-3 my-lg-0">
                                                <a class="btn btn-dark btn-social mx-2" href="https://twitter.com/poliprintam" aria-label="Twitter"><i
                                                        class="fab fa-twitter"></i></a>
                                                <a class="btn btn-dark btn-social mx-2" href="https://www.facebook.com/pages/Poliprint-Impressoras-e-Copiadoras-Manaus/161690447277019" aria-label="Facebook"><i
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
                                
  <script src="./index_files/bootstrap.bundle.min.js.download"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

  <script src="./index_files/sidebars.js.download"></script>
  <script src="js/funcshome.js"></script>
  <script src="js/funcscarrinho.js"></script>
  <script>
    function ConfirmarIsso() {
      if (!confirm("Clique em Ok para Continuar."))
        return false;
    }
  </script>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  <script>

    document.addEventListener("DOMContentLoaded", function () {
      // make it as accordion for smaller screens
      if (window.innerWidth > 992) {
        document.querySelectorAll('.navbar .nav-item').forEach(function (everyitem) {
          everyitem.addEventListener('mouseover', function (e) {
            let el_link = this.querySelector('a[data-mdb-toggle]');
            if (el_link != null) {
              let nextEl = el_link.nextElementSibling;
              el_link.classList.add('show');
              nextEl.classList.add('show');
            }
          });
          everyitem.addEventListener('mouseleave', function (e) {
            let el_link = this.querySelector('a[data-mdb-toggle]');
            if (el_link != null) {
              let nextEl = el_link.nextElementSibling;
              el_link.classList.remove('show');
              nextEl.classList.remove('show');
            }
          });
        });
      }
    });

    
    const myCarouselElement = document.querySelector('#carouselExampleCaptions')

const carousel = new bootstrap.Carousel(myCarouselElement, {
  interval: 10000,
  touch: false
})


  </script>
</body>

</html>