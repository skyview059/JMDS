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
            border: 2px solid #333; 
            border-radius: 8px;
        }

        .IDCard, .Backside {
            width: 2.63in; 
            height: 3.88in; 
            margin: 10px; 
            position: relative; 
            float: left; 
            border-radius: 8px; 
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .IDCard { 
            border: 1px solid #CCC; 
            background-color: #FFF;
        }

        .card-bg-img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: fill;
        }

        /* Center-aligned container over the hexagon */
        .id-display-container {
            position: absolute;
            top: 53%; 
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            text-align: center;
            z-index: 10; 
        }

        .learner-id {
            font-size: 6rem; 
            font-weight: bold;
            color: #e30713; 
            margin: 0;
            padding: 0;
            font-family: fantasy;
            letter-spacing: 3px;
        }
        
        /* Back side styling */
        .Backside { 
            background-color: #FFF; 
            border: 1px solid #CCC; 
            text-align: center; 
            padding: 20px 15px; 
        }
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

            .learner-id {
                color: #e30713 !important; /* প্রিন্ট করার সময়ও জোরপূর্বক এই কালারটিই পাবে */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
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
            <img class="card-bg-img" src="<?= base_url('uploads/id_card.png') ?>" alt="ID Card BG">
            
            <div class="id-display-container">
                <div class="learner-id">
                    <?= htmlspecialchars((string)($learner->id ?? '')) ?>
                </div>
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