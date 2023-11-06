@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Planilhas</h1>
        @can('create-document')
            <a href="{{ route('admin.worksheets.create') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
                <i class="fa fa-plus mr-1"></i> Adicionar novo
            </a>
        @endcan
    </div>
@stop

@section('content')

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
        <div class="card-header">
            <h3 class="card-title">Modelos de planilhas de documentos</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-2">
            <table class="table table-striped table-hover table-head-fixed" id="myTable" data-order='[[ 1, "asc" ]]'
                data-page-length='10'>
                <thead>
                    <tr>
                        <th class="py-2">Título</th>
                        <th class="py-2">Criado</th>
                        <th class="py-2">Atualizado</th>
                        <th class="py-2 px-2 text-center" style="width: 140px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($worksheets as $worksheet)
                        <tr>
                            <td class="py-2">{{ $worksheet->title }}</td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($worksheet->created_at)->format('d/m/Y H:m:s') }}
                            </td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($worksheet->updated_at)->format('d/m/Y H:m:s') }}
                            </td>
                            <td class="py-2 px-2 text-center">
                                <div class="btn-group">
                                    @can('down-document')
                                        <a href="{{ Storage::url($worksheet->file) }}" target="blank"
                                            class="btn btn-default btn-sm" title="Baixar arquivo">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endcan
                                    @can('edit-document')
                                        <a href="{{ route('admin.worksheets.edit', ['id' => $worksheet->id]) }}"
                                            class="btn btn-info btn-sm" title="Alterar registro">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete-document')
                                        <form method="POST" onsubmit="return(confirmaExcluir())"
                                            action="{{ route('admin.worksheets.destroy', ['id' => $worksheet->id]) }}">
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
