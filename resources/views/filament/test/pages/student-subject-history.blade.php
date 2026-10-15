<x-filament-panels::page>
    <style>
        .cbt-history-container {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            font-family: inherit;
        }

        /* Hero Banner */
        .cbt-hero-banner {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            padding: 1.75rem 2rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.18) 0%, rgba(139, 92, 246, 0.12) 50%, rgba(6, 182, 212, 0.08) 100%);
            border: 1px solid rgba(99, 102, 241, 0.25);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.08), 0 8px 10px -6px rgba(99, 102, 241, 0.05);
        }

        .cbt-hero-decor {
            position: absolute;
            right: -2rem;
            top: -2rem;
            width: 14rem;
            height: 14rem;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, rgba(99, 102, 241, 0) 70%);
            pointer-events: none;
            border-radius: 50%;
        }

        .cbt-hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .cbt-hero-title {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0 0 0.4rem 0;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .cbt-hero-desc {
            font-size: 0.88rem;
            opacity: 0.78;
            margin: 0;
            max-width: 540px;
            line-height: 1.5;
        }

        .cbt-hero-chips {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .cbt-hero-chip {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.95rem;
            border-radius: 0.65rem;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            font-size: 0.82rem;
            font-weight: 600;
        }

        /* Section Headings */
        .cbt-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.85rem;
        }

        .cbt-section-title {
            font-size: 1.05rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cbt-section-subtitle {
            font-size: 0.8rem;
            opacity: 0.65;
        }

        /* Subjects Grid */
        .cbt-subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 1rem;
        }

        .cbt-subject-card {
            text-align: left;
            position: relative;
            padding: 1.2rem;
            border-radius: 0.85rem;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.03);
            cursor: pointer;
            width: 100%;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 135px;
        }

        .cbt-subject-card:hover {
            transform: translateY(-3px);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.08), 0 0 15px -3px rgba(99, 102, 241, 0.15);
            background: rgba(99, 102, 241, 0.03);
        }

        .cbt-subject-card.is-active {
            border-color: #6366f1;
            background: linear-gradient(145deg, rgba(99, 102, 241, 0.12) 0%, rgba(139, 92, 246, 0.06) 100%);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.25), 0 12px 24px -6px rgba(99, 102, 241, 0.2);
        }

        .cbt-subject-top {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            margin-bottom: 0.75rem;
        }

        .cbt-subject-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.25) 100%);
            color: #818cf8;
            flex-shrink: 0;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .cbt-subject-card.is-active .cbt-subject-icon {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.35);
        }

        .cbt-subject-name {
            font-size: 0.95rem;
            font-weight: 700;
            line-height: 1.3;
            margin: 0 0 0.25rem 0;
        }

        .cbt-subject-desc {
            font-size: 0.76rem;
            opacity: 0.68;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .cbt-subject-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 0.75rem;
            border-top: 1px solid rgba(148, 163, 184, 0.12);
            font-size: 0.72rem;
            opacity: 0.75;
        }

        .cbt-badge-active {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 0.15rem 0.55rem;
            border-radius: 0.35rem;
            background: rgba(99, 102, 241, 0.2);
            color: #818cf8;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* KPI Analytics Cards */
        .cbt-analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .cbt-kpi-card {
            position: relative;
            padding: 1.25rem;
            border-radius: 0.85rem;
            border: 1px solid rgba(148, 163, 184, 0.15);
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .cbt-kpi-card:hover {
            transform: translateY(-2px);
            border-color: rgba(148, 163, 184, 0.35);
        }

        .cbt-kpi-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .cbt-kpi-label {
            font-size: 0.78rem;
            font-weight: 600;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .cbt-kpi-icon {
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 0.55rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cbt-kpi-val {
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .cbt-kpi-footer {
            font-size: 0.72rem;
            opacity: 0.65;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .cbt-progress-bar {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: rgba(148, 163, 184, 0.15);
            margin-top: 0.65rem;
            overflow: hidden;
        }

        .cbt-progress-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.6s ease;
        }

        /* History Table & Cards */
        .cbt-history-wrapper {
            border-radius: 0.85rem;
            border: 1px solid rgba(148, 163, 184, 0.18);
            background: rgba(255, 255, 255, 0.02);
            overflow: hidden;
        }

        .cbt-modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .cbt-modern-table th {
            padding: 0.85rem 1.1rem;
            text-align: left;
            font-size: 0.74rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.65;
            background: rgba(148, 163, 184, 0.04);
            border-bottom: 1px solid rgba(148, 163, 184, 0.15);
        }

        .cbt-modern-table td {
            padding: 1rem 1.1rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            vertical-align: middle;
        }

        .cbt-modern-table tr:last-child td {
            border-bottom: none;
        }

        .cbt-modern-table tr:hover td {
            background: rgba(99, 102, 241, 0.02);
        }

        /* Status & Score Pills */
        .cbt-score-pill {
            display: inline-flex;
            align-items: baseline;
            gap: 0.2rem;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 800;
            font-size: 1rem;
        }

        .cbt-score-pill.is-high {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .cbt-score-pill.is-mid {
            background: rgba(245, 158, 11, 0.12);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.25);
        }

        .cbt-score-pill.is-low {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        .cbt-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.65rem;
            border-radius: 2rem;
            font-size: 0.73rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .cbt-status-badge.passed {
            background: rgba(16, 185, 129, 0.15);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .cbt-status-badge.remedial {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .cbt-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 6px currentColor;
        }

        .cbt-breakdown-tags {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.74rem;
        }

        .cbt-tag {
            padding: 0.2rem 0.45rem;
            border-radius: 0.35rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .cbt-tag-correct {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
        }

        .cbt-tag-wrong {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
        }

        .cbt-tag-empty {
            background: rgba(148, 163, 184, 0.12);
            color: #94a3b8;
        }

        /* Empty State */
        .cbt-empty-state {
            padding: 3.5rem 1.5rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .cbt-empty-icon {
            width: 4.5rem;
            height: 4.5rem;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.08);
            border: 1px dashed rgba(99, 102, 241, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #818cf8;
            margin-bottom: 1rem;
        }
    </style>

    <div class="cbt-history-container">
        {{-- Hero Header --}}
        <div class="cbt-hero-banner">
            <div class="cbt-hero-decor"></div>
            <div class="cbt-hero-content">
                <div>
                    <h1 class="cbt-hero-title">
                        <span>Histori & Pencapaian Belajar</span>
                        <span style="font-size: 1.25rem;">🎓</span>
                    </h1>
                    <p class="cbt-hero-desc">
                        Pantau seluruh riwayat pengerjaan ujian, evaluasi skor hasil tes, dan pelajari pembahasan soal untuk mengasah pemahaman materi pelajaranmu.
                    </p>
                </div>

                {{-- Global Student KPI Chips --}}
                <div class="cbt-hero-chips">
                    <div class="cbt-hero-chip">
                        <svg style="width: 1rem; height: 1rem; color: #818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        <span>{{ $overallStats['totalExams'] }} Ujian Total</span>
                    </div>

                    <div class="cbt-hero-chip">
                        <svg style="width: 1rem; height: 1rem; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Rata-rata: {{ $overallStats['averageScore'] }}</span>
                    </div>

                    <div class="cbt-hero-chip">
                        <svg style="width: 1rem; height: 1rem; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <span>{{ $overallStats['passRate'] }}% Kelulusan</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 1: Pemilihan Mata Pelajaran --}}
        <div>
            <div class="cbt-section-header">
                <div>
                    <h2 class="cbt-section-title">
                        <svg style="width: 1.15rem; height: 1.15rem; color: #818cf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Pilih Mata Pelajaran</span>
                    </h2>
                    <span class="cbt-section-subtitle">Klik salah satu mata pelajaran di bawah untuk melihat rincian evaluasi nilaimu</span>
                </div>
            </div>

            <div class="cbt-subjects-grid">
                @foreach ($subjects as $mapel)
                    @php
                        $isSelected = $selectedSubjectId == $mapel->id;
                    @endphp
                    <button 
                        type="button"
                        wire:click="selectSubject({{ $mapel->id }})"
                        class="cbt-subject-card {{ $isSelected ? 'is-active' : '' }}"
                    >
                        <div>
                            <div class="cbt-subject-top">
                                <div class="cbt-subject-icon">
                                    <svg style="width: 1.3rem; height: 1.3rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem;">
                                        <h3 class="cbt-subject-name" title="{{ $mapel->name }}">
                                            {{ $mapel->name }}
                                        </h3>
                                        @if ($isSelected)
                                            <span class="cbt-badge-active">
                                                <svg style="width: 0.75rem; height: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Dipilih
                                            </span>
                                        @endif
                                    </div>
                                    <p class="cbt-subject-desc">
                                        {{ $mapel->description ?: 'Tidak ada deskripsi mata pelajaran' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cbt-subject-footer">
                            <span>
                                <strong>{{ $mapel->questions_count }}</strong> Soal &bull; <strong>{{ $mapel->exams_count }}</strong> Sesi
                            </span>
                            @if(isset($mapel->student_taken_count) && $mapel->student_taken_count > 0)
                                <span style="color: #10b981; font-weight: 600;">
                                    {{ $mapel->student_taken_count }} Dikerjakan
                                </span>
                            @else
                                <span style="opacity: 0.5;">Belum ada tes</span>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Section 2: Deep-Dive Analisis & Riwayat Ujian Mata Pelajaran --}}
        @if ($selectedSubject)
            <div>
                <div class="cbt-section-header">
                    <div>
                        <h2 class="cbt-section-title">
                            <svg style="width: 1.15rem; height: 1.15rem; color: #6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>Analisis & Riwayat: {{ $selectedSubject->name }}</span>
                        </h2>
                        <span class="cbt-section-subtitle">Rangkuman capaian kompetensi dan histori seluruh sesi ujian yang telah diselesaikan</span>
                    </div>
                </div>

                {{-- 4 Modern KPI Cards --}}
                <div class="cbt-analytics-grid">
                    {{-- Total Ujian --}}
                    <div class="cbt-kpi-card">
                        <div class="cbt-kpi-top">
                            <span class="cbt-kpi-label">Ujian Selesai</span>
                            <div class="cbt-kpi-icon" style="background: rgba(99, 102, 241, 0.12); color: #818cf8;">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="cbt-kpi-val" style="color: #818cf8;">
                            {{ $stats['totalExamsTaken'] }}
                        </div>
                        <div class="cbt-kpi-footer">
                            <span>Sesi ujian terdata di sistem</span>
                        </div>
                    </div>

                    {{-- Nilai Rata-rata --}}
                    <div class="cbt-kpi-card">
                        <div class="cbt-kpi-top">
                            <span class="cbt-kpi-label">Rata-rata Nilai</span>
                            <div class="cbt-kpi-icon" style="background: rgba(6, 182, 212, 0.12); color: #06b6d4;">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                            </div>
                        </div>
                        <div class="cbt-kpi-val" style="color: {{ $stats['averageScore'] >= 75 ? '#10b981' : ($stats['averageScore'] >= 60 ? '#f59e0b' : '#ef4444') }};">
                            {{ number_format((float)$stats['averageScore'], 1) }}
                        </div>
                        <div class="cbt-kpi-footer">
                            <span>Dari skala maksimal 100</span>
                        </div>
                    </div>

                    {{-- Nilai Tertinggi --}}
                    <div class="cbt-kpi-card">
                        <div class="cbt-kpi-top">
                            <span class="cbt-kpi-label">Skor Terbaik</span>
                            <div class="cbt-kpi-icon" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b;">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="cbt-kpi-val" style="color: #f59e0b;">
                            {{ number_format((float)$stats['highestScore'], 1) }}
                        </div>
                        <div class="cbt-kpi-footer">
                            <span>Rekor nilai tertinggi kamu</span>
                        </div>
                    </div>

                    {{-- Ketuntasan Belajar --}}
                    <div class="cbt-kpi-card">
                        <div class="cbt-kpi-top">
                            <span class="cbt-kpi-label">Tingkat Kelulusan</span>
                            <div class="cbt-kpi-icon" style="background: rgba(16, 185, 129, 0.12); color: #10b981;">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="cbt-kpi-val" style="color: #10b981;">
                            {{ $stats['passRate'] }}%
                        </div>
                        <div class="cbt-progress-bar">
                            <div class="cbt-progress-fill" style="width: {{ $stats['passRate'] }}%; background: linear-gradient(90deg, #10b981, #06b6d4);"></div>
                        </div>
                        <div class="cbt-kpi-footer">
                            <span>{{ $stats['passedCount'] }} dari {{ $stats['totalExamsTaken'] }} sesi lulus standar</span>
                        </div>
                    </div>
                </div>

                {{-- Riwayat Tabel Sesi Ujian --}}
                <div class="cbt-history-wrapper">
                    @if ($results->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="cbt-modern-table">
                                <thead>
                                    <tr>
                                        <th>Sesi Ujian</th>
                                        <th>Waktu Pengerjaan</th>
                                        <th style="text-align: center;">Hasil Jawaban</th>
                                        <th style="text-align: center;">Skor Akhir</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: right;">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        @php
                                            $score = (float)$result->score;
                                            $scoreClass = $score >= 75 ? 'is-high' : ($score >= 60 ? 'is-mid' : 'is-low');
                                        @endphp
                                        <tr>
                                            {{-- Sesi Ujian --}}
                                            <td>
                                                <div style="font-weight: 700; font-size: 0.92rem; margin-bottom: 0.2rem;">
                                                    {{ $result->exam?->title ?? 'Sesi Ujian #' . $result->id }}
                                                </div>
                                                <div style="font-size: 0.74rem; opacity: 0.65; display: flex; align-items: center; gap: 0.4rem;">
                                                    <span>{{ $result->total_questions }} Soal</span>
                                                    <span>&bull;</span>
                                                    <span>{{ $result->duration_spent_minutes ?? '-' }} Menit</span>
                                                </div>
                                            </td>

                                            {{-- Waktu --}}
                                            <td>
                                                <div style="font-size: 0.84rem; font-weight: 500;">
                                                    {{ $result->exam_date ? $result->exam_date->translatedFormat('d M Y') : '-' }}
                                                </div>
                                                <div style="font-size: 0.74rem; opacity: 0.65;">
                                                    {{ $result->exam_date ? $result->exam_date->format('H:i') . ' WIB' : '-' }}
                                                </div>
                                            </td>

                                            {{-- Rincian Jawaban --}}
                                            <td style="text-align: center;">
                                                <div class="cbt-breakdown-tags" style="justify-content: center;">
                                                    <span class="cbt-tag cbt-tag-correct" title="Benar">
                                                        <svg style="width: 0.7rem; height: 0.7rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        {{ $result->correct_answers }}
                                                    </span>
                                                    <span class="cbt-tag cbt-tag-wrong" title="Salah">
                                                        <svg style="width: 0.7rem; height: 0.7rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        {{ $result->wrong_answers }}
                                                    </span>
                                                    <span class="cbt-tag cbt-tag-empty" title="Kosong / Tidak Dijawab">
                                                        <svg style="width: 0.7rem; height: 0.7rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4" />
                                                        </svg>
                                                        {{ $result->unanswered }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Skor --}}
                                            <td style="text-align: center;">
                                                <span class="cbt-score-pill {{ $scoreClass }}">
                                                    {{ number_format($score, 1) }}
                                                </span>
                                            </td>

                                            {{-- Status --}}
                                            <td style="text-align: center;">
                                                @if ($result->is_passed)
                                                    <span class="cbt-status-badge passed">
                                                        <span class="cbt-status-dot"></span>
                                                        LULUS
                                                    </span>
                                                @else
                                                    <span class="cbt-status-badge remedial">
                                                        <span class="cbt-status-dot"></span>
                                                        REMEDIAL
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- Aksi --}}
                                            <td style="text-align: right;">
                                                <x-filament::button
                                                    tag="a"
                                                    size="xs"
                                                    color="gray"
                                                    icon="heroicon-m-eye"
                                                    href="{{ route('filament.test.resources.exam-histories.view', ['record' => $result->id]) }}"
                                                >
                                                    Pembahasan
                                                </x-filament::button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Empty State --}}
                        <div class="cbt-empty-state">
                            <div class="cbt-empty-icon">
                                <svg style="width: 2.25rem; height: 2.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 style="font-size: 1rem; font-weight: 700; margin: 0 0 0.35rem 0;">
                                Belum Ada Riwayat Ujian
                            </h3>
                            <p style="font-size: 0.82rem; opacity: 0.65; max-width: 380px; margin: 0 0 1.25rem 0; line-height: 1.45;">
                                Kamu belum menyelesaikan sesi ujian pada mata pelajaran <strong>{{ $selectedSubject->name }}</strong>. Mulai kerjakan ujian untuk melihat rekapan nilaimu di sini!
                            </p>
                            <x-filament::button
                                tag="a"
                                size="sm"
                                color="primary"
                                icon="heroicon-m-arrow-right"
                                icon-position="after"
                                href="{{ route('filament.test.resources.exams.index') }}"
                            >
                                Buka Daftar Ujian
                            </x-filament::button>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
