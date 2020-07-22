const CadastrarLivro = () => {

    const form = document.getElementById("Form-Cadastro");

    const data = new FormData(form);

    //Informa ao Actions.php qual método executar
    data.append("Metodo", "Cadastrar");

    const AjaxParams = {
        url: "Actions.php",
        type: "POST",
        data,
    }

    const CallBackFunction = (response) => {
        $("#aviso-cadastrar").html("");

        const aviso = response === "1" ?
            '<div class="alert alert-success" role="alert"> Livro cadastrado com sucesso. </div>' :
            '<div class="alert alert-danger" role="alert"> Esse livro já está cadastrado!!!/Não foi possível cadastar esse livro. </div>';

        setTimeout(() => $("#aviso-cadastrar").html(aviso), 32);
    };

    Ajax(AjaxParams, CallBackFunction);
}

const ConsultarLivro = (listarTudo = false) => {

    if (!listarTudo) {
        const form = document.getElementById("Form-Consulta");
        data = new FormData(form);
    }

    else {
        data = new FormData();
        data.append("Pesquisa", "");
    }

    //Informa ao Actions.php qual método executar
    data.append("Metodo", "Consultar");

    const AjaxParams = {
        url: "Actions.php",
        type: "POST",
        data,
    }

    const CallBackFunction = (response) => {

        //Limpa quaisquer dados nas divs
        $("#aviso-consultar").html("");
        $("#livros-achados").html("");

        const livrosDiv = document.getElementById("livros-achados");

        if ((response === "[]") || (response === "0")) {
            setTimeout(() => $("#aviso-consultar").html("<div class='alert alert-warning' role='alert'>Livro não encontrado.</div>"), 32);
            return;
        }

        //Converte string do php para json do js
        const LivrosAchados = JSON.parse(response);

        /* Cria a seguinte estrutura no HTML:
        <div>
            <h5>Texto - texto</h5>
            <h6>Texto - texto</h6>
            <button>Texto</button>
            <button>Texto</button>
            <button>Texto</button>
        </div>
        */
        LivrosAchados.map((livro) => {
            const div = document.createElement("div");

            const hr = document.createElement("hr");

            let buttons = [
                {
                    element: document.createElement("button"),
                    label: document.createTextNode(!(Number(livro.LivroAtivo)) ? "Marcar como disponível" : "Marcar como indisponível"),
                    event: () => EditarLivro(false, livro),
                }, {
                    element: document.createElement("button"),
                    label: document.createTextNode("Deletar Livro"),
                    event: () => DeletarLivro(livro.IdLivro),
                }, {
                    element: document.createElement("button"),
                    label: document.createTextNode("Editar Livro"),
                    event: () => PreencheFormLivro(livro),
                }
            ];

            let Hs = [
                {
                    element: document.createElement("h5"),
                    label: document.createTextNode(`${livro.NomeLivro} - ${livro.AutorLivro}`),
                }, {
                    element: document.createElement("h6"),
                    label: document.createTextNode(`Páginas: ${livro.QtePagLivro} - R$ ${livro.PrecoLivro}`),
                }, {
                    element: document.createElement("h6"),
                    label: document.createTextNode(`Data de Inclusão: ${livro.DataInclusao} - Última modificação: ${livro.DataEdicao}`),
                }
            ];


            //Implementa os elementos na div filha
            Hs.map((h) => {
                h.element.appendChild(h.label);
                div.appendChild(h.element);
            });

            buttons.map((btn) => {
                btn.element.appendChild(btn.label);
                btn.element.className = "btn btn-link";
                btn.element.addEventListener("click", btn.event);
                btn.element.type = "button";

                div.appendChild(btn.element);
            });

            div.appendChild(hr);

            //Implemeta a div filha na div pai
            setTimeout(() => livrosDiv.appendChild(div), 32);
        });
    }

    Ajax(AjaxParams, CallBackFunction);
}

const EditarLivro = (editarTudo = true, Livro = null) => {

    let data;

    //Altera LivroAtivo
    if (!editarTudo) {
        data = new FormData();

        Livro.LivroAtivo = Number(Livro.LivroAtivo) ? 0 : 1;

        data.append("IdLivro", Livro.IdLivro);
        data.append("LivroAtivo", Livro.LivroAtivo);
    }

    //Altera toda a DB
    else {
        const form = document.getElementById("Form-Editar");

        data = new FormData(form);
    }

    //Informa ao Actions.php qual método executar
    data.append("Metodo", "Editar");

    const AjaxParams = {
        url: "Actions.php",
        type: "POST",
        data,
    }

    const CallBackFunction = (response) => {

        $("#aviso-editar").html("");

        const aviso = response === "1" ?
            '<div class="alert alert-success" role="alert"> Livro editado com sucesso. </div>' :
            '<div class="alert alert-danger" role="alert"> Não Foi possível editar esse livro. </div>';

        setTimeout(() => $("#aviso-editar").html(aviso), 32);

        ConsultarLivro(true);
    };

    Ajax(AjaxParams, CallBackFunction);
}

const DeletarLivro = (idLivro) => {

    if (!confirm("Deseja realmente excluir esse livro?"))
        return;

    const data = new FormData();

    data.append("IdLivro", idLivro);

    //Informa ao Actions.php qual método executar
    data.append("Metodo", "Deletar");

    const AjaxParams = {
        url: "Actions.php",
        type: "POST",
        data,
    };

    const CallBackFunction = (response) => {

        if (response === "1") {
            setTimeout(() => {
                $("#aviso-consultar").html("<div class='alert alert-warning' role='alert'>Livro excluído.</div>");
                ConsultarLivro(true);
            }, 32);
        }

        else setTimeout(() => $("#aviso-consultar").html("<div class='alert alert-danger' role='alert'>Não foi possível excluir o livro.</div>"), 32);
    }

    Ajax(AjaxParams, CallBackFunction);
}

//Esse método Preenche o Form-Editar. É atribuido ao button pelo método ConsultarLivro.  
const PreencheFormLivro = (Livro) => {

    //FecharModal("consultar-modal");
    document.getElementById("editar-modal").className = "form-on shadow";

    const form = document.getElementById("Form-Editar");

    //Desestrutura os campos do Form-Editar
    const {
        IdLivro,
        NomeLivro,
        AutorLivro,
        QtePagLivro,
        PrecoLivro,
        LivroAtivo,
    } = form;

    //Atrubui aos campos do Form-Editar valores do Livro
    IdLivro.value = Livro.IdLivro;
    NomeLivro.value = Livro.NomeLivro;
    AutorLivro.value = Livro.AutorLivro;
    QtePagLivro.value = Livro.QtePagLivro;
    PrecoLivro.value = Livro.PrecoLivro;
    LivroAtivo.value = Livro.LivroAtivo;
}

//Função genérica AJAX
const Ajax = (params, callback) => {
    $.ajax({
        url: params.url,
        type: params.type,
        data: params.data,
        enctype: "form-data",
        contentType: false,
        processData: false,
        success: callback,
    });
}