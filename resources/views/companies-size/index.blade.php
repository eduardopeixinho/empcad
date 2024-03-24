@extends('layouts.app')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Papéis</h3>
        </div>
    </div>
    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
        <!-- Button trigger modal -->

        <button type="button" class="btn btn-outline-dark create my-1" data-toggle="modal" data-target="#staticBackdrop">
            Nova Empresa
        </button>

        <div class="table-responsive">
            <table class="table-striped table-sm data-table table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Data da Inclusão</th>
                        <th scope="col">Data da Atualização</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </main>

    @include('companies-size.form_companies-size')

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
                ajax: "{{ route('companies-size.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            $('body').on('click', '.create', function(e) {
                e.preventDefault();
                $.get("{{ url('companies-size') }}/create", function(data) {
                    $('#staticBackdrop').modal('show');
                    $("#staticBackdropLabel").html("Incluir Porte da Empresa");
                    $(".print-error-msg").css('display', 'none');

                });
            });
            $('body').on('click', '.store', function(e) {
                e.preventDefault();
                $(this).html('Confirmar');
                $.ajax({
                    data: $("#formCompanySize").serialize(),
                    url: "{{ route('companies-size.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $("#formCompanySize").trigger("reset");
                        $("#staticBackdrop").modal('hide');
                        $("#btnEditar").removeClass("update");
                        $('#btnEditar').prop('id', 'btnSalvar');
                        $("#btnSalvar").addClass("store");
                        $("#btnSalvar").value = "store";
                        $(".print-error-msg").css('display', 'none');
                        toastr.success(data.success)
                        table.draw();
                        $("#formCompanySize").preventDoubleSubmission();
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

            $('body').on('click', '.delete', function() {
                if (confirm("Confirma Exclusão?") == true) {
                    var id = $(this).data('id');
                    $.ajax({
                        type: "POST",
                        url: "{{ url('companies-size') }}" + '/' + id + "/delete",
                        data: {
                            id: id
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
                $.get("{{ url('companies-size') }}" + "/" + id + "/edit", function(data) {
                    $("modalHeading").html("Editar Porte da Empresa");
                    $('#staticBackdrop').modal('show');
                    $('#id').val(data.id);
                    $('#description').val(data.description);

                    $("#btnSalvar").removeClass("store");
                    $('#btnSalvar').prop('id', 'btnEditar');
                    $("#btnEditar").addClass("update");
                    $("#btnEditar").value = "update";
                    $(".print-error-msg").css('display', 'none');

                    $("#formCompanySize").preventDoubleSubmission();
                });

                $("body").on('click', '.update', function(e) {
                    e.preventDefault();
                    var id = $('#id').val();
                    $(this).html('Confirmar');
                    $.ajax({
                        data: $("#formCompanySize").serialize(),
                        url: "{{ url('companies-size') }}" + '/' + id,
                        type: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $("#formCompanySize").trigger("reset");
                            $("#staticBackdrop").modal('hide');
                            $("#btnEditar").removeClass("update");
                            $('#btnEditar').prop('id', 'btnSalvar');
                            $("#btnSalvar").addClass("store");
                            $("#btnSalvar").value = "store";
                            $(".print-error-msg").css('display', 'none');
                            toastr.success(data.success)
                            table.draw();
                            $("#formCompanySize").preventDoubleSubmission();
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

                $('body').on('click', '.closeA', function() {
                    $("#formCompanySize").trigger("reset");
                    $("#staticBackdrop").modal('hide');
                    $("#btnEditar").removeClass("update");
                    $('#btnEditar').prop('id', 'btnSalvar');
                    $("#btnSalvar").addClass("store");
                    $("#btnSalvar").value = "store";
                    $(".print-error-msg").css('display', 'none');
                    table.draw();
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

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });
    </script>
@endsection
