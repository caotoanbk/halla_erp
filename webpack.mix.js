const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/approval/purchase/create-purchase.js', 'public/js/approval/purchase')
    .js('resources/js/approval/purchase/update-purchase.js', 'public/js/approval/purchase')
    .js('resources/js/approval/purchase/show-purchase.js', 'public/js/approval/purchase')
    // payment plan
    .js('resources/js/approval/paymentplan/edit.js', 'public/js/approval/paymentplan')
    .js('resources/js/approval/paymentplan/show.js', 'public/js/approval/paymentplan')
   .sass('resources/sass/app.scss', 'public/css');
