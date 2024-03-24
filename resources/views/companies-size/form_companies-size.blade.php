    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Porte da Empresa</h5>
                    <button type="button" class="close closeA" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="formCompanySize" name="formCompanySize">
                        @csrf
                        <input id="id" type="hidden" name="id">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="description">Descrição</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    placeholder="Porte da Empresa">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger closeA" data-dismiss="modal">Fechar</button>
                    <button id="btnSalvar" type="submit" class="btn btn-outline-dark store"
                        value="">Confirmar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
