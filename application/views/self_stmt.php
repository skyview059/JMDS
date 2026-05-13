
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            /* CSS Document */
            body, html, ul, li, p, h1, h2, h3, h4, h5, h6, table, td, th, div { color: #000; margin: 0; padding: 0; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; }
            li, p, td, th { font-size: 10pt; }
            body { width:816px; margin:0 auto; padding:8px 10px;}
            * { -webkit-print-color-adjust: exact; }
            h1 { font-size: 16pt; }
            h2 { font-size: 14pt; }
            h3 { font-size: 12pt; }
            h4 { font-size: 10pt; }

            .header { min-height: 50px; padding-bottom:10px; text-align: center;}
            .header h5 { font-weight: normal;}
            .header .left { width:35%; float:left; text-align:left;}
            .header .right { width:60%; float:right; text-align:right;}
            .header .right p { text-align:right;}
            .header p { text-align: left; }
            .header p span { float: right; }
            table { width: 100%; border-collapse: collapse; }
            table th { background: #EEE; text-align:left; }
            table th, 
            table td { font-size:9pt; padding: 1px 3px; border: 1px solid #BBB; }
            table td.tk,
            table th.tk { text-align: right; }
            .footer { }
            .footer p { font-size:9pt;}
            hr.borderline { border-bottom:0; border-top:1px solid #AAA; margin:2px 0 5px;}

            .bill_box { width:380px; display: inline-table;}
            .bill_box { padding: 5px 10px;  margin-bottom: 45px; border: 1px solid #DDD; }            
            div.bill_box:nth-child(odd){ float: left; }
            div.bill_box:nth-child(even) {float: right; }

            @media print {
                @page { size: A4;  margin: 0; padding:0; }                                
                .next_page { page-break-after: always;}
            }                     
        </style>
        <title>Subscriber Self Billing Status </title>
    </head>
    <body>
        <header>
            <center>
                <?php echo $header; ?>
                <?php echo $subscriber; ?>
            </center>            
        </header>

        
    </body>
</html>