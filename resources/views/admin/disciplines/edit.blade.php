@extends('layouts.master')

@section('title', 'Disciplinas')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Disciplinas - Editar</h1>
        <a href="{{ route('disciplines.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-solid fa-list"></i> Voltar para listagem</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edição de disciplina</h6>
        </div>
        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <form action="{{ route('disciplines.update', ['discipline' => $discipline->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Nome da disciplina</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') ?? $discipline->name }}">
                            </div>
                        </div>
                        <div class=text-right>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\DisciplineRequest') !!}
@endsection
