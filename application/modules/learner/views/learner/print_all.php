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
            border: 2px solid #333; 
            border-radius: 8px;
        }

        /* CSS GRID TO FORCE EXACTLY 4 CARDS PER ROW */
        .id-card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 15px; 
        }
        
        .IDCard {
            background-color: #FFF;
            text-align: center; 
            box-sizing: border-box;
            height: 3.88in; 
            position: relative; 
            border-radius: 8px; 
            overflow: hidden;
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
            top: 53%; /* Centers it inside the white hexagon frame */
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
            letter-spacing: 4px;            
        }
        
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
                border: 2px solid #333 !important; 
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }

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
    <h4 style="margin: 0; color: #333;">ID Card Print Preview</h4>
    <button onclick="window.print()" class="btn btn-warning text-white font-weight-bold px-4">
        Print ID Cards
    </button>
</div>

<div class="A4Landscape">
    <div class="id-card-grid">
        <?php foreach($learners as $learner): ?>
            <div class="IDCard">
                <img class="card-bg-img" src="<?= base_url('uploads/id_card.png') ?>" alt="ID Card Background">
                
                <div class="id-display-container">
                    <div class="learner-id">
                        <?= htmlspecialchars((string)($learner->id ?? '')) ?>
                    </div>
                </div>
            </div> 
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>