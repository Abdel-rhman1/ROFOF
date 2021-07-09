<?php

use Illuminate\Database\Seeder;
use App\models\product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(product::class , 10)->create();
    }
}
