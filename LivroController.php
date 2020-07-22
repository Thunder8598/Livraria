<?php
include "SqlExecuta.php";

class LivroController
{
    function Cadastrar($data)
    {
        //Verifica se há algum livro com o mesmo nome
        $sql = "SELECT * FROM livro WHERE NomeLivro = '" . $data["NomeLivro"] . "'";
        $resposta = Sql($sql, 1, 1);

        //Formata o Preço do livro no formato da DB
        $data["PrecoLivro"] = $this->FormatarPreco($data["PrecoLivro"]);

        //Verifica se todos os campos estão corretos
        if (($resposta == 0) && ($data["NomeLivro"] != "") && (($data["AutorLivro"] != "")) && ($data["QtePagLivro"] > 0) && ($data["PrecoLivro"] > 0)) {

            $sql = "INSERT INTO livro (NomeLivro,AutorLivro,QtePagLivro,PrecoLivro) 
            VALUES ('" . $data["NomeLivro"] . "','" . $data["AutorLivro"] . "','" . $data["QtePagLivro"] . "','" . $data["PrecoLivro"] . "')";

            echo Sql($sql);
        } else echo 0;
    }

    function Consultar($data)
    {
        $Pesquisa = $data["Pesquisa"];

        //Formata o Preço do livro no formato da DB
        $PesquisaPreco = $this->FormatarPreco($Pesquisa);

        $sql = "SELECT * FROM livro WHERE 
        NomeLivro LIKE '" . $Pesquisa . "%'
        OR AutorLivro LIKE '" . $Pesquisa . "%'
        OR PrecoLivro LIKE '" . $PesquisaPreco . "%'
        OR QtePagLivro = '" . $Pesquisa . "%'";

        if ($Pesquisa == "")
            $sql = "SELECT * FROM livro";

        $response = Sql($sql);

        $index = 0;
        $dataArray = [];

        //Cria um vetor de objetos para ser convertido no formato JSON
        while ($row = mysqli_fetch_assoc($response)) {

            //Formata o Preço do livro em R$
            if ($row["PrecoLivro"])
                $row["PrecoLivro"] = $this->FormatarPreco($row["PrecoLivro"], true);

            if ($row["DataInclusao"]) 
                $row["DataInclusao"] = date_format(date_create($row["DataInclusao"]), "d/m/Y H:i:s");
            

            if ($row["DataEdicao"]) 
                $row["DataEdicao"] = date_format(date_create($row["DataEdicao"]), "d/m/Y H:i:s");

            $dataArray[$index] = $row;
            $index++;
        }

        echo json_encode($dataArray);
    }

    function Editar($data)
    {

        //Verifica se exite um outro livro com o mesmo nome
        $sql = "SELECT * FROM livro WHERE NomeLivro = '" . $data["NomeLivro"] . "' AND IdLivro != '" . $data["IdLivro"] . "'";
        $resposta = Sql($sql, 1, 1);

        //Formata o Preço do livro no formato da DB
        $data["PrecoLivro"] = $this->FormatarPreco($data["PrecoLivro"]);

        //Verifica se exite campo NomeLivro no vetor. Senão exitir, altera somente o campo LivroAtivo do DB.
        if (($resposta == 0) && (!array_key_exists("NomeLivro", $data))) {
            $sql = "UPDATE livro SET LivroAtivo = '" . $data["LivroAtivo"] . "' WHERE IdLivro = '" . $data["IdLivro"] . "'";

            echo Sql($sql);
        }

        //Verifica se todos os campos estão corretos
        else if (($resposta == 0) && ($data["NomeLivro"] != "") && (($data["AutorLivro"] != "")) && ($data["QtePagLivro"] > 0) && ($data["PrecoLivro"] > 0)) {

            $sql = "UPDATE livro SET 
            NomeLivro = '" . $data["NomeLivro"] . "',
            AutorLivro = '" . $data["AutorLivro"] . "',
            QtePagLivro = '" . $data["QtePagLivro"] . "',
            PrecoLivro = '" . $data["PrecoLivro"] . "',
            LivroAtivo = '" . $data["LivroAtivo"] . "'
            WHERE IdLivro = '" . $data["IdLivro"] . "'";

            echo Sql($sql);
        }

        //Retorna 0 em caso de algo errado
        else echo 0;
    }

    function Deletar($data)
    {
        $IdLivro = $data["IdLivro"];

        $sql = "DELETE FROM livro WHERE IdLivro = '" . $IdLivro . "'";

        echo Sql($sql);
    }

    function FormatarPreco($preco, $converterParaRS = false)
    {
        if (!$converterParaRS) {
            $preco = str_replace(".", "", $preco);
            $preco = str_replace(",", ".", $preco);
        } else
            $preco = number_format($preco, 2, ",", ".");

        return $preco;
    }
}
