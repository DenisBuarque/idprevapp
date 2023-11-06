@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Administrativo</h1>
        <a href="{{ route('admin.administratives.create') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
            <i class="fa fa-plus mr-1"></i> Adicionar novo
        </a>
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
            <h3 class="card-title">Lista de registros cadastrados:</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-2">
            <table class="table table-striped table-hover table-head-fixed" id="myTable"
                                data-order='[[ 1, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">Photo</th>
                        <th>Franqueado</th>
                        <th>Cliente</th>
                        <th>Inicio</th>
                        <th>Cessação</th>
                        <th></th>
                        <th>Resultado</th>
                        <th>Situação</th>
                        <th class="text-center" style="width: 70px;">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($administratives as $administrative)
                        <tr>
                            <td class="py-2">
                                @if (isset($administrative->user->image))
                                    <img src="{{ asset('storage/' . $administrative->user->image) }}" alt="Photo"
                                        style="width: 32px; height: 32px;" class="img-circle img-size-32 mr-2">
                                @else
                                    <img src="https://dummyimage.com/28x28/b6b7ba/fff" alt="Photo"
                                        class="img-circle img-size-32 mr-2">
                                @endif
                            </td>
                            <td class="py-2">
                                <p class="m-0" style="line-height: 1">
                                    {{ $administrative->user->name }}<br />
                                    <small>{{ $administrative->user->phone }} - {{ $administrative->user->address }},
                                        {{ $administrative->user->number }}, {{ $administrative->user->district }},
                                        {{ $administrative->user->zip_code }}, {{ $administrative->user->city }},
                                        {{ $administrative->user->state }}</small>
                                </p>
                            </td>
                            <td class="py-2">
                                <p class="m-0" style="line-height: 1">
                                    {{ $administrative->name }}
                                    <br /><small>{{ $administrative->phone }} - {{ $administrative->address }},
                                        {{ $administrative->number }},
                                        {{ $administrative->district }}, {{ $administrative->city }},
                                        {{ $administrative->state }}</small>
                                </p>
                            </td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($administrative->initial_date)->format('d/m/Y') }}
                            </td>
                            <td class="py-2">
                                {{ \Carbon\Carbon::parse($administrative->concessao_date)->format('d/m/Y') }}</td>
                            <td class="py-2">
                                @php
                                    $end = \Carbon\Carbon::parse($administrative->concessao_date);
                                    $now = \Carbon\Carbon::now();
                                    $diff = $end->diffInDays($now);
                                    echo $diff . ' dias.';
                                @endphp
                            </td>
                            <td class="py-2">
                                @if ($administrative->results == 1)
                                    Deferido
                                @else
                                    Indeferido
                                @endif
                            </td>
                            <td class="py-2">{{ $administrative->situation }}</td>
                            <td class="py-2 px-2">
                                <div class="btn0group">
                                    <a href="{{ route('admin.administratives.edit', ['id' => $administrative->id]) }}"
                                        class="btn btn-info btn-sm border" title="Alterar registro">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form method="POST" onsubmit="return(confirmaExcluir())"
                                        action="{{ route('admin.administratives.delete', ['id' => $administrative->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
