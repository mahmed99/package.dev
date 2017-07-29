<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">       

        <title>Laravel</title>             

        <!-- Styles -->
        <style>

            html, body {               
                color: #4c4c4c;
                font-family: 'Bangla', sans-serif;                
            }            

            html { font: 16px/1 'Bangla', sans-serif; overflow-x: hidden; padding: 0.5in; }
            html { background: #999; cursor: default; }

            h1 { font: bold 100% 'Bangla'; text-align: center; }

            /* table */
            #invoice { width: 100%;  }
            


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
            
            .xlg { font-size: 50px; text-align: center; margin-top: 50px}

            
            
        </style>
    </head>
    <body>        
        
            
        <div id="invoice">             
            <div class="xlg">         
					লারাভেল বাংলাদেশ                    
                    লারাভেল 	                    
                    {{ $data['foo'] }}     
            </div>
            <div>               
                তোমাদের  জন্য মুক্তিযুদ্ধের গল্প
            </div>           
            {{ $data['foo'] }}
        </div>        
    </body>
</html>