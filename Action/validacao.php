<?php
include("conn.php");
include("Banco.php");
include("functions.php");
session_start();

//Error_reporting(0);
$banco = new Banco();
$totalfinalmestipopag5 = 0;
$totalfinalanotipopag5 = 0;
$tipo = $_GET['tipo'];
switch ($tipo) {
//VALIDACAO PARA RETORNAR VALOR FINAL DA ENTRADA - CARRINHO DE COMPRAS 
    case 1:
        $qtd = (float) $_GET['valor'];
        $valor = (float) $_GET['param'];
        $id = $_GET['id'];
        $resultado = "";
        $valor_total = 0;
        if ($qtd != null) {
            $valor_total = $qtd * $valor;
            echo "R$ " . number_format($valor_total, 2, ',', '.');
        } else {
            echo "R$ " . number_format($valor, 2, ',', '.');
        }
        break;
//VALIDACAO PARA RETORNAR VALOR FINAL DA ENTRADA - CARRINHO DE COMPRAS - PART 2 
    case 2:

        $qtd = (float) $_GET['param'];
        $valor = $_GET['valor'];
        $pontos = '.';
        $result = str_replace($pontos, "", $valor);
        $valor = $result;
        $valor = (float) $valor;


        $id = $_GET['id'];
        $resultado = "";
        $valor_total = 0;
        if ($qtd != null) {
            $valor_total = $qtd * $valor;
            $valor_total = number_format($valor_total, 2, ',', '.');

            echo "
                 <div class='input-group-addon' style='font-size:16pt;'>R$</div>
                 <input disabled style='font-size:18pt; padding:20px;' type='text' class='form-control' id='valortotal' name='valortotal' placeholder='Valor Total' value='$valor_total'>
                ";
        } else {
            $valor_total = $valor;
            $valor_total = number_format($valor_total, 2, ',', '.');

            echo "
                
                 <div class='input-group-addon' style='font-size:16pt;'>R$</div>
                 <input disabled style='font-size:18pt; padding:20px;' type='text' class='form-control' id='valortotal' name='valortotal' placeholder='Valor Total' value='$valor_total'>
                ";
        }
        break;
    //validacao princial para calcular qtd * valor
    case 3:
        $qtd = (float) $_GET['param'];
        $valor = $_GET['valor'];
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
            $valor_total = number_format($valor_total, 2, ',', '.');


            echo "
               <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
                   <div class=	input-group>
						
						<input style='padding:30px; font-size: 15pt; width: 100%;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valor_total'>
					</div>
            ";
        } else {
            $valor_total = $valor;
            $valor_total = number_format($valor_total, 2, ',', '.');


            echo "
               <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
				<div class=	input-group	>
				   <input style='padding:30px; font-size: 15pt; width: 100%;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valor_total'>
				</div>
            ";
        }
        break;

    case 4:
        $valor = (float)$_GET['valor'];
        $param = $_GET['param'];
        
        
        $pontos = '.';
        $result = str_replace($pontos, "", $param);
        
        $result = str_replace(".", ",", $param);
      
    
        
        $id = $_GET['id'];
        $contadorlogicoparcelas = 0;
        $contadorvalorparcelas = 0;
        $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod = " . $id . " ORDER BY cod ASC LIMIT 1");
        while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
            $numparcelas = (float) $pagamentopesquisa->numparcelas;
        }
        $sqlParcelas = mysqli_query($conn, "SELECT * FROM pag_par_pro WHERE financeiro_pac = " . $id . " ORDER BY cod ASC");
        while ($parcelaspesquisa = mysqli_fetch_object($sqlParcelas)) {
            $contadorlogicoparcelas++;
            $contadorvalorparcelas = $contadorvalorparcelas + $parcelaspesquisa->valor;
        }
        echo "
			<div class='col-12 col-md-7' style='margin-bottom:10px;'>
			<label style='font-size:15pt; color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; '><span class='glyphicon glyphicon-hand-right'></span> Valor da Parcela</label>
			<div class='input-group'>
				<input style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' id='txtparcela' name='txtparcela' placeholder='' value='$result' onchange='Validacao(4, this.value, $valor, $id)'>
			</div>
			</div>";
        if ($numparcelas == 1) {
            if ($param > $valor) {
                echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
						<div class='alert alert-warning' style='font-size:14pt;'><b>Valor da Parcela</b> Maior do Que <b>Valor a Receber: </b><small>R$ " . number_format($valor, 2, ',', '.') . "</small></div>
						</div>";
            } else if ($param < $valor) {
                echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
						<div class='alert alert-warning' style='font-size:14pt;'><b>Valor da Parcela</b> Menor do Que <b>Valor a Receber: </b><small>R$ " . number_format($valor, 2, ',', '.') . "</small></div>
						</div>";
            } else if ($param == $valor) {
                echo "
					<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
							<a style='padding:27px; font-size: 15pt; width: 100%;' onClick='CadastrarParcelaHome(23, txtdescricaoparcela.value, txtparcela.value, $codpagamento, $id)' href='javascript:void' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-floppy-saved'></span> Pagar</br> Parcela</a>
					</div>";
            }
        } else {
            if ($contadorlogicoparcelas == 0) {
                if ($param > $valor) {
                    echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
						<div class='alert alert-warning' style='font-size:14pt;'><b>Valor da Parcela</b> Maior do Que <b>Valor a Receber: </b><small>R$ " . number_format($valor, 2, ',', '.') . "</small></div>
						</div>";
                } else {
                    echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
						<a style='padding:27px; font-size: 15pt; width: 100%;' onClick='CadastrarParcela(23, txtdescricaoparcela.value, txtparcela.value, $id)' href='javascript:void' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-floppy-saved'></span> Pagar</br> Parcela</a>
					</div>";
                }
            } else {
                $contadorlogicoparcelas++;
                if (($numparcelas / $contadorlogicoparcelas) == 1) {
                    if ($param > $valor) {
                        echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
							<div class='alert alert-warning' style='font-size:14pt;'><b>Valor da Parcela</b> Maior do Que <b>Valor a Receber: </b><small>R$ " . number_format($valor, 2, ',', '.') . "</small></div>
							</div>";
                    } else if ($param < $valor) {
                        echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
							<div class='alert alert-warning' style='font-size:14pt;'><b>Valor da Parcela</b> Menor do Que <b>Valor a Receber: </b><small>R$ " . number_format($valor, 2, ',', '.') . "</small></div>
							</div>";
                    } else if ($param == $valor) {
                        echo "
						<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
							<a style='padding:27px; font-size: 15pt; width: 100%;' onClick='CadastrarParcela(23, txtdescricaoparcela.value, txtparcela.value, $id)' href='javascript:void' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-floppy-saved'></span> Pagar</br> Parcela</a>
						</div>";
                    }
                } else {
                    if ($param > $valor) {
                        echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
							<div class='alert alert-warning' style='font-size:14pt;'><b>Valor da Parcela</b> Maior do Que <b>Valor a Receber: </b><small>R$ " . number_format($valor, 2, ',', '.') . "</small></div>
							</div>";
                    } else {
                        echo "<div class='col-12 col-md-5' id='resultadoqtdvalor' style='margin-top:10px;'>
								<a style='padding:27px; font-size: 15pt; width: 100%;' onClick='CadastrarParcela(23, txtdescricaoparcela.value, txtparcela.value, $id)' href='javascript:void' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-floppy-saved'></span> Pagar</br> Parcela</a>
											
							</div>";
                    }
                }
            }
        }

        echo "
										
		 ";
        break;
    case 5:
        $valor = (float) $_GET['valor'];
        $param = (float) $_GET['param'];
        $id = (float) $_GET['id'];
        if ($param <= $valor) {
            echo "
					<div class='col-12 col-md-9' id='resultadoqtdvalor' style='margin-bottom:10px;'>
						<label style='font-size:15pt; color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; '><span class='glyphicon glyphicon-hand-right'></span> Troco?</label>
						<div class='input-group'>
							<span class='input-group-addon' id='basic-addon1'>R$ </span>
							<input style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' id='txtTroco' name='txtTroco' placeholder='00,00' value='" . number_format($param, 2, ',', '.') . "' onchange='Validacao(5, this.value, $valor, $id)'>
						</div>
					</div>
					<div class='col-12 col-md-3' >
						<div class='alert alert-warning'><b>Valor do Troco</b> deve ser maior do que <b>Valor do Pedido</b></div>
					</div>
		";
        } else {
            echo "
					<div class='col-12 col-md-9' id='resultadoqtdvalor' style='margin-bottom:10px;'>
						<label style='font-size:15pt; color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; '><span class='glyphicon glyphicon-hand-right'></span> Troco?</label>
						<div class='input-group'>
							<span class='input-group-addon' id='basic-addon1'>R$ </span>
							<input style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' id='txtTroco' name='txtTroco' placeholder='00,00' value='" . number_format($param, 2, ',', '.') . "' onchange='Validacao(5, this.value, $valor, $id)'>
						</div>
					</div>
					<div class='col-12 col-md-3' >
						<a style='margin-top:10px; padding:27px; font-size: 15pt; width: 100%;' onClick='Validacao(6, txtTroco.value, $valor, $id)' href='javascript:void' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</br> Troco</a>
					</div>
			";
        }
        break;
    case 6:
        $idpagamento = $_GET['id'];
        $valor = $_GET['valor'];
        $param = $_GET['param'];
        $pontos = '.';
        $result = str_replace($pontos, "", $param);
        $param = str_replace(",", ".", $result);

        $query = mysqli_query($conn, "UPDATE financeiro_clientes SET gorjeta = $param WHERE cod = $idpagamento");
        if ($query) {
            $sqlPag = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod = " . $idpagamento . " ORDER BY cod ASC LIMIT 1");
            while ($pagamentopesquisa = mysqli_fetch_object($sqlPag)) {
                $codpagamento = $pagamentopesquisa->cod;
                $troco = $pagamentopesquisa->gorjeta;
            }
            echo "						<div class='alert alert-success' style='width:100%; margin-left:10px;'>Troco Salvo com sucesso <span class='glyphicon glyphicon-ok'></span> </div>
										<div class='col-12 col-md-9' id='resultadoqtdvalor' style='margin-bottom:10px;'>
											<label style='font-size:15pt; color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; '><span class='glyphicon glyphicon-hand-right'></span> Troco?</label>
											<div class='input-group'>
											<span class='input-group-addon' id='basic-addon1'>R$ </span>
											<input style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' id='txtTroco' name='txtTroco' placeholder='00,00' value='" . number_format($param, 2, ',', '.') . "' onchange='Validacao(5, this.value, $valor, $codpagamento)'>
											</div>
										</div>
										<div class='col-12 col-md-3' >
											<a style='margin-top:10px; padding:27px; font-size: 15pt; width: 100%;' onClick='Validacao(6, txtTroco.value, $valor, $codpagamento)' href='javascript:void' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</br> Troco</a>
										</div>
			";
        }
        break;
//Validação para colocar mascará no dinheiro. 
    case 7:
        $valor = $_GET['valor'];
        $pontos = '.';
        $result = str_replace($pontos, "", $valor);
        $valor = str_replace(",", ".", $result);
        $valor = (float) $valor;
        $valor = number_format($valor, 2, ',', '.');

        echo "
						<div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtValor' class='control-label'>Valor Unt.</label>
                            <input style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtValorEd' name='txtValorEd' value='$valor' onchange='Validacao(7, 1, this.value, 55)'>
                        </div>
		";
        break;

    case 8:

        echo "
            	<div class='form-group'>
					<label style='text-align:left; margin:10px; color:337AB7; border-bottom: 2px solid #337AB7; width: 90%;' for='txtNome' class='control-label'>Nome</label>
					<input  style='padding:25px; font-size: 13pt; width: 90%; margin-left:15px;' type='text' class='form-control' id='txtNome1' name='txtNome1' placeholder='' value='' >
                                        
                                </div>
			
            ";
        break;

    case 9:

        $param = $_GET['param'];
        $sqlServicos = "SELECT * FROM servicos WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
        $paramServicos = array(
            ":cod" => $param
        );


        $dataTableServicos = $banco->ExecuteQuery($sqlServicos, $paramServicos);
        foreach ($dataTableServicos as $resultadoservicos) {
            $codservico = $resultadoservicos['cod'];
            $categoriaservico = (float) $resultadoservicos['categoria'];
//$sqlCategorias = mysqli_query($conn, "SELECT * FROM categoriaserfin WHERE cod = $categoriaservico ORDER BY cod ASC LIMIT 1");
// Exibe todos os valores encontrados
            $sqlCat = "SELECT * FROM categoriaserfin WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
            $paramCat = array(
                ":cod" => $categoriaservico
            );

            $dataTableCat = $banco->ExecuteQuery($sqlCat, $paramCat);
            foreach ($dataTableCat as $resultadocat) {
                $nomecategoria = $resultadocat['nome'];
            }
            $nomeservico = $resultadoservicos['nome'];
            $descricaoservico = $resultadoservicos['descricao'];
            $valorunt = number_format($resultadoservicos['valor'], 2, ',', '.');
        }
        break;

    case 10:
        $param1 = $_GET['param'];
        $valor = $_GET['valor'];

        $codservico = (float) $_GET['valor'];
//$sqlServicos = mysqli_query($conn, "SELECT * FROM servicos WHERE cod = $codservico ORDER BY cod ASC LIMIT 1");
        $sqlServicos = "SELECT * FROM servicos WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
        $paramServicos = array(
            ":cod" => $valor
        );
        $dataTableServicos = $banco->ExecuteQuery($sqlServicos, $paramServicos);
        foreach ($dataTableServicos as $resultadoservicos) {
            $codservico = $resultadoservicos['cod'];
            $tiposervico = $resultadoservicos['tipo'];
            $qtdservico = $resultadoservicos['qtd'];
            $est_maxservico = $resultadoservicos['est_max'];
            $est_mimservico = $resultadoservicos['est_mim'];
            $cod_barraservico = $resultadoservicos['codbarra'];
        }
        if ($param1 == 1) {
            echo "
            <div class='col-12 col-md-4' style='text-align: left;'>
                            <div class='form-group label-floating'>
                                <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtEstMax' class='control-label'>Est Máx.</label>
                                <input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtEstMax' name='txtEstMax' value='$est_maxservico' autofocus>
                            </div>
                        </div>  
                        <div class='col-12 col-md-4' style='text-align: left;'>
                            <div class='form-group label-floating'>
                                <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtEstMin' class='control-label'>Est Min.</label>
                                <input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtEstMin' name='txtEstMin' value='$est_mimservico' >
                            </div>
                        </div>  
                          <input type='hidden' id='txtFornecedor' name='txtFornecedor' value='1' >
                            
                        
                        </div>  
                        <div class='col-12 col-md-4' style='text-align: left;'>
                            <div class='form-group label-floating'>
                                <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtCodBarra' class='control-label'>Qtd. Produto</label>
                                <input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtCodBarra' name='txtCodBarra' value='$qtdservico'>
                            </div>
                        </div>
                       
            
            ";
        } else {
            echo "
                                <input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%; ' type='hidden' class='form-control' id='txtEstMax' name='txtEstMax' value='$est_maxservico' autofocus>
                                <input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%; ' type='hidden' class='form-control' id='txtEstMin' name='txtEstMin' value='$est_mimservico' >
                                  <input type='hidden' id='txtFornecedor' name='txtFornecedor' value='1' >
                                  <input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%; ' type='hidden' class='form-control' id='txtCodBarra' name='txtCodBarra' value='$qtdservico'>
                       
            
            ";
        }
        break;

    case 11:
        $contador = 1;
        $param = $_GET['param'];
        $valor = $_GET['valor'];
        $id = $_GET['id'];
//$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod_orgao = $cod_orgao AND descricao LIKE '%" . $param . "%' ORDER BY cod ASC");
        echo "<table class='table'>";
        $sqlFornecedores = "SELECT * FROM fornecedores WHERE descricao LIKE :param1 ORDER BY cod ASC";
        $paramFornecedores = array(
            ":param1" => "%{$param}%"
        );
        $dataTableFornecedores = $banco->ExecuteQuery($sqlFornecedores, $paramFornecedores);
        foreach ($dataTableFornecedores as $resultadofornecedores) {
            $contador++;
            $codfornecedor = $resultadofornecedores['cod'];
            $nomefornecedor = $resultadofornecedores['descricao'];
            echo "  <tr><td><a tabindex='$contador' href='javascript: func' onclick='Validacao(17, $codfornecedor, $valor, 100)'>" . $nomefornecedor . "</a></td></tr>
                               ";
        }
        echo "</table>";

        break;

    case 12:
        $contador = 1;
        $param = $_GET['param'];
        $valor = $_GET['valor'];
        $id = $_GET['id'];
        $cod_orgao = 1;
