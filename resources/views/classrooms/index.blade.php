@extends('layouts.master')

@section('title', 'Aulas')

@section('css')
    <link href={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Aulas</h1>
        <a href="{{ route('classrooms.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-solid fa-plus"></i> Cadastar</a>
    </div>

    <!-- DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listagem de aulas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Dia da semana</th>
                            <th>Horário de início</th>
                            <th>Horário de término</th>
                            <th>Diciplina</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Dia da semana</th>
                            <th>Horário de início</th>
                            <th>Horário de término</th>
                            <th>Diciplina</th>
                            <th>Opções</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($classrooms as $classroom)
                            <tr>
                                <td>{{ $classroom->start_timestamp }}</td>
                                <td>{{ $classroom->start_timestamp }}</td>
                                <td>{{ $classroom->end_timestamp }}</td>
                                <td>{{ $classroom->dicipline }}</td>
                                <td class="d-flex">
                                    <a class="mr-1 btn btn-primary"
                                        href="{{ route('classrooms.edit', ['classroom' => $classroom->id]) }}">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </a>
                                    <a class="mr-1 btn btn-warning"
                                        href="{{ route('classrooms.show', ['classroom' => $classroom->id]) }}">
                                        <i class="fas fa-solid fa-info"></i>
                                    </a>
                                    <form action="{{ route('classrooms.destroy', ['classroom' => $classroom->id]) }}"
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
