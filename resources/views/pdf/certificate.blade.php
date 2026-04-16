<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Penyelesaian</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Serif', Georgia, serif;
            background: #ffffff;
            width: 297mm;
            height: 210mm;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1a1a2e;
            position: relative;
        }

        .outer-border {
            position: absolute;
            inset: 6mm;
            border: 3px solid #6c63ff;
            border-radius: 4mm;
        }

        .inner-border {
            position: absolute;
            inset: 9mm;
            border: 1px solid #e0d9ff;
            border-radius: 3mm;
        }

        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 12mm 24mm;
            width: 100%;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120pt;
            color: rgba(108, 99, 255, 0.04);
            font-weight: 900;
            z-index: 1;
            white-space: nowrap;
        }

        .brand {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #6c63ff;
            margin-bottom: 3mm;
        }

        .headline {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            color: #888;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 5mm;
        }

        .divider {
            width: 80mm;
            height: 2px;
            background: linear-gradient(to right, transparent, #6c63ff, transparent);
            margin: 0 auto 6mm;
        }

        .recipient-label {
            font-size: 10pt;
            color: #aaa;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 2mm;
        }

        .recipient-name {
            font-size: 30pt;
            font-weight: 900;
            color: #1a1a2e;
            margin-bottom: 5mm;
            font-family: 'DejaVu Serif', Georgia, serif;
        }

        .body-text {
            font-size: 10pt;
            color: #555;
            line-height: 1.8;
            max-width: 200mm;
            margin: 0 auto 4mm;
        }

        .course-name {
            font-size: 16pt;
            font-weight: 700;
            color: #6c63ff;
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 2mm 0;
        }

        .divider-thin {
            width: 50mm;
            height: 1px;
            background: #e0d9ff;
            margin: 6mm auto;
        }

        .meta-row {
            display: flex;
            justify-content: center;
            gap: 20mm;
            margin-top: 8mm;
            font-family: 'DejaVu Sans', Arial, sans-serif;
        }

        .meta-item {
            text-align: center;
        }

        .meta-label {
            font-size: 7pt;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #aaa;
            margin-bottom: 1mm;
        }

        .meta-value {
            font-size: 9pt;
            font-weight: 700;
            color: #333;
            border-top: 1px solid #ddd;
            padding-top: 1mm;
            min-width: 50mm;
        }

        .corner {
            position: absolute;
            width: 16mm;
            height: 16mm;
            border-color: #6c63ff;
            border-style: solid;
        }
        .corner-tl { top: 15mm; left: 15mm; border-width: 2px 0 0 2px; }
        .corner-tr { top: 15mm; right: 15mm; border-width: 2px 2px 0 0; }
        .corner-bl { bottom: 15mm; left: 15mm; border-width: 0 0 2px 2px; }
        .corner-br { bottom: 15mm; right: 15mm; border-width: 0 2px 2px 0; }
    </style>
</head>
<body>
    <div class="outer-border"></div>
    <div class="inner-border"></div>
    <div class="corner corner-tl"></div>
    <div class="corner corner-tr"></div>
    <div class="corner corner-bl"></div>
    <div class="corner corner-br"></div>

    <div class="watermark">✦</div>

    <div class="content">
        <div class="brand">Orb Science Academy</div>
        <div class="headline">Certificate of Completion</div>
        <div class="divider"></div>

        <div class="recipient-label">Proudly Presented To</div>
        <div class="recipient-name">{{ $user->name }}</div>

        <p class="body-text">
            Telah berhasil menyelesaikan seluruh materi dan memenuhi semua persyaratan dalam kursus
        </p>

        <div class="course-name">{{ $course->title }}</div>

        <p class="body-text" style="font-size:9pt; color:#aaa;">
            dengan penuh dedikasi dan semangat belajar yang tinggi.
        </p>

        <div class="divider-thin"></div>

        <div class="meta-row">
            <div class="meta-item">
                <div class="meta-label">Tanggal Selesai</div>
                <div class="meta-value">{{ $enrollment->updated_at->format('d F Y') }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Instruktur</div>
                <div class="meta-value">{{ $course->instructor->user->name ?? 'Orb Science' }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">ID Sertifikat</div>
                <div class="meta-value">OA-{{ str_pad($enrollment->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
    </div>
</body>
</html>