//$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod_orgao = $cod_orgao AND descricao LIKE '%" . $param . "%' ORDER BY cod ASC");
        echo "<table class='table'>";
        $sqlFornecedores = "SELECT * FROM fornecedores WHERE cod_orgao = :cod AND descricao LIKE :param ORDER BY cod ASC";
        $paramFornecedores = array(
            ":cod" => $cod_orgao,
            ":param" => "%{$param}%"
        );
        $dataTableFornecedores = $banco->ExecuteQuery($sqlFornecedores, $paramFornecedores);
        foreach ($dataTableFornecedores as $resultadofornecedores) {
            $contador++;
            $codfornecedor = $resultadofornecedores['cod'];
            $nomefornecedor = $resultadofornecedores['descricao'];
            echo "  <tr><td><a tabindex='$contador' href='javascript: func' onclick='Validacao(13, $codfornecedor, $valor, 100)'>" . $nomefornecedor . "</a></td></tr>
                               ";
        }
        echo "</table>";

        break;
//CONFIRMAR FORNECEDOR DA ENTRADA  
    case 13:
        $param = $_GET['param'];
        $valor = $_GET['valor'];
        $id = $_GET['id'];
        $query = mysqli_query($conn, "UPDATE entradas SET fornecedor = $param WHERE cod = $valor");
// Se inserido com scesso
        if ($query) {
//$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod = $param ORDER BY cod ASC LIMIT 1");
            $sqlFornecedores = "SELECT * FROM fornecedores WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
            $paramFornecedores = array(
                ":cod" => $param
            );
            $dataTableFornecedores = $banco->ExecuteQuery($sqlFornecedores, $paramFornecedores);
            foreach ($dataTableFornecedores as $resultadofornecedores) {
                $codfornecedor = $resultadofornecedores['cod'];
                $nomefornecedor = $resultadofornecedores['descricao'];
                echo"<b style='color:#337AB7;'>Fornecedor:</b> " . $nomefornecedor . "-<a class='btn btn-primary btn-sm' onclick='Validacao(14, 1, $valor, 100)' style='color:#fff;'><span class='glyphicon glyphicon-retweet'></span> Editar Dados</a>";
                echo "<a href='' class='btn btn-sm btn-warning' style='margin-left:10px;'> Clique aqui para continuar!</a>";
            }
        }

        break;
//EDITAR FORNECEDOR   
    case 14:
        $param = $_GET['param'];
        $codentrada = $_GET['valor'];

        if ($param == 1) {
            echo " <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; '>Adicionar Fornecedor </label>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon' id='basic-addon1'><span class='glyphicon glyphicon-search'></span></span>
                                                                                <input tabindex='1' style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' name='txtNomeFornecedor' id='txtNomeFornecedor' placeholder='Escolha Fornecedor...' value='' onkeyup='Validacao(12, this.value, $codentrada, 98)' autofocus>
                                                                            </div>
                                                                            <div id='ResultadoValidacao98'></div>";
        } else if ($param == 2) {
            echo "<label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; '>Cadastrar nº Nota Fiscal </label>
                                                                            <div class='input-group'>
                                                                                <span class='input-group-addon' id='basic-addon1'><span class='glyphicon glyphicon-plus'></span></span>
                                                                                <input tabindex='1' style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' name='txtNotafiscal' id='txtNotafiscal' placeholder='Nº Nota Fiscal...' value=''  autofocus>
                                                                                    <a onclick='Validacao(15, txtNotafiscal.value, $codentrada, 87)' href='javascript: func' style='width:100%; padding:10px; font-size:14pt;' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-floppy-saved'></span> Salvar Informação</a>
                                                                                </div>
                                                                                ";
        }
        break;


//CADASTRAR NOTA FISCAL   
    case 15:
        $param = $_GET['param'];
        $valor = $_GET['valor'];
        $id = $_GET['id'];
//$query = mysqli_query($conn, "UPDATE entradas SET n_notafiscal = '$param' WHERE cod = $valor");
// Se inserido com scesso

        $sql2 = "UPDATE entradas SET n_notafiscal =:param WHERE cod = :cod";
        $param2 = array(
            ":param" => $param,
            ":cod" => $valor
        );

        $banco->ExecuteNonQuery($sql2, $param2);
        echo"<b style='color:#337AB7;'>nº Nota Fiscal:</b> " . $param . " - <a class='btn btn-primary btn-sm' onclick='Validacao(14, 2, $valor, 87)' style='color:#fff;'><span class='glyphicon glyphicon-retweet'></span> Editar Dados</a>";
        echo " <a href='' class='btn btn-sm btn-warning'>Clique aqui para continuar!</a>";


        break;

//VALIDACAO PARA CARINHO DE COMPRAS - ENTRADAS - paramentros
    case 16:
        $param = $_GET['param'];
        $cod_orgaoF = 1;
        $valor = $_GET['valor'];
        $sqlEnt = mysqli_query($conn, "SELECT * FROM entradas WHERE cod = $valor ORDER BY cod ASC LIMIT 1");

        while ($ent = mysqli_fetch_object($sqlEnt)) {
            $ata_pregao = $ent->ata_pregao;
        }



        if ($param == 1) {
//$sqlCat = mysqli_query($conn, "SELECT * FROM categoria_produto WHERE cod_orgao = $valor ORDER BY cod ASC");
            $sqlCat = "SELECT * FROM categoriaserfin ORDER BY cod ASC";


            echo "<label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtParamControle'><span></span> Categorias:</label>
                <select tabindex='3' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' id='txtParamControle2' name='txtParamControle2' onchange='PesquisarProdutosCar(4, txtNomeProduto.value, txtParamControle.value, txtAtaPregaoCar.value, this.value, $valor)'>
                    <option value='0'>Todas Categorias</option>
                ";
            $dataTableCat = $banco->ExecuteQuery($sqlCat);
            foreach ($dataTableCat as $resultadocat) {
                $nomecategoria = $resultadocat['nome'];
                echo "  <option value='" . $resultadocat['cod'] . "'>" . $nomecategoria . "</option>
                               ";
            }
            echo "</select>";
        } else if ($param == 2) {
//$sqlFor = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod_orgao = $valor ORDER BY cod ASC");
            $sqlFornecedores2 = "SELECT * FROM fornecedores ORDER BY cod ASC";

            echo "<label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtParamControle'><span></span> Fornecedores:</label>
                <select tabindex='3' style='height: 82px; font-size: 15pt; width: 100%;' class='form-control' id='txtParamControle2' name='txtParamControle2' onchange='PesquisarProdutosCar(4, txtNomeProduto.value, txtParamControle.value, txtAtaPregaoCar.value, this.value, $valor)'>
                    <option value='0'>Todos Fornecedores</option>
                ";

            $dataTableFornecedores2 = $banco->ExecuteQuery($sqlFornecedores2);
            foreach ($dataTableFornecedores2 as $resultadofornecedores) {
                $nomefor = $resultadofornecedores['descricao'];
                echo "  <option value='" . $resultadofornecedores['cod'] . "'>" . $nomefor . "</option>
                               ";
            }
            echo "</select>";
        } else if ($param == 3) {
            echo "
                 <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%;' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtNome' class='control-label'>Apresentação</label>
                            <select tabindex='3' style='height: 82px; font-size: 15pt; width: 100%;' class='form-control' id='txtParamControle2' name='txtParamControle2' onchange='PesquisarProdutosCar(4, txtNomeProduto.value, txtParamControle.value, txtAtaPregaoCar.value, this.value, $valor)'>
                                <option value='0'>Todas Apresentação</option>
                                <option value='1'>Unidade</option>
                                <option value='2'>Comprimido</option>
                                <option value='3'>Ampola</option>
                                <option value='4'>Frasco Ampola</option>
                                <option value='5'>Frasco</option>
                                <option value='6'>Caixa</option>
                                <option value='7'>Pacote</option>
                                <option value='8'>Kit</option>
                                <option value='9'>Outros</option>
                            </select>
                ";
        }


        break;

//CONSTRUTOR DOS FORMULARIO PARA ADICIONAR ITEM NA LISTA DE ENTRADAS
    case 17:

        $param = $_GET['param'];
        $cod_orgaoF = 1;
        $valor = $_GET['valor'];
        $ata_pregao = $_GET['ata'];
        $id = $_GET['id'];
        $id2 = $id + 1;


        $contindex = $id2;
        echo "<td colspan='6'>
            <div class='row'>
                     <input type='hidden' id='txtLote$valor' name='txtLote$valor' value='000'  style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' />
            ";
        echo " 
                                <input   type='hidden' id='txtMesvalidade$valor' name='txtMesvalidade$valor' value='0' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' />
            ";
        echo " 
                                <input  type='hidden' id='txtAnovalidade$valor' name='txtAnovalidade$valor' value='0' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' />
            
            ";
        
        echo " 
            <div  class='col-12 col-md-4' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtMesPes' class='control-label'>Valor Unt. de Compra</label>
                                <input  tabindex='$contindex' onkeyup='Validacao(21, txtQtdpedidos$valor.value, this.value,  $valor" . '33' . ")' type='text' id='txtValorpedidos$valor' name='txtValorpedidos$valor' value='' value=''  style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' />
            
                    </div>
            </div>";
        $contindex = $contindex++;
        echo " 
            <div class='col-12 col-md-4' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtMesPes' class='control-label'>Qtd</label>
                                <input tabindex='$contindex' onkeyup='Validacao(21, this.value, txtValorpedidos$valor.value,  $valor" . '33' . ")' id='txtQtdpedidos$valor' name='txtQtdpedidos$valor' value='1'  style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' />
            
                    </div>
            </div>
            ";
        $contindex = $contindex++;
        echo " 
            <div class='col-12 col-md-4' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtMesPes' class='control-label'>Valor Total</label>
                                <div id='ResultadoValidacao$valor" . '33' . "'>
                                    <input disabled tabindex='$contindex'  type='text' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' placeholder='' id='txtValor$valor' name='txtValor$valor' value='R$ 0,00' >
								";
        $contindex = $contindex++;
        echo "
						<input value='$valor2' type='hidden' name='txtValor$valor" . '33' . "' id='txtValor$valor" . '33' . "' />	
                                                </div>
                    </div>
            </div>
            ";
        $contindex = $contindex++;

        echo " 
            <div class='col-12 col-md-12' style='text-align: left; '>
            <div  id='ResultadoValidacao12$valor'><div  id='ResultadoValidacao13$valor'></div></div> </br>
                            <a tabindex='$contindex' href='javascript: func' onclick='CadastrarPedido2(28, $param, $valor, txtLote$valor.value, txtMesvalidade$valor.value, txtAnovalidade$valor.value, txtQtdpedidos$valor.value, txtValor$valor" . '33' . ".value, txtAtaPregaoCar.value)' class='btn btn-success' style='padding:15px; font-size:17pt; width:100%;  '><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</br> Item</a></td></tr>
                        ";
        $contindex = $contindex++;
        echo "</div>
            ";



        echo " 
                </div>
            </td>";


        break;

//VALIDDACAO DO MES VALIDADE EM LISTA ENTRADAS
    case 18:
        $param = (int) $_GET['param'];
        $valor = (float) $_GET['valor'];

        if ($param >= 1 && $param <= 12) {
            echo "
             <div id='ResultadoValidacao13$valor'></div>";
        } else {
            echo "<div class='alert alert-warning'>Valor Válido de</br><b>1</b> a <b>12</b>.</div>";
        }
        break;
//VALIDACACAO DO ANO VALIDADE EM LISTA ENTRADAS
    case 19:
        $param = (int) $_GET['param'];
        $valor = (float) $_GET['valor'];

        $param = (int) $_GET['param'];
        $valor = (float) $_GET['valor'];

        $anohoje = date('Y');
        if ($param >= $anohoje) {
            echo "
             <div id='ResultadoValidacao13$valor'></div>";
        } else {
            echo "<div class='alert alert-warning'>Valor Válido  </br>Acima <b> $anohoje</b></div>";
        }


        break;

    case 20:
        $param = (int) $_GET['param'];
        $valor = (float) $_GET['valor'];
        $id = $_GET['id'];

        $valor = $valor * $param;
        $valor2 = $valor;
        $valor = number_format($valor, 2, ',', '.');

        echo "<b style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; text-align:center;'>Total</b>	"
        . "       <input disabled style='text-align:center; padding:20px; font-size: 13pt;' type='text' class='form-control' placeholder='' id='txtValor$valor' name='txtValor$valor' value='R$ $valor' >
                   <input value='$valor2' type='hidden' name='txtValor$id' id='txtValor$id' />	
                                                
             ";


        break;

    case 21:
        $param = (int) $_GET['param'];
        $valor = $_GET['valor'];
        $id = $_GET['id'];

        $pontos = '.';
        $result = str_replace($pontos, "", $valor);
        $result = str_replace(",", ".", $result);
        $valor = $result;
        $valor = (float) $valor;

        $valor = number_format($valor, 2, '.', '');

        $valor = $valor * $param;
        $valor2 = $valor;
        $valor = number_format($valor, 2, ',', '.');

        echo "       <input disabled style='height:81px; text-align:center; padding:20px; font-size: 13pt;' type='text' class='form-control' placeholder='' id='txtValor$valor' name='txtValor$valor' value='R$ $valor' >
                   <input value='$valor2' type='hidden' name='txtValor$id' id='txtValor$id' />	
                                                
             ";
        break;

    case 22:
        $valor = (float) $_GET['valor'];
        $param = (float) $_GET['param'];

        $valorfinal = $valor * $param;

        $valorfinal = "R$ " . number_format($valorfinal, 2, ',', '.');

        echo "<label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
								<div class=	input-group	>
									<input style='padding:40px; font-size: 15pt; width: 100%;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valorfinal'>					
								</div>";

        break;

    case 23:
        $valor = $_GET['param'];
        $param = $_GET['valor'];

        $pontos = '.';
        $result = str_replace($pontos, "", $valor);
        $result = str_replace(",", ".", $result);
        $valor = $result;
        $valor = (float) $valor;

        $valor = number_format($valor, 2, '.', '');

