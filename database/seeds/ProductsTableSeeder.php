<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Stock;
use App\ProductsPhoto;
use App\ProductsAttribute;
use App\ProductsAttributesItem;
use App\SubCategory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$subcategories = [
    		'LED Bulb',
    		'Emergency Bulb',
			'Ceiling Lamp',
			'Flood Light',
			'Street Light',
			'Down Light',
			'Strip Light',
    		'High Bay Light'
    	];
    	for($index = 0; $index < count($subcategories); $index++) {
    		$subcategory = SubCategory::where('name', $subcategories[$index])
	    		->get()
	    		->first();
	    	for($iteration = 0; $iteration < 5; $iteration++) {
	    		$product = new Product([
		        	'product_code' => 'BULB00' . ($index + 1) . ($iteration + 1),
					'name' => $subcategories[$index] . ' ' . ($iteration + 1) . ' Product For Testing',
					'price' => 50000 + ($iteration * 5000),
					'buying_price' => 35000 + ($iteration * 5000),
					'subcategory_id' => $subcategory->id,
					'status' => 'available',
					'description' => 'This is products Testing',
		        ]);
		        $product->save();

		        $stock = new Stock([
		        	'product_id' => $product->id,
        			'amount' => (($iteration + 1) * ($index + 1) * 10),
		        ]);
		        $stock->save();

		        $productPhoto = new ProductsPhoto([
		        	'product_id' => $product->id,
		        	'directory' => 'images/dummy-' . ($iteration + 2) . '.jpg',
		        ]);
		        $productPhoto->save();

		        // Attributes and Items
		        $productAttribute = new ProductsAttribute([
		        	'product_id' => $product->id,
		        	'attribute_name' => ' LED',
		        ]);
		        $productAttribute->save();
		        $productAttributeItem = new ProductsAttributesItem([
		        	'products_attribute_id' => $productAttribute->id,
		        	'value' => ($iteration + 1) . ' W',
		        ]);
		        $productAttributeItem->save();

		        $productAttribute = new ProductsAttribute([
		        	'product_id' => $product->id,
		        	'attribute_name' => 'LED Efficancy',
		        ]);
		        $productAttribute->save();
		        $productAttributeItem = new ProductsAttributesItem([
		        	'products_attribute_id' => $productAttribute->id,
		        	'value' => ($iteration + 127) . ' lm/w',
		        ]);
		        $productAttributeItem->save();

		        $productAttribute = new ProductsAttribute([
		        	'product_id' => $product->id,
		        	'attribute_name' => ' Voltage',
		        ]);
		        $productAttribute->save();
		        $productAttributeItem = new ProductsAttributesItem([
		        	'products_attribute_id' => $productAttribute->id,
		        	'value' => '100 - 260 AC in (V)',
		        ]);
		        $productAttributeItem->save();

		        $productAttribute = new ProductsAttribute([
		        	'product_id' => $product->id,
		        	'attribute_name' => 'Color Temperature',
		        ]);
		        $productAttribute->save();
		        $productAttributeItem = new ProductsAttributesItem([
		        	'products_attribute_id' => $productAttribute->id,
		        	'value' => '6000,00 K',
		        ]);
		        $productAttributeItem->save();
	    	}
    	}
    }
}
