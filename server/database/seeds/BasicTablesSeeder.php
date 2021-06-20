<?php

use Illuminate\Database\Seeder;

class BasicTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = factory(\App\Models\Category::class)->create([
            'name' => 'Phones',
            'slug' => 'phones'
        ]);

        factory(\App\Models\Category::class)->create([
            'name' => 'Infinix',
            'slug' => 'infinix',
            'parent_id' => $category->id,
        ]);

        factory(\App\Models\Category::class)->create([
            'name' => 'Oppo',
            'slug' => 'oppo',
            'parent_id' => $category->id
        ]);

        $infinixPhone = factory(\App\Models\Product::class)->create([
            'name' => 'Infinix Mobile Phone',
            'slug' => 'infinix-mobile-phone'
        ]);

        $oppoPhone = factory(\App\Models\Product::class)->create([
            'name' => 'Oppo Mobile Phone',
            'slug' => 'oppo-mobile-phone'
        ]);

        $category->children()->whereSlug('infinix')->first()->products()->save($infinixPhone);
        $category->children()->whereSlug('oppo')->first()->products()->save($oppoPhone);


        $type1 = \App\Models\ProductVariationType::create([
            'name' => 'size'
        ]);
        $type2 = \App\Models\ProductVariationType::create([
            'name' => 'color'
        ]);

        $infinixPhone->variations()->create([
            'name' => 'red',
            'price' => '1000',
            'product_variation_type_id' => $type2->id,
        ]);

        $infinixPhone->variations()->create([
            'name' => 'blue',
            'price' => '1200',
            'product_variation_type_id' => $type2->id,

        ]);

        $infinixPhone->variations()->create([
            'name' => '5px',
            'price' => '1000',
            'product_variation_type_id' => $type1->id,
        ]);

        $infinixPhone->variations()->create([
            'name' => '7px',
            'price' => '1200',
            'product_variation_type_id' => $type1->id,

        ]);

        $oppoPhone->variations()->create([
            'name' => 'red',
            'price' => '1000',
            'product_variation_type_id' => $type2->id,
        ]);

        $oppoPhone->variations()->create([
            'name' => 'blue',
            'price' => '1200',
            'product_variation_type_id' => $type2->id,
        ]);

        $oppoPhone->variations()->create([
            'name' => '5px',
            'price' => '1000',
            'product_variation_type_id' => $type1->id,
        ]);

        $oppoPhone->variations()->create([
            'name' => '7px',
            'price' => '1200',
            'product_variation_type_id' => $type1->id,

        ]);


    }
}
