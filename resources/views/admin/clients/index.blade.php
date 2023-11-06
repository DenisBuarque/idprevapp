@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Clientes (leads convetidos)</h1>
        @can('create-client')
            <a href="{{ route('admin.clients.create') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
                <i class="fa fa-plus mr-1"></i> Adicionar novo
            </a>
        @endcan
    </div>
@stop

@section('content')
    <!-- -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totals }}</h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.clients.index') }}" class="small-box-footer">
                    Listar registros <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $waiting }}</h3>
                    <p>Leads aguardando</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock"></i>
                </div>
                @if ($waiting > 0)
                    <a href="{{ route('admin.leads.tag', ['tag' => 2]) }}" class="small-box-footer">
                        Listar registros <i class="fas fa-arrow-circle-right"></i>
                    </a>
                @else
                    <a class="small-box-footer">
                        &nbsp;
                    </a>
                @endif
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $converted_lead }}</h3>
                    <p>Clientes convertidos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-thumbs-up"></i>
                </div>
                @if ($converted_lead > 0)
                    <a href="{{ route('admin.clients.tag', ['tag' => 3]) }}" class="small-box-footer">
                        Listar registros <i class="fas fa-arrow-circle-right"></i>
                    </a>
                @else
                    <a class="small-box-footer">
                        &nbsp;
                    </a>
                @endif
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $unconverted_lead }}</h3>
                    <p>Clientes não convertidos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-thumbs-down"></i>
                </div>
                @if ($unconverted_lead > 0)
                    <a href="{{ route('admin.clients.tag', ['tag' => 4]) }}" class="small-box-footer">
                        Listar registros <i class="fas fa-arrow-circle-right"></i>
                    </a>
                @else
                    <a class="small-box-footer">
                        &nbsp;
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-none">
                <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Finalizados Procedentes</span>
                    <span class="info-box-number">{{ $procedente }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-lg">
                <span class="info-box-icon bg-danger"><i class="fa fa-thumbs-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Finalizados Improcedentes</span>
                    <span class="info-box-number">{{ $improcedente }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Obteve Recursos</span>
                    <span class="info-box-number">{{ $resources }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fa fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Auto Findos</span>
                    <span class="info-box-number">{{ $findos }}</span>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="message" class="alert alert-success mb-2" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('alert'))
        <div id="message" class="alert alert-warning mb-2" role="alert">
            {{ session('alert') }}
        </div>
    @elseif (session('error'))
        <div id="message" class="alert alert-danger mb-2" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- -->
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de clientes convertidos não finalizados</h3>
                            <div class="card-tools">

                            </div>
                        </div>

                        <div class="card-body table-responsive p-2">
                            <table class="table table-striped table-hover table-head-fixed" id="myTable"
                                data-order='[[ 1, "asc" ]]' data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th class="py-2">Franqueado</th>
                                        <th class="py-2">Advs.</th>
                                        <th class="py-2">Cliente</th>
                                        <th class="py-2">Situação</th>
                                        <th class="py-2 px-2 text-center" style="width: 150px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <td>

                                                <div class="user-block">
                                                    @if (isset($lead->user->image))
                                                    <img src="{{ asset('storage/' . $lead->user->image) }}" alt="Photo"
                                                        class="img-circle img-bordered-sm">
                                                @else
                                                    <img src="https://dummyimage.com/28x28/b6b7ba/fff" alt="Photo"
                                                        class="img-circle img-bordered-sm">
                                                @endif
                                                    <span class="username">
                                                        {{ $lead->user->name }}
                                                    </span>
                                                    <span class="description">
                                                        @isset($lead->user->phone)
                                                            {{ $lead->user->phone }} -
                                                        @endisset
                                                        {{ $lead->user->email }}
                                                    </span>
                                                </div> 
                                            </td>
                                            <td class="m-0">
                                                <div class="flex flex-row mt-1">
                                                    @foreach ($lead->lawyers as $lawyer)
                                                        @if (isset($lawyer->image))
                                                            <img alt="Avatar" class="img-circle"
                                                                src="{{ asset('storage/' . $lawyer->image) }}"
                                                                style="width: 32px; height: 32px;"
                                                                title="{{ $lawyer->name }}">
                                                        @else
                                                            <img alt="Avatar" class="img-circle"
                                                            style="width: 32px; height: 32px;"
                                                                src="https://dummyimage.com/28x28/b6b7ba/fff"
                                                                title="{{ $lawyer->name }}">
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <p class="m-0" style="line-height: 1">
                                                    {{ $lead->name }} / {{ $lead->phone }}<br />
                                                    <small>
                                                        @isset($lead->address)
                                                            {{ $lead->address }}, {{ $lead->number }},
                                                            {{ $lead->district }}, {{ $lead->city }},
                                                            {{ $lead->state }}
                                                        @endisset
                                                    </small>
                                                </p>
                                            </td>
                                            <td>
                                                @php
                                                    $array_situations = [1 => 'Andamento em ordem', 2 => 'Aguardando cumprimento', 3 => 'Finalizado procedente', 4 => 'Finalizado improcedente', 5 => 'Recursos'];
                                                    foreach ($array_situations as $key => $value) {
                                                        if ($key == $lead->situation) {
                                                            echo '<span>' . $value . '</span>';
                                                        }
                                                    }
                                                @endphp
                                            </td>

                                            <td class='px-1'>
                                                <div class="btn-group">
                                                    @can('terms-client')
                                                        <a href="#" class="btn btn-sm border" title="Prazos a cumprir"
                                                            data-toggle="modal" data-target="#modal-xl{{ $lead->id }}">
                                                            <i class="fa fa-clock"></i>
                                                            <span
                                                                style="position: absolute; top: -7px; left: 3px; width: 12px; height: 14px; border-radius: 3px; background-color: #FF8c00; color: #FFFFFF; padding: 0; font-size: 9px;">{{ count($lead->terms) }}</span>
                                                        </a>
                                                    @endcan
                                                    @can('comments-client')
                                                        <a href="{{ route('admin.clients.show', ['id' => $lead->id]) }}"
                                                            title="Comentários do cliente" class="btn btn-sm border"><i
                                                                class="fa fa-comments"></i>
                                                            <span
                                                                style="position: absolute; top: -7px; left: 3px; width: 12px; height: 14px; border-radius: 3px; background-color: #FF8c00; color: #FFFFFF; padding: 0; font-size: 9px;">{{ count($lead->feedbackLeads) }}</span>
                                                        </a>
                                                    @endcan
                                                    @can('edit-client')
                                                        <a href="{{ route('admin.clients.edit', ['id' => $lead->id]) }}"
                                                            title="Alterar registro" class="btn btn-info btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete-client')
                                                        <form method="POST" onsubmit="return(confirmaExcluir())"
                                                            action="{{ route('admin.clients.destroy', ['id' => $lead->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Excluir registro">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($leads as $lead)
                <div class="modal fade" id="modal-xl{{ $lead->id }}" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Prazos</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body p-0">
                                <table class="table table-hover table-striped  table-head-fixed">
                                    <thead>
                                        <tr>
                                            <th>Comentário</th>
                                            <th>Prazo</th>
                                            <th>Audiência</th>
                                            <th>Endereço</th>
                                            <th>Status</th>
                                            <th class="py-2 px-2" style="width: 70px;">Edit</th>
                                            <th class="py-2 px-2" style="width: 70px;">Del</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($lead->terms as $term)
                                            <tr>
                                                <td>{{ $term->comments }}</td>
                                                <td>{{ \Carbon\Carbon::parse($term->term)->format('d/m/Y') }}</td>
                                                <td>
                                                    @isset($term->audiencia)
                                                        {{ \Carbon\Carbon::parse($term->audiencia)->format('d/m/Y') }}
                                                    @endisset
                                                    @isset($term->hour)
                                                        as {{ $term->hour }}
                                                    @endisset
                                                </td>
                                                <td>{{ $term->address }}</td>
                                                <td>
                                                    @if ($term->tag == 1)
                                                        <span>Aguardando</span>
                                                    @else
                                                        <span>Cumprido</span>
                                                    @endif
                                                </td>
                                                <td class='px-1'>
                                                    <a href="{{ route('admin.terms.edit', ['id' => $term->id]) }}"
                                                        class="btn btn-info btn-xs btn-block">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                                <td class='px-1'>
                                                    <form method="POST" onsubmit="return(confirmaExcluir())"
                                                        action="{{ route('admin.terms.delete', ['id' => $term->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs btn-block">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Nenhum registro encontrado</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <a href="{{ route('admin.terms.create', ['id' => $lead->id]) }}" class="btn btn-primary">
                                    <i class="fa fa-plus mr-1"></i> Adicionar Prazo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col-md-3 col-12">

            <div class="card card-deafult">
                <div class="card-header">
                    <h3 class="card-title">Parcelas Vencidas</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped table-head-fixed">
                        <thead>
                            <tr>
                                <th class="py-2">Data</th>
                                <th class="py-2">Franqueado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($installments as $value)
                                @if (\Carbon\Carbon::now()->format('Y-m-d') > $value->date && $value->active == 'S')
                                    <tr>
                                        <td class="py-2">
                                            <a
                                                href="{{ route('admin.financials.edit', ['id' => $value->financial_id]) }}">
                                                {{ \Carbon\Carbon::parse($value->date)->format('d/m/Y') }}
                                            </a>
                                        </td>
                                        <td class="py-2">{{ $value->financial->user->name }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Prazos não cumpridos</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped table-head-fixed">
                        <thead>
                            <tr>
                                <th class="py-2">Data</th>
                                <th class="py-2">Cliente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terms as $term)
                                @if (\Carbon\Carbon::now()->format('Y-m-d') > $term->term && $term->tag == 1)
                                    <tr>
                                        <td class="py-2">
                                            <a
                                                href="{{ route('admin.terms.edit', ['id' => $term->id]) }}">{{ \Carbon\Carbon::parse($term->term)->format('d/m/Y') }}</a>
                                        </td>
                                        <td class="py-2">{{ $term->lead->name }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Lembrete de clientes</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped table-head-fixed">
                        <thead>
                            <tr>
                                <th class="py-2">Cliente</th>
                                <th class="py-2">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $value)
                                @if ($value->confirmed == 1)
                                    <tr>
                                        <td class="py-2">
                                            <a
                                                href="{{ route('admin.clients.edit', ['id' => $value->id]) }}">{{ $value->name }}</a>
                                        </td>
                                        <td class="py-2">
                                            @php
                                                $array_situations = [1 => 'Andamento em ordem', 2 => 'Aguardando cumprimento', 3 => 'Finalizado procedente', 4 => 'Finalizado improcedente', 5 => 'Recursos'];
                                                foreach ($array_situations as $key => $item) {
                                                    if ($key == $value->situation) {
                                                        echo '<span>' . $item . '</span>';
                                                    }
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
@stop

@section('js')

    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                paging: true,
            });
        });

        function confirmaExcluir() {
            var conf = confirm("Deseja mesmo excluir? Os dados serão perdidos e não poderão ser recuperados.");
            if (conf) {
                return true;
            } else {
                return false;
            }
        }

        setTimeout(() => {
            document.getElementById('message').style.display = 'none';
        }, 6000);
    </script>
@stop
