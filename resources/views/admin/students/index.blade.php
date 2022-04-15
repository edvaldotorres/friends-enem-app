@extends('layouts.master')

@section('title', 'Alunos')

@section('css')
    <link href={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alunos</h1>
        <a href="{{ route('students.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-solid fa-plus"></i> Cadastar</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listagem de alunos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Opções</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->document }}</td>
                                <td class="d-flex justify-content-sm-around">
                                    <a class="btn btn-primary"
                                        href="{{ route('students.edit', ['student' => $student->id]) }}" role="button">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', ['student' => $student->id]) }}"
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
