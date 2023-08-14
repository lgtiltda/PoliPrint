<?php
session_start();
date_default_timezone_set('America/Manaus');
// Incluir aquivo de conex o
//Error_reporting(0);
include("conn.php");
include("Banco.php");
require_once("../Util/functions.php");

$tipo = $_GET['tipo'];
if (isset($_SESSION["permissaoF"])) {
    $cod_func = $_SESSION['codF'];
}
$banco = new Banco();

switch ($tipo) {
    //FUNÇÃO PARA CHAMAR NOVO PEDIDO
    case 1:
        echo "  <div class='btn btn-primary' style='background-color:#4169E1; color:#fff; display:flex; text-align:center;width:90%;  margin-left:2%; margin-top:2%; '>Cadastrar Novo Pedido<hr></div>  
                <form style='width:90%; display:flex; margin-left:2%; margin-top:2%;' onsubmit='return ConfirmarIsso();' method='post' name='frmCadastro2' id='frmCadastro2' novalidate enctype='multipart/form-data'>
                   
                    <input name='txtCodCliente' id='txtCodCliente' value='0' type='hidden' />
                    <select onchange='' tabindex='1' style='height: 82px; font-size: 15pt; width: 100%;' class='form-control' id='txtTipoEntrega' name='txtTipoEntrega' onchange=''>
                        <option value='1'>Balcão</option>
                        <option value='2'>Entrega</option>
                    </select>
                    </br>
                    <input style='padding:15px; font-size: 9pt; width: 100%;  font-weight: bold' class='btn btn-primary btn-lg btn-block ' type='submit' name='btnSubmitPedir' id='btnSubmitPedir' style='' value='Inciar Pedido'>
                </form> 
                <div class='btn btn-primary' style='background-color:#4169E1; color:#fff; display:flex; text-align:center;width:90%;  margin-left:2%; margin-top:2%; '><hr></div>  
                
        ";

        break;
    //FUNCAO PARA CHAMAR TELA DE USUÁRIOS
    case 2:


        echo "<div class='displayinfinito' style='text-align:center;'>
        <div class='container row'>
        <div class='col-md-6 col-lg-4 pb-3'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                            <H3>Cadastrar</br> Novo </br>Usuário 
                            </H3>
                            <a onClick='PagPesquisarNota(3)' href='javascript:void' class='btn btn-success'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='36px' viewBox='0 0 24 24' width='36px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><path d='M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z'/></svg>
                            </a>
                            </BR>
                            </BR>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
                    ";
        $sqlFunc = "SELECT * FROM usuarios WHERE status = :status AND sub_usuario = :sub_usuario  ORDER BY permissao ASC";
        $paramFunc = array(
            ":status" => 1,
            ":sub_usuario" => $_SESSION['codF']
        );

        $dataTableFunc = $banco->ExecuteQuery($sqlFunc, $paramFunc);
        foreach ($dataTableFunc as $resultadofunc) {
            $codfunc = $resultadofunc['cod'];
            $nomefunc = $resultadofunc['nome'];
            $imgpadrao = $resultadofunc['foto'];
            if ($imgpadrao == null) {
                $imgpadrao = "imagempadrao3.png";
            }

            $usuario = $resultadofunc['usuario'];
            $cpf = $resultadofunc['cpf'];
            $email = $resultadofunc['email'];
            $permissao = $resultadofunc['permissao'];
            if ($permissao == 1) {
                $permissaotexto = "MASTER";
            } else if ($permissao == 2) {
                $permissaotexto = "GERENTE";
            } else if ($permissao == 3) {
                $permissaotexto = "FUNCIONÁRIO";
            }
            $data_ativacao = $resultadofunc['data_vencimento'];
            echo "<div class='col-md-6 col-lg-4 pb-3'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-custom-avatar'>
                                <img class='img-fluid'
                                    src='interface/img/Usuarios/$imgpadrao'
                                    alt='Avatar' />
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                                <h5 class='card-title'>$nomefunc</h5>
                                <p class='card-text'>
                                <b>LOGIN:</b> $usuario </br> 
                                <b>CPF:</b> $cpf </br> 
                                <B> EMAIL:</B> $email </br>
                                <b>PERMISSÃO:</B>  $permissaotexto
                                </p>
                            </div>
                            <div class='card-footer' style='background: inherit; border-color: inherit;'>
                                <a href='javascript: func;' onclick='ValidacaoGeralHome(4, $codfunc, 1, 0)' class='btn btn-success'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><path d='M0 0h24v24H0z' fill='none'/><path d='M21 8V7l-3 2-3-2v1l3 2 3-2zm1-5H2C.9 3 0 3.9 0 5v14c0 1.1.9 2 2 2h20c1.1 0 1.99-.9 1.99-2L24 5c0-1.1-.9-2-2-2zM8 6c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H2v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1zm8-6h-8V6h8v6z'/></svg>
                                </a>
                                <a href='javascript: func;' onclick='ValidacaoGeralHome(4, $codfunc, 2, 0)' class='btn btn-primary'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='12' r='3.2'/><path d='M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z'/></svg>
                                </a>
                                <a href='javascript: func;' onclick='ValidacaoGeralHome(4, $codfunc, 3, 0)' class='btn btn-danger'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><path d='M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z'/></svg>
                                </a>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
        ";
        }
        echo "
                        </div>
                 </div>
        ";
        break;
    //FUNCAO PARA CADASTAR NOVO USAIROO 
    case 3:
        $imgpadrao = "";
        echo " <div class='displayinfinito'>
        <div class='container-fluid' style='width:100%;'>
        
            <div class='col-md-12 col-lg-12 pb-12'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-custom-avatar'>";  
                            if($imgpadrao==null){
                              //  echo " <img class='img-fluid'
                                //src='Interface/img/Usuarios/imagempadrao3.png'
                                //alt='' />
                                 //";
                }else{
                        echo " <img class='img-fluid'
                                src='Interface/img/Usuarios/$imgpadrao'
                                alt='' />";
                    }
                    
                                           echo"     
                    
                               
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                                <h5 class='card-title'>Cadastrar Novo Usuario   </h5>
                                <p class='card-text'>
                                </p>
                            </div>
                            
                            <div class='card-body' style='overflow-y: auto'>
                            <form onsubmit='return ConfirmarIsso();' method='post' name='frmCadastroUsu2' id='frmCadastroUsu2' novalidate enctype='multipart/form-data'>
                        <div class='row'>
                            <div class='col-12 col-md-3'>
                            <label class='pay'>Nome</label>
                            <input class='form-control'  tabindex='1' type='text' name='txtNome' id='txtNome' placeholder='NOME COMPLETO DO USUÁRIO'>
                            </div>
                            <div class='col-12 col-md-3'>
                                <label class='pay'>Usuário</label>
                                <input class='form-control' tabindex='2' onkeyup='' tabindex='3' type='text' name='txtLogin' id='txtLogin' placeholder='LOGIN DE ACESSO'
                                    minlength='19' maxlength='19'>
                            </div>
                            
                            <div class='col-12 col-md-3'>
                                <label class='pay'>Permissao</label>
                                <select class='form-control' onchange='' tabindex='3' style=' font-size: 12pt; width: 100%;' class='form-control' id='txtPermissao' name='txtPermissao' onchange=''>
                                    <option value='2'>Gerente</option>
                                    <option value='3'>Funcionário Frente de Caixa</option>
                                </select>
                                
                            </div>
                            <div class='col-12 col-md-3'>
                                <label class='pay'>CPF</label>
                                <input class='form-control' tabindex='4' onkeyup='' tabindex='3' type='text' name='txtCpf' id='txtCpf' placeholder='CPF USUÁRIO'
                                    minlength='19' maxlength='19'>
                            </div>
                            
                            <div class='col-12 col-md-2'>
                                <label class='pay'>Celular</label>
                                <input class='form-control' tabindex='5' onkeyup='' tabindex='4' type='text' id='txtCelular' name='txtCelular' placeholder='NÚMERO PARA CONTATO'
                                    class='placeicon' ength='5'>
                            </div>
                            <div class='col-12 col-md-3'>
                                <label class='pay'>EMAIL</label>
                                <input class='form-control' tabindex='6' onkeyup='' tabindex='4' type='text' id='txtEmail' name='txtEmail' placeholder='EMAIL PARA CONTATO'
                                    class='placeicon' minlength='3' maxlength='100'>
                            </div>
                            <div class='col-12 col-md-3'>
                                <label class='pay'>ENDEREÇO</label>
                                <input class='form-control' tabindex='7' onkeyup='' tabindex='3' type='text' name='txtEndereco' id='txtEndereco' placeholder='ENDEREÇO DO USUÁRIO'
                                    minlength='19' maxlength='200'>
                            </div>
                            <div class='col-12 col-md-2'>
                                <label class='pay'>NÚMERO</label>
                                <input class='form-control' tabindex='8' onkeyup='' tabindex='3' type='text' name='txtNumero' id='txtNumero' placeholder='NÚMERO DO ENDEREÇO'
                                    minlength='19' maxlength='19'>
                            </div>
                            <div class='col-12 col-md-2'>
                                <label class='pay'>BAIRRO</label>
                                <input class='form-control' tabindex='9' onkeyup='' tabindex='4' type='text' id='txtBairro' name='txtBairro' placeholder='BAIRRO DO USUÁRIO'
                                    class='placeicon' minlength='3' maxlength='50'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-12 col-md-6'>
                                <label class='pay'>Senha</label>
                                <input class='form-control' tabindex='10' onkeyup='' tabindex='3' type='password' name='txtSenha' id='txtSenha' placeholder='DIGITE SUA SENHA. MINÍMO 5 CARACTER.'
                                    minlength='19' maxlength='20'>
                            </div>
                            <div class='col-12 col-md-6'>
                                <label class='pay'>Confirmar Senha</label>
                                <input class='form-control' tabindex='11' onkeyup='' tabindex='4' type='password' id='txtSenha2' name='txtSenha2' placeholder='CONFIRME SUA SENHA.'
                                    class='placeicon' minlength='3' maxlength='20'>
                            </div>
                        </div>
                        <div id='ResultadoValidacao2'>
                        </div>
                        
                        <div class='row'>
                            <div class='col-md-12'>
                                    <input  tabindex='12' style='padding:18px; font-size: 15pt; width: 100%;' type='submit' class='btn btn-primary btn-lg btn-block' name='btnSubmit' id='btnSubmit' value='Cadastrar' />
                                    </div>        
                            </div>
                        </div>
                    </form>
                         
                            </BR>
                            </BR>
                            </div>
                        </div>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
        ";
        break;
    //FUNCAO PARA EDITAR INFORMAÇÕES DO USUÁRIO 
    case 4:

        $param2 = $_GET['param2'];
        $sqlFunc = "SELECT * FROM usuarios WHERE cod = :cod ORDER BY cod ASC LIMIT 1";
        $paramFunc = array(
            ":cod" => $_GET['param1']
        );

        $dataTableFunc = $banco->ExecuteQuery($sqlFunc, $paramFunc);
        foreach ($dataTableFunc as $resultadofunc) {
            $codfunc = $resultadofunc['cod'];
            $nomefunc = $resultadofunc['nome'];
            $imgpadrao = $resultadofunc['foto'];

            $usuario = $resultadofunc['usuario'];
            $cpf = $resultadofunc['cpf'];
            $email = $resultadofunc['email'];
            $permissao = $resultadofunc['permissao'];
            if ($permissao == 1) {
                $permissaotexto = "MASTER";
            } else if ($permissao == 2) {
                $permissaotexto = "GERENTE";
            } else if ($permissao == 3) {
                $permissaotexto = "FUNCIONÁRIO";
            }
            $data_ativacao = $resultadofunc['data_vencimento'];
        }
        if ($param2 == 1) {

            $imgpadrao = "";
        echo " <div class='displayinfinito'>
        <div class='container-fluid' style='width:100%;'>
        
            <div class='col-md-12 col-lg-12 pb-12'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-custom-avatar'>";  
                            if($imgpadrao==null){
                                echo " <img class='img-fluid'
                                src='Interface/img/Usuarios/imagempadrao3.png'
                                alt='' />
                                 ";
                }else{
                        echo " <img class='img-fluid'
                                src='Interface/img/Usuarios/$imgpadrao'
                                alt='' />";
                    }
                    
                                           echo"     
                    
                               
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                                <h5 class='card-title'>Editar Informações do Usuario   </h5>
                            </div>
                            
                            <div class='card-body' style='overflow-y: auto'>
                            <form onsubmit='return ConfirmarIsso();' method='post' name='frmCadastroUsu2' id='frmCadastroUsu2' novalidate enctype='multipart/form-data'>
                        <div class='row'>
                            <div class='col-12 col-md-4'>
                            <label class='pay'>Nome</label>
                            <input class='form-control'  tabindex='1' type='text' name='txtNome' id='txtNome' placeholder='NOME COMPLETO DO USUÁRIO'>
                            </div>
                            <div class='col-12 col-md-4'>
                                <label class='pay'>Usuário</label>
                                <input class='form-control' tabindex='2' onkeyup='' tabindex='3' type='text' name='txtLogin' id='txtLogin' placeholder='LOGIN DE ACESSO'
                                    minlength='19' maxlength='19'>
                            </div>
                            <div class='col-12 col-md-4'>
                                <label class='pay'>Permissao</label>
                                <select class='form-control' onchange='' tabindex='3' style=' font-size: 12pt; width: 100%;' class='form-control' id='txtPermissao' name='txtPermissao' onchange=''>
                                    <option value='2'>Gerente</option>
                                    <option value='3'>Funcionário Frente de Caixa</option>
                                </select>
                                
                            </div>
                            <div class='col-12 col-md-4'>
                            <label class='pay'>Senha</label>
                            <input class='form-control' tabindex='10' onkeyup='' tabindex='3' type='password' name='txtSenha' id='txtSenha' placeholder='DIGITE SUA SENHA. MINÍMO 5 CARACTER.'
                                minlength='19' maxlength='20'>
                        </div>
                        <div class='col-12 col-md-4'>
                            <label class='pay'>Confirmar Senha</label>
                            <input class='form-control' tabindex='11' onkeyup='' tabindex='4' type='password' id='txtSenha2' name='txtSenha2' placeholder='CONFIRME SUA SENHA.'
                                class='placeicon' minlength='3' maxlength='20'>
                        </div>
                    
                            <div class='col-12 col-md-4'>
                                <label class='pay'>CPF</label>
                                <input class='form-control' tabindex='4' onkeyup='' tabindex='3' type='text' name='txtCpf' id='txtCpf' placeholder='CPF USUÁRIO'
                                    minlength='19' maxlength='19'>
                            </div>
                            
                            <div class='col-12 col-md-2'>
                                <label class='pay'>Celular</label>
                                <input class='form-control' tabindex='5' onkeyup='' tabindex='4' type='text' id='txtCelular' name='txtCelular' placeholder='CONTATO'
                                    class='placeicon' ength='5'>
                            </div>
                            <div class='col-12 col-md-3'>
                                <label class='pay'>EMAIL</label>
                                <input class='form-control' tabindex='6' onkeyup='' tabindex='4' type='text' id='txtEmail' name='txtEmail' placeholder='EMAIL'
                                    class='placeicon' minlength='3' maxlength='100'>
                            </div>
                            <div class='col-12 col-md-3'>
                                <label class='pay'>ENDEREÇO</label>
                                <input class='form-control' tabindex='7' onkeyup='' tabindex='3' type='text' name='txtEndereco' id='txtEndereco' placeholder='ENDEREÇO'
                                    minlength='19' maxlength='200'>
                            </div>
                            <div class='col-12 col-md-2'>
                                <label class='pay'>NÚMERO</label>
                                <input class='form-control' tabindex='8' onkeyup='' tabindex='3' type='text' name='txtNumero' id='txtNumero' placeholder='Nº'
                                    minlength='19' maxlength='19'>
                            </div>
                            <div class='col-12 col-md-2'>
                                <label class='pay'>BAIRRO</label>
                                <input class='form-control' tabindex='9' onkeyup='' tabindex='4' type='text' id='txtBairro' name='txtBairro' placeholder='BAIRRO'
                                    class='placeicon' minlength='3' maxlength='50'>
                            </div>
                        </div>
                        <div id='ResultadoValidacao2'>
                        </div>
                        
                        <div class='row'>
                            <div class='col-md-12'>
                                    <input  tabindex='12' style='padding:18px; font-size: 15pt; width: 100%;' type='submit' class='btn btn-primary btn-lg btn-block' name='btnSubmit' id='btnSubmit' value='Cadastrar' />
                                    </div>        
                            </div>
                        </div>
                    </form>
                         
                            </BR>
                            </BR>
                            </div>
                        </div>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
        ";

        } else if ($param2 == 2) {
            echo " 
            <div class='col-md-12 col-lg-12 pb-12'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-custom-avatar'>";  
                            if($imgpadrao==null){
                                echo " <img class='img-fluid'
                                src='Interface/img/Usuarios/imagempadrao3.png'
                                alt='' />
                                        
                    ";}else{
                        echo " <img class='img-fluid'
                                src='Interface/img/Usuarios/$imgpadrao'
                                alt='' />";
                    }
                    
                                           echo"     
                    
                               
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                                <h5 class='card-title'>$nomefunc</h5>
                                <p class='card-text'>
                                </p>
                            </div>
                            
                            <div class='card-body' style='overflow-y: auto'>
                            <H3>Mudar Foto 
                            </H3>
                            <form method='post' name='frmCadastro2' id='frmCadastro2' novalidate enctype='multipart/form-data'>
                            <div class='col-12 col-md-12'>
                                    <div class='form-group label-floating'>
                                        <label for='flImagem' class='control-label'></label>            
                                        <input type='file' id='flImagemLivre' name='flImagemLivre'  accept='image/*' />
                                        </div>
                        </div>
                        <div class='col-12 col-md-12'>
                                    <div class='form-group label-floating'>
                                    <input value='$imgpadrao' name='txtImagemAtual' id='txtImagemAtual' type='hidden' />
                        <input value='$imgpadrao' name='txtCodser' id='txtCodser' type='hidden' />
                        <input style='margin-left: 5%; padding:20px; font-size: 15pt; width: 90%;' type='submit' name='btnAlterarImagem' id='btnAlterarImagem'  value='Salvar Foto'  class='btn btn-primary btn-lg btn-block' />
                        </div>
                        </div>
                        </form>     
                            </BR>
                            </BR>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
        "; } else if ($param2 == 3) {
            echo "<div class='displayinfinito' style='text-align:center;'>
        <div class='container row'>
        <div class='col-md-6 col-lg-4 pb-3'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                            <H3>Cadastrar</br> Novo </br>Usuário 
                            </H3>
                            <a onClick='PagPesquisarNota(3)' href='javascript:void' class='btn btn-success'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='36px' viewBox='0 0 24 24' width='36px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><path d='M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z'/></svg>
                            </a>
                            </BR>
                            </BR>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
                    ";
        $sqlFunc = "SELECT * FROM usuarios WHERE status = :status AND sub_usuario = :sub_usuario  ORDER BY permissao ASC";
        $paramFunc = array(
            ":status" => 1,
            ":sub_usuario" => $_SESSION['codF']
        );

        $dataTableFunc = $banco->ExecuteQuery($sqlFunc, $paramFunc);
        foreach ($dataTableFunc as $resultadofunc) {
            $codfunc = $resultadofunc['cod'];
            $nomefunc = $resultadofunc['nome'];
            $imgpadrao = $resultadofunc['foto'];
            if ($imgpadrao == null) {
                $imgpadrao = "imagempadrao3.png";
            }

            $usuario = $resultadofunc['usuario'];
            $cpf = $resultadofunc['cpf'];
            $email = $resultadofunc['email'];
            $permissao = $resultadofunc['permissao'];
            if ($permissao == 1) {
                $permissaotexto = "MASTER";
            } else if ($permissao == 2) {
                $permissaotexto = "GERENTE";
            } else if ($permissao == 3) {
                $permissaotexto = "FUNCIONÁRIO";
            }
            $data_ativacao = $resultadofunc['data_vencimento'];
            echo "<div class='col-md-6 col-lg-4 pb-3'>

                        <!-- Copy the content below until next comment -->
                        <div class='card card-custom bg-white border-white border-0'>
                            <div class='card-custom-img'
                                style='background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);'>
                            </div>
                            <div class='card-custom-avatar'>
                                <img class='img-fluid'
                                    src='interface/img/Usuarios/$imgpadrao'
                                    alt='Avatar' />
                            </div>
                            <div class='card-body' style='overflow-y: auto'>
                                <h5 class='card-title'>$nomefunc </h5>
                                <p class='card-text'>
                                <b>LOGIN:</b> $usuario </br> 
                                <b>CPF:</b> $cpf </br> 
                                <B> EMAIL:</B> $email </br>
                                <b>PERMISSÃO:</B>  $permissaotexto
                                </p>
                            </div>
                            <div class='card-footer' style='background: inherit; border-color: inherit;'>
                                <a href='javascript: func;' onclick='ValidacaoGeralHome(4, $codfunc, 1, 0)' class='btn btn-success'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><path d='M0 0h24v24H0z' fill='none'/><path d='M21 8V7l-3 2-3-2v1l3 2 3-2zm1-5H2C.9 3 0 3.9 0 5v14c0 1.1.9 2 2 2h20c1.1 0 1.99-.9 1.99-2L24 5c0-1.1-.9-2-2-2zM8 6c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H2v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1zm8-6h-8V6h8v6z'/></svg>
                                </a>
                                <a href='javascript: func;' onclick='ValidacaoGeralHome(4, $codfunc, 2, 0)' class='btn btn-primary'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='12' r='3.2'/><path d='M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z'/></svg>
                                </a>
                                <a href='javascript: func;' onclick='ValidacaoGeralHome(4, $codfunc, 3, 0)' class='btn btn-danger'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#FFFFFF'><path d='M0 0h24v24H0z' fill='none'/><path d='M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z'/></svg>
                                </a>
                            </div>
                        </div>
                        <!-- Copy until here -->
        </div>
        ";
        }
        echo "
                        </div>
                 </div>
        ";
        }
        break;

}
?>