@extends('layouts.master')

@section('title', 'Professores')

@section('css')
    <link href={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Professores</h1>
        <a href="{{ route('teachers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-solid fa-plus"></i> Cadastar</a>
    </div>

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listagem de professores</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Admin</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Admin</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Opções</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->teacher_admin }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->document }}</td>
                                <td class="d-flex">
                                    <a class="mr-1 btn btn-primary"
                                        href="{{ route('teachers.edit', ['teacher' => $teacher->id]) }}">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </a>
                                    <a class="mr-1 btn btn-warning"
                                        href="{{ route('teachers.show', ['teacher' => $teacher->id]) }}">
                                        <i class="fas fa-solid fa-info"></i>
                                    </a>
                                    <form action="{{ route('teachers.destroy', ['teacher' => $teacher->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="form-group">
                                            <input name="_method" value="delete" hidden>
                                            <button type="submit" class="btn btn-danger btn-icon">
                                                <i class="fas fa-solid fa-trash"></i>
                                            </button>
                                        </div>
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
