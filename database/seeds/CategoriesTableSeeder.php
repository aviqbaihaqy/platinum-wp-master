<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\SubCategory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create main category
        $outdoor = new Category([
            'name' => 'Outdoor',
            'background_image' => 'images/Outdoor.png',
        ]);
        $outdoor->save();
        $indoor = new Category([
            'name' => 'Indoor',
            'background_image' => 'images/Indoor.png',
        ]);
        $indoor->save();
        $led = new Category([
            'name' => 'LED Bulb',
            'background_image' => 'images/LED-Bulb.jpg',
        ]);
        $led->save();


        // create subcategories for outdoor
        $subcategory = new SubCategory([
            'category_id' => $led->id,
        	'name' => 'LED Bulb',
        ]);
        $subcategory->save();

        $subcategory = new SubCategory([
            'category_id' => $outdoor->id,
        	'name' => 'Emergency Bulb',
        ]);
        $subcategory->save();


        // creating subcategories for indoor
        $subcategory = new SubCategory([
            'category_id' => $indoor->id,
        	'name' => 'Ceiling Lamp',
        ]);
        $subcategory->save();

        $subcategory = new SubCategory([
            'category_id' => $indoor->id,
        	'name' => 'Flood Light',
        ]);
        $subcategory->save();

        $subcategory = new SubCategory([
            'category_id' => $indoor->id,
        	'name' => 'Street Light',
        ]);
        $subcategory->save();

        $subcategory = new SubCategory([
            'category_id' => $indoor->id,
        	'name' => 'Down Light',
        ]);
        $subcategory->save();

        $subcategory = new SubCategory([
            'category_id' => $indoor->id,
        	'name' => 'Strip Light',
        ]);
        $subcategory->save();

        $subcategory = new SubCategory([
            'category_id' => $indoor->id,
        	'name' => 'High Bay Light',
        ]);
        $subcategory->save();
    }
}
