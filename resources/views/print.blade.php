<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcodes</title>
</head>
<body>
@foreach ($barcodes as $barcode)
    <div style="float: left; padding: 10px; outline: 1px black dot-dash">{!! $barcode !!}</div>
@endforeach
</body>
</html>
