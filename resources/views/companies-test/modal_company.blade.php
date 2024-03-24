<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dados da Empresa</h5>
                <button type="button" class="closeA" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="alert alert-danger" id="erroData" style="display:none;">
                    <ul></ul>
                </div>

                <form id="formCompany" name="formCompany" class="needs-validation" novalidate>
                    @csrf
                    <input id="id" type="hidden" name="id">
                    <div class="form-row">
                        <div name="" id="" class="form-group col-md-4">
                            <label for="origin_desc">CNPJ</label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="CNPJ"
                                value="">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="name">Nome Fantasia</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Nome Fantasia" value="">
                        </div>

                        <div class="form-group col-md-4" hidden>
                            <label for="user_name">Email</label>
                            <p id="user_name" name="user_name">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="status_id">Situação</label>
                            <input type="text" id="status" name="status" class="form-control"
                                placeholder="Situação" value="">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cnaes_id">Atividade Principal</label>
                            <input type="text" id="cnaes_id" name="cnaes_id" class="form-control"
                                placeholder="Atividade Principal" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="legal_forms">Natureza Juridica</label>
                            <input type="text" id="legal_forms" name="legal_forms" class="form-control"
                                placeholder="Natureza Juridica" value="">
                        </div>

                    </div>
                    <br>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger closeA" data-dismiss="modal">Fechar</button>
                <button id="btnSalvar" type="submit" class="btn btn-outline-dark store"
                    value="store">Confirmar</button>
            </div>

        </div>
    </div>
</div>
</div>
