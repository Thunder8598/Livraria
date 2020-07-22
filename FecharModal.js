const FecharModal = (idModal, idDiv = []) => {
    idDiv.map((id) => {
        document.getElementById(id).innerHTML = "";
    });

    document.getElementById(idModal).className = 'form-off';
    document.getElementById('btn-limpar').click();
}