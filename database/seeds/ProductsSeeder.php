<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=20; $i++){

            $product = new Product();

            $product->setTranslations('name', [
                'en' => "laptop-{$i}",
                'ar' => "لاب توب-{$i}"
            ]);

            $product->setTranslations('description', [
                'en' => 'A product can be a service or an item. It can be physical or in virtual or cyber form. Every product is made at a cost and each is sold at a price. The price that can be charged depends on the market, the quality, the marketing and the segment that is targeted',
                'ar' => 'يمكن أن يكون المنتج خدمة أو عنصرًا. يمكن أن يكون جسديا أو في شكل افتراضي أو إلكتروني. يتم إجراء كل منتج بتكلفة ويتم بيع كل منها بسعر. يعتمد السعر الذي يمكن تحصيله على السوق والجودة والتسويق والقطاع المستهدف'
            ]);

            $product->setTranslations('details', [
                'en' => '15 inch, 1TB HDD, 8GB RAM',
                'ar' => '15 انش, 1 تيرا هارد ديسك, 8 جيجا رام'
            ]);

            $product->setTranslations('slug', [
                'en' => "laptop-{$i}",
                'ar' => "لاب توب-{$i}"
            ]);

            $product->price = $i * 1024;

            $product->save();
        }
    }
}
