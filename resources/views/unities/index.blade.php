@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card-header row mb-3">
                <div class="col-12">
                    <h1 class="">Unidades Consumidoras com Geração Distribuída</h1>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 mb-2">
                            <input id="filter" type="text" class="form-control" placeholder="Busque por qualquer informação">
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <button type="button" class="btn btn-primary btn-block" onclick="filter()">
                                Buscar
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="loading" class="text-center mb-3" style="display: none">
                <i class="fa fa-spin fa-pulse fa-spinner fa-4x"></i>
            </div>
            <div id="unities"></div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        function request(url) {
            $.ajax({
                url: url,
                data: {},
                method: 'get',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#loading').hide();
                    $('#unities').html(response);
                },
                error: function (e) {
                    $('#loading').hide();
                    swal("Falha ao carregar dados!", {icon: "error"});
                    $('#unities').html('<div class="alert alert-danger">Falha no carregamento!</div>');
                }
            });
        }

        request('{{ route('unities-list') }}');

        function filter() {
            const filter = $('#filter').val();

            request("{{ route('unities-list') }}?filter="+filter);
        }
    </script>
@endsection

