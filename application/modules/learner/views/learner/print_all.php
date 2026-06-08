<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Learners - Print ID Cards</title>
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

        /* Container styling with border for page */
        .A4Landscape { 
            width: 11.4in; 
            margin: 0 auto 30px auto; 
            padding: 20px; 
            box-sizing: border-box; 
            background-color: #FFF;
            border: 2px solid #333; /* Full container border */
            border-radius: 8px;
        }

        /* CSS GRID TO FORCE EXACTLY 4 CARDS PER ROW */
        .id-card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Forces exactly 4 equal columns */
            gap: 15px; /* Spacing between the cards */
        }
        
        .IDCard {
            background-color: #FFF; 
            border: 1px solid #CCC; 
            text-align: center; 
            padding: 15px;
            box-sizing: border-box;
            height: 3.88in; 
            position: relative; 
            border-radius: 8px; 
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
            border-top: 5px solid #ff9d27;
        }

        .photo { margin-top: 5px; }
        .photo img.radius {
            border-radius: 50%; height: 90px; background-color: #fff; border: 3px solid #ff9d27; width: 90px; object-fit: cover;
        }
        .name { font-size: 13pt; font-weight: 600; margin-top: 10px; }
        .designation { font-size: 10pt; color: #555; }
        .blood { font-size: 9pt; margin-top: 5px; font-weight: bold; color: #d9534f; }
        .auth_sign { position: absolute; right: 15px; bottom: 10px; left: 15px; font-size: 8pt; text-align: right; }
        .auth_sign hr { border-top: 1px solid #000; margin: 0 0 2px 0; width: 80px; display: inline-block; }
        
        /* Color adjustment rule for standard colors during print */
        * { -webkit-print-color-adjust: exact !important; color-adjust: exact !important; print-color-adjust: exact !important; }
        
        /* Print Media Styles */
        @media print {
            @page { size: A4 landscape; margin: 0.3in; }
            body { background-color: #FFF; padding: 0; margin: 0; }
            
            /* Hide the action header during print */
            .no-print-header { display: none !important; }
            
            /* Print specific container adjustment */
            .A4Landscape { 
                width: 100%; 
                border: 2px solid #333 !important; /* Forces visible border on printed layout */
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }
        }
    </style>
</head>
<body>

<!-- Top Header with Print Button (Hidden in Print View) -->
<div class="no-print-header">
    <h4 style="margin: 0; color: #333;">ID Card Print Preview</h4>
    <button onclick="window.print()" class="btn btn-warning text-white font-weight-bold px-4">
        Print ID Cards
    </button>
</div>

<!-- Main Container -->
<div class="A4Landscape">
    <!-- Grid Container handles the 4 card distribution -->
    <div class="id-card-grid">
        <?php foreach($learners as $learner): ?>
            <div class="IDCard">
                <!-- Simulated Logo block to match the image structure -->
                <div style="color:#ff9d27; font-weight:bold; font-size:16pt; font-style:italic;">JMDS</div>
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
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>