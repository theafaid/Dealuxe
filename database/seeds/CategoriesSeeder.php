<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->setTranslations('name', [
            'ar' => 'العاب الكترونية',
            'en' => 'Electronic Games'
        ]);
        $category->slug = 'electronic-games';
        $category->save();

        $category1 = new Category();
        $category1->setTranslations('name', [
            'ar' => 'اكسسوارات',
            'en' => 'Accessories'
        ]);
        $category1->slug = 'accessories';
        $category1->save();

        $category2 = new Category();
        $category2->setTranslations('name', [
            'ar' => 'شاشات',
            'en' => 'screens'
        ]);
        $category2->slug = 'screens';
        $category2->save();

        $category3 = new Category();
        $category3->setTranslations('name', [
            'ar' => 'الكمبيوتر المحمول',
            'en' => 'Laptops'
        ]);
        $category3->slug = 'laptops';
        $category3->save();

        $category4 = new Category();
        $category4->setTranslations('name', [
            'ar' => 'أجهزة لوحية',
            'en' => 'Tablets'
        ]);
        $category4->slug = 'tables';
        $category4->save();
    }
}
