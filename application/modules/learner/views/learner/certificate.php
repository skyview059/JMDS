<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Certificate - <?= htmlspecialchars((string)($learner->name ?? 'Imran Sardar')) ?></title>
    <link href="<?= base_url('assets/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=UnifrakturMaguntia&display=swap" rel="stylesheet">

    <style>
        body { background-color: #EEE; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; }
        
        .no-print-header {
            background-color: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 999;
        }

        * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; print-color-adjust: exact !important; }
        
        /* মেইন সার্টিফিকেট কন্টেইনার */
        .cert-container {
            width: 11.0in; height: 7.6in; margin: 0.3in auto; background-color: #fff; padding: 60px 90px; 
            text-align: center; position: relative; box-sizing: border-box;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            
            /* মোস্ট ইম্পর্ট্যান্ট: এখানে আপনার কাটা বর্ডার ইমেজটি সেট হবে */
            border: 30px solid transparent;
            border-image: url('<?= base_url("assets/images/cert-border.png") ?>') 40 round; 
        }

        /* ফন্ট সেটিংস */
        .cert-institution { 
            font-family: 'UnifrakturMaguntia', serif; 
            font-size: 34pt; font-weight: bold; color: #222; margin-bottom: 0px; line-height: 1.1;
        }
        .cert-location { 
            font-family: 'UnifrakturMaguntia', serif; 
            font-size: 20pt; color: #222; margin-bottom: 25px; 
        }
        .cert-title { 
            font-family: 'UnifrakturMaguntia', serif; 
            font-size: 26pt; margin-bottom: 35px; color: #222;
        }
        
        .cert-body { 
            font-family: 'Georgia', serif; font-size: 17pt; line-height: 2.0; color: #222; text-align: justify; text-justify: inter-word; margin: 0 20px;
        }
        
        /* ডাইনামিক ডেটার নিচে ড্যাশড আন্ডারলাইন */
        .dynamic-data {
            font-family: 'Alex Brush', cursive; 
            font-size: 26pt; font-weight: bold; color: #111; display: inline-block; padding: 0 4px; border-bottom: 1px dashed #444; line-height: 0.8;
        }
        .dynamic-data-italic {
            font-family: 'Alex Brush', cursive; font-size: 26pt; font-style: italic; display: inline-block; padding: 0 4px; border-bottom: 1px dashed #444; line-height: 0.8;
        }

        /* বটম ফুটার */
        .cert-bottom-section {
            position: absolute; bottom: 65px; left: 90px; right: 90px; display: flex; justify-content: space-between; align-items: flex-end;
        }
        
        .date-location-block {
            text-align: left; font-family: 'Alex Brush', cursive; font-size: 20pt; line-height: 1.4; color: #222;
        }
        .date-location-block span {
            font-family: 'Georgia', serif; font-size: 12pt; font-weight: bold; display: inline-block; width: 45px;
        }

        .signature-block { 
            text-align: center; font-family: 'Georgia', serif; font-size: 11pt; color: #333; line-height: 1.4; max-width: 320px;
        }
        .signature-img-space { height: 50px; position: relative; }

        /* প্রিন্ট মিডিয়া কন্ট্রোল */
        @media print {
            @page { size: A4 landscape; margin: 0; }
            body { background-color: #FFF; -webkit-print-color-adjust: exact; }
            .no-print-header { display: none !important; }
            
            .cert-container { 
                margin: 0 auto; 
                box-shadow: none !important;
                page-break-inside: avoid;
                width: 100%; height: 100vh;
                /* প্রিন্টেও যেন ইমেজ বর্ডারটি নিখুঁতভাবে পায় */
                border: 30px solid transparent !important;
                border-image: url('<?= base_url("assets/images/cert-border.png") ?>') 40 round !important;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="no-print-header">
    <h4 style="margin: 0; color: #333; font-weight: 600;">Jahanabad Military Driving School - Certificate Preview</h4>
    <button onclick="window.print()" class="btn btn-warning text-white font-weight-bold px-4">
        Print Certificate
    </button>
</div>

<div class="cert-container">
    
    <div class="cert-institution">Jahanabad Military Driving School</div>
    <div class="cert-location">Jahanabad Cantonment, Khulna</div>
    <div class="cert-title">This is to Certify That</div>
    
    <div class="cert-body">
        <span class="dynamic-data"><?= htmlspecialchars((string)($learner->name ?? 'Imran Sardar')) ?></span> son of 
        <span class="dynamic-data"><?= htmlspecialchars((string)($learner->father_name ?? 'Ruhul Amin Sardar')) ?></span> has successfully completed 
        the <span class="dynamic-data-italic"><?= htmlspecialchars((string)($learner->course_name ?? 'Driving Training Course-6 (Light Vehicle)')) ?></span> at this institution with 
        effect from <span class="dynamic-data"><?= htmlspecialchars((string)($learner->start_date ?? '01 March 2026')) ?></span> to 
        <span class="dynamic-data"><?= htmlspecialchars((string)($learner->end_date ?? '16 April 2026')) ?></span>. In testimony thereof he 
        is awarded with this certificate.
    </div>
    
    <div class="cert-bottom-section">
        <div class="date-location-block">
            Jahanabad Cantonment<br>
            Khulna<br>
            <span>Date :</span> <div class="dynamic-data" style="font-size: 18pt; border: none;"><?= htmlspecialchars((string)($learner->issue_date ?? '16 April 2026')) ?></div>
        </div>

        <div class="signature-block">
            <div class="signature-img-space"></div>
            <div style="border-top: 1px solid #222; margin-bottom: 5px; width: 250px; display: inline-block;"></div>
            <br>
            <strong>Brigadier General</strong><br>
            Commandant<br>
            <span style="font-style: italic; font-size: 10pt; color: #555;">Army Service Corps Centre & School</span>
        </div>
    </div>
</div>

</body>
</html>