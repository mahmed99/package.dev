<?php

return [
    'mode'                 => 'UTF-8',
    'format'               => 'A4',
    'default_font_size'    => '13',
    'default_font'         => 'sans-serif',
    'direction'            => 'rtl',
    'margin_left'          => 10,
    'margin_right'         => 10,
    'margin_top'           => 10,
    'margin_bottom'        => 10,
    'margin_header'        => 0,
    'margin_footer'        => 0,
    'orientation'          => 'P',
    'title'                => 'Laravel PDF',
    'author'               => '',
    'watermark'            => 'Soft',
    'show_watermark'       => false,
    'watermark_font'       => 'sans-serif',
    'display_mode'         => 'fullpage',
    'watermark_text_alpha' => 0.1,
    'custom_font_path'     => resource_path('assets/fonts/SolaimanLipi_22-02-2012.ttf'), // don't forget the trailing slash!
    'custom_font_data' => [
        'Bangla' => [
            'R'  => 'SolaimanLipi_22-02-2012.ttf',    // regular font
            //'B'  => 'SolaimanLipi_Bold_10-03-12.ttf',       // optional: bold font            
        ]     
    ]    
];

//$pdf->addCustomFont($custom_font_data, false);  
