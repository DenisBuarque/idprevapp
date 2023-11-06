@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Franqueados conveniados</h1>
        @can('create-franchisee')
            <a href="{{ route('admin.franchisees.create') }}" class="btn btn-md btn-info" title="Adicionar novo registro">
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
            <h3 class="card-title">Lista de registros cadastrados:</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-2">
            <table class="table table-striped table-hover" id="myTable" data-order='[[ 1, "asc" ]]' data-page-length='10'>
                <thead>
                    <tr>
                        <th class="py-2">Nome</th>
                        <th class="py-2">Contatos</th>
                        <th class="py-2">Advogado(s)</th>
                        <th class="py-2">Atualizado</th>
                        <th class="py-2 px-2 text-center" style="width: 70px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>

                            <td>
                                <div class="user-block">
                                    @if (isset($user->image))
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="Photo"
                                            class="img-circle img-bordered-sm">
                                    @else
                                        <img src="https://dummyimage.com/28x28/b6b7ba/fff" alt="Photo"
                                            class="img-circle img-bordered-sm">
                                    @endif
                                    <span class="username">
                                        {{ $user->name }}
                                    </span>
                                    <span class="description">
                                        {{ $user->address }}, {{ $user->number }}, {{ $user->district }},
                                        {{ $user->zip_code }}, {{ $user->city }}, {{ $user->state }}</small>
                                </div>
                            </td>
                            <td class="py-2">
                                <p class="m-0" style="line-height: 1">
                                    {{ $user->phone }}<br />
                                    <small>{{ $user->email }}</small>
                                </p>
                            </td>
                            <td class="py-2">

                                <div class="flex flex-row">
                                    @foreach ($user->lawyers as $lawyer)
                                        @if (isset($lawyer->image))
                                            <span>
                                                <img alt="Avatar" class="img-circle img-size-32"
                                                    src="{{ asset('storage/' . $lawyer->image) }}"
                                                    style="width: 32px; height: 32px;" title="{{ $lawyer->name }}" />
                                            </span>
                                        @else
                                            <span>
                                                <img alt="Avatar" class="img-circle img-size-32"
                                                    src="https://dummyimage.com/28x28/b6b7ba/fff"
                                                    title="{{ $lawyer->name }}" />
                                            </span>
                                        @endif
                                    @endforeach
                                </div>

                            </td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:m:s') }}</td>
                            <td class="py-2 px-2">
                                <div class="btn-group">
                                    @can('edit-franchisee')
                                        <a href="{{ route('admin.franchisees.edit', ['id' => $user->id]) }}"
                                            class="btn btn-block btn-info btn-sm" title="Alterar registro">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete-franchisee')
                                        <form method="POST" onsubmit="return(confirmaExcluir())"
                                            action="{{ route('admin.franchisees.destroy', ['id' => $user->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block btn-sm"
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
