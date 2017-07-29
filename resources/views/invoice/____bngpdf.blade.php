<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">       

        <title>Laravel</title>             

        <!-- Styles -->
        <style>

            html, body {               
                color: #4c4c4c;
                font-family: 'SolaimanLipi', sans-serif;                
            }            
            
           @font-face {
            font-family: 'SolaimanLipi';
            src: url("{{ asset('fonts/SolaimanLipi_22-02-2012.ttf') }}") format("truetype");
            font-weight: normal;
            } 

            @font-face {
            font-family: 'SolaimanLipi';
            src: url("{{ asset('fonts/SolaimanLipi_Bold_10-03-12.ttf') }}") format("truetype");
            font-weight: bold;
            } 

            html { font: 16px/1 'SolaimanLipi', 'Open Sans', sans-serif; overflow-x: hidden; padding: 0.5in; }
            html { background: #999; cursor: default; }

            h1 { font: bold 100% 'SolaimanLipi'; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */
            #invoice { width: 100%;  }
            table { font-size: 75%; width: 100%; }
            /*table { font-size: 75%; table-layout: fixed; width: 100%; }*/
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }


            body { 
                box-sizing: border-box; 
                height: 11in; 
                margin: 0 auto; 
                overflow: hidden; 
                padding: 0.5in; 
                width: 100%; /*8.5in; */
                position: relative; 
                font-size: 1em;
            }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #4c4c4c; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            /*header span, header img { float: right; }*/
           /* header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }*/
            header img { max-height: 100%; max-width: 100%; width:95px; float:right;  margin: 0 0 1em 1em; }
            /*img { max-height: 100%; max-width: 100%; width:95px; }*/

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            table.owner { 
                float: left; 
                font-size: 60%; 
                font-style: normal; 
                /*line-height: 1.25;*/ 
                margin: 0 1em 1em 0; 
                width:40%; 
            }
            table.owner td { border-style: none; padding: 0.175em; }

            /* table recipient */
            table.recipient { float: left; width: 35%; }
            /*table.meta:after, table.balance:after { clear: both; content: ""; display: table; }*/

            /* table meta & balance */            

            table.meta, table.balance { float: right; width: 36%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th { font-weight: bold; text-align: left; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }
            

            footer {
                color: #5D6975;
                width: 88.3%;
                height: 30px;
                position: absolute;    
                border-top: 1px solid #C1CED9;
                padding: 8px 0;
                text-align: center;
                font-size: 12px;
               /* font-family: Arial;*/
                font-weight: 300;
                bottom: 0px;
                /*left: 0px;
                right: 0px;*/
                margin-bottom: 0px;
                /*background-color: red;*/
            }

            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { 
                    box-shadow: none; 
                    margin: 0; 
                    height: 11in; 
                    width: 8.5in;
                }                
                footer { width: 90%; }
            }

            @page { margin: 0; }
         
            /*==========  Mobile First Method  ==========*/

            /* Custom, iPhone Retina 320 ~479 */ 
            @media only screen and (min-width : 320px) {
                
                html { padding: 0.1in; }
                body {
                    height: auto;
                    padding: 0.1in; 
                    font-size: 0.813em;     
                }
            }

            /* Extra Small Devices, Phones 480~767 */ 
            @media only screen and (min-width : 480px) {  
                html { padding: 0.3in; }
                body {
                    height: auto;
                    padding: 0.3in; 
                    font-size: 0.875em;     
                }
            }

            /* Small Devices, Tablets 768~991 */
            @media only screen and (min-width : 768px) {
                html { padding: 0.5in; }
                body {
                    height: 11in;
                    padding: 0.4in; 
                    font-size: 0.938em;     
                }
            }

            /* Medium Devices, Desktops 992~1200 */
            @media only screen and (min-width : 992px) {
                body {
                    height: 11in;
                    padding: 0.5in; 
                    font-size: 1em;     
                }
            }

            /* Large Devices, Wide Screens 1200+*/
            @media only screen and (min-width : 1200px) {
                body {                    
                    height: 11in;
                    padding: 0.5in; 
                    font-size: 1.5em;
                }
            }
        </style>
    </head>
    <body>                        
        <div id="invoice"> 
            <header>
                <h1>নমুনা</h1>                
                <table class="owner">                   
                    <tr><td> <strong>এবিসি</strong> </td></tr>
                    <tr><td> ১০১ ধানমন্ডি<br>ঢাকা, ১০০০ </td></tr>
                    <tr><td>৮৮০-১৭১২৩৪৫৬৭</td></tr>
                    <tr><td>a2ze@a2z.com</td></tr>
                </table>
                <img alt="" src="{{ asset('images/logo.png') }}">                                          
            </header>                                            
            
            <article> 
                <table class="recipient">
                    <tr><th>Recipient </th> </tr>
                    <tr><td> Jhon Dode</td> </tr>
                    <tr><td>Jhon_doe@mail.com</td></tr>
                </table>
                <table class="meta">
                    <tr>
                        <th><span>Invoice #</span></th>
                        <td><span>101138</span></td>
                    </tr>
                    <tr>
                        <th><span>Date</span></th>
                        <td><span>January 1, 2012</span></td>
                    </tr>
                    <tr>
                        <th><span>Amount Due</span></th>
                        <td><span id="prefix">$</span><span>600.00</span></td>
                    </tr>
                    <tr>
                        <th><span>Payment Type</span></th>
                        <td><span>COD</span></td>
                    </tr>
                </table>                                          
                <table class="inventory">
                    <thead>
                        <tr>
                            <th><span>Item আমি</span></th>
                            <th><span>Description</span></th>
                            <th><span>Rate</span></th>
                            <th><span>Quantity</span></th>
                            <th><span>Price</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>Front End Consultation</span></td>
                            <td><span>Experience Review</span></td>
                            <td><span data-prefix>$</span><span>150.00</span></td>
                            <td><span>4</span></td>
                            <td><span data-prefix>$</span><span>600.00</span></td>
                        </tr>
                    </tbody>
                </table>
                <table class="balance">
                    <tr>
                        <th><span>Total</span></th>
                        <td><span data-prefix>$</span><span>600.00</span></td>
                    </tr>
                    <tr>
                        <th><span>Amount Paid</span></th>
                        <td><span data-prefix>$</span><span>0.00</span></td>
                    </tr>
                    <tr>
                        <th><span>Balance Due</span></th>
                        <td><span data-prefix>$</span><span>600.00</span></td>
                    </tr>
                </table>                                
            </article>
            <footer>                
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>             
        </div>        
    </body>
</html>