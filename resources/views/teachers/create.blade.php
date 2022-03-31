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
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Professor(a)</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Professor(a)
                                    Administrador(a)</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome completo</label>
                                <input type="text" class="form-control" name="name" placeholder="Ex: João Paulo Batista">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nickname">Nome social</label>
                                <input type="text" class="form-control" name="nickname" placeholder="Ex: Paulo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" name="cpf" placeholder="Ex: 000.000.000-00">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="genre">Identificação de gênero</label>
                                <select name="genre" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birth_date">Data de nascimento</label>
                                <input type="text" class="form-control" name="birth_date" placeholder="Ex: 00/00/0000">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="zipcode">CEP</label>
                                <input type="text" class="form-control" name="zipcode" placeholder="00000-000">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="telephone">Telefone</label>
                                <input type="text" class="form-control" name="telephone" placeholder="(00) 00000-0000">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="whatsapp">WhatsApp</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="whatsapp" value="option1"
                                            checked>
                                        <label class="form-check-label" for="whatsapp">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="whatsapp" value="option2">
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
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Disciplina</label>
                                <select class="form-control js-example-basic-multiple" name="name[]" multiple="multiple">
                                    <option value="AL">Alabama</option>
                                    ...
                                    <option value="WY">Wyoming</option>
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
    <script src={{ asset('template/vendor/select2/select2.min.js') }}></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            theme: "bootstrap"
        });
    </script>
@endsection
