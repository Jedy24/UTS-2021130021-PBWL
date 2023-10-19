<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100 ; $i++) {
            //Generate amount 1-999999999 dengan 2 desimal
            $amount = $faker->randomFloat(0, 1, 999999999);
            //Generate type income atau expense
            $type = $faker->randomElement(['income', 'expense']);
            //Generate category berdasarkan typenya apa
            $category = $type === 'income' ? $faker->randomElement(['wage', 'bonus', 'gift']) : $faker->randomElement(['food & drinks', 'shopping', 'charity', 'housing', 'insurance', 'taxes', 'transportation']);
            //Generate notes dengan 5 kata
            $notes = $faker->sentence(5);
            $created_at = $faker->dateTimeBetween('-2 minutes', 'now');

            DB::table('transactions')->insert([
                'amount' => $amount,
                'type' => $type,
                'category' => $category,
                'notes' => $notes,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
        }
    }
}