// $result2 = str_replace($pontos, "", $param);
        $result2 = str_replace(",", ".", $param);
        $valor2 = $result2;
        $valor2 = (float) $valor2;

        $valorfinal = $valor - $valor2;
        $valorfinal2 = $valorfinal;
        if ($valorfinal <= 0) {
            $valorfinal = "0.00";
        }
        $valorfinal =  number_format($valorfinal, 2, ',', '.');

        echo "<label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Troco.</label>
								<div class='input-group'>
								
										<input disabled tabindex='1' style='padding:40px; font-size: 24pt; width: 100%;' type='text' class='form-control' id='txtTroco2' name='txtTroco2' placeholder='' value='$valorfinal'>
										<input type='hidden'  id='txtTroco' name='txtTroco' value='$valorfinal'>
								</div>";
        break;

    case 24:
        $codnota = $_GET['valor'];
        $param = $_GET['param'];
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
        $total2 = $totalfinal;
        $valorfinal = "R$ " . number_format($totalfinal, 2, ',', '.');

        if ($param == 1) {
            echo "
                 
                 <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
								";


            echo"  <label style='color:red; border-bottom: 2px solid #337AB7; width: 100%; font-size:24pt;' for='valortotal'>Finalizar Venda.</label>
                                                                <div class='input-group'>
								
										<input onkeyup='Validacao(23, this.value, $total2, 1313)'  tabindex='1' style='padding:40px; font-size: 24pt; width: 100%;' type='text' class='form-control' id='txtTrocodaVenda' name='txtTrocodaVenda' placeholder='Digite o valor do pagamento' value=''>
								</div>
                                                                ";


            echo " 
								</div>
                                                                
                                                                        <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
                                                                <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
                                                                <div class='input-group'>
                                                                
								
										<input  disabled tabindex='2' style='padding:40px; font-size: 24pt; width: 100%;' type='text' class='form-control' id='txtValorTotal' name='txtValorTotal' placeholder='' value='$valorfinal'>
								</div>
								</div>
                                                                <div class='col-12 col-md-12' id='ResultadoValidacao1313'>
                                
                                                                </div>
								
                                                                
							</div>
                 ";
        } else if ($param == 2) {
            echo "
                 
                 <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
								";


            echo"<input tabindex='1' type='hidden' id='txtTrocodaVenda' name='txtTrocodaVenda' placeholder='Digite o valor do pagamento' value=''>
								";


            echo " 
								</div>
                                                                
                                                                        <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
                                                                <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; font' for='valortotal'>Valor Total.</label>
                                                                <div class='input-group'>
                                                                
								
										<input  disabled tabindex='2' style='padding:40px; font-size: 24pt; width: 100%;' type='text' class='form-control' id='txtValorTotal' name='txtValorTotal' placeholder='' value='$valorfinal'>
								</div>
								</div>
                                                                <div class='col-12 col-md-12' id='ResultadoValidacao1313'>
                                
                                                                </div>
								
                                                                
							</div>
                 ";
        } else if ($param == 3) {
            $dinheirooudebito = 0;

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
            $totalfinal2 = $totalfinal;
            $totalfinal = number_format($totalfinal, 2, ',', '.');
            echo "  
					<div style='text-align:center;'>    
							<h3 style='text-align:center; color:#337AB7;'><b><span class='glyphicon glyphicon-hand-right'></span> Pagamento Parcelado no Crediário</h3>
						</div>
					<div class='row' style='margin-bottom:10px;'>
								<div class='col-12 col-md-5 card' style='box-shadow: 2px 2px 5px #000;'></br></br>
											<div class='input-group'>
											<select onchange='Parcelamento(22, this.value, $codnota, juros.value, juros2.value)' style='font-size:18pt; padding:15px; height:60px;' class='form-control' id='numparcelas' name='numparcelas'>
											<option value='1'>1x</option>
											<option value='2'>2x</option>
											<option value='3'>3x</option>
											<option value='4'>4x</option>
											<option value='5'>5x</option>
								c			<option value='6'>6x</option>
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
											<select onchange='Parcelamento(22, numparcelas.value, $codnota, this.value, juros2.value)' style='font-size:18pt; padding:15px; height:60px;' class='form-control' id='juros' name='juros'>
											<option value='1'>Sem Juros</option>
											<option value='2'>Juros Simples</option>
											<option value='3'>Juros Composto</option>
											</select>
											</div>
											</br>
											<div class='input-group'>
											<select onchange='Parcelamento(22, numparcelas.value, $codnota, juros.value, this.value)' style='font-size:18pt; padding:15px; height:60px;' class='form-control' id='juros2' name='juros2'>
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
								<div class='col-12 col-md-5 card' style='box-shadow: 2px 2px 5px #000;' id='resultadodoparcelamento'>
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
					
					
				";
        } else if ($param == 4) {
            echo "
                 
                 <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
								";


            echo"<input tabindex='1' type='hidden' id='txtTrocodaVenda' name='txtTrocodaVenda' placeholder='Digite o valor do pagamento' value=''>
								";


            echo " 
								</div>
                                                                
                                                                        <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
                                                                <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; font' for='valortotal'>Valor Total.</label>
                                                                <div class='input-group'>
                                                                
								
										<input  disabled tabindex='2' style='padding:40px; font-size: 24pt; width: 100%;' type='text' class='form-control' id='txtValorTotal' name='txtValorTotal' placeholder='' value='$valorfinal'>
								</div>
								</div>
                                                                <div class='col-12 col-md-12' id='ResultadoValidacao1313'>
                                
                                                                </div>
								
                                                                
							</div>
                 ";
        } else if ($param == 5) {
            echo "
                 
                 <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
								";


            echo"<input tabindex='1' type='hidden' id='txtTrocodaVenda' name='txtTrocodaVenda' placeholder='Digite o valor do pagamento' value=''>
								";


            echo " 
								</div>
                                                                
                                                                        <div class='col-12 col-md-12' id='resultadoqtdvalor' style='margin-bottom:5px;'>
                                                                <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; font' for='valortotal'>Valor Total.</label>
                                                                <div class='input-group'>
                                                                
								
										<input  disabled tabindex='2' style='padding:40px; font-size: 24pt; width: 100%;' type='text' class='form-control' id='txtValorTotal' name='txtValorTotal' placeholder='' value='$valorfinal'>
								</div>
								</div>
                                                                <div class='col-12 col-md-12' id='ResultadoValidacao1313'>
                                
                                                                </div>
								
                                                                
							</div>
                 ";
        }


        break;

    case 25:
        $param1 = $_GET['param'];
        $tiposervico = $param1;
        $codservico = (float) $_GET['valor'];
//$sqlServicos = mysqli_query($conn, "SELECT * FROM servicos WHERE cod = $codservico ORDER BY cod ASC LIMIT 1");
        $sqlServicos = "SELECT * FROM servicos WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
        $paramServicos = array(
            ":cod" => $codservico
        );


        $dataTableServicos = $banco->ExecuteQuery($sqlServicos, $paramServicos);
        foreach ($dataTableServicos as $resultadoservicos) {

            $est_maxservico = $resultadoservicos['est_max'];
            $est_mimservico = $resultadoservicos['est_mim'];
            $cod_barraservico = $resultadoservicos['cod_barra'];
        }
        if ($tiposervico == 1) {
            echo "
                <div class='col-12 col-md-12' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtNomeProduto' class='control-label'>Estoque Máximo</label>
                            <input style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtEst_maxEd' name='txtEst_maxEd' value='$est_maxservico' >
                        </div>
                    </div>  
                    <div class='col-12 col-md-12' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtNomeProduto' class='control-label'>Estoque minímo</label>
                            <input style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtEst_mimEd' name='txtEst_mimEd' value='$est_mimservico' >
                        </div>
                    </div>  
                    <div class='col-12 col-md-12' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtNomeProduto' class='control-label'>Cod Barra</label>
                            <input style='padding:30px; font-size: 15pt; width: 100%; ' type='text' class='form-control' id='txtCod_BarraEd' name='txtCod_BarraEd' value='$cod_barraservico' >
                        </div>
                    </div>  
                    
                ";
        } else {
            echo "
                            <input  type='hidden' class='form-control' id='txtEst_maxEd' name='txtEst_maxEd' value='$est_maxservico' >
                            <input  type='hidden' class='form-control' id='txtEst_mimEd' name='txtEst_mimEd' value='$est_mimservico' >
                            <input  type='hidden' class='form-control' id='txtCod_BarraEd' name='txtCod_BarraEd' value='$cod_barraservico' >
                    
                ";
        }

        break;
//VALIDACAO PARA MOSTRAR ITENS MAIS VENDIDOS
    case 26:
        echo "
            <div class='card' style='width:100%;'>
                <div class='card-body' style='width:100%;'>
                    <div class='row' style='width:100%;'>
                        <div class='col-12 col-md-4' style='text-align: left;'>
                            <div class='form-group label-floating'>
                                <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtMesAno' class='control-label'>Selecione mês e o ano</label>
                                <input style='padding:30px; font-size: 15pt; width: 100%; ' type='month' class='form-control' id='txtDataAnoMes' name='txtDataAnoMes' value='' >
                            </div>
                        </div>
                        <div class='col-12 col-md-4' style='text-align: left;'>
                        <div class='form-group label-floating'>
                            <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtCategoriaEd' class='control-label'>Selecione Categoria</label>
                             <select  style='height:62px; font-size: 15pt; width: 100%; ' type='text' id='txtCategoriaEd' name='txtCategoriaEd' class='form-control' value='' >
								<option value='0'>Todas Categorias</option>";
// $sqlCategorias = mysqli_query($conn, "SELECT * FROM categoriaserfin ORDER BY cod ASC");
        $sqlCat = "SELECT * FROM categoriaserfin ORDER BY cod ASC";

        $dataTableCat = $banco->ExecuteQuery($sqlCat);
        foreach ($dataTableCat as $resultadocat) {
            $nomecategoria = $resultadocat['nome'];
            $codcategoria = $resultadocat['cod'];

            echo "<option value='$codcategoria' >$nomecategoria</option>
											";
        }



        echo "			
									
							</select>
          
                        </div>
                        </div>
                        <div class='col-12 col-md-4' style='text-align: left;'>
                            <div class='form-group label-floating'>
                                <a  href='javascript: func' onclick='Validacao(29, txtDataAnoMes.value, txtCategoriaEd.value, 101)' class='btn btn-primary' style='width:100%; height: 100px; margin-bottom:10px; text-align: center;'></br><b><span class='glyphicon glyphicon-print'></span></br>GERAR </br>RELATÓRIO</b></a>
                            </div>
                        </div>  
                    </div>
                    <div id='ResultadoValidacao101'>
                    </div>
                </div>
            </div>
            ";
        break;

    case 27:
        $cat = $_GET['param'];

        echo "                   <div class='row' style='margin-bottom:5px;'>
                                                <input name='txtAtaSD' id='txtAtaSD' type='hidden' value='txtAtaSD'/>
								<div class='col-12 col-md-12' id=''>
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtCategoriaSD'><span></span> Categorias:</label>
                                                                    <select onchange='Validacao(44, this.value, 0, 1100)' href='javascript: func' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' id='txtBairrosFiltros' name='txtBairrosFiltros' onchange=''>
                                                                    <option value='0'>Todas Categorias</option>
                                                                    ";
        $cod_orgao = $_SESSION['cod_orgaoF'];
// $sqlFor2 = mysqli_query($conn, "SELECT * FROM categoria_produto WHERE cod_orgao = $cod_orgao ORDER BY cod ASC");
        $sqlFor = "SELECT * FROM categoriaserfin ORDER BY cod ASC";


        $dataTableFor = $banco->ExecuteQuery($sqlFor);
        foreach ($dataTableFor as $resultadofor) {
            $nomefornecedor = $resultadofor['nome'];
            echo "  <option value='" . $resultadofor['cod'] . "'>" . $nomefornecedor . ".</option>";
        }
        echo"             
                                                                    </select>
                                                                </div>
							
                                                                
                                                                		
                                                      
                                    <div class='col-12 col-md-12' id='ResultadoValidacao1100'>
                                                           
                                                     
							
							
                                       ";

        echo "
            <h3 style='margin-left: 10px; padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; '>Produtos em Estado Crítico
              - <a style='font-size:14pt;' target='_blank' href='Imprimir.php?pagina=11&codcat=0' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print' ></span> Imprimir</a>
          
            </h3>
            <table class='table' style='font-size:14pt;'>
            <tr style='text-align:center;'>
                <td><b>Cod</b></td>
                <td><b>Apresentação</b></td>
                <td><b>Produto</b></td>
                <td><b>Categoria</b></td>
                <td><b>Est. Máx</b></td>
                <td><b>Qtd</b></td>
                <td><b>Est. min.</b></td>
                
            </tr>
            ";
//$sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY cod ASC");
        $sqlProdutos = "SELECT * FROM servicos WHERE tipo = 1 ORDER BY qtd ASC";


        $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos);
        foreach ($dataTableProdutos as $resultadoprodutos) {

            $codproduto = $resultadoprodutos['cod'];
            $nomeproduto = $resultadoprodutos['nome'];
            $apresentacao = $resultadoprodutos['apresentacao'];
            $qtd = $resultadoprodutos['qtd'];
            $categoria = $resultadoprodutos['categoria'];
            $est_min = $resultadoprodutos['est_mim'];
            $est_max = $resultadoprodutos['est_max'];

            $sqlCat = "SELECT * FROM categoriaserfin WHERE cod = :categoria ORDER BY cod ASC LIMIT 1";
            $paramCat = array(
                ":categoria" => $categoria
            );

            $dataTableCat = $banco->ExecuteQuery($sqlCat, $paramCat);
            foreach ($dataTableCat as $resultadocat) {
                $nomecategoria = $resultadocat['nome'];
            }

            if ($apresentacao == 1) {
                $textoapresentacao = "Unidade";
            } else if ($apresentacao == 2) {
                $textoapresentacao = "Comprimido";
            } else if ($apresentacao == 3) {
                $textoapresentacao = "Ampola";
            } else if ($apresentacao == 4) {
                $textoapresentacao = "Frasco Ampola";
            } else if ($apresentacao == 5) {
                $textoapresentacao = "Frasco";
            } else if ($apresentacao == 6) {
                $textoapresentacao = "Caixa";
            } else if ($apresentacao == 7) {
                $textoapresentacao = "Pacote";
            } else if ($apresentacao == 8) {
                $textoapresentacao = "Kit";
            } else if ($apresentacao == 9) {
                $textoapresentacao = "Outros";
            }


            if ($qtd < $est_min) {
                echo " <tr style='text-align:center;'>
                <td>$codproduto</td>
                <td>$textoapresentacao</td>
                <td>$nomeproduto</td>
                <td>$nomecategoria</td>
                <td>$est_max</td>
                    <td>$qtd</td>
                <td>$est_min</td>
                
            </tr>
            ";
            }
        }
        echo "</table>
               </div>                 
							
            ";


        break;

    case 28:


        echo "                   <div class='row' style='margin-bottom:5px;'>
                                                <input name='txtAtaSD' id='txtAtaSD' type='hidden' value='txtAtaSD'/>
								<div class='col-12 col-md-8' id=''>
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtCategoriaSD'><span></span> Categorias:</label>
                                                                    <select Onchange='Validacao(30, this.value, 0, 1100)' href='javascript: func' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' id='txtBairrosFiltros' name='txtBairrosFiltros' onchange=''>
                                                                    <option value='0'>Todas Categorias</option>
                                                                    ";
        $cod_orgao = $_SESSION['cod_orgaoF'];
// $sqlFor2 = mysqli_query($conn, "SELECT * FROM categoria_produto WHERE cod_orgao = $cod_orgao ORDER BY cod ASC");
        $sqlFor = "SELECT * FROM categoriaserfin ORDER BY cod ASC";


        $dataTableFor = $banco->ExecuteQuery($sqlFor);
        foreach ($dataTableFor as $resultadofor) {
            $nomefornecedor = $resultadofor['nome'];
            echo "  <option value='" . $resultadofor['cod'] . "'>" . $nomefornecedor . ".</option>";
        }
        echo"             
                                                                    </select>
                                                                </div>
							
                                                                
                                                                		
                                                      
                                                     
							<div class='col-12 col-md-4' id='ResultadoValidacao1100'>
                                                             <a target='_BLANK' href='Imprimir.php?pagina=12&categoria=0' style='padding:27px; font-size: 15pt; width: 100%;'  class='btn btn-primary btn-lg btn-block active'><span class='glyphicon glyphicon-plus'></span>Gerar</br> Relatório</a>
                                                       
                                                        </div>
							
							
                                       ";



        break;
//MOSTRAR RESULTADOS DOS ITENS MAIS VENDIDOS
    case 29:

        $mesano = $_GET['param'];


        if ($mesano == null) {
            $mes = date('m');
            $ano = date('Y');
        } else {
            $t = explode("-", $mesano);
            $ano = $t[0];
            $mes = $t[1];
        }


        $categoria = $_GET['valor'];

        echo "
            <h3 style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; '>Produtos mais vendidos " . ($mes) . "/$ano
              - <a style='font-size:16pt;' target='_blank' href='Imprimir.php?pagina=10&mes=$mes&ano=$ano&categoria=$categoria' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print' ></span> Imprimir</a>
          
            </h3>
            
            ";


        if ($categoria == 0) {
            $sqlServicos = "SELECT * FROM servicos ORDER BY nome ASC";
            $dataTableServicos = $banco->ExecuteQuery($sqlServicos);
        } else {
            $sqlServicos = "SELECT * FROM servicos WHERE categoria = :cod ORDER BY nome ASC";
            $paramServicos = array(
                ":cod" => $categoria
            );
            $dataTableServicos = $banco->ExecuteQuery($sqlServicos, $paramServicos);
        }
        foreach ($dataTableServicos as $resultadoservicos) {
            $codservico = $resultadoservicos['cod'];
            $nomeservico = $resultadoservicos['nome'];
            $valorservico = $resultadoservicos['valor'];
            $valorservico = number_format($valorservico, 2, ',', '.');
            $qtd_total = 0;
            $valor_total = 0;
            $sqlListaSaidas = "SELECT * FROM pedidos WHERE servico = :cod_produto AND mes = $mes AND ano = $ano AND status = 3 ORDER BY cod ASC";
            $paramListaSaidas = array(
                ":cod_produto" => $codservico
            );
            $dataTableListaSaidas = $banco->ExecuteQuery($sqlListaSaidas, $paramListaSaidas);
            foreach ($dataTableListaSaidas as $resultadolistasaidas) {
                $qtd = $resultadolistasaidas['qtd'];
                $valor = $resultadolistasaidas['valor'];
                $qtd_total = $qtd_total + $qtd;
                $valor_total = $valor_total + $valor;
            }
            $jogo[$codservico] = [
                ["$nomeservico", "$valorservico", $qtd_total, "$valor_total"],
            ];
// print_r($jogo);
// O array
            $arraynovo[$codservico] = array(
                array($valor_total, $codservico, $nomeservico, $valorservico, $qtd_total),
            );
        }

        arsort($jogo[3]);
