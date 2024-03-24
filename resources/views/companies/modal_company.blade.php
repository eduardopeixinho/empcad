<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dados da Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                    <div class="form-row">
                        <div name="" id="" class="form-group col-md-4">
                            <label for="origin_desc">CNPJ</label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="CNPJ"
                                value="">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="user_name">Nome Fantasia</label>
                            <input type="text" id="user" name="user" class="form-control"
                                placeholder="Nome Fantasia" value="">
                        </div>

                        <div class="form-group col-md-4" hidden>
                            <label for="user_name">Email</label>
                            <p id="user_name" name="user_name">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="dt_estabilishment">Data de abertura</label>
                            <input type="date" id="dt_estabilishment" name="dt_estabilishment"
                                min={{ date('Y-m-d') }}>
                        </div>


                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="cnaes_id">Atividade Principal</label>
                            <select id="cnaes_id" name="cnaes_id" class="form-control">

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="legal_forms_id">Natureza Juridica</label>
                            <select id="legal_forms_id" name="legal_forms_id" class="form-control">

                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="status_id">Situação</label>
                            <select id="status_id" name="status_id" class="form-control">

                            </select>
                        </div>

                    </div>
                    <br>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger mclose" data-dismiss="modal">Fechar</button>
                <button id="btnSalvar" type="submit" class="btn btn-outline-dark store"
                    value="create">Confirmar</button>
            </div>

        </div>
    </div>
</div>
</div>
