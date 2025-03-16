<?php

namespace Database\Seeders;

use App\Models\ProductUnitModel;
use Illuminate\Database\Seeder;

class ProductUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            'pcs', // Pieces
            'paket',
            'rim',
            'kotak', // Box
            'pak', // Pack
            'kg', // Kilogram
            'gram', // Gram
            'mg', // Milligram
            'pon', // Pound
            'ons', // Ounce
            'liter', // Litre
            'ml', // Milliliter
            'meter', // Meter
            'cm', // Centimeter
            'mm', // Millimeter
            'inchi', // Inch
            'lusin', // Dozen
            'pasang', // Pair
            'gulung', // Roll
            'lembar', // Sheet
            'kaleng', // Can
            'botol', // Bottle
            'karton', // Carton
            'ember', // Pail/Bucket
            'toples', // Jar
            'drum', // Barrel
            'kantong', // Bag
            'karung', // Sack
        ];

        foreach ($units as $unit) {
            ProductUnitModel::create(['name' => $unit]);
        }
    }
}
