@extends('layouts.master')

@section('title', 'Aulas')

@section('css')
    <link href={{ asset('template/vendor/select2/select2.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Aulas - Cadastro</h1>
        <a href="{{ route('classrooms.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-solid fa-list"></i> Voltar para listagem</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cadastro de aula</h6>
        </div>
        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <form action="{{ route('classrooms.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="user_id">Professor(a)</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option selected value="">Selecione</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="discipline_id">Diciplina</label>
                                <select name="discipline_id" id="discipline_id" class="form-control">
                                    <option selected value="">Selecione</option>
                                    @foreach ($disciplines as $discipline)
                                        <option value="{{ $discipline->id }}">{{ $discipline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_timestamp">Data/Horário início da aula</label>
                                <input type="text" class="form-control datetimepicker" name="start_timestamp"
                                    value="{{ old('start_timestamp') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_timestamp">Data/Horário término da aula</label>
                                <input type="text" class="form-control datetimepicker" name="end_timestamp"
                                    value="{{ old('end_timestamp') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="vacancie">Vagas da turma</label>
                                <input type="number" class="form-control" name="vacancie" value="{{ old('vacancie') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="whatsapp">Horário ativo?</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="1">
                                        <label class="form-check-label" for="status">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0" checked>
                                        <label class="form-check-label" for="status">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="student_id">Alunos</label>
                                <select class="form-control js-example-basic-multiple" name="student_id[]"
                                    multiple="multiple">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
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
    {!! JsValidator::formRequest('App\Http\Requests\ClassroomRequest') !!}

    <script src={{ asset('template/vendor/select2/select2.min.js') }}></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            theme: "bootstrap"
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#user_id').change(function(e) {

                teacherId = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    url: '{{ route('loading-disciplines') }}',
                    data: {
                        'user_id': teacherId,
                    },
                    type: "GET",
                    success: function(data) {
                        $('#discipline_id').html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        jQuery.datetimepicker.setLocale('pt-BR');

        $(function() {
            $('.datetimepicker').datetimepicker({
                mask: true,
                format: 'd/m/Y H:i'
            });
        });
    </script>
@endsection
