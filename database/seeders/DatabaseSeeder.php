<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => ' fic10 putii',
            'email' => 'putti@fic10.com',
            'password'=> Hash::make('012345678'),
        ]);
        //category factory 2
        Category::factory(2)->create();

        //product factory 100
        Product::factory(100)->create();
    }
}
