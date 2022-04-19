<?php

namespace App\Http\Traits;

use App\Models\Classroom;
use Illuminate\Support\Carbon;

trait ValidClassroom
{
    public function validatedClassroom(
        string $userId,
        string $startTimestamp,
        string $endTimestamp = null
    ) {
        $validatedDate = $this->validatedDate($startTimestamp, $endTimestamp);

        if ($validatedDate) {
            return $validatedDate;
        }

        $teacherClassesNoOverlap = $this->teacherNoOverlap($userId, $startTimestamp, $endTimestamp);

        if ($teacherClassesNoOverlap) {
            return $teacherClassesNoOverlap;
        }

        $teacherClassesNoFourHoursDay = $this->teacherNoFourHoursDay($userId, $startTimestamp);

        if ($teacherClassesNoFourHoursDay) {
            return $teacherClassesNoFourHoursDay;
        }

        $teacherClassesNoTwoDiciplineDay = $this->teacherNoTwoDiciplineDay($userId, $startTimestamp);

        if ($teacherClassesNoTwoDiciplineDay) {
            return $teacherClassesNoTwoDiciplineDay;
        }
    }

    public function teacherNoOverlap(
        string $userId,
        string $startTimestamp,
        string $endTimestamp = null
    ) {
        $teacherClassesNoOverlap = Classroom::TeacherNoOverlap($userId, $startTimestamp, $endTimestamp)->get();

        if (count($teacherClassesNoOverlap) > 0) {
            return $this->redirectValidateClassromm('O professor já possui uma aula nesse horário!');
        }

        return false;
    }

    public function teacherNoFourHoursDay(
        string $userId,
        string $startTimestamp
    ) {
        $teacherClassesNoFourHoursDay = Classroom::TeacherNoFourHoursDay($userId, $startTimestamp);

        if ($teacherClassesNoFourHoursDay) {
            return $this->redirectValidateClassromm('O professor já possui mais de 4 horas de aulas nesse dia!');
        }

        return false;
    }

    public function teacherNoTwoDiciplineDay(
        string $userId,
        string $startTimestamp
    ) {
        $teacherClassesNoTwoDiciplineDay = Classroom::TeacherNoTwoDiciplineDay($userId, $startTimestamp);

        if ($teacherClassesNoTwoDiciplineDay) {
            return $this->redirectValidateClassromm('O professor já possui duas diciplina nesse dia!');
        }

        return false;
    }

    public function validatedDate(
        string $startTimestamp,
        string $endTimestamp
    ) {
        $formatStartTimestamp = Carbon::createFromFormat('d/m/Y H:i', $startTimestamp)->format('Y-m-d H:i:s');
        $formatEndTimestamp = Carbon::createFromFormat('d/m/Y H:i', $endTimestamp)->format('Y-m-d H:i:s');

        $formatStartTimestampDate = Carbon::createFromFormat('d/m/Y H:i', $startTimestamp)->format('Y-m-d');
        $formatEndTimestampDate = Carbon::createFromFormat('d/m/Y H:i', $endTimestamp)->format('Y-m-d');

        if ($formatStartTimestamp >= $formatEndTimestamp) {
            return $this->redirectValidateClassromm('A data de início não pode ser maior que a data de término!');
        }

        if ($formatStartTimestampDate != $formatEndTimestampDate) {
            return $this->redirectValidateClassromm('A data de início e término devem ser iguais!');
        }

        return false;
    }
}