// var_dump($jogo);
//  var_dump($arraynovo);

        echo "<div class='table-responsive' style='font-size:14pt;'>
        <table class='table table-striped table-sm '>
          <thead>
                    <tr>
                        <td><b>Nome Serviço/Produto</b></td>
                        <td><b>Valor Unt.</b></td>
                        <td><b>Qtd Total</b></td>
                        <td><b>Valor Total</b></td>
                    </tr>
            </thead>          ";
        arsort($arraynovo);
        foreach ($arraynovo as $chave => $valor_total) {

            foreach ($arraynovo[$chave] as $resultadoservicos) {
                $valorservico = 0;
                $qtd_total = 0;
                $valor_total = 0;

                $valor_total = $resultadoservicos[0];
                $codservico = $resultadoservicos[1];
                $nomeservico = $resultadoservicos[2];
                $valorservico = (float) $resultadoservicos[3];
                $qtd_total = $resultadoservicos[4];
                echo "
                        <tr>
                        <td>$nomeservico</td>
                        <td>" . number_format($valorservico, 2, ',', '.') . "</td>
                        <td>$qtd_total</td>
                        <td>" . number_format($valor_total, 2, ',', '.') . "</td>
                    </tr>
            
                        ";
            }
        }


        echo "</table></div>";

        break;

    case 30:

        $cat = $_GET['param'];
        echo "    <a target='_BLANK' href='Imprimir.php?pagina=12&categoria=$cat' style='padding:27px; font-size: 15pt; width: 100%;'  class='btn btn-primary btn-lg btn-block active'><span class='glyphicon glyphicon-plus'></span>Gerar</br> Relatório</a>
                                                        ";

        break;

    case 31:

        set_time_limit(500);
        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');
        echo "                   <div class='row' style='margin-bottom:5px;'>
                                                <input name='txtAtaSD' id='txtAtaSD' type='hidden' value='txtAtaSD'/>
								 <div class='col-12 col-md-9' id='resultadoqtdvalor'>
                                                                        <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtNomeProdutoSD'>Pesquisar Produto</label>
                                                                        <div class='input-group'>
                                                                            <input tabindex='1' style='padding:40px; font-size: 15pt; width: 100%;' type='text' class='form-control' name='txtNomeProdutoSD' id='txtNomeProdutoSD' placeholder='Digite a Descrição do Produto...' value='' onkeyup='SimuladorDemanda(33, this.value, txtAtaSD.value, txtCategoriaSD.value, txtMesSD.value, txtAnoSD.value, txtTiposecao.value)' autofocus>
                                                                        </div>
                                                                 </div>
                                                                <div class='col-12 col-md-3' id=''>
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtCategoriaSD'><span></span> Fornecedores:</label>
                                                                    <select style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' id='txtCategoriaSD' name='txtCategoriaSD' onchange='SimuladorDemanda(33, txtNomeProdutoSD.value, txtAtaSD.value, this.value, txtMesSD.value, txtAnoSD.value, txtTiposecao.value)'>
                                                                    <option value='0'>Todas Categorias</option>
                                                                    ";
        $cod_orgao = $_SESSION['cod_orgaoF'];
// $sqlFor2 = mysqli_query($conn, "SELECT * FROM fornecedores WHERE cod_orgao = $cod_orgao ORDER BY cod ASC");
        $sqlFor = "SELECT * FROM categoriaserfin ORDER BY cod ASC";

        $dataTableFor = $banco->ExecuteQuery($sqlFor);
        foreach ($dataTableFor as $resultadofor) {
            $nomefornecedor = $resultadofor['nome'];
            echo "  <option value='" . $resultadofor['cod'] . "'>" . $nomefornecedor . ".</option>";
        }
        echo"             
                                                                    </select>
                                                                </div>
							</div>
                                                       <div class='col-12 col-md-3'>
                                                            
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtMesSD'><span></span> Mês :</label>
                                                                <select onchange='SimuladorDemanda(33, txtNomeProdutoSD.value, txtAtaSD.value, txtCategoriaSD.value, this.value, txtAnoSD.value, txtTiposecao.value)' style='text-align:center; height:70px; font-size: 12pt; background-color:#fff;' name='txtMesSD' id='txtMesSD' class='form-control'>
                                                                                            ";
        for ($i = 1; $i <= 12; $i++) {
            echo "
                                                                                                                                                                                                                                        <option style='text-align:center;' value='$i'";
            if ($i == $mes_hoje) {
                echo "selected='selected'";
            } echo">" . $i . "</option>
                                                                                                                                                                                                                                         ";
        }
        echo"
                                                       </select>
							</div>
                                                        <div class='col-12 col-md-3'>
                                                        
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtAnoSD'><span></span> Ano:</label>
                                                         <select onchange='SimuladorDemanda(33, txtNomeProdutoSD.value, txtAtaSD.value, txtCategoriaSD.value, txtMesSD.value, this.value, txtTiposecao.value)' style=' text-align:center; height:70px; font-size: 12pt;  background-color:#fff;' name='txtAnoSD' id='txtAnoSD' class='form-control'>
                                                                                            ";
        $anoatual = date('Y');
        $anoatual = $anoatual + 10;
        for ($i = 2016; $i <= $anoatual; $i++) {
            echo "
                                                                                                                                                                                                                                        <option style='text-align:center;' value='$i'";
            if ($i == $ano_hoje) {
                echo "selected='selected'";
            } echo">" . $i . "</option>
                                                                                                                                                                                                                                         ";
        }
        echo"
                                                       </select>
							</div>
                                                        <div class='col-12 col-md-6' style='margin-bottom:10px;'>
                                                        
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtTiposecao'><span></span> Seção de Período:</label>
                                                            <select onchange='SimuladorDemanda(33, txtNomeProdutoSD.value, txtAtaSD.value, txtCategoriaSD.value, txtMesSD.value, txtAnoSD.value, this.value)' style='text-align:center; height:70px;  font-size: 12pt; background-color:#fff;' name='txtTiposecao' id='txtTiposecao' class='form-control'>
                                                                                <option value='1'>1ª Semana</option>
                                                                                <option value='2'>2ª Semana</option>
                                                                                <option value='3'>3ª Semana</option>
                                                                                <option value='4'>4ª Semana</option>
                                                                                <option value='5'>Mês Relatório Completo</option>
                                                                                <option value='6'>Mês Relatório Resumido</option>
                                                                                <option value='7'>Ano Relatório Completo</option>
                                                                                <option value='8'>Ano Relatório Resumido</option>
                                                           </select>
							</div>
							<div class='col-12 col-md-12' id='ResultadoSimulador'>
							</div>
                                       ";



        break;

    case 32:

        set_time_limit(500);
        $totalfinal = 0;
        $ata_pregao = 1;
        $qtdentradas = 0;
        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');

        $codentrada = 0;


        echo "
				<div class='row' id='MudaDia8'>   
                                ";

        echo "    <div class='col-12 col-md-12' style=''>
                                                <div class='card mb-4 box-shadow' style='width:100%;'>
                                                    <div class='card-header' style='text-align:center; background-color: #90EE90; width:100%;'>
                                                        <h4><a style='color:#fff;'  href='javascript: func' onclick='VerPesquisarDia(42, 0, 5, $dia_hoje, $mes_hoje, parampaganoFIN.value, 0)'>Entradas - Relatório Anual</br> (     <span class='glyphicon glyphicon-refresh'></span> Voltar)</a></h4>
                                                    </div>
                                                    <div class='card-body' style='text-align: center; width:100%;' id='MudaDia5'> 
                                                            <table class='table table-bordered' style='width:100%;font-size:14pt;'>
                                                                <tr style='text-align:center; background-color:#337AB7; color:#fff;'>
                                                                    <td colspan='3'><b>Entradas</b></td>
                                                                </tr>
                                                                <tr style='text-align:center;'>
                                                                    <td><b></b></td>
                                                                    <td><b>Qtd</b></td>
                                                                    <td><b>Valor Total</b></td>
                                                                </tr>

                                                                ";
        $cod_orgao = $_SESSION['cod_orgaoF'];
        $qtdtotalentfinal = 0;
        $qtdtotalsaifinal = 0;
        $valortotalentfinal = 0;
        $valortotalsaifinal = 0;
        for ($i = 1; $i <= 12; $i++) {
            $qtdtotalent = 0;
            $valortotalent = 0;
            $qtdtotalsai = 0;
            $valortotalsai = 0;
            $trueorfalsecat = 0;
            $trueorfalsecat = 1;

            $sqlListaEntradas = mysqli_query($conn, "SELECT * FROM lista_entradas WHERE mes = $i AND ano = $ano_hoje ORDER BY cod ASC");
            while ($listent = mysqli_fetch_object($sqlListaEntradas)) {
                $cod_entrada = $listent->cod_entrada;
                $sqlEntradas = mysqli_query($conn, "SELECT * FROM entradas WHERE cod = $cod_entrada ORDER BY cod ASC LIMIT 1");
                while ($ent = mysqli_fetch_object($sqlEntradas)) {
                    $qtdtotalent = $qtdtotalent + $listent->qtd;
                    $qtdtotalentfinal = $qtdtotalentfinal + $listent->qtd;

                    $valortotalent = $valortotalent + $listent->valor_total;
                    $valortotalentfinal = $valortotalentfinal + $listent->valor_total;
                }
            }
            $saldoqtd = $qtdtotalent;

            if ($saldoqtd != 0) {

                echo "
                                                                                                                                                                <tr id='ResultadoValidacao888' style='text-align:center;'>
                                                                                            <td style='width:50%;'><a href='javascript: func' style='width:100%;font-size:14pt;' class='btn btn-primary btn-sm' onclick='VerPesquisarDia(44, 0, 5, $dia_hoje, $i, parampaganoFIN.value, 0)'>" . mostraMes($i) . ".</a></td>
                                                                                             <td>$qtdtotalent</td>
                                                                                             <td>R$ " . number_format($valortotalent, 2, ',', '.') . "</td>
                                                                                            </tr>    ";
            }
        }
        $saldoqtdfinal = $qtdtotalentfinal - $qtdtotalsaifinal;

        echo "                                                                           <tr id='ResultadoValidacao888' style='text-align:center; background-color:#337AB7; color:#fff;'>
                                                                                            <td style='width:50%;'><b>Total Final</b>.</td>
                                                                                             <td>$qtdtotalentfinal</td>
                                                                                             <td>R$ " . number_format($valortotalentfinal, 2, ',', '.') . "</td>
                                                                                            </tr></table>    ";

        echo "      
                                                                                                    ";

        echo "  
                                                                                                                            </table>
                                                                                        <div class='col-12 col-md-12' style='text-align: center; ' id='resultadoqtdvalor'>
                                                                                             <a style='font-size:14pt;' target='_blank' href='Imprimir.php?pagina=19&dia=$dia_hoje&mes=$mes_hoje&ano=$ano_hoje&cod_ata=$codentrada' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                                                                        </div>
                                                                            </div>
                                                                            <div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
                                                                                    <select onchange='VerPesquisarDia(43, 0, 5, $dia_hoje, $mes_hoje ,this.value, 0)' style='margin-left:25%; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampaganoFIN' id='parampaganoFIN' class='form-control'>
                                                                                    ";
        $anoatual = $ano_hoje + 10;
        for ($i = 2016; $i <= $anoatual; $i++) {
            echo "
                                                                                                                                                            <option style='text-align:center;' value='$i'";
            if ($i == $ano_hoje) {
                echo "selected='selected'";
            } echo">$i</option>
                                                                                                                                                             ";
        }
        echo"
                                                                                    </select>
                                                                            </div>	
                                                                    </div>
                                                                </div>
                                                            
				";


        echo "</div>
                                        
					";


        break;

    case 33:


        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');

        echo "
		<ul class='nav nav-tabs' style='text-align:left; margin-top:10px;'>
				<style>
					a#botaofinclientes:hover{
						color:green;
						border: 1px solid green;
						background-color:#fff;
					}
					a#botaofinempresa:hover{
						color:#336699;
						border: 1px solid #336699;
						background-color:#fff;
					}
				</style>
				
			</ul>
		";
        $totalfinaldia = 0;
        $totalfinalmes = 0;
        $totalfinalano = 0;
        $sqlDividasDia = mysqli_query($conn, "SELECT * FROM financeiro_empresa WHERE dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje ORDER BY id ASC");
// Exibe todos os valores encontrados
        while ($dividadia = mysqli_fetch_object($sqlDividasDia)) {
            $cod = $dividadia->id;
            $codcat = $dividadia->cat;
            $descricao = $dividadia->descricao;
            $pontos = ',';
            $result = str_replace($pontos, "", $dividadia->valor);
            $valor_total = (float) $result;
            $total = $valor_total;
            $sqlCat = mysqli_query($conn, "SELECT * FROM lc_cat WHERE id = $codcat ORDER BY id ASC");
// Exibe todos os valores encontrados
            while ($cat = mysqli_fetch_object($sqlCat)) {
                $nomecategoria = $cat->nome;
            }
            $totalfinaldia = $totalfinaldia + $total;
        }
        $sqlDividasMes = mysqli_query($conn, "SELECT * FROM financeiro_empresa WHERE mes = $mes_hoje AND ano = $ano_hoje ORDER BY id ASC");
// Exibe todos os valores encontrados
        while ($dividames = mysqli_fetch_object($sqlDividasMes)) {
            $cod = $dividames->id;
            $codcat = $dividames->cat;
            $descricao = $dividames->descricao;
            $pontos = ',';
            $result = str_replace($pontos, "", $dividames->valor);
            $valor_total = (float) $result;
            $total = $valor_total;
            $sqlCat = mysqli_query($conn, "SELECT * FROM lc_cat WHERE id = $codcat ORDER BY id ASC");
// Exibe todos os valores encontrados
            while ($cat = mysqli_fetch_object($sqlCat)) {
                $nomecategoria = $cat->nome;
            }
            $totalfinalmes = $totalfinalmes + $total;
        }

        $sqlDividasAno = mysqli_query($conn, "SELECT * FROM financeiro_empresa WHERE ano = $ano_hoje ORDER BY id ASC");
