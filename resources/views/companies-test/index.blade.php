@extends('layouts.app')


@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Empresas</h3>
        </div>
    </div>
    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-3">
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
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </main>

    <!-- Modal - Solicitação -->
    @include('companies-test.modal_company')

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
                ajax: "{{ route('companies-test.index') }}",
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
                    url: "{{ route('companies-test.store') }}",
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


            $('body').on('click', '.closeA', function() {
                $("#formCompany").trigger("reset");
                $("#btnEditar").removeClass("update");
                $('#btnEditar').prop('id', 'btnSalvar');
                $("#btnSalvar").addClass("store");
                $("#btnSalvar").value = "store";
                $(".print-error-msg").css('display', 'none');
                table.draw();
            });
            $('body').on('click', '.delete', function() {
                if (confirm("Confirma Exclusão?") == true) {
                    var id = $(this).data('id');
                    var token = "{{ csrf_token() }}";
                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('companies-test') }}" + '/' + id + '/delete',
                        data: {
                            id: id,
                            _token: token
                        },
                        dataType: 'json',
                        success: function(data) {
                            toastr.success(data.success)
                            table.draw();
                        }
                    });
                }
            });

            $('body').on('click', '.edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.get("{{ url('companies-test') }}" + "/" + id + "/edit", function(data) {
                    $("modalHeading").html("Editar Empresa");
                    $('#staticBackdrop').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#status').val(data.status);
                    $('#cnpj').val(data.cnpj);
                    $('#cnaes_id').val(data.cnaes_id);
                    $('#legal_forms').val(data.legal_forms);

                    $("#btnSalvar").removeClass("store");
                    $('#btnSalvar').prop('id', 'btnEditar');
                    $("#btnEditar").addClass("update");
                    $("#btnEditar").value = "update";
                    $(".print-error-msg").css('display', 'none');

                    $("#formCompany").preventDoubleSubmission();
                });

                $("body").on('click', '.update', function(e) {
                    e.preventDefault();
                    var id = $('#id').val();
                    $(this).html('Confirmar');
                    $.ajax({
                        data: $("#formCompany").serialize(),
                        url: "{{ url('companies-test') }}" + '/' + id,
                        type: "PUT",
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
                            var msg = data.responseJSON.errors;

                            $(".print-error-msg").find("ul").html('');
                            $(".print-error-msg").css('display', 'block');
                            $.each(msg, function(key, value) {
                                $(".print-error-msg").find("ul").append('<li>' +
                                    value + '</li>');
                            });
                            $("#btnEditar").html('Confirmar');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    $(".update").unbind();
                    // e.off(); //unbind. to stop multiple form submit.
                });

                // jQuery plugin to prevent double submission of forms
                jQuery.fn.preventDoubleSubmission = function() {
                    $(this).on('submit', function(e) {
                        var $form = $(this);

                        if ($form.data('submitted') === true) {
                            // Previously submitted - don't submit again
                            e.preventDefault();
                        } else {
                            // Mark it so that the next submit can be ignored
                            $form.data('submitted', true);
                        }
                    });

                    // Keep chainability
                    return this;
                };

            });
        });
    </script>
@endsection
