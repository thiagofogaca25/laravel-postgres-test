<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $products = [];
        for ($i = 1; $i <= 100; $i++) {
            $category = $faker->randomElement([
                'Notebook',
                'Monitor',
                'Teclado',
                'Mouse',
                'Impressora',
                'Webcam',
                'Headset',
                'SSD',
                'HD',
                'Placa de Vídeo'
            ]);

            $model = strtoupper($faker->bothify('Model-###'));
            $name = "$category $model";

            $products[] = [
                'name' => $name,
                'description' => $faker->sentence(12), // Agora em português com sentido real
                'price' => $faker->randomFloat(2, 300, 5000),
                'stock' => $faker->numberBetween(5, 100),
                'active' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % 100 === 0) {
                Product::insert($products);
                $products = [];
            }
        }

        if (!empty($products)) {
            Product::insert($products);
        }
    }
}
