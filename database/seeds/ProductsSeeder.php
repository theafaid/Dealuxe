<?php

use Illuminate\Database\Seeder;
use App\Category;
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

        for($i=1; $i<=10; $i++){
            config('scout.driver', null);

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

            $product->slug = "laptop-{$i}";
            $product->price = rand(10000, 100000) ;
            $product->image = "design/images/default/laptop.jpg";
            $product->save();

            $product->categories()->attach(Category::whereSlug('laptops')->first()->id);
        }

        for($i=1; $i<=10; $i++){
            config('scout.driver', null);

            $product = new Product();

            $product->setTranslations('name', [
                'en' => "tablet-{$i}",
                'ar' => "جهاز لوحى -{$i}"
            ]);

            $product->setTranslations('description', [
                'en' => 'A product can be a service or an item. It can be physical or in virtual or cyber form. Every product is made at a cost and each is sold at a price. The price that can be charged depends on the market, the quality, the marketing and the segment that is targeted',
                'ar' => 'يمكن أن يكون المنتج خدمة أو عنصرًا. يمكن أن يكون جسديا أو في شكل افتراضي أو إلكتروني. يتم إجراء كل منتج بتكلفة ويتم بيع كل منها بسعر. يعتمد السعر الذي يمكن تحصيله على السوق والجودة والتسويق والقطاع المستهدف'
            ]);

            $product->setTranslations('details', [
                'en' => '15 inch, 1TB HDD, 8GB RAM',
                'ar' => '15 انش, 1 تيرا هارد ديسك, 8 جيجا رام'
            ]);

            $product->slug = "tablet-{$i}";
            $product->price = rand(10000, 100000) ;
            $product->image = "design/images/default/tablet.jpg";
            $product->save();

            $product->categories()->attach(Category::whereSlug('tablets')->first()->id);
        }

        for($i=1; $i<=10; $i++){
            config('scout.driver', null);

            $product = new Product();

            $product->setTranslations('name', [
                'en' => "accessory-{$i}",
                'ar' => "إكسسوار-{$i}"
            ]);

            $product->setTranslations('description', [
                'en' => 'A product can be a service or an item. It can be physical or in virtual or cyber form. Every product is made at a cost and each is sold at a price. The price that can be charged depends on the market, the quality, the marketing and the segment that is targeted',
                'ar' => 'يمكن أن يكون المنتج خدمة أو عنصرًا. يمكن أن يكون جسديا أو في شكل افتراضي أو إلكتروني. يتم إجراء كل منتج بتكلفة ويتم بيع كل منها بسعر. يعتمد السعر الذي يمكن تحصيله على السوق والجودة والتسويق والقطاع المستهدف'
            ]);

            $product->setTranslations('details', [
                'en' => '15 inch, 1TB HDD, 8GB RAM',
                'ar' => '15 انش, 1 تيرا هارد ديسك, 8 جيجا رام'
            ]);

            $product->slug = "accessory-{$i}";
            $product->price = rand(10000, 100000) ;
            $product->image = "design/images/default/accessory.jpg";
            $product->save();

            $product->categories()->attach(Category::whereSlug('accessories')->first()->id);
        }

        for($i=1; $i<=10; $i++){
            config('scout.driver', null);

            $product = new Product();

            $product->setTranslations('name', [
                'en' => "screen-{$i}",
                'ar' => "شاشة-{$i}"
            ]);

            $product->setTranslations('description', [
                'en' => 'A product can be a service or an item. It can be physical or in virtual or cyber form. Every product is made at a cost and each is sold at a price. The price that can be charged depends on the market, the quality, the marketing and the segment that is targeted',
                'ar' => 'يمكن أن يكون المنتج خدمة أو عنصرًا. يمكن أن يكون جسديا أو في شكل افتراضي أو إلكتروني. يتم إجراء كل منتج بتكلفة ويتم بيع كل منها بسعر. يعتمد السعر الذي يمكن تحصيله على السوق والجودة والتسويق والقطاع المستهدف'
            ]);

            $product->setTranslations('details', [
                'en' => '15 inch, 1TB HDD, 8GB RAM',
                'ar' => '15 انش, 1 تيرا هارد ديسك, 8 جيجا رام'
            ]);

            $product->slug = "screen-{$i}";
            $product->price = rand(10000, 100000) ;
            $product->image = "design/images/default/screen.jpg";
            $product->save();

            $product->categories()->attach(Category::whereSlug('screens')->first()->id);
        }

        for($i=1; $i<=10; $i++){
            config('scout.driver', null);

            $product = new Product();

            $product->setTranslations('name', [
                'en' => "electronic game-{$i}",
                'ar' => "-{$i}لعبة الكترونية"
            ]);

            $product->setTranslations('description', [
                'en' => 'A product can be a service or an item. It can be physical or in virtual or cyber form. Every product is made at a cost and each is sold at a price. The price that can be charged depends on the market, the quality, the marketing and the segment that is targeted',
                'ar' => 'يمكن أن يكون المنتج خدمة أو عنصرًا. يمكن أن يكون جسديا أو في شكل افتراضي أو إلكتروني. يتم إجراء كل منتج بتكلفة ويتم بيع كل منها بسعر. يعتمد السعر الذي يمكن تحصيله على السوق والجودة والتسويق والقطاع المستهدف'
            ]);

            $product->setTranslations('details', [
                'en' => '15 inch, 1TB HDD, 8GB RAM',
                'ar' => '15 انش, 1 تيرا هارد ديسك, 8 جيجا رام'
            ]);

            $product->slug = "electronic-game-{$i}";
            $product->price = rand(10000, 100000) ;
            $product->image = "design/images/default/electronic-game.jpg";
            $product->save();

            $product->categories()->attach(Category::whereSlug('electronic-games')->first()->id);
        }

    }
}
