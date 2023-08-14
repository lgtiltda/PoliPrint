 <?php
 session_start();
 // Incluir aquivo de conex o
 include("conn.php");
 include("Banco.php");
 date_default_timezone_set('America/Manaus');
 //Error_reporting(0);
 

 $tipo = $_GET['tipo'];
 $cod_func = $_SESSION['codF'];
 $banco = new Banco();

 switch ($tipo) {
     //GERAR PAGINA PESQUISA DE SERVIÇOS 
     case 1:

         $valor = $_GET['valor'];
         $codnota = $_GET['codnota'];
         $categoria = $_GET['categoria'];
         $contindex = 1;
         //TESTANDO SQL PARA CODIGO DE BARRAS, SE VERDADEIRO DEVERÁ RETORNAR SE ESTÁ ENCONTRANDO O PRODUTO POR CÓDIGO DE BARRA OU CÓDIGO INTERNO
         if ($categoria == 0) { // CONDIÇÃO PARA VERIFICAR SE O USUARIO ESTÁ BUSCANDO POR NOME DO ITEM OU CATEGORIA, NO CASO 0 ESTÁ BUSCANDO POR NOME, CASO DIFERENTE DE 0 ESTÁ BUSCANDO POR CATEGORIA
             $sqlServicos2 = "SELECT * FROM servicos WHERE  codbarra = :nome AND codbarra != '' OR codbusca = :nome2 AND codbusca != '' || nome LIKE :nome3   ORDER BY cod ASC LIMIT 10";
             $paramServicos2 = array(
                 ":nome" => $valor,
                 //PARAMETRO DE PESQUISA ENVIANDO PELO INPUT PARA COD.BARRA
                 ":nome2" => $valor,
                 //PARAMETRO DE PESQUISA ENVIANDO PELO INPUT PARA COD.BUSCA
                 ":nome3" => "%{$valor}%" //PARAMETRO DE PESQUISA ENVIANDO PELO INPUT PARA BUSCAR POR DESCRICAO DO ITEM
             );
         } else {
             $sqlServicos2 = "SELECT * FROM servicos WHERE  codbarra = :nome AND codbarra != '' OR codbusca = :nome2 AND codbusca != '' || categoria = :nome3   ORDER BY cod ASC LIMIT 10";
             $paramServicos2 = array(
                 ":nome" => $valor,
                 ":nome2" => $valor,
                 ":nome3" => $valor
             );

         }

         $dataTableServicos2 = $banco->ExecuteQuery($sqlServicos2, $paramServicos2);
         if ($dataTableServicos2 != null) {
             foreach ($dataTableServicos2 as $resultadoservicos) {
                 $codservico = $resultadoservicos['cod'];
                 $nomeservico = $resultadoservicos['nome'];
                 $tiposervico = $resultadoservicos['tipo'];
                 $valorservico = $resultadoservicos['valor'];
                 $imgservico = $resultadoservicos['img'];
                 $qtdservico = $resultadoservicos['qtd'];
                 $categoriaservico = $resultadoservicos['categoria'];

                 $contindex++;
                 if ($tiposervico == 0) {
                     $textotipo = "&nbsp";
                 } else {
                     $textotipo = "ESTOQUE ATUAL: $qtdservico";
                 }

                 if ($imgservico == null) {
                     $imgpadrao = "imagempadrao3.png";
                 } else {
                     $imgpadrao = $imgservico;
                 }

                 echo "
              <a onclick='CadastrarPedido(2, $codservico, $codnota, $valorservico, $categoriaservico, 0)' tabindex='$contindex' style='margin-left:10px;' href='javascript:func'>
              <div class='col-md-4'>
                  <div class='card' style='width: 18rem;'>
                      <img src='interface/img/Servicos/$imgpadrao' class='card-img-top' alt='...'>
                      <div class='card-body'>
                          <h5 class='card-title'>$nomeservico</h5>
                          <p class='card-text' style='color:green; font-size: 18pt;;'>R$ " . number_format($valorservico, 2, ',', '.') . " </p>
                          <p class='card-text' style='color:RED; font-size: 12pt;;'> $textotipo</p>
                      </div>
                  </div>
              </div>
          </a> 
              ";
             }
         }
         break;
     //ADICIONAR ITEM AO PEDIDO    
     case 2:
         $codservico = $_GET['id'];
         $codnota = $_GET['codnota'];
         $valor = $_GET['valor'];
         $valor = number_format($valor, 2, ",", ".");
         $categoria = $_GET['categoria'];
         $qtd = 1;
         $qtdpedido2 = 0;

         $pontos = '.';
         $result = str_replace($pontos, "", $valor);
         $result = str_replace(",", ".", $result);
         $valor = $result;
         $valor = (float) $valor;
         $valor = $valor * $qtd;


         $valor = number_format($valor, 2, '.', '');
         $status = 1;
         $obs = "";
         $dia = date('d');
         $mes = date('m');
         $ano = date('Y');

         //$query = mysqli_query($conn, "INSERT INTO `pedidos` (`cod`, `dente`, `servico`, `usuario`, `qtd`, `valor`, `status`, `nivel`, `obs`, `tipo`, `dia`, `mes`, `ano`, `categoria`) VALUES (NULL, NULL, '" . $codservico . "', '" . $codnota . " ', '" . $qtd . " ', '" . $valor . " ', '1', NULL, NULL, NULL, '" . $dia . " ', '" . $mes . " ', '" . $ano . " ', '" . $categoria . " ')");
         // Se inserido com scesso
 

         $sql = "INSERT INTO `pedidos` (servico, usuario, qtd, valor, status, obs, dia, mes, ano, categoria) VALUES (:servico, :usuario, :qtd,  :valor, :status,:obs, :dia, :mes, :ano, :categoria)";
         $param = array(
             ":servico" => $codservico,
             ":usuario" => $codnota,
             ":qtd" => $qtd,
             ":valor" => $valor,
             ":status" => 1,
             ":obs" => $obs,
             ":dia" => $dia,
             ":mes" => $mes,
             ":ano" => $ano,
             ":categoria" => $categoria,
         );

         $banco->ExecuteNonQuery($sql, $param);

         $cod = $codnota;

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

         echo " 
         
             <a id='Btnitem' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
                 class='InputStyle' type='submit'>
                 QTD ITENS: $qtdpedidos
             </a>
             <a id='Btnvalor' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
                 class='InputStyle' type='submit'>
                 VALOR: R$ $totalfinal2
             </a>
       
   
         ";

         break;
     //GERAR PAGINA CHAMAR CATEGORIAS DE PRODUTOS/SERVIÇOS 
     case 3:

         $valor = $_GET['valor'];
         $codnota = $_GET['codnota'];
         $categoria = $_GET['categoria'];
         $contindex = 1;
         //CODIGO PARA MOSTRAR AS CATEGORIAS DE PRODUTOS
         $sqlServicos2 = "SELECT * FROM categoriaserfin ORDER BY cod ASC";

         $dataTableServicos2 = $banco->ExecuteQuery($sqlServicos2);
         if ($dataTableServicos2 != null) {
             foreach ($dataTableServicos2 as $resultadoservicos) {
                 $codservico = $resultadoservicos['cod'];
                 $nomeservico = $resultadoservicos['nome'];
                 $imgservico = $resultadoservicos['img'];


                 $contindex++;

                 if ($imgservico == null) {
                     $imgpadrao = "imagempadrao3.png";
                 } else {
                     $imgpadrao = $imgservico;
                 }

                 echo "
             <a onclick='buscarServicos(1, $codservico, $codnota, $codservico)' tabindex='$contindex' style='margin-left:10px;' href='javascript:func'>
             <div class='col-md-4'>
                 <div class='card' style='width: 18rem;'>
                     <img src='interface/img/Servicos/$imgpadrao' class='card-img-top' alt='...'>
                     <div class='card-body'>
                         <h5 class='card-title'>$nomeservico</h5>
                         </div>
                 </div>
             </div>
         </a> 
             ";
             }
         }
         break;
     //FUNCAO PARA CHAMAR TELA DE ADICOONAR PEDIDO pagamento
     case 4:
         $codnota = $_GET['codnota'];
         $parampag = $_GET['valor'];
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

         $totalfinal2 = 0;
         //   $totalfinal2 = number_format($totalfinal, 2, ',', '.');
         $qtdpedidos = number_format($qtdpedidos, 3, ',', '.');

         $totalfinal2 = $totalfinal;
         $totalfinal = number_format($totalfinal, 2, ',', '.');
         $valorfinal = $totalfinal;

         $sqlNota = mysqli_query($conn, "SELECT * FROM notas WHERE cod = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($notaspesquisa = mysqli_fetch_object($sqlNota)) {
             $usuarionota = $notaspesquisa->usuario;
             $nomecli = $notaspesquisa->nomeCli;
         }

         if ($parampag == 0) {

             echo "
            <div class='container-fluid'>
            <div class='row'>
                <form onsubmit='return ConfirmarIsso();'   name='form_cadastrarmovimento' method='post' action='' style='margin-top:5px; width:100%;'>
                <div class='col-md-12 col-sm-12 p-0 box'>
                     <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                        <a  style='color:#ccc;' href='javascript: func' onclick='buscarPagamentoCar(4, 0, $codnota, 1)'  id='heading2' class='text-danger'>Pagamento á Vista</a> 
                        ";
             if ($usuarionota != 0) {
                 echo "/ <a  style='color:#ccc;' href='javascript: func' onclick='buscarPagamentoCar(4, 1, $codnota, 1)'  id='heading2' class=''>Pagamento Crediário</a> ";
             }
             echo " 
                        <div class='input-group mb-3'>
                        <span style='height:50px;' class='input-group-text' id='basic-addon1'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='120' viewBox='0 -960 960 960' width='48'><path d='M540-420q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM220-280q-24.75 0-42.375-17.625T160-340v-400q0-24.75 17.625-42.375T220-800h640q24.75 0 42.375 17.625T920-740v400q0 24.75-17.625 42.375T860-280H220Zm100-60h440q0-42 29-71t71-29v-200q-42 0-71-29t-29-71H320q0 42-29 71t-71 29v200q42 0 71 29t29 71Zm480 180H100q-24.75 0-42.375-17.625T40-220v-460h60v460h700v60ZM220-340v-400 400Z'/></svg>
                        </span>
                        <input onkeyup='ValidacaoGeralPagamento(14, $codnota, this.value, pagamentocartaodeb.value, pagamentocartaocred.value, pagamentopix.value, pagamentototal.value, pagamentotroco.value)' style='height:50px; margin-top:0px; font-size:14pt;' type='number' class='form-control' placeholder='Pagamento em Dinheiro' aria-label='Pagamento em Dinheiro' aria-describedby='basic-addon1' id='pagamentodinheiro' name='pagamentodinheiro' value=''>
                        </div>
                        <div class='input-group mb-3' style='margin-top:-41px;'>
                        <span style='height:50px;' class='input-group-text' id='basic-addon1'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='48' height='80' viewBox='0 0 24 24' fill='none' stroke='blue' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-credit-card'><rect x='1' y='4' width='22' height='16' rx='2' ry='2'></rect><line x1='1' y1='10' x2='23' y2='10'></line></svg>
                        </span>
                        <input onkeyup='ValidacaoGeralPagamento(14, $codnota, pagamentodinheiro.value, this.value, pagamentocartaocred.value, pagamentopix.value, pagamentototal.value, pagamentotroco.value)' style='height:50px; margin-top:0px; font-size:14pt;' type='number' class='form-control' placeholder='Pagamento em Cartão de Débito' aria-label='Pagamento em Cartão de Débito' aria-describedby='basic-addon1' id='pagamentocartaodeb' name='pagamentocartaodeb'>
                        </div>
                        <div class='input-group mb-3' style='margin-top:-41px;'>
                        <span style='height:50px;' class='input-group-text' id='basic-addon1'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='48' height='80' viewBox='0 0 24 24' fill='none' stroke='red' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-credit-card'><rect x='1' y='4' width='22' height='16' rx='2' ry='2'></rect><line x1='1' y1='10' x2='23' y2='10'></line></svg>
                        </span>
                        <input onkeyup='ValidacaoGeralPagamento(14, $codnota, pagamentodinheiro.value, pagamentocartaodeb.value, this.value, pagamentopix.value, pagamentototal.value, pagamentotroco.value)' style='height:50px; margin-top:0px; font-size:14pt;' type='number' class='form-control' placeholder='Pagamento em Cartão de Crédito' aria-label='Pagamento em Cartão de Crédito' aria-describedby='basic-addon1' id='pagamentocartaocred' name='pagamentocartaocred'>
                        </div>
                        <div class='input-group mb-3' style='margin-top:-41px;'>
                        <span style='height:50px;' class='input-group-text' id='basic-addon1'>
                        <img width='48' height='40' src='interface/img/svg/iconepix.png' />
                        </span>
                        <input onkeyup='ValidacaoGeralPagamento(14, $codnota, pagamentodinheiro.value, pagamentocartaodeb.value, pagamentocartaocred.value, this.value, pagamentototal.value, pagamentotroco.value)' style='height:50px; margin-top:0px; font-size:14pt;' type='number' class='form-control' placeholder='Pagamento no Pix' aria-label='Pagamento no Pix' aria-describedby='basic-addon1' id='pagamentopix' name='pagamentopix'>
                        </div>
                        <div class='input-group mb-3' style='margin-top:-41px;'>
                        <span style='height:60px; width:75px; font-size:14pt;' class='input-group-text' id='basic-addon1'>
                        <b >Valor </br> Total</b>
                        </span>
                        <input disabled style='height:60px; margin-top:0px; font-size:14pt;' type='text' class='form-control' placeholder='Valor Total' aria-label='Valor Total' aria-describedby='basic-addon1' id='pagamentototal2' name='pagamentototal2' value='R$ $totalfinal'>
                        <input type='hidden' class='form-control' placeholder='Valor Total' aria-label='Valor Total' aria-describedby='basic-addon1' id='pagamentototal' name='pagamentototal' value='$totalfinal2'>
                        </div>
                        <input type='hidden' value='1' id='txtParamControle2' name='txtParamControle2'>
                        <input type='hidden' value='0' id='numparcelas' name='numparcelas'>
                        <input type='hidden' value='0' id='juros' name='juros'>
                        <input type='hidden' value='0' id='juros2' name='juros2'>
                        <input type='hidden' value='$codnota' id='txtCod' name='txtCod'>
                        
                        <div id='ResultadoValidacaoPagamento'>
                            
                        <input type='hidden' value='0' id='pagamentotroco' name='pagamentotroco'>
                       
                    </div>
                </div>
                </from>
            </div>
        </div>
            ";

         } else {
             echo "
            <div class='container-fluid'>
            <div class='row'>
            <form onsubmit='return ConfirmarIsso();'   name='form_cadastrarmovimento' method='post' action='' style='margin-top:5px; width:100%;'>
                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                        <a  style='color:#ccc;' href='javascript: func' onclick='buscarPagamentoCar(4, 0, $codnota, 1)'  id='heading2' class=''>Pagamento á Vista</a>
                        ";
             if ($usuarionota != 0) {
                 echo "/ <a  style='color:#ccc;' href='javascript: func' onclick='buscarPagamentoCar(4, 1, $codnota, 1)'  id='heading2' class='text-danger'>Pagamento Crediário</a> ";
             }
             echo "
                        <div class='input-group mb-3'>";
             $dinheirooudebito = 0;

             echo "<div class='row col-12' style='margin-bottom:10px; width:100%;'>
                                                        <div class='col-12 col-md-6 card' style='box-shadow: 2px 2px 5px #000;'></br></br>
                                                                    <div class='input-group'>
                                                                    <select onchange='Parcelamento(16, this.value, $codnota, juros.value, juros2.value)' style='font-size:18pt; padding:15px; height:60px;' class='form-control' id='numparcelas' name='numparcelas'>
                                                                    <option value='1'>1x</option>
                                                                    <option value='2'>2x</option>
                                                                    <option value='3'>3x</option>
                                                                    <option value='4'>4x</option>
                                                                    <option value='5'>5x</option>
                                                                	<option value='6'>6x</option>
                                                                    <option value='7'>7x</option>
                                                                    <option value='8'>8x</option>
                                                                    <option value='9'>9x</option>
                                                                    <option value='10'>10x</option>
                                                                    <option value='11'>11x</option>
                                                                    <option value='12'>12x</option>
                                                                    </select>
                                                                    </div>
                                                                    </br>
                                                                    <div class='input-group'>
                                                                    <select onchange='Parcelamento(16, numparcelas.value, $codnota, this.value, juros2.value)' style='font-size:18pt; padding:15px; height:60px;' class='form-control' id='juros' name='juros'>
                                                                    <option value='1'>Sem Juros</option>
                                                                    <option value='2'>Juros Simples</option>
                                                                    <option value='3'>Juros Composto</option>
                                                                    </select>
                                                                    </div>
                                                                    </br>
                                                                    <div class='input-group'>
                                                                    <select onchange='Parcelamento(16, numparcelas.value, $codnota, juros.value, this.value)' style='font-size:18pt; padding:15px; height:60px;' class='form-control' id='juros2' name='juros2'>
                                                                    <option value='1'>1%</option>
                                                                    <option value='2'>2%</option>
                                                                    <option value='3'>3%</option>
                                                                    <option value='4'>4%</option>
                                                                    <option value='5'>5%</option>
                                                                    <option value='6'>6%</option>
                                                                    <option value='7'>7%</option>
                                                                    <option value='8'>8%</option>
                                                                    <option value='9'>9%</option>
                                                                    <option value='10' selected='selected'>10%</option>
                                                                    <option value='20'>20%</option>
                                                                    <option value='30'>30%</option>
                                                                    <option value='40'>40%</option>
                                                                    <option value='50'>50%</option>
                                                                    <option value='60'>60%</option>
                                                                    <option value='70'>70%</option>
                                                                    <option value='80'>80%</option>
                                                                    <option value='90'>90%</option>
                                                                    <option value='100'>100%</option>
                                                                    </select>
                                                                    </div>
                                                        </div>
                                                        <div class='col-12 col-md-6 card' style='box-shadow: 2px 2px 5px #000;' id='resultadodoparcelamento'>
                                                            <label for='valortotal'><h4>Valor da Parcela</h4></label>
                                                            <div class='input-group'>
                                                            <input style='font-size:14pt; padding:25px;' disabled type='text' class='form-control' id='valorparcela' placeholder='' value='$valorfinal'>
                                                            </div>
                                                        
                                                            <label for='valortotal'><h4>Valor Total</h4></label>
                                                            <div class='input-group'>
                                                            <input style='font-size:14pt; padding:25px;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valorfinal'>
                                                            </div>
                                                        </div>
                                                    </div>    
                        </div>
                        <input type='hidden' value='2' id='txtParamControle2' name='txtParamControle2'>
                        <input type='hidden' value='$codnota' id='txtCod' name='txtCod'>
                      
                        <input type='hidden' value='2' id='txtParamControle2' name='txtParamControle2'>
                        <input type='hidden' value='0' id='pagamentodinheiro' name='pagamentodinheiro'>
                        <input type='hidden' value='0' id='pagamentocartaodeb' name='pagamentocartaodeb'>
                        <input type='hidden' value='0' id='pagamentocartaocred' name='pagamentocartaocred'>
                        <input type='hidden' value='0' id='pagamentopix' name='pagamentopix'>
                       
                        <div id='ResultadoValidacaoPagamento'>
                            <input type='hidden' value='0' id='pagamentotroco' name='pagamentotroco'>
                            <div class='col-md-12' style='margin-top:-40px;'>
                            <input style='width:100%; height:45px;' type='submit' value='FINALIZAR PAGAMENTO' class='btn btn-info placeicon' name='btnCadastrarFinalizarSaida' id='btnCadastrarFinalizarSaida'>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            ";

         }

         break;

     //FUNCAO PARA CHAMAR TELA DE ADICOONAR pedido avulso 
     case 5:
         $codnota = $_GET['codnota'];
         echo "
            <div class='container-fluid' >
            <div class='row' >
                

                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage' >
                        <div class='form-card' >
                            <h2 id='heading2' class='text-danger'>Adicionar item avulso</h2>
                            <label class='pay'>Descrição</label>
                            <input  tabindex='2' type='text' name='descricaopedido' id='descricaopedido' placeholder='Detalhes ou especificação do produto'>
                            <div class='row'>
                                <div class='col-12 col-md-6'>
                                    <label class='pay'>Valor Produto</label>
                                    <input onkeyup='ValidacaoGeralCarrinho(12, this.value, $codnota, qtdpedido.value, 2)' tabindex='3' type='text' name='valorunt' id='valorunt' placeholder='R$ 0,00'
                                        minlength='19' maxlength='19'>
                                </div>
                                <div class='col-12 col-md-6'>
                                    <label class='pay'>Qtd Produto</label>
                                    <input onkeyup='ValidacaoGeralCarrinho(12, valorunt.value, $codnota, this.value, 2)' tabindex='4' type='text' id='qtdpedido' name='qtdpedido' placeholder='0,000'
                                        class='placeicon' minlength='3' maxlength='5'>
                                </div>
                            </div>
                            <div id='ResultadoValidacao2'>
                            <label class='pay'>Valor Total</label>
                            <input style='color:#Fff;' disabled  tabindex='5' type='text' name='holdername' placeholder='R$ 0,00' value='R$ 0,00'>
                            </div>
                            <div class='row'>
                                <div class='col-md-12'>
                                        <button tabindex='6' style='padding:18px; font-size: 15pt; width: 100%;' href=\"javascript:func()\" onclick=\"CadastrarPedidoAvulso2(13, descricaopedido.value, '" . $codnota . "', valorunt.value , '0', qtdpedido.value)\" type='button' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-plus'></span> Salvar Pedido</button>
                               </div>        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
  
            ";

         break;

     //FUNCAO PARA CHAMAR TELA DE SELECIONAR CLIENTES
     case 6:
         $codnota = $_GET['codnota'];
         $param = $_GET['valor'];

         //PARAM = 0 BUSCAR POR NOME / PARAM = 1 BUSCAR POR MESA / PARA = 3 CADASTRAR CLIENTE 
         $testelogico = 0;
         $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
             $testelogico = 1;
         }
         $sqlNota = mysqli_query($conn, "SELECT * FROM notas WHERE cod = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($notaspesquisa = mysqli_fetch_object($sqlNota)) {
             $usuarionota = $notaspesquisa->usuario;
             $nomecli = $notaspesquisa->nomeCli;
         }

         echo "<div class='' style='width:99%;'>
         ";
         if ($testelogico == 0) {
             if ($usuarionota == 0) {
                 if ($nomecli != null) {
                     echo "<h2 class='alert alert-success'>$nomecli - SELECIONADA</h2>
                     ";
                 }
             } else {
                 $usuarionota;
                 //$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod = $codfornecedor ORDER BY cod ASC LIMIT 1");
                 $sqlFornecedores = "SELECT * FROM clientes WHERE id = :cod ORDER BY id ASC LIMIT 1";
                 $paramFornecedores = array(
                     ":cod" => $usuarionota
                 );
                 $dataTableFornecedores = $banco->ExecuteQuery($sqlFornecedores, $paramFornecedores);
                 foreach ($dataTableFornecedores as $resultadocli) {
                     $codfornecedor = $resultadocli['id'];
                     $nome = $resultadocli['nome'];
                     $endereco = $resultadocli['endereco'];
                     $bairro = $resultadocli['bairro'];
                     $numero = $resultadocli['numero'];
                     $complemento = $resultadocli['complemento'];
                     $celular = $resultadocli['celular'];
                 }
                 echo "<div class='alert alert-success'><h3 style='text-align:left; width:99%;'><b><span class='glyphicon glyphicon-hand-right'></span> Cliente selecionado</b></h3>
                                 ";
                 echo "<p >
                                <b>Nome:</b>$nome</br>
                                 <b>Endereço:</b>$endereco</br>
                                 <b>Bairro:</b>$bairro</br>
                                 <b>Número:</b>$numero</br>
                                 <b>Complemento:</b>$complemento</br>
                                 <b>Celular:</b>$celular</br>
                                 </p>
                             
                  </div>   ";
             }
         }

         if ($param == 0) {
             echo "
            <div class='container-fluid'>
            <div class='row' >
                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                            <a href='javascript: func' onclick='buscarClientesCar(6, 0, $codnota, 1)' id='heading2' class='text-danger'>Selecionar Cliente</a> /
                            <a  style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 2, $codnota, 1)'  id='heading2' class=''>Cadastar Cliente</a> / 
                            <a  style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 1, $codnota, 1)'  id='heading2' class=''>Selecionar Mesa</a>
                             </br>
                            <label class='pay'>Digite o nome do seu cliente!</label>
                            <input onKeyup='ValidacaoGeralCarrinho(10, this.value, $codnota, 0, 1)'  tabindex='2' type='text' name='txtClientesSelecionar' id='txtClientesSelecionar' placeholder='Nome do Cliente'>
                            <div class='row' id='ResultadoValidacao1'>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        ";
         } else if ($param == 1) {
             echo "
            <div class='container-fluid'>
            <div class='row' >
                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                            <a style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 0, $codnota, 1)' id='heading2' class=''>Selecionar Cliente</a> /
                            <a  style='color:#ccc;' style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 2, $codnota, 1)'  id='heading2' class=''>Cadastar Cliente</a>
                            / 
                            <a   href='javascript: func' onclick='buscarClientesCar(6, 1, $codnota, 1)'  id='heading2' class='text-danger'>Selecionar Mesa</a>
                             </br>
                            <div class='row'>
                           	<div class='col-12 col-md-12'>
                                <label class='pay'>Selecione a Mesa!</label>
								<select style='height:80px;font-size: 15pt; width: 100%; background-color:#fff;' name='txtClientesSelecionar' id='txtClientesSelecionar' onchange='' class='form-control'>
                                                                        ";
             $nomemesa = "";
             $ocupadaounao = 0;
             for ($i = 1; $i <= 20; $i++) {
                 $sqlEntradas = "SELECT * FROM notas WHERE nomeCli LIKE :nota AND status = 1 ORDER BY cod DESC LIMIT 1";
                 $paramEntradas = array(
                     ":nota" => "%MESA $i%"

                 );
                 $dataTableEntradas = $banco->ExecuteQuery($sqlEntradas, $paramEntradas);
                 if ($dataTableEntradas != NULL) {
                     $nomemesa = "<span style='color:red;'> - Ocupada</span>";
                     $ocupadaounao = 1;
                 } else {
                     $nomemesa = "<span style='color:green;'> - Livre</span>";
                     $ocupadaounao = 0;
                 }
                 echo "<option value='MESA $i' ";
                 if ($ocupadaounao == 1) {
                     echo "disabled";
                 }
                 echo ">MESA $i $nomemesa </option>
                                                                                    ";
             }
             echo " 
                        </select>
                        </div>
                        <div class='col-12 col-md-12'>
								<a style='padding:27px; font-size: 15pt; width: 100%;'  href='javascript:func()' onclick='AlterarClienteNota(9, txtClientesSelecionar.value, $codnota, 0)' class='btn btn-success' ><span class='glyphicon glyphicon-floppy-disk'></span> Selecionar Mesa</a>
		                </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        ";
         } else if ($param == 2) {
             $data_nascimento = "00/00/0000";
             echo "
            <div class='container-fluid'>
            <div class='row' >
                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                            <a style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 0, $codnota, 1)' id='heading2' class=''>Selecionar Cliente</a> /
                            <a   style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 2, $codnota, 1)'  id='heading2' class='text-danger'>Cadastar Cliente</a>
                            / 
                            <a  style='color:#ccc;'  href='javascript: func' onclick='buscarClientesCar(6, 1, $codnota, 1)'  id='heading2' class=''>Selecionar Mesa</a>
                            </br>
                            <div class='row'>
                            <div class='col-md-6 col-sm-12'>
                            <label class='pay'>Digite o nome do seu cliente!</label>
                            <input  tabindex='2' type='text' name='txtClientesSelecionar' id='txtClientesSelecionar' placeholder='Nome do Cliente'>
                            </div>
                            <div class='col-md-6 col-sm-12'>
                            <label class='pay'>Digite o Celular!</label>
                            <input  tabindex='2' type='text' name='celular' id='celular' placeholder='Celular do Cliente'>
                            </div>
                            <div class='col-md-6 col-sm-12'>
                            <label class='pay'>Digite o Endereço!</label>
                            <input  tabindex='2' type='text' name='endereco' id='endereco' placeholder='Endereço do Cliente'>
                            </div>
                            <div class='col-md-6 col-sm-12'>
                            <label class='pay'>Digite o nº!</label>
                            <input  tabindex='2' type='text' name='numero' id='numero' placeholder='nº do Endereço do Cliente'>
                            </div>
                            <div class='col-md-6 col-sm-12'>
                            <label class='pay'>Digite o Bairro!</label>
                            <input  tabindex='2' type='text' name='bairro' id='bairro' placeholder='Bairro do Cliente'></div>
                            <div class='col-md-6 col-sm-12'>
                            <label class='pay'>Digite o Complemento!</label>
                            <input  tabindex='2' type='text' name='complemento' id='complemento' placeholder='Complemento do Endereço'>
                            </div>
                            <div class='col-12 col-md-12'>
                                <a tabindex='2' style='font-size: 15pt; width: 100%; margin-top:20px;' href='javascript:func()' onclick='CadastrarNovoClienteViaPagamento(11, txtClientesSelecionar.value, $data_nascimento, celular.value, endereco.value, bairro.value, numero.value, complemento.value, $codnota)' class='btn btn-success' style='margin-top:5px; width:100%;'><span class='glyphicon glyphicon-floppy-disk'></span> Salvar Cliente </a>
                            </div>
                            <div class='row'>
                                
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        ";
         }
         echo " </div>";


         break;

     //FUNCAO PARA CHAMAR TELA DE EDITAR ULT. ITEM
     case 7:
         $codnota = $_GET['codnota'];
         $codpedido = $_GET['valor'];
         $total = 0;
         $nomecategoria = "Avulso";
         $codservico = 0;
         $nomeservico = 0;
         $qtd = 0;
         $valorunt = 0;

         $sqlPedidos = "SELECT * FROM pedidos WHERE usuario = :cod ORDER BY cod DESC LIMIT 1";
         $paramPedidos = array(
             ":cod" => $codnota
         );
         $dataTablePedidos = $banco->ExecuteQuery($sqlPedidos, $paramPedidos);
         foreach ($dataTablePedidos as $resultadopedidos) {
             $codservico = $resultadopedidos['servico'];
             $codpedidoCard = $resultadopedidos['cod'];

             if ($codservico == 0) {
                 $nomeservico = $resultadopedidos['obs'];
                 $obs = "";
             } else {
                 $categoria = $resultadopedidos['categoria'];
                 $sqlCategorias = "SELECT * FROM categoriaserfin WHERE cod= :cod LIMIT 1";
                 $paramCategorias = array(
                     ":cod" => $categoria
                 );
                 $dataTableCategorias = $banco->ExecuteQuery($sqlCategorias, $paramCategorias);
                 foreach ($dataTableCategorias as $resultadocategorias) {
                     $nomecategoria = $resultadocategorias['nome'];
                 }
                 $sqlServicos = "SELECT * FROM servicos WHERE cod= :cod LIMIT 1";
                 $paramServicos = array(
                     ":cod" => $codservico
                 );
                 $dataTableServicos = $banco->ExecuteQuery($sqlServicos, $paramServicos);
                 foreach ($dataTableServicos as $resultadoservicos) {
                     $nomeservico = $resultadoservicos['nome'] . "(" . $nomecategoria . ")";
                     $obs = $resultadopedidos['obs'];
                 }
             }
             $valor = (float) $resultadopedidos['valor'];
             $valor2card = (float) $resultadopedidos['valor'];
             $qtd = (float) $resultadopedidos['qtd'];
             $valorunt = $valor / $qtd;
             $total = $total + $valor;
             $codpedido = $resultadopedidos['cod'];
             $nomecategoria = "";
             $valorunt = number_format($valorunt, 2, ',', '.');
             $valor = number_format($valor, 2, ',', '.');
         }
         // Procura titulos no banco relacionados ao valor
         $sqlPedido = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = " . $codnota . " ORDER BY cod DESC");
         $total = 0;

         $qtdpedidos = 0;
         $totalfinal = 0;
         $valor = 0;
         while ($pedidos = mysqli_fetch_object($sqlPedido)) {
             $qtdpedidos = $qtdpedidos + (float) $pedidos->qtd;
             $valor = (float) $pedidos->valor;
             $totalfinal = $totalfinal + $valor;
         }
         $totalfinal2 = 0;
         $totalfinal2 = number_format($totalfinal, 2, ',', '.');
         $testelogico1 = 0;
         $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($pags = mysqli_fetch_object($sqlPag)) {
             $testelogico1 = 1;
         }

         echo "
            <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                            <h2 id='heading2' class='text-danger'>Editar último item </h2>
                            <label class='pay'>Descrição</label>
                            <input  style='color:#fff;' tabindex='2' type='text' name='holdername' id='holdername' placeholder='' disabled value='$nomeservico'>
                            <div class='row'>
                                <div class='col-12 col-md-6'>
                                    <label class='pay'>Valor Unt.</label>
                                    <input onkeyup='ValidacaoGeralCarrinho(12, this.value, $codnota, qtdpedido.value, 2)' tabindex='3' type='text' name='valorunt' id='valorunt' value='$valorunt'
                                        minlength='19' maxlength='19'>
                                </div>
                                <div class='col-12 col-md-6'>
                                    <label class='pay'>Qtd Produto</label>
                                    <input onkeyup='ValidacaoGeralCarrinho(12, valorunt.value, $codnota, this.value, 2)' tabindex='4' type='text' name='qtdpedido' id='qtdpedido' value='$qtd' 
                                        class='placeicon' minlength='3' maxlength='5'>
                                </div>
                                <div id='ResultadoValidacao2'>
                                    <label class='pay'>Valor Total</label>
                                    <input style='color:#Fff;' disabled  tabindex='5' type='text' name='holdername' placeholder='R$ 0,00' value='R$ $valor2card'>
                                </div>
                            </div
                            ";
         if ($codservico == 0) {
             echo " 
                                                    <div class='col-12 col-md-12'>
                                                        <input type='hidden' class='form-control' id='obspedido' placeholder='' value='$nomeservico'>
                                                    </div>
                                                    ";
         } else {
             echo "<label class='pay'>Obs:</label>
                                <input  tabindex='5' type='text' name='obspedido' id='obspedido' value='$obs'>
                                    ";
         }

         echo "
                             <div class='row'>
                                <div class='col-md-12'>
                                    <input href=\"javascript:func()\" onclick='EditarPedido(8, $codpedido, qtdpedido.value, valorunt.value, obspedido.value, $codnota)' tabindex='6' type='submit' value='SALVAR ALTERAÇÕES ' class='btn btn-success '
                                        style='width:100%; color:#fff;'>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
           </div>
        </div>
  
            ";
         break;
     //GERAR PAGINA DE ALTERAÇÃO DAS INFORMAÇÕES DO PEDIDO    
     case 8:

         $codpedido = $_GET['cod'];

         $sqlPedidos = "SELECT * FROM pedidos WHERE cod= :cod LIMIT 1";
         $paramPedidos = array(
             ":cod" => $codpedido
         );
         $dataTablePedidos = $banco->ExecuteQuery($sqlPedidos, $paramPedidos);
         foreach ($dataTablePedidos as $resultadopedidos) {
             $codservico = $resultadopedidos['servico'];
         }


         $qtdpedido = (float) $_GET['qtd'];
         $valor = $_GET['valor'];
         $obs = $_GET['obs'];
         $codnota = $_GET['codnota'];
         $pontos = '.';
         $result = str_replace($pontos, "", $valor);
         $result = str_replace(",", ".", $result);
         $valor = $result;
         $valor = (float) $valor;
         $valor = $valor * $qtdpedido;


         $valor = number_format($valor, 2, '.', '');
         if ($codservico == 0) {
             //  $query = mysqli_query($conn, "UPDATE pedidos SET qtd = $qtdpedido, valor = '$valor' WHERE cod = $codpedido");
             $sql = "UPDATE pedidos SET qtd = :qtd, valor = :valor WHERE cod = :cod";
             $param = array(
                 ":cod" => $codpedido,
                 ":qtd" => $qtdpedido,
                 ":valor" => $valor
             );

             $banco->ExecuteNonQuery($sql, $param);
         } else {
             //$query = mysqli_query($conn, "UPDATE pedidos SET qtd = $qtdpedido, valor = '$valor', obs = '$obs'  WHERE cod = $codpedido");
             $sql = "UPDATE pedidos SET qtd = :qtd, valor = :valor, obs = :obs WHERE cod = :cod";
             $param = array(
                 ":cod" => $codpedido,
                 ":qtd" => $qtdpedido,
                 ":valor" => $valor,
                 ":obs" => $obs
             );

             $banco->ExecuteNonQuery($sql, $param);
         }

         $codnota = $_GET['codnota'];
         $testelogico1 = 0;

         // Procura titulos no banco relacionados ao valor
         $sqlPedido = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = " . $codnota . " ORDER BY cod ASC");
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

         $totalfinal2 = 0;
         $totalfinal2 = number_format($totalfinal, 2, ',', '.');

         $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($pags = mysqli_fetch_object($sqlPag)) {
             $testelogico1 = 1;
         }


         if ($testelogico1 == 0) {
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

             echo " 
            <a id='Btnitem' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
            class='InputStyle' type='submit'>
            QTD ITENS: $qtdpedidos
        </a>
        <a id='Btnvalor' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
            class='InputStyle' type='submit'>
            VALOR: R$ $totalfinal2
        </a>";
         }
         break;
     //GERAR ATUALIZAÇÃO DE SELECIONAR CLIENTE 
     case 9:

         $codnota = $_GET['codnota'];
         $usuario = $_GET['valor'];
         $param2 = $_GET['param'];

         if ($param2 == 0) {
             //$query = mysqli_query($conn, "UPDATE notas SET nomeCli = '$usuario' WHERE cod = $codnota");
             $sql = "UPDATE notas SET nomeCli = :nome , usuario = 0 WHERE cod = :cod";
             $param = array(
                 ":nome" => $usuario,
                 ":cod" => $codnota
             );
             $banco->ExecuteNonQuery($sql, $param);

         } else if ($param2 == 1) {
             $sql = "UPDATE notas SET usuario = :usuario , nomeCli='' WHERE cod = :cod";
             $param = array(
                 ":usuario" => $usuario,
                 ":cod" => $codnota
             );
             $banco->ExecuteNonQuery($sql, $param);
         } else if ($param2 == 2) {

         }

         $testelogico = 0;
         $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
             $testelogico = 1;
         }
         $sqlNota = mysqli_query($conn, "SELECT * FROM notas WHERE cod = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($notaspesquisa = mysqli_fetch_object($sqlNota)) {
             $usuarionota = $notaspesquisa->usuario;
             $nomecli = $notaspesquisa->nomeCli;
         }


         echo "<div class='' style='width:99%;'>
        ";
         if ($testelogico == 0) {
             if ($usuarionota == 0) {
                 if ($nomecli != null) {
                     echo "<h2 class='alert alert-success'>$nomecli - SELECIONADA</h2>
                    ";
                 }
             } else {
                 $usuarionota;
                 //$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod = $codfornecedor ORDER BY cod ASC LIMIT 1");
                 $sqlFornecedores = "SELECT * FROM clientes WHERE id = :cod ORDER BY id ASC LIMIT 1";
                 $paramFornecedores = array(
                     ":cod" => $usuarionota
                 );
                 $dataTableFornecedores = $banco->ExecuteQuery($sqlFornecedores, $paramFornecedores);
                 foreach ($dataTableFornecedores as $resultadocli) {
                     $codfornecedor = $resultadocli['id'];
                     $nome = $resultadocli['nome'];
                     $endereco = $resultadocli['endereco'];
                     $bairro = $resultadocli['bairro'];
                     $numero = $resultadocli['numero'];
                     $complemento = $resultadocli['complemento'];
                     $celular = $resultadocli['celular'];
                 }
                 echo "<div class='alert alert-success'><h3 style='text-align:left; color:#000; '><b><span class='glyphicon glyphicon-hand-right'></span> Cliente selecionado</b></h3>
								";
                 echo "<p style='color:#000'>
                               <b>Nome:</b>$nome</br>
                                <b>Endereço:</b>$endereco</br>
                                <b>Bairro:</b>$bairro</br>
                                <b>Número:</b>$numero</br>
                                <b>Complemento:</b>$complemento</br>
                                <b>Celular:</b>$celular</br>
                                </p>
                            
                 </div>   ";
             }
         }
         echo "
            <div class='container-fluid'>
            <div class='row' >
                <div class='col-md-12 col-sm-12 p-0 box'>
                    <div class='card rounded-0 border-0 card2' id='paypage'>
                        <div class='form-card'>
                            <a href='javascript: func' onclick='buscarClientesCar(6, 0, $codnota, 1)' id='heading2' class='text-danger'>Selecionar Cliente</a> /
                            <a  style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 2, $codnota, 1)'  id='heading2' class=''>Cadastar Cliente</a> / 
                            <a  style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 1, $codnota, 1)'  id='heading2' class=''>Selecionar Mesa</a>
                             </br>
                            <label class='pay'>Digite o nome do seu cliente!</label>
                            <input onKeyup='ValidacaoGeralCarrinho(10, this.value, $codnota, 0, 1)'  tabindex='2' type='text' name='txtClientesSelecionar' id='txtClientesSelecionar' placeholder='Nome do Cliente'>
                                <div id='ResultadoValidacao1' class='row'>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        ";



         break;
     //FUNCAO PARA SELECIONAR CLIENTE
     case 10:
         $param1 = $_GET['param1']; //VALOR DIGITADO
         $param2 = $_GET['param2']; //CODIGO DA PEDIDO
 
         echo "<div class='table-responsive custom-table-responsive'>
      
        <table class='table custom-table'>
        
            <tr style='background-color:#000;'>
              <th scope='col'>Nome</th>
              <th scope='col'>Endereço</th>
              <th scope='col'>Celular</th>
            </tr>
         
          <tbody>
          ";
         $sqlClientes = "SELECT * FROM clientes WHERE nome LIKE :nome ORDER BY id DESC LIMIT 10";
         $paramClientes = array(
             ":nome" => "%{$param1}%"
         );
         $contt = 1;
         $dataTableClientes = $banco->ExecuteQuery($sqlClientes, $paramClientes);
         foreach ($dataTableClientes as $resultadoclientes) {
             $cod_cliente = $resultadoclientes['id'];
             $nome_cliente = $resultadoclientes['nome'];
             $endereco_cliente = $resultadoclientes['endereco'];
             $numero_cliente = $resultadoclientes['numero'];
             $bairro_cliente = $resultadoclientes['bairro'];
             $celular_cliente = $resultadoclientes['celular'];
             $contt++;
             echo " 
            <tr scope='row'>
              <td style='text-align:center;'><a tabindex='$contt' href='javascrit: func' onclick='AlterarClienteNota(9, $cod_cliente, $param2, 1)'>$nome_cliente</a></td>
              <td>
                <b>End:</b> $endereco_cliente
                  <small class='d-block'><b>Bairro</b>:$bairro_cliente / <b>nº</b>: $numero_cliente</small>
              </td>
              <td>
                $celular_cliente
              </td>
            </tr>

        ";
         }
         echo " 
          </tbody>
        </table>
      </div>
        ";
         break;
     //FUNCAO PARA CADASTAR CLIENTE E ATUALIZAR CLIENTE EM NOTA
     case 11:
         $nome = $_GET['nome'];
         $nascimento = $_GET['datanascimento'];
         $celular = $_GET['celular'];
         $endereco = $_GET['endereco'];
         $bairro = $_GET['bairro'];
         $numero = $_GET['numero'];
         $complemento = $_GET['complemento'];
         $codnota = $_GET['codnota'];
         $data = date('d/m/Y');
         $variavelalert = "";
         echo "<div class='' style='width:99%;'>";
         if ($nome != null && $celular != null) {
             $sql = "INSERT INTO `clientes` (nome, nascimento, celular, endereco, bairro, numero, complemento,  data, status, cod_usuarios) VALUES (:nome, :nascimento,:celular, :endereco, :bairro, :numero, :complemento, :data, :status, :cod_usuarios)";
             $param = array(
                 ":nome" => $nome,
                 ":nascimento" => $nascimento,
                 ":celular" => $celular,
                 ":endereco" => $endereco,
                 ":bairro" => $bairro,
                 ":numero" => $numero,
                 ":complemento" => $complemento,
                 ":data" => $data,
                 ":status" => 1,
                 ":cod_usuarios" => $_SESSION['codF']
             );
             $banco->ExecuteNonQuery($sql, $param);
             $valor2 = "";
             $cod_loja = $_SESSION['codF'];
             $sqlVolta = mysqli_query($conn, "SELECT * FROM clientes  WHERE cod_usuarios = $cod_loja ORDER BY id DESC LIMIT 1");
             while ($clientesult = mysqli_fetch_object($sqlVolta)) {
                 $cod_cliete = $clientesult->id;

                 $queryNovo = mysqli_query($conn, "UPDATE notas SET usuario = $cod_cliete , nomeCli = '' WHERE cod = $codnota");
             }
         } else {
             echo "
             <div class='alert alert-warning'> NOME E CELULAR NÃO PODEM SER NULOS </div>";
         }


         $testelogico = 0;
         $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
             $testelogico = 1;
         }
         $sqlNota = mysqli_query($conn, "SELECT * FROM notas WHERE cod = " . $codnota . " ORDER BY cod ASC LIMIT 1");
         while ($notaspesquisa = mysqli_fetch_object($sqlNota)) {
             $usuarionota = $notaspesquisa->usuario;
             $nomecli = $notaspesquisa->nomeCli;
         }


         if ($testelogico == 0) {
             if ($usuarionota == 0) {
                 if ($nomecli != null) {
                     echo "<h2 class='alert alert-success'>$nomecli - SELECIONADA</h2>
                   ";
                 }
             } else {
                 $usuarionota;
                 //$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod = $codfornecedor ORDER BY cod ASC LIMIT 1");
                 $sqlFornecedores = "SELECT * FROM clientes WHERE id = :cod ORDER BY id ASC LIMIT 1";
                 $paramFornecedores = array(
                     ":cod" => $usuarionota
                 );
                 $dataTableFornecedores = $banco->ExecuteQuery($sqlFornecedores, $paramFornecedores);
                 foreach ($dataTableFornecedores as $resultadocli) {
                     $codfornecedor = $resultadocli['id'];
                     $nome = $resultadocli['nome'];
                     $endereco = $resultadocli['endereco'];
                     $bairro = $resultadocli['bairro'];
                     $numero = $resultadocli['numero'];
                     $complemento = $resultadocli['complemento'];
                     $celular = $resultadocli['celular'];
                 }
                 echo "<div class='alert alert-success'><h3 style='text-align:left; color:#000; '><b><span class='glyphicon glyphicon-hand-right'></span> Cliente selecionado</b></h3>
                               ";
                 echo "<p style='color:#000'>
                              <b>Nome:</b>$nome</br>
                               <b>Endereço:</b>$endereco</br>
                               <b>Bairro:</b>$bairro</br>
                               <b>Número:</b>$numero</br>
                               <b>Complemento:</b>$complemento</br>
                               <b>Celular:</b>$celular</br>
                               </p>
                           
                </div>   ";
             }
         }
         echo "
           <div class='container-fluid'>
           <div class='row' >
               <div class='col-md-12 col-sm-12 p-0 box'>
                   <div class='card rounded-0 border-0 card2' id='paypage'>
                       <div class='form-card'>
                           <a href='javascript: func' onclick='buscarClientesCar(6, 0, $codnota, 1)' id='heading2' class='text-danger'>Selecionar Cliente</a> /
                           <a  style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 2, $codnota, 1)'  id='heading2' class=''>Cadastar Cliente</a> / 
                           <a  style='color:#ccc;' href='javascript: func' onclick='buscarClientesCar(6, 1, $codnota, 1)'  id='heading2' class=''>Selecionar Mesa</a>
                            </br>
                           <label class='pay'>Digite o nome do seu cliente!</label>
                           <input onKeyup='ValidacaoGeralCarrinho(10, this.value, $codnota, 0, 1)'  tabindex='2' type='text' name='txtClientesSelecionar' id='txtClientesSelecionar' placeholder='Nome do Cliente'>
                               <div id='ResultadoValidacao1' class='row'>
                               </div>
                       </div>
                       </div>
                   </div>
               </div>
          </div>
       </div>
       ";


         echo "</div>";
         break;
     //VALIDACAÇÃO PARA ATUALIZAR VALOR TOTAL EM PEDIDO AVULSO
     case 12:
         $valor = $_GET['param1']; //valor unt 
         $codnota = $_GET['param2']; //cond da nota
         $qtd = (float) $_GET['param3']; //qtd
         $pontos = '.';
         $result = str_replace($pontos, "", $valor);
         $result = str_replace(",", ".", $result);
         $result = (float) $result;
         $valor = number_format($result, 2, '.', '');

         $id = $_GET['id'];
         $resultado = "";
         $valor_total = 0;
         if ($qtd != null) {
             $valor_total = $qtd * $valor;
             $valor_total2 = $qtd * $valor;
             $valor_total = number_format($valor_total, 2, ',', '.');

             echo "<label class='pay'>Valor Total</label>
             <input style='color:#fff;' disabled  tabindex='5' type='text' name='valortotal' id='valortotal' placeholder='R$ 0,00' value='R$ $valor_total'>      
             ";

             if ($valor_total2 <= 0) {
                 echo "</br><div class='alert alert-danger'>Quantidade ou Valor Unt. não podem ser valores menor ou igual a 0.</div>";
             }
         } else {
             $valor_total = $valor;
             $valor_total = number_format($valor_total, 2, ',', '.');
             echo "<label class='pay'>Valor Total</label>
             <input style='color:#fff;' disabled  tabindex='5' type='text' name='valortotal' id='valortotal' placeholder='R$ 0,00' value='R$ $valor_total'>      
             ";
         }
         break;
     //GERAR PAGINA CADASTRAR PEDIDO AVULSO
     case 13:
         $codservico = 0;
         $codnota = $_GET['codnota'];
         $valor = $_GET['valor'];
         $categoria = $_GET['categoria'];
         $qtd = $_GET['qtd'];
         $categoria = $_GET['categoria'];
         $status = 1;
         $obs = $_GET['id'];
         $dia = date('d');
         $mes = date('m');
         $ano = date('Y');
         $contindex = 0;
         $pontos = '.';
         $result = str_replace($pontos, "", $valor);
         $result = str_replace(",", ".", $result);
         $valor = $result;
         $valor = (float) $valor;
         $valor = $valor * $qtd;

         // $query = mysqli_query($conn, "INSERT INTO `pedidos` (`cod`, `dente`, `servico`, `usuario`, `qtd`, `valor`, `status`, `nivel`, `obs`, `tipo`, `dia`, `mes`, `ano`, `categoria`) VALUES (NULL, NULL, '" . $codservico . "', '" . $codnota . " ', '" . $qtd . " ', '" . $valor . " ', '1', NULL, '" . $obs . "', NULL, '" . $dia . " ', '" . $mes . " ', '" . $ano . " ', '" . $categoria . " ')");
         // Se inserido com scesso
         $sql = "INSERT INTO `pedidos` (dente, servico, usuario, qtd, valor, status, nivel, obs, tipo, dia, mes, ano, categoria) VALUES (:dente, :servico, :usuario, :qtd,  :valor, :status, :nivel, :obs, :tipo, :dia, :mes, :ano, :categoria)";
         $param = array(
             ":dente" => 0,
             ":servico" => 0,
             ":usuario" => $codnota,
             ":qtd" => $qtd,
             ":valor" => $valor,
             ":status" => 1,
             ":nivel" => 1,
             ":obs" => $obs,
             ":tipo" => 1,
             ":dia" => $dia,
             ":mes" => $mes,
             ":ano" => $ano,
             ":categoria" => $categoria,
         );

         $banco->ExecuteNonQuery($sql, $param);

         $codnota = $_GET['codnota'];
         $cod = $codnota;

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

         echo " 
         
             <a id='Btnitem' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
                 class='InputStyle' type='submit'>
                 QTD ITENS: $qtdpedidos
             </a>
             <a id='Btnvalor' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
                 class='InputStyle' type='submit'>
                 VALOR: R$ $totalfinal2
             </a>
       
   
         ";
         break;
     //VALIDACAO PARA PAGAMENTO
     case 14:
         $codnota = $_GET['param1'];
         $param1 = (float) $_GET['param2']; //INPUT DINHEIRO
         $param2 = (float) $_GET['param3']; //INPUT DEBITO
         $param3 = (float) $_GET['param4']; //INPUT CRÉDITO
         $param4 = (float) $_GET['param5']; //INPUT PIX
         $param5 = (float) $_GET['param6']; //INPUT TOTAL
         $param6 = (float) $_GET['param7']; //INPUT TROCO
 
         $total_soma = 0;
         $saldo = 0;
         $total_soma = $param1 + $param2 + $param3 + $param4;

         $saldo = $total_soma - $param5;

         if ($param2 > $param5 || $param3 > $param5 || $param4 > $param5 || ($param2 + $param3 + $param4) > $param5) {
             echo "<div class='alert alert-danger'>VALOR INVÁLIDO, PAGAMENTOS ALTERNATIVOS AO DINHEIRO NÃO PODEM ULTRAPASSAR O VALOR DO PEDIDO</div>";
             echo "<input value='0' type='hidden' id='pagamentotroco' name='pagamentotroco'>
            ";
         } else {

             if ($saldo == 0) {
                 echo "<div class='col-md-12' style='margin-top:-40px;'>
            <input style='width:100%; height:45px;' type='submit' value='FINALIZAR PAGAMENTO' class='btn btn-info placeicon' name='btnCadastrarFinalizarSaida' id='btnCadastrarFinalizarSaida'>
            <input value='0' type='hidden' id='pagamentotroco' name='pagamentotroco'>
            ";

             } else if ($saldo > 0) {

                 $saldo2 = number_format($saldo, 2, ',', '.');
                 echo "
            <div class='input-group mb-3' style='margin-top:-51px;'>
            <span style='height:50px; font-size:14pt ' class='input-group-text' id='basic-addon1'>
            <b >TROCO:</b>
            </span>
            <input disabled value='R$ $saldo2' style='height:50px; margin-top:0px; font-size:14pt ' type='text' class='form-control' placeholder='Troco' aria-label='Troco' aria-describedby='basic-addon1' id='pagamentotroco2' name='pagamentotroco2'>
            </div>
            <input value='$saldo' type='hidden' id='pagamentotroco' name='pagamentotroco'>
            <div class='col-md-12' style='margin-top:-30px;'>
            <input name='btnCadastrarFinalizarSaida' id='btnCadastrarFinalizarSaida' style='width:100%; height:45px;' type='submit' value='FINALIZAR PAGAMENTO' class='btn btn-info placeicon'>
            ";
             } else if ($saldo < 0) {
                 $saldo = -1 * $saldo;

                 $saldo = number_format($saldo, 2, ',', '.');
                 echo "<div class='alert alert-danger'>AINDA RESTAM R$ $saldo PARA COMPLETAR O PAGAMENTO</div>";
                 echo "<input value='0' type='hidden' id='pagamentotroco' name='pagamentotroco'>
            ";
             }
         }
         break;
     //ATUALIZAR LISTA DE ITENS
     case 15:
         $codnota = $_GET['param1'];
         $contador = 20;

         echo "
            <h1>Lista de Itens</h1>
        <table class='table table-responsive table-dark' style=''>
            <tr style='background-color:#000;'>
                <td>Item</td>
                <td>Qtd</td>
                <td>Valor</td>
                <td>Total</td>
            </tr>
            ";


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
             //     $total = $total + $valor;
             $codpedido = $resultadopedidos2['cod'];
             $nomecategoria = "";
             $valorunt = number_format($valorunt, 2, ',', '.');
             $valor = number_format($valor, 2, ',', '.');


             $testelogico = 0;
             $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = " . $codnota . " ORDER BY cod ASC LIMIT 1");
             while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
                 $testelogico = 1;
             }
             $botaoapagar = "";
             if ($testelogico == 0) {
                 $botaoapagar = "<a style='font-size:16pt;' tabindex='$contador' id='primeirobotao' href='javascript: func()' onclick='CadastrarPedidoAvulso2(17, 0, $codnota, $codpedido, 0, 0)'    class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Apagar</a>";
             }
             echo "
				
					<tr>
						<td><b>" . $nomeservico . "<b></td>
						<td>$qtd</td>
						<td>R$ " . $valorunt . "</td>
						<td>R$ " . $valor . "</td>
					</tr>
		   ";
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
         // $total = number_format($total, 2, ',', '.');
         echo "
          </table>
           ";
         break;
     //PAGINA FINAL DE PAGAMENTO - FORMULATARIO DE PAGAMENTO PARCELADO NO CARTÃO DE CREDITO
     case 16:
         $codnota = $_GET['codnota'];
         $numparcelas = (float) $_GET['valor'];
         $juros = $_GET['juros'];
         $juros2 = (float) $_GET['juros2'];
         // Procura titulos no banco relacionados ao valor
         $sqlPedido = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = " . $codnota . " ORDER BY cod ASC");
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


         echo "
        <label style='margin-top:-24px;' for='valorparcela'><h4>Valor da Parcela</h4></label>
        <div class='input-group'>
        <input style='font-size:14pt; padding:25px;' disabled type='text' class='form-control' id='valorparcela' placeholder='' value='$valorparcela'>
        </div>
    
        <label for='valortotal'><h4>Valor Total</h4></label>
        <div class='input-group'>
        <input style='font-size:14pt; padding:25px;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$totalfinal'>
        </div>
				 				
				 ";
         break;
     //FUNCAO PARA APAGAR LISTA DE ITEM EM PEDIDOS
     case 17:

         $codnota = $_GET['codnota'];
         $codpedido = $_GET['valor'];

         $query = mysqli_query($conn, "DELETE FROM `pedidos` WHERE cod = $codpedido");
         // Se inserido com scesso
         if ($query) {
             $contador = 20;
             $cod = $codnota;

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

             echo " 
            
                <a id='Btnitem' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
                    class='InputStyle' type='submit'>
                    QTD ITENS: $qtdpedidos
                </a>
                <a id='Btnvalor' style='width: 50%; margin-left: 10px; padding: 5px; background-color: #4169E1; color:#fff;'
                    class='InputStyle' type='submit'>
                    VALOR: R$ $totalfinal2
                </a>
          
      
            ";
         }
         break;
 }

 ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  