// Exibe todos os valores encontrados
        while ($dividaano = mysqli_fetch_object($sqlDividasAno)) {
            $cod = $dividaano->id;
            $codcat = $dividaano->cat;
            $descricao = $dividaano->descricao;
            $pontos = ',';
            $result = str_replace($pontos, "", $dividaano->valor);
            $valor_total = (float) $result;
            $total = $valor_total;
            $sqlCat = mysqli_query($conn, "SELECT * FROM lc_cat WHERE id = $codcat ORDER BY id ASC");
// Exibe todos os valores encontrados
            while ($cat = mysqli_fetch_object($sqlCat)) {
                $nomecategoria = $cat->nome;
            }
            $totalfinalano = $totalfinalano + $total;
        }

        echo "
       
		<div class='row'>
		
            <div class='col-6 col-md-6' id='resultadoqtdvalor'>
                <a style='' onclick='VerMovCat(31, 0)' href='javascript:void' class='btn btn-danger btn-sm btn-block'><span class='glyphicon glyphicon-usd'></span> Cadastrar Despesa</a>
            </div>
            <div class='col-6 col-md-6' id='resultadoqtdvalor'>
                <a style='' onclick='VerMovCat(32, 1)' href='javascript:void' class='btn btn-success btn-sm btn-block'><span class='glyphicon glyphicon-plus-sign'></span> Nova Categoria</a>
            </div>
           
        </div>
				<div class='row' id='telamovcat'>
                    <div class='col-12 col-md-4' style=''>
                        <div class='card mb-4 box-shadow' style='width:100%;'>
                            <div class='card-header' style='text-align:center; background-color: #FFA07A; width:100%;'>
				<h4><a style='color:#fff;'  href='javascript: func' onclick='VerPesquisarDespesa(28, 1, 1, parampagdiaFIN.value, parampagmesFIN.value, parampaganoFIN.value, 0)'>Despesas Diária</br> (Ver Tudo)</a></h4>
                            </div>
                            <div class='card-body' style='text-align: center;' id='MudaDespesa2'>
                                <h5 class='my-0 font-weight-normal'><b>R$ " . number_format($totalfinaldia, 2, ',', '.') . "</b></h5>
                                <ul class='list-unstyled mt-12 mb-12' style='font-size:8pt; padding:5px;'>";
        $sqlCategorias = "SELECT * FROM lc_cat WHERE cod_usu = :cod ORDER BY id ASC";
        $paramCategorias = array(
            ":cod" => 1
        );

        $dataTableCategorias = $banco->ExecuteQuery($sqlCategorias, $paramCategorias);
        foreach ($dataTableCategorias as $resultadocategorias) {
            $idcat = $resultadocategorias['id'];
            $nomecat = $resultadocategorias['nome'];
            $sqlDividasDia = mysqli_query($conn, "SELECT * FROM financeiro_empresa WHERE dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje AND cat = $idcat ORDER BY id ASC");
// Exibe todos os valores encontrados
            $totalfinaldiacat = 0;
            while ($dividadia = mysqli_fetch_object($sqlDividasDia)) {
                $cod = $dividadia->id;
                $pontos = ',';
                $result = str_replace($pontos, "", $dividadia->valor);
                $valor_total = (float) $result;
                $total = $valor_total;

                $totalfinaldiacat = $totalfinaldiacat + $total;
            }

            echo "
                                    <li>$nomecat: " . number_format($totalfinaldiacat, 2, ',', '.') . "</li>
                                 ";
        }

        echo "</ul>
                                    <div class='col-12 col-md-12' style='text-align: center;' id='resultadoqtdvalor'>
                                    <a style='' target='_blank' href='Imprimir.php?pagina=6&dia=$dia_hoje&mes=$mes_hoje&ano=$ano_hoje' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                </div>
                            </div>
				<div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
				<select onchange='VerPesquisarDespesa(28, 2, 2, this.value, parampagmesFIN.value, parampaganoFIN.value, 0)' style='margin-left:50px; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampagdiaFIN' id='parampagdiaFIN' class='form-control'>
								";
        for ($i = 1; $i <= 31; $i++) {
            echo "
										<option style='text-align:center;' value='$i'";
            if ($i == $dia_hoje) {
                echo "selected='selected'";
            } echo">Dia $i</option>
										 ";
        }
        echo"
							</select>
									
							</div>	
					   </div>
                    </div>
                    
					<div class='col-12 col-md-4' style=''>
                        <div class='card mb-4 box-shadow' style='width:100%;'>
                            <div class='card-header' style='text-align:center; background-color: #FA8072; width:100%;'>
				<h4><a style='color:#fff;'  href='javascript: func' onclick='VerPesquisarDespesa(29, 1, 1, parampagdiaFIN.value, parampagmesFIN.value, parampaganoFIN.value, 0)'>Despesas Mensal</br> (Ver Tudo)</a></h4>
                            </div>
                            <div class='card-body' style='text-align: center;' id='MudaDespesa3'>
                                                                <h5 class='my-0 font-weight-normal'><b>R$ " . number_format($totalfinalmes, 2, ',', '.') . "</b></h5>
                                <ul class='list-unstyled mt-12 mb-12' style='font-size:8pt; padding:5px;'>";
        $sqlCategorias = "SELECT * FROM lc_cat WHERE cod_usu = :cod ORDER BY id ASC";
        $paramCategorias = array(
            ":cod" => 1
        );

        $dataTableCategorias = $banco->ExecuteQuery($sqlCategorias, $paramCategorias);
        foreach ($dataTableCategorias as $resultadocategorias) {
            $idcat = $resultadocategorias['id'];
            $nomecat = $resultadocategorias['nome'];
            $sqlDividasDia = mysqli_query($conn, "SELECT * FROM financeiro_empresa WHERE mes = $mes_hoje AND ano = $ano_hoje AND cat = $idcat ORDER BY id ASC");
// Exibe todos os valores encontrados
            $totalfinaldiacat = 0;
            while ($dividadia = mysqli_fetch_object($sqlDividasDia)) {
                $cod = $dividadia->id;
                $pontos = ',';
                $result = str_replace($pontos, "", $dividadia->valor);
                $valor_total = (float) $result;
                $total = $valor_total;

                $totalfinaldiacat = $totalfinaldiacat + $total;
            }

            echo "
                                    <li>$nomecat: " . number_format($totalfinaldiacat, 2, ',', '.') . "</li>
                                 ";
        }

        echo "</ul>
                                    <div class='col-12 col-md-12' style='text-align: center;' id='resultadoqtdvalor'>
                                    <a style='' target='_blank' href='Imprimir.php?pagina=7&mes=$mes_hoje&ano=$ano_hoje' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                </div>
                            </div>
				<div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
				<select  onchange='VerPesquisarDespesa(29, 2, 3, parampagdiaFIN.value, this.value, parampaganoFIN.value, 0)' style='margin-left:50px; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampagmesFIN' id='parampagmesFIN' class='form-control'>
								";
        for ($i = 1; $i <= 12; $i++) {
            echo "
										<option style='text-align:center;' value='$i'";
            if ($i == $mes_hoje) {
                echo "selected='selected'";
            } echo">Mes $i</option>
										 ";
        }
        echo"
							</select>
									
							</div>	
					   </div>
                    </div>
                    
				
				<div class='col-12 col-md-4' style=''>
                        <div class='card mb-4 box-shadow' style='width:100%;'>
                            <div class='card-header' style='text-align:center; background-color: #B22222; width:100%;'>
				<h4><a  style='color:#fff;' href='javascript: func' onclick='VerPesquisarDespesa(30, 1, 1, parampagdiaFIN.value, parampagmesFIN.value, parampaganoFIN.value, 0)'  >Despesas Anual</br> (Ver Tudo)</a></h4>
                            </div>
                            <div class='card-body' style='text-align: center;' id='MudaDespesa4'>
                                                                <h5 class='my-0 font-weight-normal'><b>R$ " . number_format($totalfinalano, 2, ',', '.') . "</b></h5>
                                <ul class='list-unstyled mt-12 mb-12' style='font-size:8pt; padding:5px;'>";
        $sqlCategorias = "SELECT * FROM lc_cat WHERE cod_usu = :cod ORDER BY id ASC";
        $paramCategorias = array(
            ":cod" => 1
        );

        $dataTableCategorias = $banco->ExecuteQuery($sqlCategorias, $paramCategorias);
        foreach ($dataTableCategorias as $resultadocategorias) {
            $idcat = $resultadocategorias['id'];
            $nomecat = $resultadocategorias['nome'];
            $sqlDividasDia = mysqli_query($conn, "SELECT * FROM financeiro_empresa WHERE  ano = $ano_hoje AND cat = $idcat ORDER BY id ASC");
// Exibe todos os valores encontrados
            $totalfinaldiacat = 0;
            while ($dividadia = mysqli_fetch_object($sqlDividasDia)) {
                $cod = $dividadia->id;
                $pontos = ',';
                $result = str_replace($pontos, "", $dividadia->valor);
                $valor_total = (float) $result;
                $total = $valor_total;

                $totalfinaldiacat = $totalfinaldiacat + $total;
            }

            echo "
                                    <li>$nomecat: " . number_format($totalfinaldiacat, 2, ',', '.') . "</li>
                                 ";
        }

        echo "</ul>
                                    <div class='col-12 col-md-12' style='text-align: center;' id='resultadoqtdvalor'>
                                    <a style='' target='_blank' href='Imprimir.php?pagina=8&ano=$ano_hoje' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                </div>
                            </div>
							<div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
							<select onchange='VerPesquisarDespesa(30, 2, 4, parampagdiaFIN.value, parampagmesFIN.value, this.value, 0)'  style='margin-left:50px; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampaganoFIN' id='parampaganoFIN'  class='form-control'>
								";
        for ($i = 2018; $i <= 2030; $i++) {
            echo "
										<option style='text-align:center;' value='$i'";
            if ($i == $ano_hoje) {
                echo "selected='selected'";
            } echo">Ano $i</option>
										 ";
        }
        echo"
							</select>
									
							</div>	
					   </div>
                    </div>
                    
				</div>
		
	<div id='MudaDespesa1' style='width:100%;'>
        </div>
				
		";


        break;

//PAGINA PARA FATURAMENTO
    case 34:



        echo "
		<ul class='nav nav-tabs' style='text-align:left; margin-top:10px;'>
				<style>
					a#botaofinclientes:hover{
						color:green;
						border: 1px solid green;
						background-color:#fff;
					}
					a#botaofinempresa:hover{
						color:#336699;
						border: 1px solid #336699;
						background-color:#fff;
					}
				</style>
				
			</ul>
                <div class='row'>
		
            <div class='col-12 col-md-12' id='resultadoqtdvalor'>
                <a style='padding: 10px;' onclick='VerMovCat(38, 0)' href='javascript:void' class='btn btn-success btn-sm btn-block'><span class='glyphicon glyphicon-usd'></span> Movimento Faturamento</a>
            </div>  
           
        </div>
        <div class='row' id='telamovcat'>
                
            
      
		";

        $totalfinalano = 0;
        $totalfinalmes = 0;
        $totalfinaldia = 0;
        $totalfinaldiatipo1 = 0;
        $totalfinaldiatipo2 = 0;
        $totalfinalmestipo1 = 0;
        $totalfinalmestipopag1 = 0;


        $totalfinaldiatipopag1 = 0;
        $totalfinaldiatipopag2 = 0;
        $totalfinaldiatipopag3 = 0;
        $totalfinaldiatipopag4 = 0;

        $totalfinalanotipo1 = 0;
        $totalfinalanotipopag1 = 0;
        $totalfinalanotipo2 = 0;
        $totalfinalanotipopag4 = 0;
        $totalfinalanotipopag3 = 0;
        $totalfinalanotipopag2 = 0;
        $totalfinalanotipopag1 = 0;
        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');
        $totalfinaldiatipopag5 = 0;
        $totalfinalMEStipopag5 = 0;
        $totalfinalANOtipopag5 = 0;


        $sqlNotasDia = mysqli_query($conn, "SELECT * FROM notas WHERE dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje AND status = 3 ORDER BY cod ASC");
// Exibe todos os valores encontrados
        while ($notasdia = mysqli_fetch_object($sqlNotasDia)) {
            $codnota = $notasdia->cod;

            $sqlPagNota = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = $codnota ORDER BY cod ASC LIMIT 1");
// Exibe todos os valores encontrados
            while ($pagnota = mysqli_fetch_object($sqlPagNota)) {
                $parcelas1 = $pagnota->numparcelas;
                $pontos = ',';
                $result = str_replace($pontos, "", $pagnota->total);
                $valor_total = (float) $result;
                $total = $valor_total;

                $totalfinaldia = $totalfinaldia + $total;
                if ($pagnota->tipo == 1) {
                    $totalfinaldiatipo1 = $totalfinaldiatipo1 + $total;
                    if ($pagnota->tipopag == 1) {
                        $totalfinaldiatipopag1 = $totalfinaldiatipopag1 + $total;
                    } else if ($pagnota->tipopag == 2) {
                        $totalfinaldiatipopag2 = $totalfinaldiatipopag2 + $total;
                    } else if ($pagnota->tipopag == 3) {
                        $totalfinaldiatipopag5 = $totalfinaldiatipopag5 + $total;
                    }
                } else if ($pagnota->tipo == 2) {
                    $totalfinaldiatipo2 = $totalfinaldiatipo2 + $total;
                    if ($pagnota->tipopag == 1) {
                        $totalfinaldiatipopag3 = $totalfinaldiatipopag3 + $total;
                    } else if ($pagnota->tipopag == 2) {
                        $totalfinaldiatipopag4 = $totalfinaldiatipopag4 + $total;
                    }
                }
            }
        }


        $sqlNotasMes = mysqli_query($conn, "SELECT * FROM notas WHERE mes = $mes_hoje AND ano = $ano_hoje AND status = 3 ORDER BY cod ASC");
// Exibe todos os valores encontrados
        while ($notasmes = mysqli_fetch_object($sqlNotasMes)) {
            $codnota = $notasmes->cod;
            $sqlPagNota = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = $codnota ORDER BY cod ASC LIMIT 1");
// Exibe todos os valores encontrados
            while ($pagnota = mysqli_fetch_object($sqlPagNota)) {
                $parcelas1 = $pagnota->numparcelas;
                $pontos = ',';
                $result = str_replace($pontos, "", $pagnota->total);
                $valor_total = (float) $result;
                $total = $valor_total;

                $totalfinalmes = $totalfinalmes + $total;
                if ($pagnota->tipo == 1) {
                    $totalfinalmestipo1 = $totalfinalmestipo1 + $total;
                    if ($pagnota->tipopag == 1) {
                        $totalfinalmestipopag1 = $totalfinalmestipopag1 + $total;
                    } else if ($pagnota->tipopag == 2) {
                        $totalfinalmestipopag2 = $totalfinalmestipopag2 + $total;
                    } else if ($pagnota->tipopag == 3) {
                        $totalfinalmestipopag5 = $totalfinalmestipopag5 + $total;
                    }
                } else if ($pagnota->tipo == 2) {
                    $totalfinalmestipo2 = $totalfinalmestipo2 + $total;
                    if ($pagnota->tipopag == 1) {
                        $totalfinalmestipopag3 = $totalfinalmestipopag3 + $total;
                    } else if ($pagnota->tipopag == 2) {
                        $totalfinalmestipopag4 = $totalfinalmestipopag4 + $total;
                    }
                }
            }
        }

        $sqlNotasAno = mysqli_query($conn, "SELECT * FROM notas WHERE ano = $ano_hoje AND status = 3 ORDER BY cod ASC");
