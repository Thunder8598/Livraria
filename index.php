<?php
?>

<html>

<head>
    <title>Livraria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <script src="jquery.min.js"></script>
    <script src="DBAjax.js"></script>
    <script src="FecharModal.js"></script>
</head>

<body>
    <main class="shadow">
        <div>
            <center>
                <h1>Bem-Vindo(a)</h1>
                <h5>O deseja fazer?</h5>
            </center>
        </div>

        <div id="gui-buttons">
            <center>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('cadastrar-modal').className='form-on shadow'">Cadastrar um livro</button>
                <button type="button" class="btn btn-success" onclick="document.getElementById('consultar-modal').className='form-on shadow'">Consultar/Atualizar/Deletar livros</button>
            </center>
        </div>
    </main>


    <script>
        const AtivarBtnConsultar = () => {
            (document.getElementById("Pesquisa").value != "") ?
            document.getElementById('btn-consultar').disabled = false:
                document.getElementById('btn-consultar').disabled = true;
        }
    </script>

    <!--Cadastro-->
    <div class="form-off shadow" id="cadastrar-modal">
        <button type="button" class="btn btn-sm btn-danger btn-close" onclick="FecharModal('cadastrar-modal',['aviso-cadastrar'])">X</button>



        <center>
            <h3>Cadastro de livros</h3>
        </center>

        <form method="POST" action="#" id="Form-Cadastro" name="Form-Cadastro">

            <div id="aviso-cadastrar"></div>

            <div class="form-group">
                <label>Nome do livro:</label>
                <input class="form-control" type="text" name="NomeLivro" />
            </div>

            <div class="form-group">
                <label>Autor do livro:</label>
                <input class="form-control" type="text" name="AutorLivro" />
            </div>

            <div class="form-group">
                <label>Quantidade de páginas:</label>
                <input class="form-control" type="text" name="QtePagLivro" />
            </div>

            <div class="form-group">
                <label>Preço do livro:</label>
                <input class="form-control" type="text" name="PrecoLivro" />
            </div>

            <button type="button" class="btn btn-success" onclick="CadastrarLivro()">Cadastrar</button>
            <button type="reset" class="btn btn-danger" id="btn-limpar">Limpar campos</button>
        </form>
    </div>

    <!--Consulta-->
    <div class="form-off shadow" id="consultar-modal">
        <button type="button" class="btn btn-sm btn-danger btn-close" onclick="FecharModal('consultar-modal',['aviso-consultar','livros-achados'])">X</button>

        <center>
            <h3>Consulta de livros</h3>
        </center>

        <form method="POST" action="#" id="Form-Consulta" name="Form-Consulta">

            <div id="aviso-consultar"></div>

            <div class="form-group">
                <label>Consulta por Nome/Autor/Preço/Número de páginas do livro:</label>
                <input class="form-control" onkeyup="AtivarBtnConsultar()" type="text" id="Pesquisa" name="Pesquisa" />
            </div>

            <button type="button" class="btn btn-success" id="btn-consultar" onclick="ConsultarLivro()" disabled>Consultar</button>
            <button type="button" class="btn btn-warning" onclick="ConsultarLivro(true)">Consultar todos os Livros</button>
            <button type="reset" class="btn btn-danger" id="btn-limpar">Limpar campo</button>

            <hr>
            <div id="livros-achados"></div>

        </form>
    </div>

    <!--Editar livro-->
    <div class="form-off shadow" id="editar-modal">
        <button type="button" class="btn btn-sm btn-danger btn-close" onclick="FecharModal('editar-modal',['aviso-editar'])">X</button>

        <center>
            <h3>Atualizar cadastro de livro</h3>
        </center>

        <form method="POST" action="#" id="Form-Editar" name="Form-Editar">
            
            <div id="aviso-editar"></div>

            <div class="form-group">
                <label>Nome do livro:</label>
                <input class="form-control" type="text" name="NomeLivro" />
            </div>

            <div class="form-group">
                <label>Autor do livro:</label>
                <input class="form-control" type="text" name="AutorLivro" />
            </div>

            <div class="form-group">
                <label>Quantidade de páginas:</label>
                <input class="form-control" type="text" name="QtePagLivro" />
            </div>

            <div class="form-group">
                <label>Preço do livro:</label>
                <input class="form-control" type="text" name="PrecoLivro" />
            </div>

            <div class="form-group">
                <label>Livro disponível</label>
                <input class="" type="radio" name="LivroAtivo" value="1" />

                <label>Livro indisponível</label>
                <input class="" type="radio" name="LivroAtivo" value="0" />
            </div>

            <input type="hidden" name="IdLivro" value="" />

            <button type="button" class="btn btn-success" onclick="EditarLivro()">Editar</button>
            <button type="reset" class="btn btn-danger" id="btn-limpar">Limpar campos</button>
        </form>
    </div>
</body>

</html>