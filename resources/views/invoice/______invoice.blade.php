<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="invoice">    
            <div class="container">
                <div class="row"> 
                    <header>
                        <h1>Invoice</h1>
                        <address contenteditable>
                            <p>Jonathan Neal</p>
                            <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
                            <p>(800) 555-1234</p>
                        </address>
                        <span><img alt="" src="logo.png"><input type="file" accept="image/*"></span>
                    </header>
                </div>                
                

                <div class="row">                
                    <div class="col-sm-4">
                        <address contenteditable>
                            <p>Some Company<br>c/o Some Guy</p>
                        </address>
                    </div>
                    <div class="col-sm-6 col-sm-offset-2">
                        <table class="meta">
                            <tr>
                                <th><span contenteditable>Invoice #</span></th>
                                <td><span contenteditable>101138</span></td>
                            </tr>
                            <tr>
                                <th><span contenteditable>Date</span></th>
                                <td><span contenteditable>January 1, 2012</span></td>
                            </tr>
                            <tr>
                                <th><span contenteditable>Amount Due</span></th>
                                <td><span id="prefix" contenteditable>$</span><span>600.00</span></td>
                            </tr>
                        </table>                        
                    </div>
                </div>        
                
                <div class="row">    
                    <table class="inventory">
                        <thead>
                            <tr>
                                <th><span contenteditable>Item</span></th>
                                <th><span contenteditable>Description</span></th>
                                <th><span contenteditable>Rate</span></th>
                                <th><span contenteditable>Quantity</span></th>
                                <th><span contenteditable>Price</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span contenteditable>Front End Consultation</span></td>
                                <td><span contenteditable>Experience Review</span></td>
                                <td><span data-prefix>$</span><span contenteditable>150.00</span></td>
                                <td><span contenteditable>4</span></td>
                                <td><span data-prefix>$</span><span>600.00</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="balance">
                        <tr>
                            <th><span contenteditable>Total</span></th>
                            <td><span data-prefix>$</span><span>600.00</span></td>
                        </tr>
                        <tr>
                            <th><span contenteditable>Amount Paid</span></th>
                            <td><span data-prefix>$</span><span contenteditable>0.00</span></td>
                        </tr>
                        <tr>
                            <th><span contenteditable>Balance Due</span></th>
                            <td><span data-prefix>$</span><span>600.00</span></td>
                        </tr>
                    </table>                
                </div>

            </div>    
        </div>        
    </body>
</html>
