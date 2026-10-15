@php
    $record = $getRecord();
    $details = $record->details()->with(['question.answers', 'selectedAnswer', 'correctAnswer'])->get();
    $score = (float) $record->score;
    $isPassed = (bool) $record->is_passed;
@endphp

<style>
    .cbt-detail-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        font-family: inherit;
    }

    /* Score Header Card */
    .cbt-score-header {
        position: relative;
        overflow: hidden;
        border-radius: 0.85rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 50%, rgba(6, 182, 212, 0.05) 100%);
        border: 1px solid rgba(99, 102, 241, 0.2);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
    }

    .cbt-stat-card {
        padding: 0.85rem 1rem;
        border-radius: 0.65rem;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(148, 163, 184, 0.15);
        backdrop-filter: blur(8px);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cbt-stat-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        opacity: 0.65;
        margin-bottom: 0.25rem;
    }

    .cbt-stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1.1;
    }

    /* Question Cards */
    .cbt-q-card-modern {
        border-radius: 0.85rem;
        border: 1px solid rgba(148, 163, 184, 0.18);
        background: rgba(255, 255, 255, 0.02);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.1rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .cbt-q-card-modern:hover {
        border-color: rgba(99, 102, 241, 0.35);
        box-shadow: 0 6px 16px -4px rgba(0, 0, 0, 0.05);
    }

    .cbt-q-card-modern.is-correct-card {
        border-left: 4px solid #10b981;
    }

    .cbt-q-card-modern.is-wrong-card {
        border-left: 4px solid #ef4444;
    }

    .cbt-q-card-modern.is-unanswered-card {
        border-left: 4px solid #94a3b8;
    }

    .cbt-q-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 0.75rem;
        margin-bottom: 0.85rem;
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .cbt-q-num {
        font-weight: 700;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .cbt-q-text {
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        opacity: 0.95;
    }

    .cbt-answers-box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 0.85rem;
        margin-top: 0.85rem;
    }

    .cbt-ans-card {
        padding: 0.85rem 1.1rem;
        border-radius: 0.65rem;
        border: 1px solid rgba(148, 163, 184, 0.15);
        background: rgba(255, 255, 255, 0.02);
    }

    .cbt-ans-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .cbt-ans-body {
        font-size: 0.88rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .cbt-explain-box {
        margin-top: 1rem;
        padding: 0.85rem 1.1rem;
        border-radius: 0.65rem;
        background: rgba(99, 102, 241, 0.06);
        border: 1px solid rgba(99, 102, 241, 0.2);
        font-size: 0.84rem;
        line-height: 1.5;
    }
</style>

<div class="cbt-detail-container">
    {{-- Score Header Overview --}}
    <div class="cbt-score-header">
        <div class="cbt-stat-card">
            <span class="cbt-stat-label">Nilai Akhir</span>
            <div class="cbt-stat-value" style="color: {{ $isPassed ? '#10b981' : '#ef4444' }};">
                {{ number_format($score, 1) }}
            </div>
        </div>

        <div class="cbt-stat-card">
            <span class="cbt-stat-label">Total Soal</span>
            <div class="cbt-stat-value">
                {{ $record->total_questions }}
            </div>
        </div>

        <div class="cbt-stat-card">
            <span class="cbt-stat-label" style="color: #10b981;">Jawaban Benar</span>
            <div class="cbt-stat-value" style="color: #10b981;">
                {{ $record->correct_answers }}
            </div>
        </div>

        <div class="cbt-stat-card">
            <span class="cbt-stat-label" style="color: #ef4444;">Jawaban Salah</span>
            <div class="cbt-stat-value" style="color: #ef4444;">
                {{ $record->wrong_answers }}
            </div>
        </div>

        <div class="cbt-stat-card">
            <span class="cbt-stat-label">Tidak Dijawab</span>
            <div class="cbt-stat-value" style="opacity: 0.7;">
                {{ $record->unanswered }}
            </div>
        </div>
    </div>

    {{-- Daftar Pembahasan Tiap Nomor --}}
    <div>
        <h3 style="font-size: 1rem; font-weight: 700; margin: 0 0 1rem 0; display: flex; align-items: center; gap: 0.5rem;">
            <svg style="width: 1.1rem; height: 1.1rem; color: #818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span>Rincian Evaluasi Jawaban & Pembahasan</span>
        </h3>

        @forelse ($details as $index => $detail)
            @php
                $isCorrect = (bool) $detail->is_correct;
                $isUnanswered = is_null($detail->selected_answer_id);
                $cardClass = $isCorrect ? 'is-correct-card' : ($isUnanswered ? 'is-unanswered-card' : 'is-wrong-card');
            @endphp

            <div class="cbt-q-card-modern {{ $cardClass }}">
                {{-- Topbar Nomor & Status Nilai --}}
                <div class="cbt-q-topbar">
                    <span class="cbt-q-num">
                        <span>Soal No. {{ $index + 1 }}</span>
                    </span>

                    <div>
                        @if ($isCorrect)
                            <span style="font-size: 0.74rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 2rem; background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); display: inline-flex; align-items: center; gap: 0.3rem;">
                                <svg style="width: 0.75rem; height: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                Benar (+{{ number_format((float)$detail->score, 1) }} poin)
                            </span>
                        @elseif ($isUnanswered)
                            <span style="font-size: 0.74rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 2rem; background: rgba(148, 163, 184, 0.15); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.3); display: inline-flex; align-items: center; gap: 0.3rem;">
                                Tidak Dijawab (0 poin)
                            </span>
                        @else
                            <span style="font-size: 0.74rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 2rem; background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); display: inline-flex; align-items: center; gap: 0.3rem;">
                                <svg style="width: 0.75rem; height: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Salah (0 poin)
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Konten Pertanyaan --}}
                <div class="cbt-q-text">
                    {!! $detail->question?->payload ?? '<em>Pertanyaan telah dihapus</em>' !!}
                </div>

                {{-- Perbandingan Jawaban --}}
                <div class="cbt-answers-box">
                    {{-- Jawaban Siswa --}}
                    <div class="cbt-ans-card" style="{{ $isCorrect ? 'border-color: rgba(16, 185, 129, 0.3); background: rgba(16, 185, 129, 0.03);' : ($isUnanswered ? '' : 'border-color: rgba(239, 68, 68, 0.3); background: rgba(239, 68, 68, 0.03);') }}">
                        <span class="cbt-ans-label" style="color: {{ $isCorrect ? '#10b981' : ($isUnanswered ? 'inherit' : '#ef4444') }};">
                            <span>Jawaban Kamu:</span>
                        </span>
                        <div class="cbt-ans-body" style="color: {{ $isCorrect ? '#10b981' : ($isUnanswered ? 'inherit' : '#ef4444') }};">
                            @if ($isUnanswered)
                                <span style="opacity: 0.5; font-style: italic;">(Tidak memilih jawaban)</span>
                            @else
                                {{ $detail->student_answer_text ?? $detail->selectedAnswer?->text ?? '-' }}
                            @endif
                        </div>
                    </div>

                    {{-- Kunci Jawaban Resmi --}}
                    <div class="cbt-ans-card" style="border-color: rgba(16, 185, 129, 0.3); background: rgba(16, 185, 129, 0.03);">
                        <span class="cbt-ans-label" style="color: #10b981;">
                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Kunci Jawaban Resmi:</span>
                        </span>
                        <div class="cbt-ans-body" style="color: #10b981;">
                            {{ $detail->correct_answer_text ?? $detail->correctAnswer?->text ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- Pembahasan / Penjelasan Soal --}}
                @if ($detail->question?->description)
                    <div class="cbt-explain-box">
                        <div style="font-weight: 700; color: #818cf8; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.35rem;">
                            <svg style="width: 0.9rem; height: 0.9rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Pembahasan Materi:</span>
                        </div>
                        <div style="opacity: 0.9;">
                            {{ $detail->question->description }}
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div style="text-align: center; padding: 2.5rem 1rem; opacity: 0.6; font-size: 0.88rem;">
                Tidak ada rincian soal untuk rekapan ujian ini.
            </div>
        @endforelse
    </div>
</div>
