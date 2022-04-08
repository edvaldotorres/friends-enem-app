@extends('layouts.master')

@section('title', 'Alunos')

@section('css')
    <link href={{ asset('template/vendor/select2/select2.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alunos - Editar</h1>
        <a href="{{ route('students.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-solid fa-list"></i> Voltar para listagem</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edição de aluno</h6>
        </div>
        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <form action="{{ route('students.update', ['student' => $student->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input hidden name="teacher" value="0">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome completo</label>
                                <input type="text" class="form-control" name="name" placeholder="Ex: João Paulo Batista"
                                    value="{{ old('name') ?? $student->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nickname">Nome social</label>
                                <input type="text" class="form-control" name="nickname" placeholder="Ex: Paulo"
                                    value="{{ old('nickname') ?? $student->nickname }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="document">CPF</label>
                                <input type="text" class="form-control mask-document" name="document"
                                    placeholder="Ex: 000.000.000-00" value="{{ old('document') ?? $student->document }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="genre">Identificação de gênero</label>
                                <select name="genre" class="form-control">
                                    <option selected>Selecione</option>
                                    <option value="1"
                                        {{ old('genre') == '1' ? 'selected' : ($student->genre == 1 ? 'selected' : '') }}>
                                        Homem</option>
                                    <option value="2"
                                        {{ old('genre') == '2' ? 'selected' : ($student->genre == 2 ? 'selected' : '') }}>
                                        Mulher</option>
                                    <option value="3"
                                        {{ old('genre') == '3' ? 'selected' : ($student->genre == 3 ? 'selected' : '') }}>
                                        Ambos</option>
                                    <option value="4"
                                        {{ old('genre') == '4' ? 'selected' : ($student->genre == 4 ? 'selected' : '') }}>
                                        Nenhum</option>
                                    <option value="5"
                                        {{ old('genre') == '5' ? 'selected' : ($student->genre == 5 ? 'selected' : '') }}>
                                        Prefiriu não
                                        informar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birth_date">Data de nascimento</label>
                                <input type="text" class="form-control mask-birth_date" name="birth_date"
                                    placeholder="Ex: 00/00/0000" value="{{ old('birth_date') ?? $student->birth_date }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="zipcode">CEP</label>
                                <input type="text" class="form-control mask-zipcode" name="zipcode" placeholder="00000-000"
                                    value="{{ old('zipcode') ?? $student->zipcode }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="color_declaration">Auto declaração de cor</label>
                                <select name="color_declaration" class="form-control">
                                    <option selected>Selecione</option>
                                    <option value="1"
                                        {{ old('color_declaration') == '1' ? 'selected' : ($student->color_declaration == 1 ? 'selected' : '') }}>
                                        Afrodescendente</option>
                                    <option value="2"
                                        {{ old('color_declaration') == '2' ? 'selected' : ($student->color_declaration == 2 ? 'selected' : '') }}>
                                        Indígena
                                    </option>
                                    <option value="3"
                                        {{ old('color_declaration') == '3' ? 'selected' : ($student->color_declaration == 3 ? 'selected' : '') }}>
                                        Amarelo
                                    </option>
                                    <option value="4"
                                        {{ old('color_declaration') == '4' ? 'selected' : ($student->color_declaration == 4 ? 'selected' : '') }}>
                                        Negro
                                    </option>
                                    <option value="5"
                                        {{ old('color_declaration') == '5' ? 'selected' : ($student->color_declaration == 5 ? 'selected' : '') }}>
                                        Branco
                                    </option>
                                    <option value="6"
                                        {{ old('color_declaration') == '6' ? 'selected' : ($student->color_declaration == 6 ? 'selected' : '') }}>
                                        Preto
                                    </option>
                                    <option value="7"
                                        {{ old('color_declaration') == '7' ? 'selected' : ($student->color_declaration == 7 ? 'selected' : '') }}>
                                        Pardo
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="observation">Observações textuais</label>
                                <textarea class="form-control" rows="2"
                                    name="observation">{{ old('observation') ?? $student->observation }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <h4> Opções de Login</h4>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <i class="far fa-envelope"></i> <label>E-mail </label>
                                <input autocomplete="off" type="email" class="form-control" placeholder="email@email.com"
                                    name="email" value="{{ old('email') ?? $student->email }}">
                            </div>
                            <div class="form-group col-md-4">
                                <i class="fas fa-unlock"></i> <label>Senha </label>
                                <input autocomplete="off" type="password" class="form-control"
                                    placeholder="Informe uma senha" name="password" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <i class="fas fa-unlock"></i> <label>Confirme a senha </label>
                                <input id="password-confirm" autocomplete="off" type="password" class="form-control"
                                    placeholder="Informe uma senha" name="password_confirmation" autocomplete="new-password"
                                    value="">
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
    {!! JsValidator::formRequest('App\Http\Requests\StudentRequest') !!}

    <script src={{ asset('template/vendor/select2/select2.min.js') }}></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            theme: "bootstrap"
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.mask-document').mask('000.000.000-00', {
                reverse: true
            });
            $('.mask-birth_date').mask('00/00/0000');
            $('.mask-zipcode').mask('00000-000');
            $('.mask-telephone').mask('(00) 00000-0000');
        });
    </script>
@endsection
