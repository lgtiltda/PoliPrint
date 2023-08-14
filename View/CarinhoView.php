<!-- EXTENÇÇÕES CSS PARA TABELAS - INICIO -->
<link href="./tabelas_files/css" rel="stylesheet">
<link rel="stylesheet" href="./tabelas_files/style.css">
<link rel="stylesheet" href="./tabelas_files/owl.carousel.min.css">
<link rel="stylesheet" href="./tabelas_files/style(1).css">
<script defer="" referrerpolicy="origin" src="./tabelas_files/s.js.download"></script>
<script nonce="1e1b5a99-c59f-434d-8d0b-7fd9555ca29e">(function (w, d) { !function (bg, bh, bi, bj) { bg[bi] = bg[bi] || {}; bg[bi].executed = []; bg.zaraz = { deferred: [], listeners: [] }; bg.zaraz.q = []; bg.zaraz._f = function (bk) { return function () { var bl = Array.prototype.slice.call(arguments); bg.zaraz.q.push({ m: bk, a: bl }) } }; for (const bm of ["track", "set", "debug"]) bg.zaraz[bm] = bg.zaraz._f(bm); bg.zaraz.init = () => { var bn = bh.getElementsByTagName(bj)[0], bo = bh.createElement(bj), bp = bh.getElementsByTagName("title")[0]; bp && (bg[bi].t = bh.getElementsByTagName("title")[0].text); bg[bi].x = Math.random(); bg[bi].w = bg.screen.width; bg[bi].h = bg.screen.height; bg[bi].j = bg.innerHeight; bg[bi].e = bg.innerWidth; bg[bi].l = bg.location.href; bg[bi].r = bh.referrer; bg[bi].k = bg.screen.colorDepth; bg[bi].n = bh.characterSet; bg[bi].o = (new Date).getTimezoneOffset(); if (bg.dataLayer) for (const bt of Object.entries(Object.entries(dataLayer).reduce(((bu, bv) => ({ ...bu[1], ...bv[1] })), {}))) zaraz.set(bt[0], bt[1], { scope: "page" }); bg[bi].q = []; for (; bg.zaraz.q.length;) { const bw = bg.zaraz.q.shift(); bg[bi].q.push(bw) } bo.defer = !0; for (const bx of [localStorage, sessionStorage]) Object.keys(bx || {}).filter((bz => bz.startsWith("_zaraz_"))).forEach((by => { try { bg[bi]["z_" + by.slice(7)] = JSON.parse(bx.getItem(by)) } catch { bg[bi]["z_" + by.slice(7)] = bx.getItem(by) } })); bo.referrerPolicy = "origin"; bo.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bg[bi]))); bn.parentNode.insertBefore(bo, bn) };["complete", "interactive"].includes(bh.readyState) ? zaraz.init() : bg.addEventListener("DOMContentLoaded", zaraz.init) }(w, d, "zarazData", "script"); })(window, document);
</script>
<style>
    .osSwitch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 15.3px
    }

    .osSwitch input {
        opacity: 0;
        width: 0;
        height: 0
    }

    .osSlider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 34px;
        background-color: #93a0b5;
        transition: 0.4s
    }

    .osSlider:before {
        position: absolute;
        content: '';
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 1px;
        border-radius: 50%;
        background-color: white;
        transition: 0.4s
    }

    input:checked+.sliderGreen {
        background-color: #04d289
    }

    input:checked+.sliderRed {
        background-color: #ff3b30
    }

    input:not(:checked)+.defaultGreen {
        background-color: #04d289
    }

    input:checked+.osSlider:before {
        transform: translateX(17px)
    }
