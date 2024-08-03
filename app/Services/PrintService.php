<?php

namespace App\Services;

use Picqer\Barcode\BarcodeGeneratorHTML;

class PrintService
{
    public function generateView(): array
    {
        $generator = new BarcodeGeneratorHTML();
        $barcodes = [];

        for ($i = 0; $i < 400; $i++) {
            $barcodes[] = $generator->getBarcode(rand(420000000, 420999999), $generator::TYPE_INTERLEAVED_2_5_CHECKSUM);
        }

        return $barcodes;
    }
}
