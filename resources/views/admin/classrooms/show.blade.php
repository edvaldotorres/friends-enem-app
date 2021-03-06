@extends('layouts.master')

@section('title', 'Aula: Visualizar')

@section('css')
    <link href={{ asset('template/vendor/select2/select2.min.css') }} rel="stylesheet">
    <link href={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }} rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Aula - Visualizar</h1>
        <a href="{{ route('home') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-solid fa-list"></i> Voltar para listagem</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Visualização da aula</h6>
        </div>
        <div class="card-body">
            <div class="sbp-preview">
                <div class="sbp-preview-content">
                    <form>
                        <fieldset disabled>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="user_id">Professor(a)</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ $teacher->id == $classroom->user_id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="discipline_id">Diciplina</label>
                                    <select name="discipline_id" id="discipline_id" class="form-control">
                                        @foreach ($teachers as $teacher)
                                            @foreach ($teacher->disciplines as $discipline)
                                                <option value="{{ $discipline->id }}"
                                                    {{ $discipline->id == $classroom->discipline_id ? 'selected' : '' }}>
                                                    {{ $discipline->name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_timestamp">Data/Horário início da aula</label>
                                    <input type="text" class="form-control datetimepicker" name="start_timestamp"
                                        value="{{ old('start_timestamp') ?? $classroom->startTimestampDate }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_timestamp">Data/Horário término da aula</label>
                                    <input type="text" class="form-control datetimepicker" name="end_timestamp"
                                        value="{{ old('end_timestamp') ?? $classroom->endTimestampDate }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="vacancie">Vagas da turma</label>
                                    <input type="number" class="form-control" name="vacancie"
                                        value="{{ old('vacancie') ?? $classroom->vacancie }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="whatsapp">Horário ativo?</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                {{ old('status') == '1' ? 'checked' : ($classroom->status == 1 ? 'checked' : '') }}>
                                            <label class="form-check-label" for="status">
                                                Sim
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0"
                                                {{ old('status') == '0' ? 'checked' : ($classroom->status == 0 ? 'checked' : '') }}>
                                            <label class="form-check-label" for="status">
                                                Não
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->type == App\Enums\UserType::STUDENT)
        @foreach ($teachers as $teacher)
            @if ($teacher->id == $classroom->user_id)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Dados do professor(a)</h6>
                    </div>
                    <div class="card-body">
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form>
                                    <fieldset disabled>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Professor(a)</label>
                                                <input type="text" class="form-control datetimepicker" name="name"
                                                    value="{{ $teacher->name }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nickname">Nome social</label>
                                                <input type="text" class="form-control datetimepicker" name="nickname"
                                                    value="{{ $teacher->nickname }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="graduation">Graduação</label>
                                                <select name="graduation" class="form-control">
                                                    <label for="graduation">Graduação</label>
                                                    <option value="1" {{ $teacher->graduation == 1 ? 'selected' : '' }}>
                                                        Graduando</option>
                                                    <option value="2" {{ $teacher->graduation == 2 ? 'selected' : '' }}>
                                                        Graduado</option>
                                                    <option value="3" {{ $teacher->graduation == 3 ? 'selected' : '' }}>
                                                        Especialista
                                                    </option>
                                                    <option value="4" {{ $teacher->graduation == 4 ? 'selected' : '' }}>
                                                        Mestrando</option>
                                                    <option value="5" {{ $teacher->graduation == 5 ? 'selected' : '' }}>
                                                        Mestre</option>
                                                    <option value="6" {{ $teacher->graduation == 6 ? 'selected' : '' }}>
                                                        Doutorando
                                                    </option>
                                                    <option value="7" {{ $teacher->graduation == 7 ? 'selected' : '' }}>
                                                        Doutor(a)</option>
                                                    <option value="8" {{ $teacher->graduation == 8 ? 'selected' : '' }}>
                                                        Pós-Doutorando
                                                    </option>
                                                    <option value="9" {{ $teacher->graduation == 9 ? 'selected' : '' }}>
                                                        Pós-Doutor(a)
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="telephone">Telefone</label>
                                                <input type="text" class="form-control mask-telephone" name="telephone"
                                                    value="{{ $teacher->telephone }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="whatsapp">WhatsApp</label>
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="whatsapp"
                                                            value="1" {{ $teacher->whatsapp == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="whatsapp">
                                                            Sim
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="whatsapp"
                                                            value="0" {{ $teacher->whatsapp == 0 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="whatsapp">
                                                            Não
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="card shadow mb-12">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Listagem de alunos na aula</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($students as $student)
                                        @foreach ($classroom->students as $s)
                                            @if ($student->id == $s->id)
                                                <tr>
                                                    <td>{{ $student->name }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\ClassroomRequest') !!}

    <script src={{ asset('template/vendor/select2/select2.min.js') }}></script>

    <script src={{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}></script>
    <script src={{ asset('template/js/demo/datatables-demo.js') }}></script>

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
                format: 'd/m/Y H:i'
            });
        });
    </script>
@endsection