</style>
<!-- EXTENÇÇÕES CSS PARA TABELAS - FIM -->
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .bloco-de-notas {
        color: #Fff;
        background: #363636;
        width: 600px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
    }


    h1 {
        font-size: 24px;
        margin-top: 0;
        text-align: center;
    }

    p {
        font-size: 16px;
        line-height: 1.6;
    }

    @media (max-width: 760px) {
        .bloco-de-notas {
            display: none;
        }
    }


    :root {
        --gradient: linear-gradient(to left top, #4169E1 10%, #4169E1 90%) !important;
    }

    .card {
        background: #363636;
        border: 1px solid #4169E1;
        color: rgba(250, 250, 250, 0.8);
        margin-bottom: 2rem;
    }

    .btn {
        border: 5px solid #4169E1;
        border-image-slice: 1;
        background: var(--gradient) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        border-image-source: var(--gradient) !important;
        text-decoration: none;
        transition: all .4s ease;
    }

    .btn:hover,
    .btn:focus {
        background: var(--gradient) !important;
        -webkit-background-clip: none !important;
        -webkit-text-fill-color: #fff !important;
        border: 5px solid #4169E1 !important;
        box-shadow: #4169E1 1px 0 10px;
        text-decoration: underline;
    }


    .displayinfinito::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 4px;
    }

    .displayinfinito::-webkit-scrollbar {
        width: 25px;
        color: #000
    }

    .card-img-top {
        width: 100%;
        height: 200px;
    }

    @media (min-width: 1024px) {
        #Btncategorias {
            font-size: 18pt;
            text-align: center;
        }

        #Btnitem {
            font-size: 18pt;
        }

        #Btnvalor {
            font-size: 18pt;
        }

        .displayinfinito {
            display: flex;
            flex-direction: row;
            /* justify-content: center; */
            align-items: top;
            overflow-x: auto;
            width: 300px;
            height: 93%;
            overflow-y: scroll;

        }

    }

    @media (max-width: 460px) {
        #Btncategorias {
            font-size: 10pt;
            text-align: center;
        }

        #Btnitem {
            font-size: 20pt;
        }

        #Btnvalor {
            font-size: 20pt;
        }

        .displayinfinito {
            display: flex;
            flex-direction: row;
            /* justify-content: center; */
            align-items: top;
            overflow-x: auto;
            width: 300px;
            height: 93%;
            overflow-y: scroll;

        }

    }

    /*Alterações para CARD em Editar Item, Pagamentos, Clientes e Editar ul. Item*/
    /*Card containing 2 cards*/
    .card0 {
        border: 0;
    }

    /*Left Side card*/
    .card1 {
        margin: 0;
        padding: 10px;
        padding-top: 15px;
        padding-bottom: 0px;
        background: #263238;
    }

    .bill-head {
        color: #ffffff;
        font-weight: bold;
        margin-bottom: 0px;
        margin-top: 0px;
        font-size: 30px;
    }

    .line {
        border-right: 1px grey solid;
    }

    .bill-date {
        color: #BDBDBD;
    }

    .red-bg {
        margin-top: 10px;
        margin-left: 0px;
        margin-right: 0px;
        background-color: #F44336;
        padding-left: 20px !important;
        padding: 25px 10px 25px 15px;
    }

    #total {
        margin-top: 0px;
        padding-left: 7px;
    }

    #total-label {
        margin-bottom: 0px;
        color: #ffffff;
        padding-left: 7px;
    }

    #heading1 {
        color: #ffffff;
        font-size: 20px;
        padding-left: 10px;
    }

    #heading2 {
        font-size: 27px;
        color: #D50000;
    }

    
</style>
<?PHP

if (filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT)) {
    $id = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    $tipo = 2;
    $listaNotas = $notasController->RetornarNotas($tipo, $id);
    if ($listaNotas != null) {
        foreach ($listaNotas as $user477) {
            $codnota = $user477->getCod();
            $codusuario2 = $user477->getUsuario();
            $nomeCli = $user477->getNomeCli();
        }
    }
} else {
    $listaNotas = $notasController->RetornarUltimaNota($_SESSION['codF']);
    if ($listaNotas != null) {
        foreach ($listaNotas as $user477) {
            $codnota = $user477->getCod();
            $codusuario2 = $user477->getUsuario();
            $nomeCli = $user477->getNomeCli();
        }
    } else {
        //header('Location: index.php?msgget=6');
        $status = 1;
        //$usuario1 = $codusuario2;
        $func = $_SESSION["codF"];

        $data_hoje2 = date('d/m/Y');

        $t = explode("/", $data_hoje2);
        $dia = $t[0];
        $mes = $t[1];
        $ano = $t[2];

        $sqlNotas = "SELECT * FROM notas ORDER BY cod DESC LIMIT 1";
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

        $notas = new Notas();
        $notas->setStatus($status);
        $notas->setUsuario(0);
        $notas->setDia($dia);
        $notas->setMes($mes);
        $notas->setAno($ano);
        $notas->setFunc($func);
        $notas->setOrdem($ordem);

        if ($notasController->Cadastrar($notas)) {
            header("location: index.php?pagina=carinhocompras");
        } else {
            $resultado = " <div class='alert alert-danger' role='alert'><span>Houve um herro ao cadastrar novo Orçamento!</span> </div>";
        }
    }
}
$numparcelas = 0;
$testelogico = 0;
$sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
    $testelogico = 1;
    $tipo = $pagamentopesquisa->tipo;
    $total = $pagamentopesquisa->total;
    $numparcelas = $pagamentopesquisa->numparcelas;
    $dinheiro = $pagamentopesquisa->dinheiro;
    $debito = $pagamentopesquisa->debito;
    $credito = $pagamentopesquisa->credito;
    $pix = $pagamentopesquisa->pix;
    $gorjeta = $pagamentopesquisa->gorjeta;

    $textotipo = "";


    if ($tipo == 1) {
        $textotipo = "Pagamento á Vista</br><p style='color:red;'>";
        if ($dinheiro != 0) {
            $textotipo = $textotipo . "
            Dinheiro: R$ " . number_format($dinheiro, 2, ',', '.')
                . "</BR>
            ";
        }
        if ($debito != 0) {
            $textotipo = $textotipo . "
            Débito: R$ " . number_format($debito, 2, ',', '.')
                . "</BR>
            ";
        }
        if ($credito != 0) {
            $textotipo = $textotipo . "
            Crédito: R$ " . number_format($credito, 2, ',', '.')
                . "</BR>
            ";
        }
        if ($pix != 0) {
            $textotipo = $textotipo . "
            Pix: R$ " . number_format($pix, 2, ',', '.')
                . "</BR>
            ";
        }
        if ($gorjeta != 0) {
            $textotipo = $textotipo . "
            Troco: R$ " . number_format($gorjeta, 2, ',', '.')
                . "</BR>
            ";
        }
        $textotipo = $textotipo . "</p>";
    } else {
        $valorparcela = 0;
        if ($numparcelas != 0) {
            $valorparcela = $total / $numparcelas;
        }
        $textotipo = "Pagamento Parcelado</br>";
        $textotipo = $textotipo . "
        Parcelado em: $numparcelas x</br>
        Valor Parcela: R$  ". number_format($valorparcela, 2, ',', '.');
    }

}