// Exibe todos os valores encontrados
        while ($notasano = mysqli_fetch_object($sqlNotasAno)) {
            $codnota = $notasano->cod;
            $sqlPagNota = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = $codnota ORDER BY cod ASC LIMIT 1");
// Exibe todos os valores encontrados
            while ($pagnota = mysqli_fetch_object($sqlPagNota)) {
                $parcelas1 = $pagnota->numparcelas;
                $pontos = ',';
                $result = str_replace($pontos, "", $pagnota->total);
                $valor_total = (float) $result;
                $total = $valor_total;

                $totalfinalano = $totalfinalano + $total;
                if ($pagnota->tipo == 1) {
                    $totalfinalanotipo1 = $totalfinalanotipo1 + $total;
                    if ($pagnota->tipopag == 1) {
                        $totalfinalanotipopag1 = $totalfinalanotipopag1 + $total;
                    } else if ($pagnota->tipopag == 2) {
                        $totalfinalanotipopag2 = $totalfinalanotipopag2 + $total;
                    } else if ($pagnota->tipopag == 3) {
                        $totalfinalanotipopag5 = $totalfinalanotipopag5 + $total;
                    }
                } else if ($pagnota->tipo == 2) {
                    $totalfinalanotipo2 = $totalfinalanotipo2 + $total;
                    if ($pagnota->tipopag == 1) {
                        $totalfinalanotipopag3 = $totalfinalanotipopag3 + $total;
                    } else if ($pagnota->tipopag == 2) {
                        $totalfinalanotipopag4 = $totalfinalanotipopag4 + $total;
                    }
                }
            }
        }


        echo "
				
                    <div class='col-12 col-md-4' style=''>
                        <div class='card mb-4 box-shadow' style='width:100%;'>
                            <div class='card-header' style='text-align:center; background-color: #90EE90; width:100%;'>
									<h4><a style='color:#fff;'  href='javascript: func' onclick='VerPesquisarDia(25, 2, 2, parampagdiaFIN.value, parampagmesFIN.value ,parampaganoFIN.value, 0)'>Faturamento Diário</br> (Ver Tudo)</a></h4>
                            </div>
                            <div class='card-body' style='text-align: center;' id='MudaDia1'> 
                                <h5 class='my-0 font-weight-normal'><b>R$ " . number_format($totalfinaldia, 2, ',', '.') . "</b></h5>
                                <ul class='list-unstyled mt-12 mb-12'>
                                    <li>Á Vista: R$ " . number_format($totalfinaldiatipo1, 2, ',', '.') . "</li>
                                    <li>Parcelado: R$ " . number_format($totalfinaldiatipo2, 2, ',', '.') . "</li>
                                    <li>-----------------------------------</li>
                                    <li>Dinheiro: R$ " . number_format($totalfinaldiatipopag1, 2, ',', '.') . "</li>
                                    <li>Débito: R$ " . number_format($totalfinaldiatipopag2, 2, ',', '.') . "</li>
                                    <li>Pix: R$ " . number_format($totalfinaldiatipopag5, 2, ',', '.') . "</li>
                                    <li>Crédito: R$ " . number_format($totalfinaldiatipopag3, 2, ',', '.') . "</li>
				    <li>Crediário: R$ " . number_format($totalfinaldiatipopag4, 2, ',', '.') . "</li>

                                </ul>
                                 <div class='col-12 col-md-12' style='text-align: center; ' id='resultadoqtdvalor'>
                                    <a style='' target='_blank' href='Imprimir.php?pagina=3&dia=$dia_hoje&mes=$mes_hoje&ano=$ano_hoje' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                </div>
                            </div>
							<div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
							<select onchange='VerPesquisarDia(25, 1, 1, this.value, parampagmesFIN.value ,parampaganoFIN.value, 0)' style='margin-left:50px; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampagdiaFIN' id='parampagdiaFIN' class='form-control'>
								";
        for ($i = 1; $i <= 31; $i++) {
            echo "
										<option style='text-align:center;' value='$i'";
            if ($i == $dia_hoje) {
                echo "selected='selected'";
            } echo">Dia $i</option>
										 ";
        }
        echo"
							</select>
									
							</div>	
					   </div>
                    </div>
                    
					<div class='col-12 col-md-4' style=''>
                        <div class='card mb-4 box-shadow' style='width:100%;'>
                            <div class='card-header' style='text-align:center; background-color: #00bbff; width:100%;'>
				<h4><a style='color:#fff;'  href='javascript: func' onclick='VerPesquisarDia(26, 2, 2, parampagdiaFIN.value, parampagmesFIN.value ,parampaganoFIN.value, 0)'>Faturamento Mensal</br> (Ver Tudo)</a></h4>
                            </div>
                            <div class='card-body' style='text-align: center;' id='MudaDia3'>
                                <h5 class='my-0 font-weight-normal'><b>R$ " . number_format($totalfinalmes, 2, ',', '.') . "</b></h5>
                                <ul class='list-unstyled mt-12 mb-12'>
                                    <li>Á Vista: R$ " . number_format($totalfinalmestipo1, 2, ',', '.') . "</li>
                                    <li>Parcelado: R$ " . number_format($totalfinalmestipo2, 2, ',', '.') . "</li>
                                    <li>-----------------------------------</li>
                                    <li>Dinheiro: R$ " . number_format($totalfinalmestipopag1, 2, ',', '.') . "</li>
                                    <li>Débito: R$ " . number_format($totalfinalmestipopag2, 2, ',', '.') . "</li>
                                    <li>Pix: R$ " . number_format($totalfinalmestipopag5, 2, ',', '.') . "</li>
                                    <li>Crédito: R$ " . number_format($totalfinalmestipopag3, 2, ',', '.') . "</li>
									<li>Crediário: R$ " . number_format($totalfinalmestipopag4, 2, ',', '.') . "</li>

                                </ul>
                                 <div class='col-12 col-md-12' style='text-align: center; ' id='resultadoqtdvalor'>
                           <a style='' target='_blank' href='Imprimir.php?pagina=4&mes=$mes_hoje&ano=$ano_hoje' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                 </div>
                            </div>
							<div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
                            <select onchange='VerPesquisarDia(26, 1, 3, parampagdiaFIN.value, this.value ,parampaganoFIN.value, 0)' style='margin-left:50px; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampagmesFIN' id='parampagmesFIN' class='form-control'>
								";
        for ($i = 1; $i <= 12; $i++) {
            echo "
										<option style='text-align:center;' value='$i'";
            if ($i == $mes_hoje) {
                echo "selected='selected'";
            } echo">Mes $i</option>
										 ";
        }
        echo"
							</select>
									
							</div>	
					   </div>
                    </div>
                    
				
				<div class='col-12 col-md-4' style=''>
                        <div class='card mb-4 box-shadow' style='width:100%;'>
                            <div class='card-header' style='text-align:center; background-color: #9acfea; width:100%;'>
				<h4><a style='color:#fff;'  href='javascript: func' onclick='VerPesquisarDia(27, 2, 2, parampagdiaFIN.value, parampagmesFIN.value ,parampaganoFIN.value, 0)'>Faturamento Anual</br> (Ver Tudo)</a></h4>
                            </div>
                            <div class='card-body' style='text-align: center;' id='MudaDia4'>
                                <h5 class='my-0 font-weight-normal'><b>R$ " . number_format($totalfinalano, 2, ',', '.') . "</b></h5>
                                <ul class='list-unstyled mt-12 mb-12'>
                                    <li>Á Vista: R$ " . number_format($totalfinalanotipo1, 2, ',', '.') . "</li>
                                    <li>Parcelado: R$ " . number_format($totalfinalanotipo2, 2, ',', '.') . "</li>
                                    <li>-----------------------------------</li>
                                    <li>Dinheiro: R$ " . number_format($totalfinalanotipopag1, 2, ',', '.') . "</li>
                                    <li>Débito: R$ " . number_format($totalfinalanotipopag2, 2, ',', '.') . "</li>
                                    <li>Pix: R$ " . number_format($totalfinalanotipopag5, 2, ',', '.') . "</li>
                                    <li>Crédito: R$ " . number_format($totalfinalanotipopag3, 2, ',', '.') . "</li>
									<li>Crediário: R$ " . number_format($totalfinalanotipopag4, 2, ',', '.') . "</li>

                                </ul>
                                 <div class='col-12 col-md-12' style='text-align: center; ' id='resultadoqtdvalor'>
                                    <a style='' target='_blank' href='Imprimir.php?pagina=5&&mes=$mes_hoje&ano=$ano_hoje' class='btn btn-info btn-sm btn-block '><span class='glyphicon glyphicon-print'></span> Imprimir Relatório</a>
                                </div>
                            </div>
							<div class='card-footer' style='text-align:center; background-color: #ccc; width:100%;'>
                            <select onchange='VerPesquisarDia(27, 1, 4, parampagdiaFIN.value, parampagmesFIN.value ,this.value, 0)' style='margin-left:50px; text-align:center; height:70px; border:none; font-size: 12pt; width: 50%; background-color:#fff;' name='parampaganoFIN' id='parampaganoFIN' class='form-control'>
								";
        for ($i = 2018; $i <= 2030; $i++) {
            echo "
										<option style='text-align:center;' value='$i'";
            if ($i == $ano_hoje) {
                echo "selected='selected'";
            } echo">Ano $i</option>
										 ";
        }
        echo"
							</select>
									
							</div>	
					   </div>
                    </div>
                    
	
           </div>
	<div id='MudaDia2' style='width:100%;'>
            
        </div>	
		</div>
				
		";


        break;

    CASE 35:
        $mes_hoje = date('m');
        $ano_hoje = date('Y');
        echo "
            <div class='card' style='width:100%;'>
                <div class='card-body' style='width:100%;'>
                    <div class='row' style='width:100%;'>
                        <div class='col-12 col-md-8' style='text-align: left;'>
                            <div class='form-group label-floating'>
                                <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtMesAno' class='control-label'>Selecione mês e o ano</label>
                                <input onkeyup='Validacao(36, this.value, 0, 101)' style='padding:30px; font-size: 15pt; width: 100%; ' type='month' class='form-control' id='txtDataAnoMes' name='txtDataAnoMes' value='' >
                            </div>
                        </div>
                        
                        <div class='col-12 col-md-4' style='text-align: left;'>
                            <div id='ResultadoValidacao101' style='width:100%;'>
                                <div class='form-group label-floating'>
                                    <a target='_BLANK' href='Imprimir.php?pagina=14&mes=$mes_hoje&ano=$ano_hoje' style='padding:27px; font-size: 15pt; width: 100%;'  class='btn btn-primary btn-lg btn-block active'><span class='glyphicon glyphicon-plus'></span>Gerar</br> Relatório</a>
                                </div>
                            </div>  
                    </div>
                    
                    </div>
                </div>
            </div>
            ";

        BREAK;

    case 36:
        $mesano = $_GET['param'];


        if ($mesano == null) {
            $mes_hoje = date('m');
            $ano_hoje = date('Y');
        } else {
            $t = explode("-", $mesano);
            $ano_hoje = $t[0];
            $mes_hoje = $t[1];
        }
        echo "
                            <div class='form-group label-floating'>
                                <a target='_BLANK' href='Imprimir.php?pagina=14&mes=$mes_hoje&ano=$ano_hoje' style='padding:27px; font-size: 15pt; width: 100%;'  class='btn btn-primary btn-lg btn-block active'><span class='glyphicon glyphicon-plus'></span>Gerar</br> Relatório</a>
                            </div>
                        
            ";
        break;

    case 37:
        $valor = $_GET['param'];
        $param = 1;
        $ata = 1;
        $param2 = 0;
        if ($valor == null) {
            $sqlEntradas = "SELECT * FROM entradas ORDER BY cod DESC LIMIT 20";

            $dataTableEntradas = $banco->ExecuteQuery($sqlEntradas);
        } else {
            $sqlEntradas = "SELECT * FROM entradas WHERE n_notafiscal LIKE :nota ORDER BY cod DESC";
            $paramEntradas = array(
                ":nota" => "%{$valor}%"
            );
            $dataTableEntradas = $banco->ExecuteQuery($sqlEntradas, $paramEntradas);
        }
// var_dump($dataTableEntradas)  ;
        echo "
            <table class='table' style='font-size:14pt;'>
            <tr style='text-align:center;'>
                <td><b>Cod. Entrada</b></td>
                <td><b>Nº Nota Fiscal</b></td>
                <td><b>Qtd Total</b></td>
                <td><b>Valor Total</b></td>
                <td><b>Data</b></td>
                <td><b>Status</b></td>
                <td></td>
            </tr>
                ";
// Exibe todos os valores encontrados
        foreach ($dataTableEntradas as $resultadoent) {
            $entradascod = $resultadoent['cod'];
            $entradas_atapregao = $resultadoent['ata_pregao'];
            $entradasfornecedor = $resultadoent['fornecedor'];
            $entradasn_notafiscal = $resultadoent['n_notafiscal'];
            $entradascod_funcionario = $resultadoent['cod_funcionario'];
            $entradasdia = $resultadoent['dia'];
            $entradasmes = $resultadoent['mes'];
            $entradasano = $resultadoent['ano'];
            $entradascod_orgao = $resultadoent['cod_orgao'];
            $entradasimg = $resultadoent['img'];
            $entradasstatus = $resultadoent['status'];
            $textostatus = "";
            if ($entradasstatus == 1) {
                $textostatus = "Aberto";
            } else {
                $textostatus = "Finalizado";
            }
//$sqlPregao = mysqli_query($conn, "SELECT * FROM pregao WHERE cod = $entradas_atapregao ORDER BY cod ASC LIMIT 1");
// Exibe todos os valores encontrados
            $sqlEntradasLista = mysqli_query($conn, "SELECT * FROM lista_entradas WHERE cod_entrada = $entradascod ORDER BY cod ASC");
            $qtdfinal = 0;
            $valorfinal = 0;
            while ($entradaslista = mysqli_fetch_object($sqlEntradasLista)) {
                $listaentradascod = $entradaslista->cod;
                $listaentradascod_entrada = $entradaslista->cod_entrada;
                $listaentradascod_produto = $entradaslista->cod_produto;
                $listaentradaslote = $entradaslista->lote;
                $listaentradasmes_validade = $entradaslista->mes_validade;
                $listaentradasano_validade = $entradaslista->ano_validade;
                $listaentradasqtd = $entradaslista->qtd;
                $qtdfinal = $qtdfinal + $listaentradasqtd;
                $listaentradasvalor_total = $entradaslista->valor_total;
                $valorfinal = $valorfinal + $listaentradasvalor_total;
                $listaentradasvalor_total = number_format($listaentradasvalor_total, 2, ',', '.');

                $listaentradasdia = $entradaslista->dia;
                $listaentradasmes = $entradaslista->mes;
                $listaentradasano = $entradaslista->ano;
            }
            echo "
                    <tr style='text-align:center;'>
                        <td>$entradascod</td>
                        <td style='width:10%;'>$entradasn_notafiscal</td>
                        <td>$qtdfinal</td>
                        <td>R$ " . number_format($valorfinal, 2, ',', '.') . " </td>
                        <td>$entradasdia/$entradasmes/$entradasano</td>
                        <td style='width:10%;'>$textostatus</td>
                        <td><a style='width:100%; font-size:16pt;' class='btn btn-primary' href='?pagina=entradas&cod=$entradascod' onclick=''><span class='glyphicon glyphicon-play'></span> Ver Tudo</a></td>
                    </tr>
                    ";
        }
        echo "</table>";

        break;
    case 38:
        $codnota = $_GET['valor'];
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
            <ul class='nav flex-column mb-2' >
                    <li class='nav-item' style=''>
                        <a  class='nav-link' href='' style=' width: 100%; text-align: right;'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='200' height='200' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                            Qtd  de Itens:</br><b style='color:red;'>$qtdpedidos</b>
                         
                        </a>
                    </li>
                    <li class='nav-item' style=''>
                        <a  class='nav-link' href='' style=' width: 100%; text-align: right;'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-file-text'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'></path><polyline points='14 2 14 8 20 8'></polyline><line x1='16' y1='13' x2='8' y2='13'></line><line x1='16' y1='17' x2='8' y2='17'></line><polyline points='10 9 9 9 8 9'></polyline></svg>
                            Valor Total:R$</br><b style='color:green;'>$totalfinal2</b>
                         
                        </a>
                    </li>
                    
                  
                    
                </ul>
           ";


        break;

    case 39:
        $ultimodigio = 0;
        $param = $_GET['param'];


        $sqlCat = "SELECT * FROM servicos WHERE codbusca !=0 ORDER BY codbusca DESC LIMIT 1";


        $dataTableCat = $banco->ExecuteQuery($sqlCat);

        if ($dataTableCat != null) {
            foreach ($dataTableCat as $resultadoservicos) {

                $ultimodigio = (float) $resultadoservicos['codbusca'];
                $ultimodigio = $ultimodigio + 1;
            }
        } else {
            $ultimodigio = 1000;
        }
        $sqlPag = mysqli_query($conn, "SELECT * FROM  WHERE codbusca != 0 ORDER BY codbusca DESC LIMIT 1");

        $query = mysqli_query($conn, "UPDATE servicos SET codbusca = $ultimodigio WHERE cod = $param");
        if ($query) {
            echo "    <label style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' style='padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtNomeProduto' class='control-label'>Cod. Busca</label>
                            <input tabindex='$contadorindex' style='padding:30px; font-size: 15pt; width: 100%; ' type='text' disabled class='form-control' id='txtCod_BuscaEd2' name='txtCod_BuscaEd2' value='$ultimodigio' autofocus>
                            <input type='hidden' class='form-control' id='txtCod_BuscaEd' name='txtCod_BuscaEd' value='$ultimodigio' />
                       ";
        }
        break;
//GERAR PEDIDOS  
    case 40:
        $cat = $_GET['param'];

        echo "                   <div class='row' style='margin-bottom:5px;'>
                                                <input name='txtAtaSD' id='txtAtaSD' type='hidden' value='txtAtaSD'/>
								<div class='col-12 col-md-12' id=''>
                                                                <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%; ' for='txtCategoriaSD'><span></span> Categorias:</label>
                                                                    <select onchange='Validacao(42, this.value, 0, 1100)' href='javascript: func' style='height: 82px; font-size: 15pt; width: 100%; ' class='form-control' id='txtBairrosFiltros' name='txtBairrosFiltros' onchange=''>
                                                                    <option value='0'>Todas Categorias</option>
                                                                    ";
        $cod_orgao = $_SESSION['cod_orgaoF'];
