@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Leads de atendimento</h1>
        @can('create-lead')
            <a href="{{ route('admin.leads.create') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
                <i class="fa fa-plus mr-1"></i> Adicionar novo
            </a>
        @endcan
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $leads_total }}</h3>
                    <p>Leads</p>
                </div>
                <div class="icon">
                    <i class="fa fa-flag"></i>
                </div>
                <a class="small-box-footer">
                    &nbsp;
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
                <a class="small-box-footer">
                    &nbsp;
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $converted_lead }}</h3>
                    <p>Leads convertidos</p>
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
                    <p>Leads cancelados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-thumbs-down"></i>
                </div>
                <a class="small-box-footer">
                    &nbsp;
                </a>
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


    <div class="card">
        <div class="card-body table-responsive p-2">

            <table class="table table-striped table-hover" id="myTable" data-order='[[ 1, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th>Franqueado</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Atualizado</th>
                        <th class="text-center" style="width: 100px;">Ações</th>
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
                            <td class="py-2">
                                <p class="m-0" style="line-height: 1">{{ $lead->name }}
                                    @isset($lead->address)
                                        <br />
                                        <small class="mr-2">{{ $lead->phone }}</small>
                                        <small>{{ $lead->address }}, nº {{ $lead->number }},
                                            {{ $lead->district }}, {{ $lead->city }}, {{ $lead->state }}</small>
                                    @endisset
                                </p>
                            </td>
                            <td class="py-2">
                                @if ($lead->tag == 1)
                                    <small class="badge badge-info">Novo</small>
                                @elseif ($lead->tag == 2)
                                    <small class="badge badge-warning">Aguardando</small>
                                @elseif ($lead->tag == 3)
                                    <small class="badge badge-success">Convertido</small>
                                @else
                                    <small class="badge badge-danger">Cancelados</small>
                                @endif
                               
                            </td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($lead->updated_at)->format('d/m/Y H:m:s') }}</td>
                            <td class="py-2 px-2">
                                <div class="btn-group">
                                    @can('comments-lead')
                                        <a href="{{ route('admin.leads.show', ['id' => $lead->id]) }}"
                                            class="btn btn-sm btn-light border">
                                            <i class="fa fa-comments"></i>

                                            <span
                                                style="position: absolute; top: -3px; left: -5px; width: 12px; height: 14px; border-radius: 3px; background-color: #FF8c00; color: #FFFFFF; padding: 0; font-size: 9px;">{{ count($lead->feedbackLeads) }}</span>


                                        </a>
                                    @endcan
                                    @can('edit-lead')
                                        <a href="{{ route('admin.leads.edit', ['id' => $lead->id]) }}"
                                            class="btn btn-info btn-sm border" title="Alterar registro">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete-lead')
                                        <form method="POST" onsubmit="return(confirmaExcluir())"
                                            action="{{ route('admin.leads.destroy', ['id' => $lead->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir registro">
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