//INICIO SUBMIT PARA FINALIZAR PAGAMENTO
if (filter_input(INPUT_POST, "btnCadastrarFinalizarSaida", FILTER_SANITIZE_STRING)) {



    $cod_saida = filter_input(INPUT_POST, "txtCod", FILTER_SANITIZE_NUMBER_INT);
    $formapagamento = filter_input(INPUT_POST, "txtParamControle2", FILTER_SANITIZE_NUMBER_INT);
    $numparcelas = filter_input(INPUT_POST, "numparcelas", FILTER_SANITIZE_NUMBER_INT);
    $juros = filter_input(INPUT_POST, "juros", FILTER_SANITIZE_STRING);
    $juros2 = filter_input(INPUT_POST, "juros2", FILTER_SANITIZE_STRING);

    $dinheiro = (float) filter_input(INPUT_POST, "pagamentodinheiro", FILTER_SANITIZE_STRING);
    $cartaodeb = (float) filter_input(INPUT_POST, "pagamentocartaodeb", FILTER_SANITIZE_STRING);
    $cartaocred = (float) filter_input(INPUT_POST, "pagamentocartaocred", FILTER_SANITIZE_STRING);
    $pix = (float) filter_input(INPUT_POST, "pagamentopix", FILTER_SANITIZE_STRING);
    $troco = (float) filter_input(INPUT_POST, "pagamentotroco", FILTER_SANITIZE_STRING);

    $saidas = $notasController->RetornarNotas(2, $cod_saida);

    $dinheiroreal = $dinheiro - $troco;

    $total = 0;
    if ($saidas != NULL) {
        foreach ($saidas as $saidasteste) {


            $dia = $saidasteste->getDia();
            $mes = $saidasteste->getMes();
            $ano = $saidasteste->getAno();


            if ($saidasteste->getStatus() == 3) {
                header("Location: index.php?pagina=carinhocompras&cod=$cod_saida");
            } else {
                if ($notasController->AlterStatusTodos(3, $cod_saida)) {
                    $resultado = " <div class='alert alert-success' role='alert'><span>Saída finalizada com sucesso!</span> </div>";
                    $termo = "";
                    $tipo = 1;
                    $status2 = $cod_saida;
                    $pedidosController->AlterStatusTodos2(3, $cod_saida);
                    $listasaidas3 = $pedidosController->RetornarPedidos($termo, $tipo, $status2);
                    // var_dump($listasaidas3);
                    if ($listasaidas3 != NULL) {
                        foreach ($listasaidas3 as $saidas3) {
                            $qtd_saida = $saidas3->getQtd();
                            $cod_produto2 = $saidas3->getServico();
                            $total = $total + $saidas3->getValor();
                            $tipo_servico = $servicoController->RetornarTipo($cod_produto2);
                            if ($tipo_servico == 1) {
                                $qtd_final = 0;
                                $qtd_produto = $servicoController->RetornarNomeValorProdutos($cod_produto2);
                                $qtd_final = $qtd_produto - $qtd_saida;
                                $servicoController->AlterQtdEstoque($qtd_final, $cod_produto2);
                            }
                        }
                        $totalfinal = $total;
                        if ($formapagamento == 1) {
                            $tipopag1 = 1;
                            $tipopag2 = 1;
                        } else if ($formapagamento == 2) {
                            $tipopag1 = 2;
                            $tipopag2 = 1;

                            if ($juros == 1) {
                                $valorparcela = $totalfinal / $numparcelas;
                                $totalfinal2 = $totalfinal;
                                $totalfinal = number_format($totalfinal, 2, ',', '.');
                                $valorparcela = number_format($valorparcela, 2, ',', '.');
                            } else if ($juros == 2) {
                                $totalfinal = $totalfinal + ($totalfinal * ($juros2 / 100));
                                $valorparcela = $totalfinal / $numparcelas;
                                $totalfinal2 = $totalfinal;
                                $totalfinal = number_format($totalfinal, 2, ',', '.');
                                $valorparcela = number_format($valorparcela, 2, ',', '.');
                            } else if ($juros == 3) {
                                $totalfinalporc = ($totalfinal * ($juros2 / 100));
                                $valorparcela = ($totalfinal / $numparcelas) + $totalfinalporc;
                                $totalfinal = 0;
                                for ($i = 1; $i <= $numparcelas; $i++) {
                                    $totalfinal = $totalfinal + $valorparcela;
                                }
                                $totalfinal2 = $totalfinal;
                                $totalfinal = number_format($totalfinal, 2, ',', '.');
                                $valorparcela = number_format($valorparcela, 2, ',', '.');
                            }

                            $total = $totalfinal;
                            $pontos = '.';
                            $total = str_replace($pontos, "", $total);

                            $total = str_replace(",", ".", $total);

                        }


                        $sqlTestePag = "SELECT * FROM financeiro_clientes WHERE cod_orcamento = :cod ORDER BY cod ASC";
                        $paramTestePag = array(
                            ":cod" => $cod_saida
                        );
                        $nomecategoria = "Avulso";
                        $dataTableTestePag = $banco->ExecuteQuery($sqlTestePag, $paramTestePag);
                        if ($dataTableTestePag == null) {
                            $query = mysqli_query($conn, "INSERT INTO `financeiro_clientes` (`cod_orcamento`, `tipo`, `total`, `numparcelas`, `tipopag`, `dia`, `mes`, `ano`, `gorjeta`, `dinheiro`, `debito`, `credito`,`pix`) VALUES ('" . $cod_saida . "', '" . $tipopag1 . " ', '" . $total . " ', '" . $numparcelas . "', " . $tipopag2 . " , '" . $dia . " ', '" . $mes . " ', '" . $ano . " ', '" . $troco . "', '" . $dinheiroreal . "', '" . $cartaodeb . "', '" . $cartaocred . "', '" . $pix . "')");
                            // Se inserido com scesso
                            if ($query) {
                                $sqlNota = mysqli_query($conn, "SELECT * FROM notas WHERE cod = $cod_saida ORDER BY cod ASC");
                                while ($notaspesquisa = mysqli_fetch_object($sqlNota)) {
                                    $codnota = $notaspesquisa->cod;
                                    $usuarionota = $notaspesquisa->usuario;
                                }

                                $status = 1;
                                $usuario1 = $codusuario2;
                                $func = $_SESSION["codF"];

                                $data_hoje2 = date('d/m/Y');

                                $t = explode("/", $data_hoje2);
                                $dia = $t[0];
                                $mes = $t[1];
                                $ano = $t[2];
                                ?>
                                <script>
                                    window.location.href = "index.php?pagina=carinhocompras&cod=<?= $cod_saida; ?>";
                                </script>
                                <?php
                            }
                        }
                    }
                    //header("Location: index.php?pagina=carinhocompras&cod=$cod_saida");
                } else {
                    $resultado = " <div class='alert alert-danger' role='alert'><span>Houve um erro ao trocar status da saída!</span> </div>";
                }
            }
        }
    }
}
//FIM SUBMIT PARA FINALIZAR PAGAMENTO
?>

