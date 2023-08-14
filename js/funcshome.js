var req;
//PAGINA PESQUISAR NOTA
function PagPesquisarNota(tipo) {

    // Verificando Browser
        if (window.XMLHttpRequest) {
            req = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            req = new ActiveXObject("Microsoft.XMLHTTP");
        }
    
    // Arquivo PHP juntamento com a id da noticia (método GET)
        var url = "Action/retornarhome.php?tipo=" + tipo;
    
    // Chamada do método open para processar a requisição
        req.open("Get", url, true);
    
    // Quando o objeto recebe o retorno, chamamos a seguinte função;
        req.onreadystatechange = function () {
    
            // Exibe a mensagem "Aguarde..." enquanto carrega
            if (req.readyState == 1) {
                document.getElementById('ListaPedidosTodos').innerHTML = 'Aguarde...';
            }
    
            // Verifica se o Ajax realizou todas as operações corretamente
            if (req.readyState == 4 && req.status == 200) {
    
                // Resposta retornada pelo exibir.php
                var resposta = req.responseText;
    
                // Abaixo colocamos a resposta na div conteudo
                document.getElementById('ListaPedidosTodos').innerHTML = resposta;
                
            $("#painelPedidos").hide();
            $("#ListaPedidosTodos").show();
            $("#painelClientes").hide();
            $("#telainicialfinanceiro").hide();
            $("#telainicialclientes").show();
              document.getElementById('li02').className = '';
            document.getElementById('li01').className = 'active';
                
    
            }
        }
        req.send(null);
    
}
//FUNCAO GERAL PARA VALIDAR INFORMAÇÕES OU CHAMAR FORMULARIO ALTERNATIVOS DENTRO DE VARIAS DE CONTROLAS POR ID
function ValidacaoGeralHome(tipo, param1, param2, param3) {

    // Verificando Browser
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "Action/retornarhome.php?tipo=" + tipo + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3;
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
