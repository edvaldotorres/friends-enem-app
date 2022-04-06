<option selected value="">Selecione</option>
@foreach ($teacherDisciplines->disciplines as $discipline)
    <option value="{{ $discipline->id }}">{{ $discipline->name }}</option>
@endforeach
