@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-outline-dark btn-sm" href="{{ route('structs.index') }}" role="button">Voltar</a>
    @can(config('system_settings.btn_permission.edit_struct'))
        <button type="button" class="btn btn-outline-dark btn-sm edit-struct">
            Editar Unidade
        </button>
    @endcan
    @can(config('system_settings.btn_permission.add_address'))
        <button type="button" class="btn btn-outline-dark btn-sm create-address" data-toggle="modal" data-target="#staticBackdrop">
            Incluir Endereço
        </button>
    @endcan
    @can(config('system_settings.btn_permission.add_network'))
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-dark btn-sm create-network" data-toggle="modal"
            data-target="#staticBackdrop2">
            Incluir Rede
        </button>
    @endcan
@stop

@section('content')
    <input id="struct_id" type="text" name="struct_id" value="{{ $struct['id'] }}" hidden>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Dados da Unidade</h3>
        </div>
        <div class="card-body">
            @include('unidades.form_struct')

        </div>
        <div class="modal-footer">
            <button id="btnCancelar_S" type="button" class="btn btn-outline-danger close-struct" hidden disabled>
                Cancelar
            </button>
            <button id="btnEditar_S" type="submit" class="btn btn-outline-dark edit-struct" value="">Habilitar
                Edição</button>
        </div>

    </div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Endereços</h3>
        </div>

        <main class="ms-sm-auto col-lg-12">
            <div class="pull-right mb-2">

            </div>

            <div class="table-responsive">
                <table class="table-striped table-sm data-table table">
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Tipo de Endereço</th>
                            <th scope="col">Logradouro</th>
                            <th scope="col">Nº</th>
                            <th scope="col">Complemento</th>
                            <th scope="col">Bairro</th>
                            <th scope="col">CEP</th>
                            <th scope="col">UF</th>
                            <th scope="col">Município</th>
                            <th scope="col">Dados de Contato</th>
                            <!--   <th scope="col">Dt Criação</th> -->
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </main>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Redes</h3>
        </div>

        <main class="ms-sm-auto col-lg-12">
            <div class="pull-right mb-2">

            </div>

            <div class="table-responsive">
                <table class="table-striped table-sm data-table2 table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Estrutura</th>
                            <th scope="col">Escopo de Rede</th>
                            <th scope="col">Data da Inclusão</th>
                            <th scope="col">Data da Atualização</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Dados do Endereço</h5>
                    <button type="button" class="close close-address" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form id="formAddress" name="formAddress">
                        @csrf
                        <fieldset id="form_addreses_view">
                            <input id="me_structs_id" name="me_structs_id" type="text" value="{{ $struct['id'] }}"
                                hidden>
                            <input id="addresses_id" name="addresses_id" type="text" value="" hidden>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="address_types">Tipo de Endereço</label>
                                    <select name="address_types" id="address_types" class="form-control">

                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="street_address">Logradouro</label>
                                    <input type="text" name="street_address" id="street_address"
                                        class="form-control">

                                </div>
                                <div class="form-group col-md-1">
                                    <label for="number">Número</label>
                                    <input type="text" name="number" id="number" class="form-control">
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="comp_address">Complemento</label>
                                    <input type="text" name="comp_address" id="comp_address" class="form-control">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="district">Bairro</label>
                                    <input type="text" name="district" id="district" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="state">UF</label>
                                    <select name="state" id="state" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">Município</label>
                                    <select name="city" id="city" class="form-control" disabled>

                                    </select>

                                </div>
                                <div class="form-group col-md-2">
                                    <label for="zip_code">CEP</label>
                                    <input type="text" name="zip_code" id="zip_code" class="form-control">

                                </div>
                            </div>
                            <span id="contact_list">

                            </span>
                        </fieldset>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger close-address"
                        data-dismiss="modal">Fechar</button>
                    <button id="btnSalvarE" type="submit" class="btn btn-outline-dark store-address"
                        value="">Confirmar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Usuário -->
    <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdrop2Label">Dados da Rede</h5>
                    <button type="button" class="close closeB" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg-network" style="display:none">
                        <ul></ul>
                    </div>
                    <form id="formNetwork" name="formNetwork">
                        @csrf
                        <fieldset id="form_network_view">
                            <input id="me_structs_id" name="me_structs_id" type="text" value="{{ $struct['id'] }}"
                                hidden>
                            <input id="id_network" name="id_network" type="text" value="" hidden>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="list_address_id">Endereço</label>
                                    <select name="list_address_id" id="list_address_id" class="form-control">

                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="struct">Estrutura</label>
                                    <input type="text" name="struct" id="struct" class="form-control"
                                        placeholder="Estrutura: MPS, MTP, Fazenda, PF etc">

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="network_scope">Escopo de Rede</label>
                                    <input type="text" name="network_scope" id="network_scope" class="form-control">
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div id="modal_footer" class="modal-footer">
                    <button type="button" class="btn btn-outline-danger close-network" data-dismiss="modal">
                        Fechar
                    </button>
                    <button id="btnSalvarF" type="submit" class="btn btn-outline-dark store-network"value="">
                        Confirmar
                    </button>


                </div>
            </div>
        </div>



    @stop

    @section('css')
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    @stop

    @section('js')
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script> -->
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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
                var data_url = document.getElementById('struct_id').value;
                var struct_id = data_url;
                $.get("{{ url('structs') }}/" + struct_id + "/show", function(data) {
                    $('#form_view').attr('disabled', true);
                    $("#btnSalvar").removeClass("store");
                    $('#btnSalvar').prop('id', 'btnEditar');
                    $("#btnEditar").addClass("edit");
                    $("#btnEditar").html('Habilitar Edição');

                    $('#id').val(data.struct.id);
                    $('#me_structs_id').val(data.struct.id);
                    $('#type_struct').val(data.struct.type_struct_id);
                    $('#order').val(data.struct.order);
                    $('#code').val(data.struct.code);
                    $('#acronym').val(data.struct.acronym);
                    $('#title_struct').val(data.struct.title);
                    $('#description').val(data.struct.description);
                    $('#parent_id').val(data.struct.parent_id);
                    $('#siorg_id').val(data.struct.siorg_id);
                    $('#siorg_father_id').val(data.struct.siorg_father_id);
                    $('#list').val(data.struct.list);
                    $('#uf_struct').val(data.struct.uf_struct);
                    $('#status').val(data.struct.status);
                    $('#holder').val(data.struct.holder);
                    $('#substitute').val(data.struct.substitute);
                });

                var url = "../../js/pt-BR.json";
                var table = $(".data-table").DataTable({
                    language: {
                        url: url
                    },
                    serverSide: true,
                    processing: true,
                    ajax: "{{ url('structs') }}" + '/' + data_url + '/address',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'address_types_id',
                            name: 'address_types_id'
                        },
                        {
                            data: 'street_address',
                            name: 'street_address'
                        },
                        {
                            data: 'number',
                            name: 'number'
                        },
                        {
                            data: 'comp_address',
                            name: 'comp_address'
                        },
                        {
                            data: 'district',
                            name: 'district'
                        },
                        {
                            data: 'zip_code',
                            name: 'zip_code'
                        },
                        {
                            data: 'state',
                            name: 'state'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'contact',
                            name: 'contact'
                        },
                        /*{
                            data: 'created',
                            name: 'created_at'
                        },*/
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });

                var table2 = $(".data-table2").DataTable({
                    language: {
                        url: url
                    },
                    serverSide: true,
                    processing: true,
                    ajax: "{{ url('addresses') }}" + '/' + data_url + '/networks',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'addresses_id',
                            name: 'addresses_id'
                        },
                        {
                            data: 'struct',
                            name: 'struct'
                        },
                        {
                            data: 'network_scope',
                            name: 'network_scope'
                        },
                        {
                            data: 'created',
                            name: 'created_at'
                        },
                        {
                            data: 'updated',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });

                $('body').on('click', '.edit-struct', function(e) {
                    e.preventDefault();
                    $('#form_view').attr('disabled', false);
                    //$('#btnEditar').attr('disabled', false);
                    // $('#btnEditar').attr('hidden', false);
                    $('#btnCancelar_S').attr('disabled', false);
                    $('#btnCancelar_S').attr('hidden', false);
                    $("#btnEditar_S").html('Atualizar');
                    $("#btnEditar_S").removeClass("edit-struct");
                    $("#btnEditar_S").addClass("update-struct");
                });

                $('body').on('click', '.close-struct', function(e) {
                    $('#form_view').attr('disabled', true);
                    //$('#btnEditar').attr('disabled', true);
                    //$('#btnEditar').attr('hidden', true);
                    $('#btnCancelar_S').attr('disabled', true);
                    $('#btnCancelar_S').attr('hidden', true);
                    $("#btnEditar_S").html('Habilitar Edição');
                    $("#btnEditar_S").removeClass("update-struct");
                    $("#btnEditar_S").addClass("edit-struct");
                    //location.reload();
                });

                $("body").on('click', '.update-struct', function(e) {
                    e.preventDefault();
                    var id = $('#id').val();
                    $.ajax({
                        data: $("#formStruct").serialize(),
                        url: "{{ url('structs') }}" + '/' + id,
                        type: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $('#form_view').attr('disabled', true);
                            // $('#btnEditar').attr('disabled', true);
                            //$('#btnEditar').attr('hidden', true);
                            $('#btnCancelar_S').attr('disabled', true);
                            $('#btnCancelar_S').attr('hidden', true);
                            $("#btnEditar_S").html('Habilitar Edição');
                            $("#btnEditar_S").removeClass("update-struct");
                            $("#btnEditar_S").addClass("edit-struct");
                            toastr.success(data.success)
                            table.draw();
                            $("#formStruct").preventDoubleSubmission();

                        },
                        error: function(data) {
                            //console.log('Error:', data);
                            var msg = data.responseJSON.errors;
                            //alert(msg)
                            $(".print-error-msg").find("ul").html('');
                            $(".print-error-msg").css('display', 'block');
                            $.each(msg, function(key, value) {
                                $(".print-error-msg").find("ul").append('<li>' +
                                    value + '</li>');
                            });
                            $("#btnEditar_S").html('Atualizar');
                        }
                    });
                    e.preventDefault(); //STOP default action
                    $(".update").unbind();
                    // e.off(); //unbind. to stop multiple form submit.
                });

                $('body').on('click', '.create-address', function(e) {
                    e.preventDefault();
                    $.get("{{ url('addresses') }}/create", function(data) {
                        var opt_address_types = '<option value="0">Selecione a Unidade</option>';
                        $.each(data.address_types, function(key, obj) {
                            //alert(value.acronym);
                            opt_address_types += '<option value="' + obj.id + '" title="' + obj
                                .address_types +
                                '">' + obj.description + '</option>';
                        });
                        $('#address_types').html(opt_address_types);
                        var opt_states = '<option value="0">Selecione uma UF</option>';
                        $.each(data.states, function(key, obj) {
                            opt_states += '<option value="' + obj.uf_code + '" title="' + obj
                                .uf_description +
                                '">' + obj.uf_description + '</option>';
                        });
                        $('#state').html(opt_states);

                        var contact = '<div id="contact_list_A" class="form-row">'

                        contact += '<div class="form-group col-md-4">' +
                            '<label for="telefone">Telefone</label>' +
                            '<input type="text" name="telefone" id="telefone" class="form-control" placeholder="(55) (DDD) 000000000, (55) (DDD) 000000000" value="">' +
                            '</div>';

                        contact += '<div class="form-group col-md-4">' +
                            '<label for="email">Email</label>' +
                            '<input type="text" name="email" id="email" class="form-control" placeholder="alias@dominio.gov.br, alias@dominio.gov.br" value="">' +
                            '</div>';

                        contact += '<div class="form-group col-md-4">' +
                            '<label for="site">Site</label>' +
                            '<input type="text" name="site" id="site" class="form-control" placeholder="unidade.gov.br, unidade.gov.br" value="">' +
                            '</div>';
                        contact += '</div>'

                        $('#contact_list').append(contact);

                    });
                });

                $("#state").change(function() {
                    $('#city').attr('disabled', false);
                    var id = document.getElementById('state').value;
                    $.get("{{ url('addresses') }}/" + id + "/cities", function(data) {
                        var opt_cities = '<option value="0">Selecione um Município</option>';
                        $.each(data.cities, function(key, obj) {
                            opt_cities += '<option value="' + obj.code_city + '" title="' + obj
                                .city_description +
                                '">' + obj.city_description + '</option>';
                        });
                        $('#city').html(opt_cities);
                    });
                });

                $('body').on('click', '.store-address', function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#formAddress").serialize(),
                        url: "{{ route('addresses.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $("#formAddress").trigger("reset");
                            $("#staticBackdrop").modal('hide');
                            $("#contact_list_A").remove();
                            toastr.success(data.success)
                            table.draw();
                        },
                        error: function(data) {
                            var msg = data.responseJSON.errors;
                            $(".print-error-msg").find("ul").html('');
                            $(".print-error-msg").css('display', 'block');
                            $.each(msg, function(key, value) {
                                $(".print-error-msg").find("ul").append('<li>' + value +
                                    '</li>');
                            });
                        }
                    });
                });

                $('body').on('click', '.detail-address', function(e) {
                    e.preventDefault();
                    $('#staticBackdrop').modal('show');
                    $('#form_addreses_view').attr('disabled', true);
                    $("#btnSalvarE").removeClass("store-address");
                    $("#btnSalvarE").addClass("edit-address");
                    $("#btnSalvarE").value = "edit-address";
                    $("#btnSalvarE").html('Habilitar Edição');

                    var id = $(this).data('id');
                    $.get("{{ url('addresses') }}" + "/" + id + "/edit", function(data) {
                        var opt_address_types =
                            '<option value="0">Selecione o Tipo de endereço</option>';
                        $.each(data.address_types, function(key, obj) {
                            if (obj.id == data.address.address_types_id) {
                                opt_address_types += '<option value="' + obj.id + '" title="' +
                                    obj
                                    .description +
                                    '" selected>' + obj.description + '</option>';
                            } else {
                                opt_address_types += '<option value="' + obj.id + '" title="' +
                                    obj
                                    .description +
                                    '">' + obj.description + '</option>';
                            }

                        });
                        var opt_state = '<option value="0">Selecione a UF</option>';
                        $.each(data.states, function(key, obj) {
                            if (obj.uf_code == data.address.state) {
                                opt_state += '<option value="' + obj.uf_code + '" title="' + obj
                                    .uf_description +
                                    '" selected>' + obj.uf_description + '</option>';
                            } else {
                                opt_state += '<option value="' + obj.uf_code + '" title="' + obj
                                    .uf_description +
                                    '">' + obj.uf_description + '</option>';
                            }

                        });
                        var opt_cities = '<option value="' + data.district.code_city + '" title="' +
                            data.district
                            .city_description +
                            '" selected>' + data.district.city_description + '</option>';

                        var opt_cities = '<option value="0">Selecione a UF</option>';
                        $.each(data.district, function(key, obj) {
                            if (obj.code_city == data.address.city) {
                                opt_cities += '<option value="' + obj.code_city + '" title="' +
                                    obj
                                    .city_description +
                                    '" selected>' + obj.city_description + '</option>';
                            } else {
                                opt_cities += '<option value="' + obj.code_city + '" title="' +
                                    obj
                                    .city_description +
                                    '">' + obj.city_description + '</option>';
                            }

                        });

                        $('#addresses_id').val(data.address.id);
                        $('#address_types').html(opt_address_types);
                        $('#street_address').val(data.address.street_address);
                        $('#number').val(data.address.number);
                        $('#comp_address').val(data.address.comp_address);
                        $('#district').val(data.address.district);
                        $('#state').html(opt_state);
                        $('#city').html(opt_cities);
                        $('#zip_code').val(data.address.zip_code);

                        var contact = '<div id="contact_list_A" class="form-row">'

                        contact += '<div class="form-group col-md-4">' +
                            '<label for="telefone">Telefone</label>' +
                            '<input type="text" name="telefone" id="telefone" class="form-control" value="' +
                            data.telefone + '">' +
                            '</div>';

                        contact += '<div class="form-group col-md-4">' +
                            '<label for="email">Email</label>' +
                            '<input type="text" name="email" id="email" class="form-control" value="' +
                            data.email + '">' +
                            '</div>';

                        contact += '<div class="form-group col-md-4">' +
                            '<label for="site">Site</label>' +
                            '<input type="text" name="site" id="site" class="form-control" value="' +
                            data.site + '">' +
                            '</div>';
                        contact += '</div>'

                        $('#contact_list').append(contact);

                    });
                });

                $('body').on('click', '.edit-address', function() {
                    $('#form_addreses_view').attr('disabled', false);
                    $('#city').attr('disabled', false);
                    $("#btnSalvarE").removeClass("edit-address");
                    $("#btnSalvarE").addClass("update-address");
                    $("#btnSalvarE").value = "update-address";
                    $("#btnSalvarE").html('Atualizar');
                });

                $('body').on('click', '.update-address', function(e) {
                    e.preventDefault();
                    var id = document.getElementById('addresses_id').value;
                    $.ajax({
                        data: $("#formAddress").serialize(),
                        url: "{{ url('addresses') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        success: function(data) {
                            $("#formAddress").trigger("reset");
                            $("#staticBackdrop").modal('hide');
                            $("#btnSalvarE").removeClass("update-address");
                            $("#btnSalvarE").addClass("store-address");
                            $("#btnSalvarE").value = "store-address";
                            $("#contact_list_A").remove();
                            toastr.success(data.success)
                            table.draw();
                            $(".print-error-msg").css('display', 'none');
                        },
                        error: function(data) {
                            var msg = data.responseJSON.errors;
                            $(".print-error-msg").find("ul").html('');
                            $(".print-error-msg").css('display', 'block');
                            $.each(msg, function(key, value) {
                                $(".print-error-msg").find("ul").append('<li>' +
                                    value + '</li>');
                            });
                        }
                    });
                    e.preventDefault(); //STOP default action
                    $(".update-address").unbind();
                });

                $('body').on('click', '.close-address', function() {
                    $('#form_addreses_view').attr('disabled', false);
                    $('#city').attr('disabled', false);
                    $("#formAddress").trigger("reset");
                    $("#btnSalvarE").removeClass("update-address");
                    $("#btnSalvarE").removeClass("edit-address");
                    $("#btnSalvarE").addClass("store-address");
                    $("#btnSalvarE").html('Confirmar');
                    $("#contact_list_A").remove();
                    $(".print-error-msg").css('display', 'none');
                    table.draw();
                });

                $('body').on('click', '.create-network', function(e) {
                    e.preventDefault();
                    var data_url = document.getElementById('struct_id').value;
                    var struct_id = data_url;
                    $.get("{{ url('networks') }}/" + struct_id + "/create", function(data) {
                        var opt_address = '<option value="0">Selecione um endereço</option>';
                        $.each(data.addresses, function(key, obj) {
                            if (obj.comp_address == null) {
                                obj.comp_address = '';
                                var hiffen = '';
                            } else {
                                var hiffen = ' - ';
                            }
                            opt_address += '<option value="' + obj.id + '" title="' + obj.uf +
                                '">' + obj.street_address + hiffen + obj.comp_address +
                                '</option>';
                        });
                        $('#list_address_id').html(opt_address);

                    });

                });

                $('body').on('click', '.store-network', function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#formNetwork").serialize(),
                        url: "{{ route('networks.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $("#formNetwork").trigger("reset");
                            $("#staticBackdrop2").modal('hide');
                            $(".print-error-msg-network").css('display', 'none');
                            toastr.success(data.success)
                            table2.draw();
                        },
                        error: function(data) {
                            var msg = data.responseJSON.errors;
                            $(".print-error-msg-network").find("ul").html('');
                            $(".print-error-msg-network").css('display', 'block');
                            $.each(msg, function(key, value) {
                                $(".print-error-msg-network").find("ul").append('<li>' +
                                    value +
                                    '</li>');
                            });
                        }
                    });
                });

                $('body').on('click', '.detail-network', function(e) {
                    e.preventDefault();
                    $('#staticBackdrop2').modal('show');
                    $('#form_network_view').attr('disabled', true);
                    $("#btnSalvarF").removeClass("store-network");
                    $("#btnSalvarF").addClass("edit-network");
                    $("#btnSalvarF").value = "edit-network";
                    $("#btnSalvarF").html('Habilitar Edição');
                    var data_url = document.getElementById('struct_id').value;
                    var struct_id = data_url;
                    var id = $(this).data('id');
                    $.get("{{ url('networks') }}" + "/" + id + "/" + struct_id + "/edit", function(data) {
                        var opt_address = '<option value="0">Selecione um endereço</option>';
                        $.each(data.addresses, function(key, obj) {
                            if (obj.id == data.networks.addresses_id) {
                                if (obj.comp_address == null) {
                                    obj.comp_address = '';
                                    var hiffen = '';
                                } else {
                                    var hiffen = ' - ';
                                }
                                opt_address += '<option value="' + obj.id + '" title="' + obj
                                    .uf +
                                    '" selected>' + obj.street_address + hiffen + obj
                                    .comp_address +
                                    '</option>';
                            } else {
                                opt_address += '<option value="' + obj.id + '" title="' + obj
                                    .uf +
                                    '">' + obj.street_address + hiffen + obj.comp_address +
                                    '</option>';
                            }
                        });
                        $('#id_network').val(id);
                        $('#list_address_id').html(opt_address);
                        $('#struct').val(data.networks.struct);
                        $('#network_scope').val(data.networks.network_scope);
                        $(".print-error-msg-network").css('display', 'none');
                    });
                });

                $('body').on('click', '.edit-network', function() {
                    $('#form_network_view').attr('disabled', false);
                    $("#btnSalvarF").removeClass("edit-network");
                    $("#btnSalvarF").addClass("update-network");
                    $("#btnSalvarF").value = "update-network";
                    $("#btnSalvarF").html('Atualizar');
                });

                $('body').on('click', '.update-network', function(e) {
                    e.preventDefault();
                    var id = document.getElementById('id_network').value;
                    $.ajax({
                        data: $("#formNetwork").serialize(),
                        url: "{{ url('networks') }}" + '/' + id,
                        type: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $("#formNetwork").trigger("reset");
                            $("#staticBackdrop2").modal('hide');
                            $("#btnSalvarF").removeClass("update-network");
                            $("#btnSalvarF").addClass("store-network");
                            $("btnSalvarF").value = "store-network";
                            $(".print-error-msg-network").css('display', 'none');
                            toastr.success(data.success)
                            table2.draw();
                            $("#formNetwork").preventDoubleSubmission();
                        },
                        error: function(data) {
                            var msg = data.responseJSON.errors;
                            $(".print-error-msg-network").find("ul").html('');
                            $(".print-error-msg-network").css('display', 'block');
                            $.each(msg, function(key, value) {
                                $(".print-error-msg-network").find("ul").append('<li>' +
                                    value + '</li>');
                            });
                        }
                    });
                    e.preventDefault(); //STOP default action
                    $(".update-network").unbind();
                });

                $('body').on('click', '.close-network', function() {
                    $('#form_network_view').attr('disabled', false);
                    $("#formNetwork").trigger("reset");
                    $("#btnSalvarF").removeClass("update-network");
                    $("#btnSalvarF").removeClass("edit-network");
                    $("#btnSalvarF").addClass("store-network");
                    $("#btnSalvarF").html('Confirmar');
                    $(".print-error-msg-network").css('display', 'none');
                    table2.draw();
                });

                $('body').on('click', '.user-edit', function(e) {
                    e.preventDefault();
                    var user_id = document.getElementById('user_id').value;
                    $("#name_view").attr('readonly', true);
                    $('#form_view').attr('disabled', true);
                    $.get("{{ url('users') }}/" + user_id + "/edit", function(data) {
                        $('#struct_id').val(data.user_details.id);
                        var opt_user = '<option value="' + user_id + '" title="' + data.user_details
                            .email +
                            '">' + data.user_details.name + '</option>';
                        $('#name_view').html(opt_user);
                        $('#name').val(data.user_details.name);
                        $("#email").val(data.user_details.email);
                        $("#email_view").val(data.user_details.email);
                        $("#cpf").val(data.user_details.cpf);
                        $("#registration").val(data.user_details.registration);
                        var opt_struct = '<option value="' + data.user_details.me_structs_id +
                            '" selected>' + data.user_details.struct_desc + '</option>';

                        $('#me_structs_id').html(opt_struct);
                        //$('#me_structs_id').val(data.user_details.me_structs_id);
                        $('#cpf').val(data.user_details.cpf);
                        $('#uf').val(data.user_details.uf);
                        $('#position').val(data.user_details.position);
                        $('#schooling').val(data.user_details.schooling);
                        $('#dn').val(data.user_details.dn);
                        $('#retirement').val(data.user_details.retirement);
                        $('#home_organization').val(data.user_details.home_organization);
                        $('#email').val(data.user_details.email);
                        $('#email_view').val(data.user_details.email);
                        $('#situation').val(data.user_details.situation);
                        $('#funct').val(data.user_details.funct);
                        $('#funct_publication').val(data.user_details.funct_publication);

                    });
                });

                $("body").on('click', '.user-update', function(e) {
                    e.preventDefault();
                    var user_id = document.getElementById('user_id').value;
                    $(this).html('Confirmar');
                    $.ajax({
                        data: $("#formUser").serialize(),
                        url: "{{ url('users') }}" + '/' + user_id,
                        type: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $("#formUser").trigger("reset");
                            $("#staticBackdrop2").modal('hide');
                            toastr.success(data.success)
                            table.draw();
                            $("#formUser").preventDoubleSubmission();
                            location.reload();

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
                        }
                    });
                    e.preventDefault(); //STOP default action
                    $(".update").unbind();
                    // e.off(); //unbind. to stop multiple form submit.
                });

                $('body').on('click', '.closeA', function() {
                    $("#formUserRole").trigger("reset");
                    $("#btnEditar").removeClass("update");
                    $('#btnEditar').prop('id', 'btnSalvar');
                    $("#btnSalvar").addClass("store");
                    $("#btnSalvar").html('Confirmar');
                    table.draw();
                });

                $('body').on('click', '.closeB', function() {
                    $("#formUser").trigger("reset");
                    table.draw();
                });

                $('body').on('click', '.create', function(e) {
                    e.preventDefault();
                    var user_id = document.getElementById('user_id').value;
                    $.get("{{ url('users-roles') }}/" + user_id + "/new_role", function(data) {

                        $("#staticBackdropLabel").html("Atribuir Papel");

                        var opt_user = '<option value="0">Selecione um Usuario</option>';
                        opt_user = '<option value="' + data.users.id + '" title="' + data
                            .users.email +
                            '">' + data.users.email + '</option>';
                        $("#user_name").html(opt_user);

                        var opt_role = '<option value="0">Selecione um Papel</option>';
                        $.each(data.roles, function(key, obj) {
                            //alert(value.acronym);
                            opt_role += '<option value="' + obj.id + '" title="' + obj.name +
                                '">' + obj.label + '</option>';
                        });
                        $('#role_name').html(opt_role);


                    });
                });

                $('body').on('change', '#user_name', function(e) {
                    e.preventDefault();
                    var user_id = $(this).val();
                    $.get("{{ url('users-roles') }}/" + user_id + "/details", function(data) {
                        $("#name").val(data.user_details.name);
                        //$("#email").val(data.user_details.email);
                        $("#registration").val(data.user_details.registration);
                        $("#cpf").val(data.user_details.cpf);

                    });
                });

                $('body').on('click', '.store', function(e) {
                    e.preventDefault();
                    $(this).html('Confirmar');
                    $.ajax({
                        data: $("#formUserRole").serialize(),
                        url: "{{ route('users-roles.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $("#formUserRole").trigger("reset");
                            $("#staticBackdrop").modal('hide');
                            toastr.success(data.success)
                            table.draw();
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
                });

                $('body').on('click', '.delete-address', function() {
                    if (confirm("Confirma Exclusão?") == true) {
                        var id = $(this).data('id');
                        // ajax
                        $.ajax({
                            type: "POST",
                            url: "{{ url('addresses') }}" + '/' + id + '/delete',
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
                    $.get("{{ url('users-roles') }}" + "/" + id + "/edit", function(data) {
                        $("modalHeading").html("Editar");
                        $('#staticBackdrop').modal('show');
                        $('#id').val(data.user_role.id);

                        opt_user = '<option value="' + data.user_role.id + '" title="' + data.user_role
                            .name + '">' + data.user_role.email + '</option>';

                        $('#user_name').html(opt_user);
                        var opt_role = '<option value="0">Selecione um Papel</option>';
                        $.each(data.roles, function(key, obj) {
                            if (data.user_role.roles_id == obj.id) {
                                opt_role += '<option value="' + obj.id + '" title="' + obj
                                    .name + '" selected>' + obj.label + '</option>';
                            } else {
                                opt_role += '<option value="' + obj.id + '" title="' + obj
                                    .name + '" >' + obj.label + '</option>';
                            }
                        });
                        $('#role_name').html(opt_role);

                        $("#name").val(data.user_role.name);
                        // $("#email").val(data.user_role.email);
                        $("#registration").val(data.user_role.registration);
                        $("#cpf").val(data.user_role.cpf);
                        $("#dt_validity").val(data.user_role.dt_validity);

                        $("#btnSalvar").removeClass("store");
                        $('#btnSalvar').prop('id', 'btnEditar');
                        $("#btnEditar").addClass("update");
                        $("#btnEditar").value = "update";
                        //$('button[type=submit], input[type=submit]').prop('disabled',false);
                        $("#formUserRole").preventDoubleSubmission();
                    });

                    $("body").on('click', '.update', function(e) {
                        e.preventDefault();
                        var id = $('#id').val();
                        $(this).html('Confirmar');
                        $.ajax({
                            data: $("#formUserRole").serialize(),
                            url: "{{ url('users-roles') }}" + '/' + id + '/update',
                            type: "PATCH",
                            dataType: 'json',
                            success: function(data) {
                                $("#formUserRole").trigger("reset");
                                $("#staticBackdrop").modal('hide');
                                $("#btnEditar").removeClass("update");
                                $('#btnEditar').prop('id', 'btnSalvar');
                                $("#btnSalvar").addClass("store");
                                $("#btnSalvar").value = "store";
                                //$('button[type=submit], input[type=submit]').prop('disabled',true);
                                toastr.success(data.success)
                                table.draw();
                                $("#formUserRole").preventDoubleSubmission();
                                // e.preventDefault(); //STOP default action      
                                /* $(':input','#formSituation')
                                   .not(':button, :submit, :reset, :hidden')
                                   .val('')
                                   .removeAttr('checked')
                                   .removeAttr('selected');*/
                            },
                            error: function(data) {
                                //console.log('Error:', data);
                                var msg = data.responseJSON.errors;
                                //alert(msg)
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

                function printErrorMsg(msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function(key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    });
                }
            });
        </script>



    @stop
