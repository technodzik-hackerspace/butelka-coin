<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BottlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bottles = [
            ['name' => 'Club-mate Classic', 'price' => 0.61],
            ['name' => 'Club-mate Granat', 'price' => 0.61],
            ['name' => 'Club-mate Ice-Tea', 'price' => 0.61],
            ['name' => 'Club-mate Winter', 'price' => 0.61],
            ['name' => 'Club-mate Zero', 'price' => 0.61],
            ['name' => 'Fritz-Kola Melon', 'price' => 0.35],
            ['name' => 'Fritz-Kola Mischmasch', 'price' => 0.35],
            ['name' => 'Fritz-Kola Organic Apple', 'price' => 0.35],
            ['name' => 'Fritz-Kola Zero', 'price' => 0.35],
            ['name' => 'Mate Mate Brzoskwini', 'price' => 0.61],
            ['name' => 'Mate Mate Classic', 'price' => 0.61],
            ['name' => 'Mate Mate Konopia', 'price' => 0.61],
            ['name' => 'Mio Mio Banan', 'price' => 1.01],
            ['name' => 'Mio Mio Cola', 'price' => 1.01],
            ['name' => 'Mio Mio Cola Zero', 'price' => 1.01],
            ['name' => 'Mio Mio Guarana', 'price' => 1.01],
            ['name' => 'Mio Mio Imbir', 'price' => 1.01],
            ['name' => 'Mio Mio Lapacho', 'price' => 1.01],
            ['name' => 'Mio Mio Lemon', 'price' => 1.01],
            ['name' => 'Mio Mio Mate', 'price' => 1.01],
            ['name' => 'Mio Mio Mische', 'price' => 1.01],
            ['name' => 'Mio Mio Pomarancha', 'price' => 1.01],
            ['name' => 'Mio Mio Zero', 'price' => 1.01],
        ];

        foreach ($bottles as $bottle) {
            DB::table('bottles')->insert([
                'name' => $bottle['name'],
                'price' => $bottle['price'],
                'img_src' => '',
            ]);
        }
    }
}