// $sqlFor2 = mysqli_query($conn, "SELECT * FROM categoria_produto WHERE cod_orgao = $cod_orgao ORDER BY cod ASC");
        $sqlFor = "SELECT * FROM categoriaserfin ORDER BY cod ASC";


        $dataTableFor = $banco->ExecuteQuery($sqlFor);
        foreach ($dataTableFor as $resultadofor) {
            $nomefornecedor = $resultadofor['nome'];
            echo "  <option value='" . $resultadofor['cod'] . "'>" . $nomefornecedor . ".</option>";
        }
        echo"             
                                                                    </select>
                                                                </div>
							
                                                                
                                                                		
                                                      
                                    <div class='col-12 col-md-12' id='ResultadoValidacao1100'>
                                                           
                                                        </div>                 
							
							
							
                                       ";


        break;


    case 41:
        $dia = $_GET['dia'];
        $mes = $_GET['mes'];
        $ano = $_GET['ano'];

        $param = $_GET['valor'];
        $param22 = $_GET['valor'];

          echo "</br><table class='table' style='font-size:16pt;'>
            <tr style='text-align:center;'>
                <td><b>COD. NOTA</b></td>
                <td><b>INFORMAÇÕES DO PEDIDO</b></td>
                <td><b>INFORMAÇÕES DO PAGAMENTO</b></td>
                <td><b>CLIENTE</b></td>
                <td><b>FUNCIONÁRIO</b></td>
                <td></td>
            </tr>
            ";

        if ($param == 0) {


//$sql = mysqli_query($conn, "SELECT * FROM notas WHERE status = 3 AND dia = $dia AND mes = $mes AND ano = $ano ORDER BY cod ASC");
            $sqlNota = "SELECT * FROM notas WHERE status = :status AND dia = :dia AND mes = :mes AND ano = :ano  ORDER BY cod DESC";
            $paramNota = array(
                ":status" => 3,
                ":dia" => $dia,
                ":mes" => $mes,
                ":ano" => $ano,
            );
        } else {

//$sql = mysqli_query($conn, "SELECT * FROM notas WHERE status = 3 AND dia = $dia AND mes = $mes AND ano = $ano ORDER BY cod ASC");
            $sqlNota = "SELECT * FROM notas WHERE status = :status AND dia = :dia AND mes = :mes AND ano = :ano AND func = :usu ORDER BY cod DESC";
            $paramNota = array(
                ":status" => 3,
                ":dia" => $dia,
                ":mes" => $mes,
                ":ano" => $ano,
                ":usu" => $param22,
            );
        }
        $dataTableNota = $banco->ExecuteQuery($sqlNota, $paramNota);
        foreach ($dataTableNota as $resultadonota) {
            $qtdTotalFinal = 0;
            $valorTotalFinal = 0;
            $nomecli = "";
            $textotipopag = "";
            $codnota = $resultadonota['cod'];
            $codnota2 = $resultadonota['cod'];
            $cod_usuarionota = $resultadonota['usuario'];
            $datadia_nota = $resultadonota['dia'];
            $datames_nota = $resultadonota['mes'];
            $dataano_nota = $resultadonota['ano'];
            $codfuncionario_nota = $resultadonota['func'];

            if ($cod_usuarionota == 0) {
                $nomecli = $resultadonota['nomeCli'];
            } else {
                $sqlCli = "SELECT * FROM clientes WHERE id = :id ORDER BY id ASC LIMIT 1";
                $paramCli = array(
                    ":id" => $cod_usuarionota
                );

                $dataTableCli = $banco->ExecuteQuery($sqlCli, $paramCli);
                foreach ($dataTableCli as $resultadocli) {
                    $nomecli = $resultadocli['nome'];
                    $enderecocli = $resultadocli['endereco'];
                    $numerocli = $resultadocli['numero'];
                    $complementocli = $resultadocli['complemento'];
                    $celularcli = $resultadocli['celular'];
                }
            }
//$sqlFunc = mysqli_query($conn, "SELECT * FROM usuarios WHERE cod = $codfuncionario_nota ORDER BY cod ASC LIMIT 1");
            $sqlFunc = "SELECT * FROM usuarios WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
            $paramFunc = array(
                ":cod" => $codfuncionario_nota
            );

            $dataTableFunc = $banco->ExecuteQuery($sqlFunc, $paramFunc);
            foreach ($dataTableFunc as $resultadofunc) {
                $nomefunc = $resultadofunc['nome'];
            }
            
            $textopedidos = "";
            $sqlPedidos = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = $codnota ORDER BY cod ASC");
            while ($pedidos = mysqli_fetch_object($sqlPedidos)) {
                $qtdTotalFinal = $qtdTotalFinal + (int) $pedidos->qtd;
                $valorTotalFinal = $valorTotalFinal + (float) $pedidos->valor;
                $cod_servi2 = $pedidos->servico;
              
                $sqlCli = "SELECT * FROM servicos WHERE cod = :id ORDER BY cod ASC";
                $paramCli = array(
                    ":id" => $cod_servi2
                );

                $dataTableCli = $banco->ExecuteQuery($sqlCli, $paramCli);
                foreach ($dataTableCli as $resultadocli) {
                    $codproduto = $resultadocli['nome'];

                    $textopedidos = $textopedidos . $codproduto . " | ";
                }
            }

            $sqlPedidos = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = $codnota ORDER BY cod ASC");
            while ($pedidos = mysqli_fetch_object($sqlPedidos)) {
                $qtdTotalFinal = $qtdTotalFinal + (int) $pedidos->qtd;
                $valorTotalFinal = $valorTotalFinal + (float) $pedidos->valor;
            }

            $sqlPagCli = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = $codnota ORDER BY cod ASC LIMIT 1");
            while ($pag = mysqli_fetch_object($sqlPagCli)) {
                $valorTotalFinal = (float) $pag->total;

                if ($pag->tipo == 1 && $pag->tipopag == 1) {
                    $textotipopag = "Pagamento em Dinheiro";
                }
                if ($pag->tipo == 1 && $pag->tipopag == 2) {
                    $textotipopag = "Pagamento em Cartão Débito";
                }
                if ($pag->tipo == 1 && $pag->tipopag == 3) {
                    $textotipopag = "Pagamento em Pix";
                }
                if ($pag->tipo == 2 && $pag->tipopag == 1) {

                    $textotipopag = "Pagamento no Cartão de Crédito";
                }

                if ($pag->tipo == 2 && $pag->tipopag == 2) {

                    $textotipopag = "Pagamento no Crediário";
                }
            }

            echo "
            <tr style='text-align:justify;'>
            <td>$codnota2</td>
            <td style='font-size:9pt;'>$textopedidos</td>
            <td>
            $textotipopag </BR>
            VALOR TOTAL:</br><b> R$ " . number_format($valorTotalFinal, 2, ',', '.') . "</br></td>
         
            <td>$nomecli</td>
            <td>$nomefunc</td>
                <td><a style='font-size:12pt; paddind:15px;' href='javascript: func' onclick='PagVerTudo(10, $codnota, 1)' class='btn btn-primary btn-sm btn-block' style='color:#fff;'><span class='glyphicon glyphicon-play'></span>   Ver Tudo </a></td>
            </tr>";
        }
        echo "</table>";
        break;
//funcao para gerar pedido automatico por categoria de produto    
    case 42:

        $param1 = $_GET['param'];
        echo "    <a target='_BLANK' href='Imprimir.php?pagina=16&codcat=$param1' style='margin:10px; font-size: 15pt; width: 98%;'  class='btn btn-primary btn-lg btn-block active'><span class='glyphicon glyphicon-plus'></span>Imprimir </a>
                                                        ";
        echo "<table class='table table-bordered' style='font-size:14pt;'>
                <tr style='text-align:center;'>
                    <td><b>Produto</b></td>";

        echo "<td style='width:20%;'><b>Qtd Solicitada</b></td>
               
                 
                    <td><b>Qtd</b></td>
                    <td><b>Est. máx</b></td>
                    <td><b>Est. min.</b></td>
                </tr>

        ";

        if ($param1 == 0) {
//   $sqlProdutos = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao LIKE '%" . $descricao . "%' ORDER BY cod ASC");
            $sqlProdutos = "SELECT * FROM servicos WHERE tipo = 1 ORDER BY nome ASC";
            $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos, $paramProdutos);
        } else {
            $sqlProdutos = "SELECT * FROM servicos WHERE categoria = $param1 AND tipo = 1 ORDER BY nome ASC";
            $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos, $paramProdutos);
        }

        $textoapresentacao = "";

        foreach ($dataTableProdutos as $resultadoprodutos) {
            $codproduto = $resultadoprodutos['cod'];
            $apresentacao = $resultadoprodutos['apresentacao'];
            $descricao = $resultadoprodutos['nome'];
            $qtd = $resultadoprodutos['qtd'];
            $valor = $resultadoprodutos['valor'];
            $categoria = $resultadoprodutos['categoria'];
            $fornecedor = $resultadoprodutos['fornecedor'];
            $est_min = $resultadoprodutos['est_mim'];
            $est_max = $resultadoprodutos['est_max'];

            $valor = number_format($valor, 2, ',', '.');

            if ($apresentacao == 1) {
                $textoapresentacao = "Unidade";
            } else if ($apresentacao == 2) {
                $textoapresentacao = "Comprimido";
            } else if ($apresentacao == 3) {
                $textoapresentacao = "Ampola";
            } else if ($apresentacao == 4) {
                $textoapresentacao = "Frasco Ampola";
            } else if ($apresentacao == 5) {
                $textoapresentacao = "Frasco";
            } else if ($apresentacao == 6) {
                $textoapresentacao = "Caixa";
            } else if ($apresentacao == 7) {
                $textoapresentacao = "Pacote";
            } else if ($apresentacao == 8) {
                $textoapresentacao = "Kit";
            } else if ($apresentacao == 9) {
                $textoapresentacao = "Outros";
            }

            echo "<tr style='text-align:center;' id='ResultadoValidacao11$codproduto'>
                    <td style='width:20%;'>" . $descricao . '-' . $textoapresentacao . "</td>";
            $mediasemanal = 0;
            $contadormedia = 0;
            $totalfinal = 0;
            $resultadomedia = 0;

            if ($contadormedia != 0) {
                $resultadomedia = $mediasemanal / $contadormedia;
            }
            $qtdsolic = 0;

            $qtdsolic = $est_max - $qtd;

            if ($qtdsolic < 0) {
                $qtdsolic = "NÃO SOLICITADO";
            } else {
                $qtdsolic = "<input onchange='Validacao3param(43, this.value, $param1, $codproduto, 11$codproduto)' name='qtdsolic$codproduto' style='padding:20px; font-size: 10pt; width: 100%; text-align:center;' type='text' class='form-control' id='qtdsolic$codproduto' placeholder='' value='$qtdsolic'>
			";
            }


            echo "<td>  $qtdsolic	</td>
                  
                    <td>$qtd</td>
                        
                        <td>$est_max</td>
                            <td>$est_min</td>
                              
                </tr>
                    ";
        }
        echo "</table>";
        break;
    case 43:

        $qtdnova = $_GET['param1'];
        $categoriatal = $_GET['param2'];
        $codproduto = $_GET['param3'];

        $sqlProdutos = "SELECT * FROM servicos WHERE cod = $codproduto ORDER BY nome ASC";
        $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos);


        $textoapresentacao = "";

        foreach ($dataTableProdutos as $resultadoprodutos) {
            $qtdatual = $resultadoprodutos['qtd'];
        }
        if($qtdatual==null){
            $qtdatual = 0;
        }


        $novo_est = 0;
        $novo_est = $qtdnova + $qtdatual;

        $query = mysqli_query($conn, "UPDATE servicos SET est_max = $novo_est WHERE cod = $codproduto");
        if ($query) {



            $sqlProdutos = "SELECT * FROM servicos WHERE cod = $codproduto ORDER BY nome ASC";
            $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos);


            $textoapresentacao = "";

            foreach ($dataTableProdutos as $resultadoprodutos) {
                $codproduto = $resultadoprodutos['cod'];
                $apresentacao = $resultadoprodutos['apresentacao'];
                $descricao = $resultadoprodutos['nome'];
                $qtd = $resultadoprodutos['qtd'];
                $valor = $resultadoprodutos['valor'];
                $categoria = $resultadoprodutos['categoria'];
                $fornecedor = $resultadoprodutos['fornecedor'];
                $est_min = $resultadoprodutos['est_mim'];
                $est_max = $resultadoprodutos['est_max'];

                $valor = number_format($valor, 2, ',', '.');

                if ($apresentacao == 1) {
                    $textoapresentacao = "Unidade";
                } else if ($apresentacao == 2) {
                    $textoapresentacao = "Comprimido";
                } else if ($apresentacao == 3) {
                    $textoapresentacao = "Ampola";
                } else if ($apresentacao == 4) {
                    $textoapresentacao = "Frasco Ampola";
                } else if ($apresentacao == 5) {
                    $textoapresentacao = "Frasco";
                } else if ($apresentacao == 6) {
                    $textoapresentacao = "Caixa";
                } else if ($apresentacao == 7) {
                    $textoapresentacao = "Pacote";
                } else if ($apresentacao == 8) {
                    $textoapresentacao = "Kit";
                } else if ($apresentacao == 9) {
                    $textoapresentacao = "Outros";
                }

                echo "  <td style='width:20%;'>" . $descricao . '-' . $textoapresentacao . "</td>";
                $mediasemanal = 0;
                $contadormedia = 0;
                $totalfinal = 0;
                $resultadomedia = 0;

                if ($contadormedia != 0) {
                    $resultadomedia = $mediasemanal / $contadormedia;
                }
                $qtdsolic = 0;

                $qtdsolic = $est_max - $qtd;

                if ($qtdsolic < 0) {
                    $qtdsolic = "NÃO SOLICITADO";
                } else {
                    $qtdsolic = "<input onchange='Validacao3param(43, this.value, $categoriatal, $codproduto, 11$codproduto)' name='qtdsolic$codproduto' style='padding:20px; font-size: 10pt; width: 100%; text-align:center;' type='text' class='form-control' id='qtdsolic$codproduto' placeholder='' value='$qtdsolic'>
			";
                }


                echo "<td>  $qtdsolic	</td>
                  
                    <td>$qtd </td>
                        
                        <td>$est_max</td>
                            <td>$est_min</td>
               
                    ";
            }
        }

        break;
        
        
     //funcao para categorias de estoque critico
    case 44:
         $param1=$_GET['param'];
        echo "
            <h3 style='margin-left: 10px; padding:5px; color:337AB7; border-bottom: 2px solid #337AB7; width: 100%; '>Produtos em Estado Crítico
              - <a style='font-size:14pt;' target='_blank' href='Imprimir.php?pagina=11&codcat=$param1' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-print' ></span> Imprimir</a>
          
            </h3>
            <table class='table' style='font-size:14pt;'>
            <tr style='text-align:center;'>
                <td><b>Cod</b></td>
                <td><b>Apresentação</b></td>
                <td><b>Produto</b></td>
                <td><b>Categoria</b></td>
                <td><b>Est. Máx</b></td>
                <td><b>Qtd</b></td>
                <td><b>Est. min.</b></td>
                
            </tr>
            ";
