<div class="font-weight-light text-right">
    Unidades encontradas: {{ $unities->total() }}
</div>
<table class="table align-items-center">
    <thead class="thead-light">
    <tr>
        <th scope="col">Detalhes</th>
    </tr>
    </thead>
    <tbody class="list list">
    @forelse($unities as $unity)
        <tr>
            <td class="row" style="font-size: 11px">
                <div class="col-xs-12 col-md-4">
                    <div class="font-weight-light">
                        Cód. da GD: {{ $unity->code }}
                    </div>
                    <div>
                        {{ $unity->distributor_name }}
                    </div>
                    Titular: {{ $unity->owner }}
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="font-weight-light">
                        Classe: {{ $unity->project_class }}
                    </div>
                    <div>
                        Subgrupo: {{ $unity->sub_group }}
                    </div>
                    Modalidade: {{ $unity->modality }}
                </div>
                <div class="col-xs-12 col-md-2">
                    <div class="font-weight-light">
                        Qtde UCs crediadas: {{ $unity->credit_receivers }}
                    </div>
                    <div>
                        Cidade: {{ $unity->city }} - {{ $unity->state }}
                    </div>
                    Cep: {{ $unity->postal_code }}
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="font-weight-light">
                        Data Conexão: {{ $unity->connection_date ?: 'N/I' }}
                    </div>
                    <div>
                        Tipo / Fonte: {{ $unity->project_type }} / {{ $unity->source }}
                    </div>
                    Potência Instalada (kW): {{ $unity->power }}
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <th colspan="4">
                <div class="alert alert-info">
                    Nenhum resultado!
                </div>
            </th>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="text-center" id="unities-pagination">
    <hr>
    {{ $unities->appends(['filter' => $filter])->links() }}
</div>

<script>
    $('#unities-pagination a').on('click', function (e) {
        e.preventDefault();

        request($(this).attr('href'));

        $('html, body').animate({ scrollTop: 0 }, 500);
    })
</script>

<style>
    #unities-pagination nav ul {
        display: inline-flex;
    }
</style>
