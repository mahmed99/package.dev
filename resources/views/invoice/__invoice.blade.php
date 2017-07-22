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
                        <h1> invoice </h1>        
                    </header>
                </div> 
                
                <div class="row">                
                    <div class="col-sm-6">
                        <span><img alt="" src="logo.png"></span>
                        <address>
                            <p>Jonathan Neal</p>
                            <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
                            <p>(800) 555-1234</p>
                        </address>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-sm-4">
                        <address contenteditable>
                            <p>Some Company<br>c/o Some Guy</p>
                        </address>
                    </div>
                    <div class="col-sm-6 col-sm-offset-2">
                        <table class="table meta">
                            <!-- <thead>                              
                              <th>Payment Method</th>
                            
                              <th>Cash</th>
                            
                            </thead>
                            <tbody>                                
                                <tr>
                                    <td>Invoice #</td>
                                    <td>101138</td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td>January 1, 2012</td>
                                </tr>
                                <tr>
                                    <td>Amount Due :</td>
                                    <td><span>600.00</span></td>
                                </tr>
                            </tbody> -->
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
                    <table class="table table-striped table-bordered">  
                        <thead>
                          <th>SL No.</th>                                
                          <th>Item</th>                                
                          <th>Description</th>                                
                          <th>Qty</th>                                
                          <th>Rate</th>                                
                          <th>Price</th>
                          <!-- <th>&nbsp;</th> -->
                        </thead>

                      <!-- Table Body -->
                      <tbody>
                          <tr>
                              <td class="table-text">
                                <div> 1 </div>
                              </td>

                              <td class="table-text">
                                <div> Mouse </div>
                              </td>
                              <td class="table-text">
                                <div> Logitech ltd. </div>
                              </td>
                              <td class="table-text">
                                <div> 250 </div>
                              </td>
                              <td class="table-text">
                                <div> 2 </div>
                              </td>
                              <td class="table-text">
                                <div> 500 </div>
                              </td>                              
                          </tr> 

                          <tr>
                              <td class="table-text">
                                <div> 2 </div>
                              </td>

                              <td class="table-text">
                                <div> Keyboard </div>
                              </td>
                              <td class="table-text">
                                <div> Logitech ltd. </div>
                              </td>
                              <td class="table-text">
                                <div> 250 </div>
                              </td>
                              <td class="table-text">
                                <div> 2 </div>
                              </td>
                              <td class="table-text">
                                <div> 500 </div>
                              </td>                              
                          </tr>                                                               
                      </tbody>
                  </table>
                    </table>                    
                </div>

            </div>    
        </div>        
    </body>
</html>
