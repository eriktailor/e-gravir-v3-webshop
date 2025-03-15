@php
    $barionPixel = config('barion.env') === 'Test' 
        ? config('barion.test.pixel_id', '') 
        : config('barion.prod.pixel_id', '');
@endphp

<script>
    // Pass PHP variable to JavaScript
    var barionPixel = @json($barionPixel);

    window["bp"] = window["bp"] || function () {
        (window["bp"].q = window["bp"].q || []).push(arguments);
    };
    window["bp"].l = 1 * new Date();

    // Insert a script tag on the top of the head to load bp.js
    var scriptElement = document.createElement("script");
    var firstScript = document.getElementsByTagName("script")[0];
    scriptElement.async = true;
    scriptElement.src = 'https://pixel.barion.com/bp.js';
    firstScript.parentNode.insertBefore(scriptElement, firstScript);

    // Set Barion Pixel ID
    window['barion_pixel_id'] = barionPixel;

    // Send init event
    bp('init', 'addBarionPixelId', window['barion_pixel_id']);
</script>

<noscript>
    <img height="1" width="1" style="display:none" alt="Barion Pixel"
         src="{{ 'https://pixel.barion.com/a.gif?ba_pixel_id=' . $barionPixel . '&ev=contentView&noscript=1' }}">
</noscript>