//$sql = mysqli_query($conn, "SELECT * FROM produtos ORDER BY cod ASC");
        
        
        if ($param1 == 0) {
//   $sqlProdutos = mysqli_query($conn, "SELECT * FROM produtos WHERE descricao LIKE '%" . $descricao . "%' ORDER BY cod ASC");
            $sqlProdutos = "SELECT * FROM servicos WHERE tipo = 1 ORDER BY nome ASC";
            $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos, $paramProdutos);
        } else {
            $sqlProdutos = "SELECT * FROM servicos WHERE categoria = $param1 AND tipo = 1 ORDER BY nome ASC";
            $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos, $paramProdutos);
        }

       

        $dataTableProdutos = $banco->ExecuteQuery($sqlProdutos);
        foreach ($dataTableProdutos as $resultadoprodutos) {

            $codproduto = $resultadoprodutos['cod'];
            $nomeproduto = $resultadoprodutos['nome'];
            $apresentacao = $resultadoprodutos['apresentacao'];
            $qtd = $resultadoprodutos['qtd'];
            if($qtd==null){
                $qtd = 0;
            }
            $categoria = $resultadoprodutos['categoria'];
            $est_min = $resultadoprodutos['est_mim'];
            $est_max = $resultadoprodutos['est_max'];

            $sqlCat = "SELECT * FROM categoriaserfin WHERE cod = :categoria ORDER BY cod ASC LIMIT 1";
            $paramCat = array(
                ":categoria" => $categoria
            );

            $dataTableCat = $banco->ExecuteQuery($sqlCat, $paramCat);
            foreach ($dataTableCat as $resultadocat) {
                $nomecategoria = $resultadocat['nome'];
            }

            if ($apresentacao == 1) {
                $textoapresentacao = "Unidade";
            } else if ($apresentacao == 2) {
                $textoapresentacao = "Comprimido";
            } else if ($apresentacao == 3) {
                $textoapresentacao = "Ampola";
            } else if ($apresentacao == 4) {
                $textoapresentacao = "Frasco Ampola";
            } else if ($apresentacao == 5) {
                $textoapresentacao = "Frasco";
            } else if ($apresentacao == 6) {
                $textoapresentacao = "Caixa";
            } else if ($apresentacao == 7) {
                $textoapresentacao = "Pacote";
            } else if ($apresentacao == 8) {
                $textoapresentacao = "Kit";
            } else if ($apresentacao == 9) {
                $textoapresentacao = "Outros";
            }


            if ($qtd < $est_min) {
                echo " <tr style='text-align:center;'>
                <td>$codproduto</td>
                <td>$textoapresentacao</td>
                <td>$nomeproduto</td>
                <td>$nomecategoria</td>
                <td>$est_max</td>
                    <td>$qtd</td>
                <td>$est_min</td>
                
            </tr>
            ";
            }
        }
        echo "</table>
        
        ";
        break;
   //VALIDACAO PARA ATUALIZAR ITEM AVULSO  
    case 45:
        $qtd = (float) $_GET['param'];
        $valor = $_GET['valor'];
        $pontos = '.';
        $result = str_replace($pontos, "", $valor);
        $result = str_replace(",", ".", $result);
        $result = (float) $result;
        $valor = number_format($result, 2, '.', '');
        $codnota = $_GET['codnota'];

        $id = $_GET['id'];
        $resultado = "";
        $valor_total = 0;
        if ($qtd != null) {
            $valor_total = $qtd * $valor;
            $valor_total2 = $qtd * $valor;
            $valor_total = number_format($valor_total, 2, ',', '.');


            echo "
                                        <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
                                        <div class='input-group'>
						<input style='padding:30px; font-size: 15pt; width: 100%;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valor_total'>
					</div>";
                                        if($valor_total2<=0){
                                         echo "</br><div class='alert alert-danger'>Quantidade ou Valor Unt. não podem ser valores menor ou igual a 0.</div>";   
                                        }else{
                                        echo "
                                            </br>
                                        <div class='col-12 col-md-12'>
						<button style='padding:18px; font-size: 15pt; width: 100%;' href=\"javascript:func()\" onclick=\"CadastrarPedidoAvulso2(7, descricaopedido.value, '" . $codnota . "', valorunt.value , '0', qtdpedido.value)\" type='button' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-plus'></span> Salvar</br> Pedido</button>
					</div>";
                                        }
            
        } else {
            $valor_total = $valor;
            $valor_total = number_format($valor_total, 2, ',', '.');


            echo "
               <label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
				<div class='input-group'>
				   <input style='padding:30px; font-size: 15pt; width: 100%;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valor_total'>
				</div>
            ";
        }
        
        
        break;
    
    //validacao para editrar informacoes do item
    CASE 46:
        $qtd = (float) $_GET['param'];
        $valor = $_GET['valor'];
        $pontos = '.';
        $result = str_replace($pontos, "", $valor);
        $result = str_replace(",", ".", $result);
        $result = (float) $result;
        $valor = number_format($result, 2, '.', '');

        
        
        $id = $_GET['id'];
        $codnota = $_GET['codnota'];
        $codpedido = $_GET['codpedido'];
        $total = 0;
        
        
        $sqlPedidos = "SELECT * FROM pedidos WHERE cod = :cod ORDER BY cod DESC LIMIT 1";
        $paramPedidos = array(
            ":cod" => $codpedido
        );
        $nomecategoria = "Avulso";
        $dataTablePedidos = $banco->ExecuteQuery($sqlPedidos, $paramPedidos);
        foreach ($dataTablePedidos as $resultadopedidos) {
            
            $codservico = $resultadopedidos['servico'];

            if ($codservico == 0) {
                $nomeservico = $resultadopedidos['obs'];
                $obs = "";
            } else {
                $categoria = $resultadopedidos['categoria'];
                //$sql3 = mysqli_query($conn, "SELECT * FROM categoriaserfin WHERE cod=$categoria LIMIT 1");
                $sqlCategorias = "SELECT * FROM categoriaserfin WHERE cod= :cod LIMIT 1";
                $paramCategorias = array(
                    ":cod" => $categoria
                );
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
                    $nomeservico = $resultadoservicos['nome'] . "(" . $nomecategoria . ")";
                    $obs = $resultadopedidos['obs'];
                }
            }
            }

        
        $resultado = "";
        $valor_total = 0;
        
        $valor_total = $qtd * $valor;
        $valor_total2 = $qtd * $valor;
        $valor_total = number_format($valor_total, 2, ',', '.');


            echo "
               <label style='color:#337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='valortotal'>Valor Total.</label>
                   <div class='input-group'>
						
						<input style='padding:30px; font-size: 15pt; width: 100%;' disabled type='text' class='form-control' id='valortotal' placeholder='' value='$valor_total'>
					</div>
            ";
            if($valor_total2<=0){
                echo "<div style='margin-top:10px; font-size:18pt; padding:20px;' class='alert alert-danger'>Por favor, não edite a Quantidade ou Valor unt. com valores menor ou igual a 0. </div>";
            }else{
                 
            if ($codservico == 0) {
                ECHO" 
									<div class='col-12 col-md-12'>
										<input type='hidden' class='form-control' id='obspedido' placeholder='' value='$nomeservico'>
										<button tabindex='4' style='margin-bottom:10px; padding:30px; font-size: 15pt; width: 100%; ' href=\"javascript:func()\" onclick='EditarPedidoNovo(10, $codpedido, qtdpedido.value, valorunt.value, obspedido.value, $codnota)' type='button' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-plus'></span> Salvar</br> Pedido</button>
									</div>
									";
            } else {
                ECHO"
									<div class='col-12 col-md-12'>
										<div class='form-group' style='text-align:left;'>
											<label style='color:337AB7; border-bottom: 2px solid #337AB7; width: 100%;' for='descricaopedido'>Obs</label>
											<input tabindex='4' style='padding:30px; font-size: 15pt; width: 100%;' type='text' class='form-control' id='obspedido' placeholder='' value='$obs'>
										</div>
									</div>
									<div class='col-12 col-md-12'>
											<button tabindex='5' style='margin-bottom:10px; padding:20px; font-size: 15pt; width: 100%;' href=\"javascript:func()\" onclick='EditarPedidoNovo(10, $codpedido, qtdpedido.value, valorunt.value, obspedido.value, $codnota)' type='button' class='btn btn-success btn-lg btn-block'><span class='glyphicon glyphicon-plus'></span> Salvar Pedido</button>
									</div>
					";
            }

                                                 
            }
            
            
        
        BREAK;
   //validacao para chamar tela de pesquisar
        
    case 47:
        $codnota = $_GET['param'];
        echo "<a id='ResultadoValidacao20000'><input style='width:100%; padding:20px; font-size:16pt;' tabindex='1' autofocus class='form-control' type='text' onfocus='' placeholder='Pequisar Produto' aria-label='Pesquisar' style='height: 50px; font-size: 16pt;' autofocus name='txtNomeCliente2222' id='txtNomeCliente2222'  onkeyup='buscarServicos(44, this.value,  $codnota )'></a>
     ";
        break;
   //pedidos feitos no balcao 
    case 48:
       echo" </br><table class='table' style='font-size:14pt;'>
            <tr style='text-align:center; background-color:#337AB7; color:#fff; '>
                <td><b>Cod.</b></td>
                <td><b>Qtd. Pedidos</b></td>
                <td><b>Valor Total</b></td>
                <td><b>Cliente</b></td>
                <td><b>Funcionário</b></td>
                <td></td>
            </tr>
            ";
        $qtdTotalFinal = 0;
        $valorTotalFinal = 0;
        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');
        //$sql = mysqli_query($conn, "SELECT * FROM notas WHERE status = 2 ORDER BY cod ASC");
// Exibe todos os valores encontrados
        if ($_SESSION['permissaoF'] == 1) {

            $sqlNota = "SELECT * FROM notas WHERE tipo_pedido =1 AND status = :status AND dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje ORDER BY cod DESC";
            $paramNota = array(
                ":status" => 3
            );
        } ELSE {
            $codfunc = $_SESSION['codF'];
            $sqlNota = "SELECT * FROM notas WHERE tipo_pedido =1 AND status = :status AND func = $codfunc AND dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje ORDER BY cod DESC";
            $paramNota = array(
                ":status" => 3
            );
        }

        $dataTableNota = $banco->ExecuteQuery($sqlNota, $paramNota);
        foreach ($dataTableNota as $resultadonota) {
            $qtdTotalFinal = 0;
            $valorTotalFinal = 0;
            $nomecli = "";
            $codnota = $resultadonota['cod'];
            $cod_usuarionota = $resultadonota['usuario'];
            $datadia_nota = $resultadonota['dia'];
            $datames_nota = $resultadonota['mes'];
            $dataano_nota = $resultadonota['ano'];
            $codfuncionario_nota = $resultadonota['func'];
              $tipopedido = $resultadonota['tipo_pedido'];
                $ordem = $resultadonota['ordem'];

                if($tipopedido==1){
                $ordem = $resultadonota['ordem'];
                }else{
                    $ordem = 'E'.$codnota;
                }


            if ($cod_usuarionota == 0) {
                $nomecli = $resultadonota['nomeCli'];
            } else {
                //$sqlCli = mysqli_query($conn, "SELECT * FROM clientes WHERE id = $cod_usuarionota ORDER BY id ASC LIMIT 1");
                $sqlCli = "SELECT * FROM clientes WHERE id = :id ORDER BY id ASC LIMIT 1";
                $paramCli = array(
                    ":id" => $cod_usuarionota
                );

                $dataTableCli = $banco->ExecuteQuery($sqlCli, $paramCli);
                foreach ($dataTableCli as $resultadocli) {
                    $nomecli = $resultadocli['nome'];
                    $enderecocli = $resultadocli['endereco'];
                    $numerocli = $resultadocli['numero'];
                    $complementocli = $resultadocli['complemento'];
                    $celularcli = $resultadocli['celular'];
                }
            }
            //$sqlFunc = mysqli_query($conn, "SELECT * FROM usuarios WHERE cod = $codfuncionario_nota ORDER BY cod ASC LIMIT 1");
            $sqlFunc = "SELECT * FROM usuarios WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
            $paramFunc = array(
                ":cod" => $codfuncionario_nota
            );

            $dataTableFunc = $banco->ExecuteQuery($sqlFunc, $paramFunc);
            foreach ($dataTableFunc as $resultadofunc) {
                $nomefunc = $resultadofunc['nome'];
            }

            $sqlPedidos = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = $codnota ORDER BY cod ASC");
            while ($pedidos = mysqli_fetch_object($sqlPedidos)) {
                $qtdTotalFinal = $qtdTotalFinal + (int) $pedidos->qtd;
                $valorTotalFinal = $valorTotalFinal + (float) $pedidos->valor;
            }

            $sqlPagCli = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = $codnota ORDER BY cod ASC LIMIT 1");
            while ($pag = mysqli_fetch_object($sqlPagCli)) {
                $valorTotalFinal = (float) $pag->total;
            }

            echo "<tr style='text-align:center;'>
            <td>$ordem</td>
            <td>$qtdTotalFinal</td>
            <td>" . number_format($valorTotalFinal, 2, ',', '.') . "</td>
            <td>$nomecli</td>
            <td>$nomefunc</td>
                <td>
                <a target='_BLANK' href='pdf2.php?cod=2' class='btn btn-primary btn-sm btn-block' style='color:#fff; font-size:14pt;'><span class='glyphicon glyphicon-play'></span> Nota Fiscal</a>
                    ";
            $permissao_funcionario = (int) $_SESSION['permissaoF'];
            if ($permissao_funcionario == 1) {
               // echo "<form onsubmit='return ConfirmarIsso();' name='form_cadastrarmovimento' method='post' action='' style='margin-top:5px;'>
		//							<input  type='hidden' value='$codnota' id='txtCod' name='txtCod' />
                  //                                                      <input onfocus='' tabindex='1' type='submit' value='Cancelar Pedido' class='btn btn-danger btn-sm btn-block' style='color:#fff; font-size:14pt;' name='btnCancelarNota' />
            //</td>							</form> ";
            } echo "	
</tr>";
        }
        echo "</table>";
        break;
    
    case 49:
       echo "</br><table class='table' style='font-size:14pt;'>
            <tr style='text-align:center; background-color:#337AB7; color:#fff; '>
                <td><b>Cod.</b></td>
                <td><b>Qtd. Pedidos</b></td>
                <td><b>Valor Total</b></td>
                <td><b>Cliente</b></td>
                <td><b>Funcionário</b></td>
                <td></td>
            </tr>
            ";
        $qtdTotalFinal = 0;
        $valorTotalFinal = 0;
        $dia_hoje = date('d');
        $mes_hoje = date('m');
        $ano_hoje = date('Y');
        //$sql = mysqli_query($conn, "SELECT * FROM notas WHERE status = 2 ORDER BY cod ASC");
// Exibe todos os valores encontrados
        if ($_SESSION['permissaoF'] == 1) {

            $sqlNota = "SELECT * FROM notas WHERE tipo_pedido = 2 AND status = :status AND dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje ORDER BY cod desc";
            $paramNota = array(
                ":status" => 3
            );
        } ELSE {
            $codfunc = $_SESSION['codF'];
            $sqlNota = "SELECT * FROM notas WHERE tipo_pedido = 2 AND status = :status AND func = $codfunc AND dia = $dia_hoje AND mes = $mes_hoje AND ano = $ano_hoje ORDER BY cod desc";
            $paramNota = array(
                ":status" => 3
            );
        }

        $dataTableNota = $banco->ExecuteQuery($sqlNota, $paramNota);
        foreach ($dataTableNota as $resultadonota) {
            $qtdTotalFinal = 0;
            $valorTotalFinal = 0;
            $nomecli = "";
            $codnota = $resultadonota['cod'];
            $cod_usuarionota = $resultadonota['usuario'];
            $datadia_nota = $resultadonota['dia'];
            $datames_nota = $resultadonota['mes'];
            $dataano_nota = $resultadonota['ano'];
            $codfuncionario_nota = $resultadonota['func'];
              $tipopedido = $resultadonota['tipo_pedido'];
                $ordem = $resultadonota['ordem'];

                if($tipopedido==1){
                $ordem = $resultadonota['ordem'];
                }else{
                    $ordem = 'E'.$codnota;
                }


            if ($cod_usuarionota == 0) {
                $nomecli = $resultadonota['nomeCli'];
            } else {
                //$sqlCli = mysqli_query($conn, "SELECT * FROM clientes WHERE id = $cod_usuarionota ORDER BY id ASC LIMIT 1");
                $sqlCli = "SELECT * FROM clientes WHERE id = :id ORDER BY id ASC LIMIT 1";
                $paramCli = array(
                    ":id" => $cod_usuarionota
                );

                $dataTableCli = $banco->ExecuteQuery($sqlCli, $paramCli);
                foreach ($dataTableCli as $resultadocli) {
                    $nomecli = $resultadocli['nome'];
                    $enderecocli = $resultadocli['endereco'];
                    $numerocli = $resultadocli['numero'];
                    $complementocli = $resultadocli['complemento'];
                    $celularcli = $resultadocli['celular'];
                }
            }
            //$sqlFunc = mysqli_query($conn, "SELECT * FROM usuarios WHERE cod = $codfuncionario_nota ORDER BY cod ASC LIMIT 1");
            $sqlFunc = "SELECT * FROM usuarios WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
            $paramFunc = array(
                ":cod" => $codfuncionario_nota
            );

            $dataTableFunc = $banco->ExecuteQuery($sqlFunc, $paramFunc);
            foreach ($dataTableFunc as $resultadofunc) {
                $nomefunc = $resultadofunc['nome'];
            }

            $sqlPedidos = mysqli_query($conn, "SELECT * FROM pedidos WHERE usuario = $codnota ORDER BY cod ASC");
            while ($pedidos = mysqli_fetch_object($sqlPedidos)) {
                $qtdTotalFinal = $qtdTotalFinal + (int) $pedidos->qtd;
                $valorTotalFinal = $valorTotalFinal + (float) $pedidos->valor;
            }

            $sqlPagCli = mysqli_query($conn, "SELECT * FROM financeiro_clientes WHERE cod_orcamento = $codnota ORDER BY cod ASC LIMIT 1");
            while ($pag = mysqli_fetch_object($sqlPagCli)) {
                $valorTotalFinal = (float) $pag->total;
            }

            echo "<tr style='text-align:center;'>
            <td>$codnota</td>
            <td>$qtdTotalFinal</td>
            <td>" . number_format($valorTotalFinal, 2, ',', '.') . "</td>
            <td>$nomecli</td>
            <td>$nomefunc</td>
                <td>
                <a target='_BLANK' href='pdf2.php?cod=$codnota' class='btn btn-primary btn-sm btn-block' style='color:#fff; font-size:14pt;'><span class='glyphicon glyphicon-play'></span> Nota Fiscal</a>
                    ";
            $permissao_funcionario = (int) $_SESSION['permissaoF'];
            if ($permissao_funcionario == 1) {
               // echo "<form onsubmit='return ConfirmarIsso();' name='form_cadastrarmovimento' method='post' action='' style='margin-top:5px;'>
		//							<input  type='hidden' value='$codnota' id='txtCod' name='txtCod' />
                  //                                                      <input onfocus='' tabindex='1' type='submit' value='Cancelar Pedido' class='btn btn-danger btn-sm btn-block' style='color:#fff; font-size:14pt;' name='btnCancelarNota' />
            //</td>							</form> ";
            } echo "	
</tr>";
        }
        echo "</table>";
        break;
}
?>