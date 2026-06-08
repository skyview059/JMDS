<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print ID Card - <?= htmlspecialchars((string)($learner->name ?? '')) ?></title>
    <link href="<?= base_url('assets/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body { background-color: #EEE; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 0; }
        
        /* Screen mode block for header */
        .no-print-header {
            background-color: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Container styling */
        .A4Landscape { width: 11.7in; margin: 0 auto; padding: 20px; box-sizing: border-box; }
        
        /* Wrapper to keep Front and Back sides contained nicely */
        .card-container {
            display: inline-block;
            background-color: #FFF;
            padding: 15px;
            border: 2px solid #333; /* Container border */
            border-radius: 8px;
        }

        .IDCard, .Backside {
            background-color: #FFF; border: 1px solid #CCC; margin: 10px; text-align: center; padding: 15px;
            width: 2.63in; height: 3.88in; position: relative; float: left; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }
        .IDCard { border-top: 5px solid #ff9d27; }
        .photo { margin-top: 15px; }
        .photo img.radius {
            border-radius: 50%; height: 90px; background-color: #fff; border: 3px solid #ff9d27; width: 90px; object-fit: cover;
        }
        .name { font-size: 13pt; font-weight: 600; margin-top: 10px; }
        .designation { font-size: 10pt; color: #555; }
        .blood { font-size: 9pt; margin-top: 5px; font-weight: bold; color: #d9534f; }
        .auth_sign { position: absolute; right: 15px; bottom: 10px; left: 15px; font-size: 8pt; text-align: right; }
        .auth_sign hr { border-top: 1px solid #000; margin: 0 0 2px 0; width: 80px; display: inline-block; }
        
        /* Back side */
        .Backside { padding: 20px 15px; }
        .note { font-size: 9pt; line-height: 1.3; }
        .company { font-size: 11pt; border: 1px solid #444; margin: 10px auto 0; font-weight: bold; padding: 5px; }
        .address { text-align: right; font-size: 8pt; margin-top: 15px; line-height: 1.4; }
        .clearfix::after { content: ""; clear: both; display: table; }

        /* Force standard colors during print */
        * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; print-color-adjust: exact !important; }
        
        /* Print Media Styles */
        @media print {
            @page { size: A4 landscape; margin: 0.3in; }
            body { background-color: #FFF; }
            
            /* Hide the action header during print */
            .no-print-header { display: none !important; }
            
            .A4Landscape { padding: 0; margin: 0; width: 100%; }
            .card-container { border: 2px solid #333 !important; box-shadow: none; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="no-print-header">
    <h4 style="margin: 0; color: #333;">Learner ID Card Preview (Single)</h4>
    <button onclick="window.print()" class="btn btn-warning text-white font-weight-bold px-4">
        Print ID Card
    </button>
</div>

<div class="A4Landscape">
    <div class="card-container clearfix">
        
        <div class="IDCard">
            <div style="color:#ff9d27; font-weight:bold; font-size:16pt; font-style:italic; line-height: 1;">JMDS</div>
            <div style="font-size:7pt; color:#555; margin-bottom: 5px;">INNOVATION IN LEARNING</div>

            <div class="photo">
                <?php if(!empty($learner->photo)): ?>
                    <img class="radius" src="<?= base_url('uploads/learner/' . $learner->photo) ?>">
                <?php else: ?>
                    <div style="height: 90px; width: 90px; border-radius: 50%; background: #ccc; display: inline-block; border: 3px solid #ff9d27;"></div>
                <?php endif; ?>
            </div>
            <div class="name"><?= htmlspecialchars((string)($learner->name ?? '')) ?></div>
            <div class="designation">Batch: <?= htmlspecialchars((string)($learner->batch_name ?? '')) ?></div>
            <div class="blood">Blood: <?= htmlspecialchars((string)($learner->blood_group ?? '')) ?></div>  
            
            <div class="auth_sign">
                <hr/><br/>
                Authorized Signatory
            </div>  
        </div> 
                
        <div class="Backside">
            <div class="note">
                This is to certify that the person whose name &
                photograph appear on this card is a Learner of:
            </div>
            <div class="company">
                JMDS
            </div>
            <div class="address">
                <p><strong>JMDS Learner System</strong><br/>    
                Contact: <?= htmlspecialchars((string)($learner->primary_mobile ?? '')) ?><br/>
                Bangladesh.</p>
            </div>
        </div>

    </div>
</div>

</body>
</html>