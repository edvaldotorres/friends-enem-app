@extends('layouts.master')

@section('title', 'Professores')

@section('css')
    <link href={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Professores</h1>
        <a href="{{ route('teachers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-solid fa-plus"></i> Cadastar</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listagem de professores</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tipo</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Opções</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>
                                    @if ($teacher->type == 1)
                                        <div class="badge bg-primary text-white rounded-pill">Administrador</div>
                                    @else
                                        <div class="badge bg-info text-white rounded-pill">Professor</div>
                                    @endif
                                </td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->document }}</td>
                                <td class="d-flex justify-content-sm-around">
                                    <a class="btn btn-primary"
                                        href="{{ route('teachers.edit', ['teacher' => $teacher->id]) }}" role="button">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('teachers.destroy', ['teacher' => $teacher->id]) }}"
                                        method="POST">
                                        <button class="btn btn-danger">
                                            <i class="fas fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src={{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ asset('template/js/demo/datatables-demo.js') }}></script>
@endsection
