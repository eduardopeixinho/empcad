@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Cadastro de Empresas</h1>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
        <div class="pull-right mb-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-dark create my-4" data-toggle="modal" data-target="#staticBackdrop">
                Nova Empresa
            </button>
        </div>

        <div class="table-responsive">
            <table class="table-striped table-sm data-table table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">Situação</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">Atividade Principal</th>
                        <th scope="col">Natureza Juridica</th>
                        <th scope="col">Data Cadastro</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </main>

    <!-- Modal - Solicitação -->
    @include('companies.modal_company')
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "10000",
                "hideDuration": "10000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            var url = "./js/pt-BR.json";
            var table = $(".data-table").DataTable({
                language: {
                    url: url
                },
                serverSide: true,
                processing: true,
                ajax: "{{ route('companies.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'cnpj',
                        name: 'cnpj'
                    },
                    {
                        data: 'cnaes_id',
                        name: 'cnaes_id'
                    },
                    {
                        data: 'legal_forms',
                        name: 'legal_forms'
                    },

                    {
                        data: 'dt_estabilishment',
                        name: 'dt_estabilishment'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('body').on('click', '.store', function(e) {
                e.preventDefault();
                $(this).html('Confirmar');
                $.ajax({
                    data: $("#formCompany").serialize(),
                    url: "{{ route('companies.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $("#formCompany").trigger("reset");
                        $("#staticBackdrop").modal('hide');
                        $("#btnEditar").removeClass("update");
                        $('#btnEditar').prop('id', 'btnSalvar');
                        $("#btnSalvar").addClass("store");
                        $("#btnSalvar").value = "store";
                        $(".print-error-msg").css('display', 'none');
                        toastr.success(data.success)
                        table.draw();
                        $("#formCompany").preventDoubleSubmission();
                    },
                    error: function(data) {
                        //console.log('Error:', data);
                        var msg = data.responseJSON.errors;
                        //alert(msg)
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display', 'block');
                        $.each(msg, function(key, value) {
                            $(".print-error-msg").find("ul").append('<li>' + value +
                                '</li>');
                        });
                        $("#btnSalvar").html('Confirmar');
                    }
                });
                e.preventDefault(); //STOP default action
                $(".update").unbind();
            });




        });
    </script>
@endsection