<script src="interface/js/jquery_2.1.1_jquery.min.js"></script>
<script>

    <?php if ($testelogico == 0) { ?>
        $(document).keydown(function (e) {
            if (e.keyCode == 113) {
                buscarPagamentoCar(4, 0, <?= $codnota; ?>, 1);
            }

            if (e.keyCode == 115) {
                buscarPedidoAvulsoCar(5, 0, <?= $codnota; ?>, 1);
            }
            if (e.keyCode == 119) {
                buscarClientesCar(6, 0, <?= $codnota; ?>, 1);
            }


            if (e.keyCode == 120) {
                //imprmir nota fiscal via javascript ou chamadaa de phg
                //GerarTelasCarrinho(1, 1, <?= $codnota ?>)
                window.open('pdf2.php?cod=<?= $codnota ?>');

            }

            if (e.keyCode == 121) {
                //imprmir nota fiscal via javascript ou chamadaa de phg
                buscarEdPedido(7, 1, <?= $codnota ?>);


            }



        });
        //FIM FUNÇÕES PARA USAR ATALHO DO TECLADO 
        <?php
    }
    ?>


    $(document).ready(function () {

        //For Card Number formatted input
        var cardNum = document.getElementById('cr_no');
        cardNum.onkeyup = function (e) {
            if (this.value == this.lastValue) return;
            var caretPosition = this.selectionStart;
            var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
            var parts = [];

            for (var i = 0, len = sanitizedValue.length; i < len; i += 4) {
                parts.push(sanitizedValue.substring(i, i + 4));
            }

            for (var i = caretPosition - 1; i >= 0; i--) {
                var c = this.value[i];
                if (c < '0' || c > '9') {
                    caretPosition--;
                }
            }
            caretPosition += Math.floor(caretPosition / 4);

            this.value = this.lastValue = parts.join('-');
            this.selectionStart = this.selectionEnd = caretPosition;
        }

        //For Date formatted input
        var expDate = document.getElementById('exp');
        expDate.onkeyup = function (e) {
            if (this.value == this.lastValue) return;
            var caretPosition = this.selectionStart;
            var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
            var parts = [];

            for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
                parts.push(sanitizedValue.substring(i, i + 2));
            }

            for (var i = caretPosition - 1; i >= 0; i--) {
                var c = this.value[i];
                if (c < '0' || c > '9') {
                    caretPosition--;
                }
            }
            caretPosition += Math.floor(caretPosition / 2);

            this.value = this.lastValue = parts.join('/');
            this.selectionStart = this.selectionEnd = caretPosition;
        }

        // Radio button
        $('.radio-group .radio').click(function () {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

    })
</script>
<?PHP
if (isset($_SESSION["permissaoF"])) {
    if ($testelogico == 0) {
        ?>
        <!--INICIO DO MENU SUPERIOR -->

        <nav style='margin-top:-25px;' data-bs-theme="primary" class="navbar bg-primary  navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <!-- <a class="nav-link disabled">Login</a> -->
                        </li>
                    </ul>
                    <form class="d-flex" role="search" style="width: 100%; margin-top: 0px;">
                        <!-- EM FUNÇÃO JAVASCRIPT BUSCAR, PRIMEIRO PARAMETRO É QUAL FUNCAO SERÁ MOSTRADA DENTRO DO PHP, O VALOR DIGITADO, O CÓDIGO DA NOTA DE VENDA E O TIPO DE PARAMETRO DE PESQUISA SE É POR CATEGORIA OU NOME -->
                        <input tabindex="1" onkeyup="buscarServicos(1, this.value, <?= $codnota; ?>, 0)" autofocus=''
                            class="InputStyle" placeholder="Localize seus produtos/serviços..."
                            style="background-color: #4169E1; color:#fff;  width:100%; padding: 10px; font-family:Arial, FontAwesome"
                            type="text" type="search" aria-label="Search" id="TxtPesquisarItem">
                        <a id="Btncategorias" onclick="buscarServicos(3, 0, <?= $codnota; ?>, 1)" href="javascript:func"
                            style='margin-left: 10px; padding: 10px; background-color: #4169E1; color:#fff; width: 30%;'
                            class="InputStyle" type="submit">
                            Categorias
                        </a>
                    </form>
                </div>
            </div>
        </nav>
    <?php }

    // Procura titulos no banco relacionados ao valor
    $sqlPedido = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = " . $codnota . " ORDER BY cod DESC");
    $total = 0;
    $codpedido = 0;
    $qtdpedidos = 0;
    $totalfinal = 0;
    $valor = 0;
    while ($pedidos = mysqli_fetch_object($sqlPedido)) {
        $qtdpedidos = $qtdpedidos + (float) $pedidos->qtd;
        $valor = (float) $pedidos->valor;
        $totalfinal = $totalfinal + $valor;
    }
    $totalfinal2 = $totalfinal;

    $totalfinal2 = 0;
    $totalfinal2 = number_format($totalfinal, 2, ',', '.');
    $qtdpedidos = number_format($qtdpedidos, 3, ',', '.');

    ?>
    <div id='ResultadoAdicionar' style='width: 100%; text-align: center; display:flex;'>
        <a id="Btnitem" style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
            class="InputStyle" type="submit">
            QTD ITENS: <?= $qtdpedidos; ?>
    </a>
    <a id="Btnvalor" style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
        class="InputStyle" type="submit">
        VALOR: R$ <?= $totalfinal2; ?>
    </a>
</div>
<!--FIM DO MENU SUPERIOR -->
<?php } ?>

<!--INICIO DO MENU LATERAL -->

<main class="d-flex flex-nowrap" style="height:81%;">

    <div class="d-flex flex-column flex-shrink-0 bg-body-tertiary" style="width: 4.5rem;">
        <a href="" class="d-block p-3 link-body-emphasis text-decoration-none" data-bs-toggle="tooltip"
            data-bs-placement="right" data-bs-original-title="Sisven">
            <img src="interface/img/logo-sem-fundo.png" width="40" height="40">

            <span class="visually-hidden">Sisven </span>
        </a>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center" style="background-color: #4169E1;">
            <?php if ($testelogico == 0) { ?>
                <li class="nav-item">
                    <a onclick="buscarPagamentoCar(4, 0, <?= $codnota; ?>, 1)" href="javascript:func"
                        class="nav-link  py-3 border-bottom rounded-0" aria-current="page" data-bs-toggle="tooltip"
                        data-bs-placement="right" aria-label="Home" data-bs-original-title="F2 - Pagamentos">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                            viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                            <g>
                                <rect fill="none" height="24" width="24" />
                            </g>
                            <g>
                                <path
                                    d="M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2 S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44 C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z M12,2l4,4l-4,4l-1.41-1.41L12.17,7L8,7l0-2l4.17,0l-1.59-1.59L12,2z" />
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a onclick="buscarPedidoAvulsoCar(5, 0, <?= $codnota; ?>, 1)" href="javascript:func" tabindex="12"
                        href="" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip"
                        data-bs-placement="right" aria-label="Dashboard" data-bs-original-title="F4 - Item Avulso">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                            viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                            <rect fill="none" height="24" width="24" />
                            <path
                                d="M13,10h-2V8h2V10z M13,6h-2V1h2V6z M7,18c-1.1,0-1.99,0.9-1.99,2S5.9,22,7,22s2-0.9,2-2S8.1,18,7,18z M17,18 c-1.1,0-1.99,0.9-1.99,2s0.89,2,1.99,2s2-0.9,2-2S18.1,18,17,18z M8.1,13h7.45c0.75,0,1.41-0.41,1.75-1.03L21,4.96L19.25,4l-3.7,7 H8.53L4.27,2H1v2h2l3.6,7.59l-1.35,2.44C4.52,15.37,5.48,17,7,17h12v-2H7L8.1,13z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="?pagina=carinhocompras&cod=<?= $codnota; ?>" tabindex="13" style=""
                        class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right"
                        aria-label="Orders" data-bs-original-title="F5 - Add Itens">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#FFFFFF">
                            <path d="M0 0h24v24H0zm18.31 6l-2.76 5z" fill="none" />
                            <path
                                d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z" />
                        </svg>
                    </a>
                </li>
                <!--  <li>
        <a href="" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Products" data-bs-original-title="Pedidos">
          <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Products"><use xlink:href="#grid"></use></svg>
        </a>
      </li> -->
                <li>
                    <a onclick="buscarClientesCar(6, 0, <?= $codnota; ?>, 1)" href="javascript:func" tabindex="14"
                        class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right"
                        aria-label="Customers" data-bs-original-title="F8 - Clientes">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                            viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                            <g>
                                <rect fill="none" height="24" width="24" />
                            </g>
                            <g>
                                <g>
                                    <circle cx="10" cy="8" r="4" />
                                    <path
                                        d="M10.35,14.01C7.62,13.91,2,15.27,2,18v2h9.54C9.07,17.24,10.31,14.11,10.35,14.01z" />
                                    <path
                                        d="M19.43,18.02C19.79,17.43,20,16.74,20,16c0-2.21-1.79-4-4-4s-4,1.79-4,4c0,2.21,1.79,4,4,4c0.74,0,1.43-0.22,2.02-0.57 L20.59,22L22,20.59L19.43,18.02z M16,18c-1.1,0-2-0.9-2-2c0-1.1,0.9-2,2-2s2,0.9,2,2C18,17.1,17.1,18,16,18z" />
                                </g>
                            </g>
                        </svg>
                    </a>
                </li>
                <li>
                    <a tabindex="15" href="pdf2.php?cod=<?= $codnota ?>" target='_BLANK'
                        class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right"
                        aria-label="Customers" data-bs-original-title="F9 - Nota">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#FFFFFF">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a onclick="buscarEdPedido(7, 0, <?= $codnota; ?>, 1)" href='javascript:func' tabindex="16"
                        href="https://getbootstrap.com/docs/5.3/examples/sidebars/#"
                        class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right"
                        aria-label="Customers" data-bs-original-title="F10 - Editar Item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#FFFFFF">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm7-7H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-1.75 9c0 .23-.02.46-.05.68l1.48 1.16c.13.11.17.3.08.45l-1.4 2.42c-.09.15-.27.21-.43.15l-1.74-.7c-.36.28-.76.51-1.18.69l-.26 1.85c-.03.17-.18.3-.35.3h-2.8c-.17 0-.32-.13-.35-.29l-.26-1.85c-.43-.18-.82-.41-1.18-.69l-1.74.7c-.16.06-.34 0-.43-.15l-1.4-2.42c-.09-.15-.05-.34.08-.45l1.48-1.16c-.03-.23-.05-.46-.05-.69 0-.23.02-.46.05-.68l-1.48-1.16c-.13-.11-.17-.3-.08-.45l1.4-2.42c.09-.15.27-.21.43-.15l1.74.7c.36-.28.76-.51 1.18-.69l.26-1.85c.03-.17.18-.3.35-.3h2.8c.17 0 .32.13.35.29l.26 1.85c.43.18.82.41 1.18.69l1.74-.7c.16-.06.34 0 .43.15l1.4 2.42c.09.15.05.34-.08.45l-1.48 1.16c.03.23.05.46.05.69z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <a tabindex="17" href="?" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip"
                        data-bs-placement="right" aria-label="Customers" data-bs-original-title="Voltar">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                            fill="#FFFFFF">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M19 7v4H5.83l3.58-3.59L8 6l-6 6 6 6 1.41-1.41L5.83 13H21V7z" />
                        </svg>
                    </a>
                </li>
            </ul>
            <?PHP
            } else {
                ?>
            <li>
                <a tabindex="15" href="pdf2.php?cod=<?= $codnota ?>" target='_BLANK'
                    class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right"
                    aria-label="Customers" data-bs-original-title="Nota">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z" />
                    </svg>
                </a>
            </li>
            <li>
                <a tabindex="15" href="Imprimir.php?pagina=2&cod=<?= $codnota; ?>" target='_BLANK'
                    class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right"
                    aria-label="Customers" data-bs-original-title="Ordem de Serviço">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z" />
                    </svg>
                </a>
            </li>
            <li>
                <a tabindex="17" href="?" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip"
                    data-bs-placement="right" aria-label="Customers" data-bs-original-title="Voltar">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M19 7v4H5.83l3.58-3.59L8 6l-6 6 6 6 1.41-1.41L5.83 13H21V7z" />
                    </svg>
                </a>
            </li>
            <?php
            }
            ?>

    </div>
    <?php if ($testelogico == 0) { ?>
        <div class="displayinfinito" id='ListaPedidosTodos'
            style='width:100%; text-align:left; margin-left:2px; margin-top:10px;'>
        </div>
    <?php } else {
        $sqlNotas = "SELECT * FROM notas WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
        $paramNotas = array(
            ":cod" => $codnota
        );

        $dataTableNotas = $banco->ExecuteQuery($sqlNotas, $paramNotas);
        foreach ($dataTableNotas as $resultadonotas) {
            $usuarionota = $resultadonotas['usuario'];
            $nomecli = $resultadonotas['nomeCli'];

            $tipopedido = $resultadonotas['tipo_pedido'];
            $ordem = $resultadonotas['ordem'];

            if ($tipopedido == 1) {
                $ordem = $resultadonotas['ordem'];
            } else {
                $ordem = 'E' . $codnota;
            }

            //$sqlNomecli = mysqli_query($conn, "SELECT * FROM clientes WHERE id = $usuarionota ORDER BY id ASC LIMIT 1");
            $sqlNomeCli = "SELECT * FROM clientes WHERE id = :cod ORDER BY id ASC LIMIT 1";
            $paramNomeCli = array(
                ":cod" => $usuarionota
            );
            $endereco = "";
            $bairro = "";
            $numero = "";
            $complemento = "";
            $celular = "";
            $nascimento = "";
            $dataTableNomeCli = $banco->ExecuteQuery($sqlNomeCli, $paramNomeCli);
            foreach ($dataTableNomeCli as $resultadonomecli) {
                $nomecli = $resultadonomecli['nome'];
                $endereco = $resultadonomecli['endereco'];
                $bairro = $resultadonomecli['bairro'];
                $numero = $resultadonomecli['numero'];
                $complemento = $resultadonomecli['complemento'];
                $celular = $resultadonomecli['celular'];
                $nascimento = $resultadonomecli['nascimento'];
                $cpf = $resultadonomecli['cpf'];
            }
        }
        ?>
        <div class="" id='' style='width:100%; text-align:left; margin-left:2px; margin-top:10px;'>
            <TABLE style='font-size:14pt; color:#000'
                class='table table-bordered striped centered highlight responsive-table'>
                <TR>
                    <Td>
                        <div class='alert alert-success' style=' font-size:27pt;'>
                            <b>Informações do Pedido</b></br>
                            <small>O código do seu pedido é:</small> <b style='color:#000'>
                                <?= $ordem; ?>
                            </b> </br>
                            <small>Forma de Pagamento:</small> <b style='color:#000'>
                                <?= $textotipo; ?>
                            </b> </br>

                        </div>
                    </td>
                </TR>
            </TABLE>
            <form style='width:95%; display:flex; margin-left:2%; margin-top:2%;' onsubmit='return ConfirmarIsso();'
                method='post' name='frmCadastro2' id='frmCadastro2' novalidate enctype='multipart/form-data'>

                <input name='txtCodCliente' id='txtCodCliente' value='0' type='hidden' />
                <select autofocus="" onchange='' tabindex='31' style='height: 82px; font-size: 15pt; width: 100%;'
                    class='form-control' id='txtTipoEntrega' name='txtTipoEntrega' onchange=''>
                    <option value='1'>Balcão</option>
                    <option value='2'>Entrega</option>
                </select>
                </br>
                <input tabindex='32' style='padding:15px; font-size: 9pt; width: 100%;  font-weight: bold'
                    class='btn btn-success btn-lg btn-block ' type='submit' name='btnSubmitPedir' id='btnSubmitPedir'
                    style='' value='Inciar Pedido'>
            </form>

        </div>



    <?php } ?>
    <div class="bloco-de-notas" id='ResultadoValidacao50'>
        <h1>Lista de Itens</h1>
        <table class="table table-responsive table-dark" style="">
            <tr style='background-color:#000;'>
                <td>Item</td>
                <td>Qtd</td>
                <td>Valor</td>
                <td>Total</td>
            </tr>
            <?php
            $contador = 20;

            //$sql = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = " . $codnota . " ORDER BY cod ASC");
            $sqlPedidos2 = "SELECT * FROM pedidos WHERE usuario = :cod ORDER BY cod DESC";
            $paramPedidos2 = array(
                ":cod" => $codnota
            );

            $dataTablePedidos2 = $banco->ExecuteQuery($sqlPedidos2, $paramPedidos2);
            foreach ($dataTablePedidos2 as $resultadopedidos2) {

                $codpedido = $resultadopedidos2['cod'];
                $codservico = $resultadopedidos2['servico'];

                if ($codservico == 0) {
                    $nomeservico = $resultadopedidos2['obs'] . "<b><small>(Avulso)</small>" . "<b>";
                    $obs = "";
                } else {
                    $categoria = $resultadopedidos2['categoria'];
                    //$sql3 = mysqli_query($conn, "SELECT * FROM categoriaserfin WHERE cod=$categoria LIMIT 1");
                    $sqlCategorias = "SELECT * FROM categoriaserfin WHERE cod=  :cod LIMIT 1";
                    $paramCategorias = array(
                        ":cod" => $categoria
                    );
                    $nomecategoria = "Avulso";
                    $dataTableCategorias = $banco->ExecuteQuery($sqlCategorias, $paramCategorias);
                    foreach ($dataTableCategorias as $resultadocategorias) {
                        $nomecategoria = $resultadocategorias['nome'];
                    }
                    //$sql2 = mysqli_query($conn, "SELECT * FROM servicos WHERE cod=" . $codservico . " LIMIT 1");
                    $sqlServicos = "SELECT * FROM servicos WHERE cod= :cod LIMIT 1";
                    $paramServicos = array(
                        ":cod" => $codservico
                    );

                    $dataTableServicos = $banco->ExecuteQuery($sqlServicos, $paramServicos);
                    foreach ($dataTableServicos as $resultadoservicos) {
                        $nomeservico = $resultadoservicos['nome'] . "<b><small>(" . $nomecategoria . ")</small>" . "<b>";
                        $obs = $resultadopedidos2['obs'];
                    }
                }
                $valor = (float) $resultadopedidos2['valor'];
                $qtd = (float) $resultadopedidos2['qtd'];
                $valorunt = $valor / $qtd;
                $total = $total + $valor;
                $codpedido = $resultadopedidos2['cod'];
                $nomecategoria = "";
                $valorunt = number_format($valorunt, 2, ',', '.');
                $valor = number_format($valor, 2, ',', '.');

                echo "
				
					<tr>
						<td><b>" . $nomeservico . "<b></td>
						<td>$qtd</td>
						<td>R$ " . $valorunt . "</td>
						<td>R$ " . $valor . "</td>
					</tr>
		   ";
                $botaoapagar = "";
                if ($testelogico == 0) {
                    $botaoapagar = "<a style='font-size:16pt;' tabindex='$contador' id='primeirobotao' href='javascript: func()' onclick='CadastrarPedidoAvulso2(17, 0, $codnota, $codpedido, 0, 0)'    class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Apagar</a>";
                }
                if ($codservico != 0) {
                    echo "<tr>
                        <td>Obs:</td>
                        <td>$obs</td>
                        <td colspan='2' style='text-align:right;'>  
                             $botaoapagar  
						</td>
                        </tr>";
                } else {
                    echo "<tr>
                    <td colspan='4' style='text-align:right;'>  
                        $botaoapagar   
                    </td>
                    </tr>";
                }
                $contador++;
            }
            $total = number_format($total, 2, ',', '.');
            ?>
        </table>
    </div>
    </div>
    </div>
</main>