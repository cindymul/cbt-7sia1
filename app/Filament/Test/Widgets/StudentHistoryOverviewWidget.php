<?php

namespace App\Filament\Test\Widgets;

use App\Models\ExamResult;
use Filament\Widgets\Widget;

class StudentHistoryOverviewWidget extends Widget
{
    protected string $view = 'filament.test.widgets.student-history-overview-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public function getViewData(): array
    {
        $student = auth()->user()?->student;
        $studentId = $student?->id;

        $results = $studentId
            ? ExamResult::with(['exam', 'subject'])
                ->where('student_id', $studentId)
                ->orderBy('exam_date', 'desc')
                ->get()
            : collect();

        $totalExams = $results->count();
        $averageScore = $totalExams > 0 ? round($results->avg('score'), 1) : 0;
        $passedCount = $results->where('is_passed', true)->count();
        $passRate = $totalExams > 0 ? round(($passedCount / $totalExams) * 100, 1) : 0;

        $recentExams = $results->take(3);

        return [
            'student' => $student,
            'totalExams' => $totalExams,
            'averageScore' => $averageScore,
            'passRate' => $passRate,
            'recentExams' => $recentExams,
        ];
    }
}
