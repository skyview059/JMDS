<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Certificate - <?= htmlspecialchars((string)($learner->name ?? '')) ?></title>
    <link href="<?= base_url('assets/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body { background-color: #EEE; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; }
        
        /* Screen mode block for header */
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
        
        .cert-container {
            width: 10.5in; height: 7.2in; margin: 0.3in auto; background-color: #fff; padding: 40px; 
            border: 15px solid #1a3a5c; text-align: center; position: relative; box-sizing: border-box;
            outline: 5px solid #ff9d27; outline-offset: -25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .cert-logo { margin-bottom: 20px; }
        .cert-title { font-size: 45pt; font-weight: bold; margin-bottom: 20px; color: #1a3a5c; text-transform: uppercase; font-family: Georgia, serif; }
        .cert-subtitle { font-size: 18pt; margin-bottom: 40px; color: #555; }
        .cert-name { font-size: 35pt; font-weight: bold; text-decoration: underline; margin-bottom: 30px; color: #ff9d27; font-family: Georgia, serif; }
        .cert-body { font-size: 16pt; margin-bottom: 60px; line-height: 1.6; color: #333; }
        .signature-block { position: absolute; bottom: 60px; right: 80px; text-align: center; }
        .signature-block hr { border-top: 2px solid #000; width: 200px; margin: 0 auto 10px; opacity: 1; }
        .date-block { position: absolute; bottom: 60px; left: 80px; text-align: center; }
        .date-block hr { border-top: 2px solid #000; width: 150px; margin: 0 auto 10px; opacity: 1; }

        /* Direct system layout management for print view */
        @media print {
            @page { size: A4 landscape; margin: 0; }
            body { background-color: #FFF; -webkit-print-color-adjust: exact; }
            
            /* Hide the top control block interface completely */
            .no-print-header { display: none !important; }
            
            /* Center the certificate container on actual paper */
            .cert-container { 
                margin: 0 auto; 
                box-shadow: none !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="no-print-header">
    <h4 style="margin: 0; color: #333; font-weight: 600;">Certificate Preview Interface</h4>
    <button onclick="window.print()" class="btn btn-warning text-white font-weight-bold px-4">
        Print Certificate
    </button>
</div>

<div class="cert-container">
    <div class="cert-title">CERTIFICATE OF COMPLETION</div>
    <div class="cert-subtitle">This is to proudly certify that</div>
    <div class="cert-name"><?= htmlspecialchars((string)($learner->name ?? '')) ?></div>
    <div class="cert-body">
        Has successfully completed the training and fulfilled all requirements<br>
        for <strong>Batch: <?= htmlspecialchars((string)($learner->batch_name ?? '')) ?></strong>.<br>
        We commend their dedication and wish them success in their future endeavors.
    </div>
    
    <div class="date-block">
        <div style="height:40px;"></div>
        <hr/>
        <strong>Date</strong>
    </div>

    <div class="signature-block">
        <div style="height:40px;"></div>
        <hr/>
        <strong>Authorized Signatory</strong>
    </div>
</div>

</body>
</html>