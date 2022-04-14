<?php

namespace App\Http\Traits;

use App\Models\Classroom;

trait ValidClassroom
{
    public function validatedClassroom(
        string $userId,
        string $startTimestamp,
        string $endTimestamp = null
    ) {
        $teacherClassesNoOverlap = Classroom::Validate1($userId, $startTimestamp, $endTimestamp)->get();

        if (count($teacherClassesNoOverlap) > 0) {
            return $this->redirectValidateClassromm('O professor já possui uma aula nesse horário!');
        }

        $teacherClassesNoFourHoursDay = Classroom::Validate2($userId, $startTimestamp);

        if ($teacherClassesNoFourHoursDay) {
            return $this->redirectValidateClassromm('O professor já possui mais de 4 horas de aulas nesse dia!');
        }

        $teacherClassesNoTwoDiciplineDay = Classroom::Validate3($userId, $startTimestamp);

        if ($teacherClassesNoTwoDiciplineDay) {
            return $this->redirectValidateClassromm('O professor já possui duas diciplina nesse dia!');
        }
    }
}
