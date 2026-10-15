<?php

namespace App\Filament\Test\Pages;

use App\Models\ExamResult;
use App\Models\Subject;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\Url;

class StudentSubjectHistory extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Histori Pelajaran';

    protected static ?string $title = 'Histori Pelajaran';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.test.pages.student-subject-history';

    #[Url]
    public ?int $selectedSubjectId = null;

    public function mount(): void
    {
        if (! $this->selectedSubjectId) {
            $firstSubject = Subject::first();
            $this->selectedSubjectId = $firstSubject?->id;
        }
    }

    public function selectSubject(?int $subjectId): void
    {
        $this->selectedSubjectId = $subjectId;
    }

    public function getViewData(): array
    {
        $student = auth()->user()?->student;
        $studentId = $student?->id;

        // Overall stats across all subjects
        $allStudentResults = $studentId 
            ? ExamResult::where('student_id', $studentId)->get() 
            : collect();

        $overallTotal = $allStudentResults->count();
        $overallAvg = $overallTotal > 0 ? round($allStudentResults->avg('score'), 1) : 0;
        $overallPassed = $allStudentResults->where('is_passed', true)->count();
        $overallPassRate = $overallTotal > 0 ? round(($overallPassed / $overallTotal) * 100, 1) : 0;

        // Group results by subject for quick count
        $studentSubjectExams = $allStudentResults->groupBy('subject_id');

        $subjects = Subject::withCount(['questions', 'exams'])->get()->map(function ($subj) use ($studentSubjectExams) {
            $subjResults = $studentSubjectExams->get($subj->id, collect());
            $subj->student_taken_count = $subjResults->count();
            $subj->student_avg_score = $subjResults->count() > 0 ? round($subjResults->avg('score'), 1) : null;
            return $subj;
        });

        $selectedSubject = $this->selectedSubjectId 
            ? Subject::with(['questions'])->find($this->selectedSubjectId) 
            : null;

        $resultsQuery = ExamResult::with(['exam', 'subject'])
            ->where('student_id', $studentId);

        if ($this->selectedSubjectId) {
            $resultsQuery->where('subject_id', $this->selectedSubjectId);
        }

        $results = $resultsQuery->orderBy('exam_date', 'desc')->get();

        // Calculate student's personal statistics on this subject
        $totalExamsTaken = $results->count();
        $averageScore = $totalExamsTaken > 0 ? round($results->avg('score'), 1) : 0;
        $highestScore = $totalExamsTaken > 0 ? round($results->max('score'), 1) : 0;
        $lowestScore = $totalExamsTaken > 0 ? round($results->min('score'), 1) : 0;
        $passedCount = $results->where('is_passed', true)->count();
        $passRate = $totalExamsTaken > 0 ? round(($passedCount / $totalExamsTaken) * 100, 1) : 0;

        return [
            'student' => $student,
            'subjects' => $subjects,
            'selectedSubject' => $selectedSubject,
            'results' => $results,
            'overallStats' => [
                'totalExams' => $overallTotal,
                'averageScore' => $overallAvg,
                'passedCount' => $overallPassed,
                'passRate' => $overallPassRate,
            ],
            'stats' => [
                'totalExamsTaken' => $totalExamsTaken,
                'averageScore' => $averageScore,
                'highestScore' => $highestScore,
                'lowestScore' => $lowestScore,
                'passedCount' => $passedCount,
                'passRate' => $passRate,
            ],
        ];
    }
}
