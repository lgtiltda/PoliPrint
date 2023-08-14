var req;
//PAGINA PESQUISAR SERRVIÇOS OU PRODUTOS
function buscarServicos(tipo, valor, codnota, categoria) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&categoria=" + categoria;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Produtos..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;
        }
    }
    req.send(null);
    document.getElementById('valoruntEd').focus();
}
//FUNCAO PARA CHAMAR TELA DE EDIAR ULTIMO PEDIDO
function buscarEdPedido(tipo, valor, codnota, categoria) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&categoria=" + categoria;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Produtos..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;

            document.getElementById('valorunt').focus();
            document.getElementById('valorunt').select();

        }
    }
    req.send(null);

}
//FUNCAO PARA CHAMAR TELA DE CLIENTES EM CARRINHO
function buscarClientesCar(tipo, valor, codnota, categoria) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&categoria=" + categoria;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Produtos..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;

            document.getElementById('txtClientesSelecionar').focus();
            document.getElementById('txtClientesSelecionar').select();

        }
    }
    req.send(null);

}
//FUNCAO PARA CHAMAR TELA DE CLIENTES EM CARRINHO
function buscarPedidoAvulsoCar(tipo, valor, codnota, categoria) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&categoria=" + categoria;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Produtos..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;

            document.getElementById('descricaopedido').focus();
            document.getElementById('descricaopedido').select();

        }
    }
    req.send(null);

}
//FUNCAO PARA CHAMAR TELA DE CLIENTES EM CARRINHO
function buscarPagamentoCar(tipo, valor, codnota, categoria) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&categoria=" + categoria;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Produtos..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;

            document.getElementById('pagamentodinheiro').focus();
            document.getElementById('pagamentodinheiro').select();

        }
    }
    req.send(null);

}
// FUNÇÃO PARA EXIBIR CADASTRAR PEDIDO
function CadastrarPedido(tipo, id, codnota, valor, categoria, qtd) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamento com a id da noticia (método GET)
    var url = "Action/retornarcarrinho.php?tipo=" + tipo + "&id=" + id + "&codnota=" + codnota + "&valor=" + valor + "&categoria=" + categoria + "&qtd=" + qtd;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Aguarde..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ResultadoAdicionar').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo retornarcarinho.php
            var resposta = req.responseText;

            // Abaixo colocamos a resposta na div conteudo
            document.getElementById('ResultadoAdicionar').innerHTML = resposta;

        }
    }


    req.send(null);
    // Validacao(38, 1, codnota, 20000);
    setTimeout(() => { ValidacaoGeralCarrinho(15, codnota, 0, 0, 50); }, 400);

    //setTimeout(() => { buscarServicos(42, 1, codnota); }, 300);

    document.getElementById('TxtPesquisarItem').value = '';
    document.getElementById('TxtPesquisarItem').focus();
}
//FUNÇÃO PARA ALTERAR AS INFORMAÇÕES DO PEDIDO
function EditarPedido(tipo, cod, qtd, valor, obs, codnota) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamento com a id da noticia (método GET)
    var url = "Action/retornarcarrinho.php?tipo=" + tipo + "&cod=" + cod + "&qtd=" + qtd + "&valor=" + valor + "&obs=" + obs + "&codnota=" + codnota;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Aguarde..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ResultadoAdicionar').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo exibir.php
            var resposta = req.responseText;

            // Abaixo colocamos a resposta na div conteudo
            document.getElementById('ResultadoAdicionar').innerHTML = resposta;


        }
    }

    setTimeout(() => { ValidacaoGeralCarrinho(15, codnota, 0, 0, 50); }, 400);

    document.getElementById('TxtPesquisarItem').value = '';
    document.getElementById('TxtPesquisarItem').focus();

    req.send(null);

}
//ALTERAR CLIENTE NA NOTA DO PEDIDO
function AlterarClienteNota(tipo, valor, codnota, param) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&param=" + param;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Noticias..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;

        }
    }
    req.send(null);
}
//FUNCAO GERAL PARA VALIDAR INFORMAÇÕES OU CHAMAR FORMULARIO ALTERNATIVOS DENTRO DE VARIAS DE CONTROLAS POR ID
function ValidacaoGeralCarrinho(tipo, param1, param2, param3, id) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?tipo=" + tipo + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&id=" + id;
    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Noticias..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ResultadoValidacao' + id).innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ResultadoValidacao' + id).innerHTML = resposta;
        }
    }
    req.send(null);
}
//FUNCAO GERAL PARA VALIDAR INFORMAÇÕES OU CHAMAR FORMULARIO ALTERNATIVOS DENTRO DE VARIAS DE CONTROLAS POR ID
function ValidacaoGeralPagamento(tipo, param1, param2, param3, param4, param5, param6, param7) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?tipo=" + tipo + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5 + "&param6=" + param6 + "&param7=" + param7;
    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Buscando Noticias..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ResultadoValidacaoPagamento').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('ResultadoValidacaoPagamento').innerHTML = resposta;
        }
    }
    req.send(null);
}
//FUNCAO PARA CADASTRAR NOVO CLIENTE EM CARRINHO DE COMPRAS
function CadastrarNovoClienteViaPagamento(tipo, nome, datanascimento, celular, endereco, bairro, numero, complemento, codnota) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamento com a id da noticia (método GET)
    var url = "Action/retornarcarrinho.php?tipo=" + tipo + "&codnota=" + codnota + "&nome=" + nome + "&datanascimento=" + datanascimento + "&celular=" + celular + "&endereco=" + endereco + "&bairro=" + bairro + "&numero=" + numero + "&complemento=" + complemento;

    // Chamada do método open para processar a requisiçãCo
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Aguarde..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ListaPedidosTodos').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }


        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo exibir.php
            var resposta = req.responseText;

            // Abaixo colocamos a resposta na div conteudo
            document.getElementById('ListaPedidosTodos').innerHTML = resposta;

        }
    }
    req.send(null);
}
// FUNÇÃO PARA EXIBIR CADASTRAR PEDIDO
function CadastrarPedidoAvulso2(tipo, id, codnota, valor, categoria, qtd) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamento com a id da noticia (método GET)
    var url = "Action/retornarcarrinho.php?tipo=" + tipo + "&id=" + id + "&codnota=" + codnota + "&valor=" + valor + "&categoria=" + categoria + "&qtd=" + qtd;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Aguarde..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('ResultadoAdicionar').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo exibir.php
            var resposta = req.responseText;



            setTimeout(() => { ValidacaoGeralCarrinho(15, codnota, 0, 0, 50); }, 400);


            // Abaixo colocamos a resposta na div conteudo
            document.getElementById('ResultadoAdicionar').innerHTML = resposta;
            document.getElementById('TxtPesquisarItem').value = '';
            document.getElementById('TxtPesquisarItem').focus();

        }
    }
    req.send(null);
}
function FuncaoParaValidarPagamento(tipo, dinheiro, debito, credito, pix, total, troco) {
    // Abaixo colocamos a resposta na div conteudo
    document.getElementById('ResultadoValidacaopagamento').innerHTML = 'resposta ok';
    document.getElementById('TxtPesquisarItem').value = '';
    document.getElementById('TxtPesquisarItem').focus();

}
//FUNÇÃO PARA DIVIDIR E APLICAR JUROS NO PAGAMENTO
function Parcelamento(tipo, valor, codnota, juros, juros2) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarcarrinho.php?codnota=" + codnota + "&valor=" + valor + "&tipo=" + tipo + "&juros=" + juros + "&juros2=" + juros2;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function () {

        // Exibe a mensagem "Aguarde..." enquanto carrega
        if (req.readyState == 1) {
            document.getElementById('resultadodoparcelamento').innerHTML = "<div class='alert alert-danger' style='width:100%; text-align:center;'><div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <div class='spinner-grow text-danger' role='status'><span class='visually-hidden'> </span></div> <span>Nosso Java Travou, por favor, atualize o navegador...<span></div>";
        }

        // Verifica se o Ajax realizou todas as operações corretamente
        if (req.readyState == 4 && req.status == 200) {

            // Resposta retornada pelo busca.php
            var resposta = req.responseText;

            // Abaixo colocamos a(s) resposta(s) na div resultado
            document.getElementById('resultadodoparcelamento').innerHTML = resposta;

        }
    }
    req.send(null);
}