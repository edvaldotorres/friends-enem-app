@extends('layouts.master')

@section('title', 'Professores')

@section('css')
    <link href={{ asset('template/vendor/select2/select2.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Professores - Cadastro</h1>
        <a href="{{ route('teachers.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-solid fa-list"></i> Voltar para listagem</a>
    </div>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cadastro de professor(a)</h6>
        </div>
        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <form action="{{ route('teachers.store') }}" method="POST">
                        @csrf
                        <input hidden name="teacher" value="1">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="teacher_admin">Tipo de cadastro</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="teacher_admin" value="0" checked>
                                        <label class="form-check-label" for="teacher_admin">
                                            Professor(a)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="teacher_admin" value="1">
                                        <label class="form-check-label" for="teacher_admin">
                                            Professor(a) Administrador(a)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome completo</label>
                                <input type="text" class="form-control" name="name" placeholder="Ex: João Paulo Batista"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nickname">Nome social</label>
                                <input type="text" class="form-control" name="nickname" placeholder="Ex: Paulo"
                                    value="{{ old('nickname') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="document">CPF</label>
                                <input type="text" class="form-control mask-document" name="document"
                                    placeholder="Ex: 000.000.000-00" value="{{ old('document') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="genre">Identificação de gênero</label>
                                <select name="genre" class="form-control">
                                    <option selected>Selecione</option>
                                    <option value="1" {{ old('genre') == '1' ? 'selected' : '' }}>Homem</option>
                                    <option value="2" {{ old('genre') == '2' ? 'selected' : '' }}>Mulher</option>
                                    <option value="3" {{ old('genre') == '3' ? 'selected' : '' }}>Ambos</option>
                                    <option value="4" {{ old('genre') == '4' ? 'selected' : '' }}>Nenhum</option>
                                    <option value="5" {{ old('genre') == '5' ? 'selected' : '' }}>Prefiriu não
                                        informar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birth_date">Data de nascimento</label>
                                <input type="text" class="form-control mask-birth_date" name="birth_date"
                                    placeholder="Ex: 00/00/0000" value="{{ old('birth_date') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="zipcode">CEP</label>
                                <input type="text" class="form-control mask-zipcode" name="zipcode" placeholder="00000-000"
                                    value="{{ old('zipcode') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telephone">Telefone</label>
                                <input type="text" class="form-control mask-telephone" name="telephone"
                                    placeholder="(00) 00000-0000" value="{{ old('telephone') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="whatsapp">WhatsApp</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="whatsapp" value="1">
                                        <label class="form-check-label" for="whatsapp">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="whatsapp" value="0" checked>
                                        <label class="form-check-label" for="whatsapp">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="graduation">Graduação</label>
                                <select name="graduation" class="form-control">
                                    <option selected>Selecione</option>
                                    <option value="1" {{ old('graduation') == '1' ? 'selected' : '' }}>Graduando</option>
                                    <option value="2" {{ old('graduation') == '2' ? 'selected' : '' }}>Graduado</option>
                                    <option value="3" {{ old('graduation') == '3' ? 'selected' : '' }}>Especialista
                                    </option>
                                    <option value="4" {{ old('graduation') == '4' ? 'selected' : '' }}>Mestrando</option>
                                    <option value="5" {{ old('graduation') == '5' ? 'selected' : '' }}>Mestre</option>
                                    <option value="6" {{ old('graduation') == '6' ? 'selected' : '' }}>Doutorando
                                    </option>
                                    <option value="7" {{ old('graduation') == '7' ? 'selected' : '' }}>Doutor(a)</option>
                                    <option value="8" {{ old('graduation') == '8' ? 'selected' : '' }}>Pós-Doutorando
                                    </option>
                                    <option value="9" {{ old('graduation') == '9' ? 'selected' : '' }}>Pós-Doutor(a)
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="discipline_id">Disciplina</label>
                                <select class="form-control js-example-basic-multiple" name="discipline_id[]"
                                    multiple="multiple">
                                    @foreach ($disciplines as $discipline)
                                        <option value="{{ $discipline->id }}">{{ $discipline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <h4> Opções de Login</h4>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <i class="far fa-envelope"></i> <label>E-mail </label>
                                <input autocomplete="off" type="email" class="form-control" placeholder="email@email.com"
                                    name="email">
                            </div>
                            <div class="form-group col-md-4">
                                <i class="fas fa-unlock"></i> <label>Senha </label>
                                <input autocomplete="off" type="password" class="form-control"
                                    placeholder="Informe uma senha" name="password">
                            </div>
                            <div class="form-group col-md-4">
                                <i class="fas fa-unlock"></i> <label>Confirme a senha </label>
                                <input id="password-confirm" autocomplete="off" type="password" class="form-control"
                                    placeholder="Informe uma senha" name="password_confirmation"
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <div class=text-right>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\TeacherRequest') !!}

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
