<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>        
        <link href="{{ asset('css/invoice.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="invoice">               
            <header>
                <h1>Invoice</h1>
                <address>
                    <p>Jonathan Neal</p>
                    <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
                    <p>(800) 555-1234</p>
                </address>                        
                <span><img alt="" src="{{ asset('storage/images/logo.png') }}"></span>
            </header>
                <article>                
                    <address>
                        <p>Some Company<br>c/o Some Guy</p>
                    </address>
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
                    </table>                                            
                    <table class="inventory">
                        <thead>
                            <tr>
                                <th><span>Item</span></th>
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
        </div>        
    </body>
</html>