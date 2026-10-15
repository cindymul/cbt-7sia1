<x-filament-widgets::widget>
    <style>
        .cbt-widget-card {
            border-radius: 1rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.05) 50%, rgba(6, 182, 212, 0.03) 100%);
            border: 1px solid rgba(99, 102, 241, 0.22);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            font-family: inherit;
        }

        .cbt-widget-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-bottom: 1.25rem;
            margin-bottom: 1.25rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
        }

        .cbt-widget-greeting {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0 0 0.25rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cbt-widget-sub {
            font-size: 0.82rem;
            opacity: 0.7;
            margin: 0;
        }

        .cbt-widget-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.85rem;
            margin-bottom: 1.25rem;
        }

        .cbt-w-metric {
            padding: 1rem;
            border-radius: 0.75rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(148, 163, 184, 0.15);
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .cbt-w-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cbt-w-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            font-weight: 700;
            opacity: 0.65;
            display: block;
            margin-bottom: 0.15rem;
        }

        .cbt-w-val {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .cbt-recent-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 1rem;
            border-radius: 0.65rem;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(148, 163, 184, 0.12);
            margin-bottom: 0.6rem;
            transition: all 0.2s ease;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .cbt-recent-item:hover {
            border-color: rgba(99, 102, 241, 0.35);
            background: rgba(99, 102, 241, 0.03);
            transform: translateX(3px);
        }
    </style>

    <div class="cbt-widget-card">
        {{-- Widget Top Header --}}
        <div class="cbt-widget-header">
            <div>
                <h2 class="cbt-widget-greeting">
                    <span>Selamat Datang, {{ $student?->name ?? 'Siswa' }}</span>
                    <span>👋</span>
                </h2>
                <p class="cbt-widget-sub">
                    Berikut adalah ringkasan performa dan histori ujian terbarumu di portal CBT.
                </p>
            </div>

            <x-filament::button
                tag="a"
                size="sm"
                color="primary"
                icon="heroicon-m-academic-cap"
                href="{{ route('filament.test.pages.student-subject-history') }}"
            >
                Histori Pelajaran Lengkap
            </x-filament::button>
        </div>

        {{-- 3 Quick KPI Cards --}}
        <div class="cbt-widget-metrics">
            <div class="cbt-w-metric">
                <div class="cbt-w-icon" style="background: rgba(99, 102, 241, 0.15); color: #818cf8;">
                    <svg style="width: 1.35rem; height: 1.35rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <span class="cbt-w-label">Ujian Dikerjakan</span>
                    <span class="cbt-w-val" style="color: #818cf8;">{{ $totalExams }} Sesi</span>
                </div>
            </div>

            <div class="cbt-w-metric">
                <div class="cbt-w-icon" style="background: rgba(16, 185, 129, 0.15); color: #10b981;">
                    <svg style="width: 1.35rem; height: 1.35rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <div>
                    <span class="cbt-w-label">Rata-rata Skor</span>
                    <span class="cbt-w-val" style="color: {{ $averageScore >= 75 ? '#10b981' : ($averageScore >= 60 ? '#f59e0b' : '#ef4444') }};">
                        {{ number_format((float)$averageScore, 1) }}
                    </span>
                </div>
            </div>

            <div class="cbt-w-metric">
                <div class="cbt-w-icon" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;">
                    <svg style="width: 1.35rem; height: 1.35rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div>
                    <span class="cbt-w-label">Tingkat Kelulusan</span>
                    <span class="cbt-w-val" style="color: #f59e0b;">{{ $passRate }}%</span>
                </div>
            </div>
        </div>

        {{-- Riwayat Ujian Terbaru (Top 3) --}}
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                <span style="font-size: 0.85rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                    <svg style="width: 1rem; height: 1rem; color: #818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Histori Ujian Terbaru</span>
                </span>

                @if ($totalExams > 0)
                    <a href="{{ route('filament.test.resources.exam-histories.index') }}" style="font-size: 0.76rem; color: #818cf8; font-weight: 600; text-decoration: none;">
                        Lihat Semua Riwayat &rarr;
                    </a>
                @endif
            </div>

            @forelse ($recentExams as $item)
                @php
                    $isPassed = (bool) $item->is_passed;
                    $itemScore = (float) $item->score;
                @endphp
                <div class="cbt-recent-item">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 2.2rem; height: 2.2rem; border-radius: 0.5rem; background: rgba(99, 102, 241, 0.12); color: #818cf8; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;">
                            {{ mb_substr($item->subject?->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <div style="font-size: 0.88rem; font-weight: 700;">
                                {{ $item->exam?->title ?? 'Sesi Ujian' }}
                            </div>
                            <div style="font-size: 0.74rem; opacity: 0.65; display: flex; gap: 0.4rem; align-items: center;">
                                <span>{{ $item->subject?->name ?? '-' }}</span>
                                <span>&bull;</span>
                                <span>{{ $item->exam_date ? $item->exam_date->translatedFormat('d M Y, H:i') : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-size: 0.95rem; font-weight: 800; color: {{ $isPassed ? '#10b981' : '#ef4444' }};">
                            {{ number_format($itemScore, 1) }}
                        </span>

                        @if ($isPassed)
                            <span style="font-size: 0.7rem; font-weight: 700; padding: 0.2rem 0.55rem; border-radius: 1rem; background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">
                                Lulus
                            </span>
                        @else
                            <span style="font-size: 0.7rem; font-weight: 700; padding: 0.2rem 0.55rem; border-radius: 1rem; background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">
                                Remedial
                            </span>
                        @endif

                        <x-filament::button
                            tag="a"
                            size="xs"
                            color="gray"
                            href="{{ route('filament.test.resources.exam-histories.view', ['record' => $item->id]) }}"
                        >
                            Pembahasan
                        </x-filament::button>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 2rem 1rem; border-radius: 0.65rem; border: 1px dashed rgba(148, 163, 184, 0.25); background: rgba(255, 255, 255, 0.01);">
                    <p style="font-size: 0.85rem; opacity: 0.7; margin: 0 0 0.75rem 0;">
                        Belum ada ujian yang kamu selesaikan saat ini.
                    </p>
                    <x-filament::button
                        tag="a"
                        size="xs"
                        color="primary"
                        icon="heroicon-m-arrow-right"
                        icon-position="after"
                        href="{{ route('filament.test.resources.exams.index') }}"
                    >
                        Mulai Kerjakan Ujian
                    </x-filament::button>
                </div>
            @endforelse
        </div>
    </div>
</x-filament-widgets::widget>
