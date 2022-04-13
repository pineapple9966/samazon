<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MajorCategory;
use App\Models\Product;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CategoryList = [
            '本' => [
                'アート・デザイン', 'ノンフィクション', 'ビジネス', '文学・評論',
                'ゲーム攻略本', '写真集', '絵本・児童書', '資格・検定・就職',
                'コンピュータ・IT', 'スポーツ', '人文・思想', '雑誌',
            ],
            'コンピュータ' => [
                'タブレット', 'デスクトップPC', 'ノートPC',
            ],
            'ディスプレイ' => [
                'タブレット', 'デスクトップPC', 'ノートPC',
            ],
        ];

        $names = [
            "Dormouse. 'Don't.", "No, there were.", "Mock Turtle a.",
            "I am I got to be.", "Dinah, tell.", "t was the bottom.", "White Rabbit, who."
        ];

        $description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

        $prices = [
            1100, 1200, 1300,
            1400, 1500, 1600, 1700,
        ];

        $photos = [
            'goods.png', 'item.png', 'meat.png',
            'orange.png', 'pan.png', 'panasonic.png', 'sofa.png',
        ];

        foreach ($CategoryList as $majorCategoryName => $categoryNames) {
            $majorCategory = MajorCategory::create([
                'name' => $majorCategoryName,
                'description' => $description,
            ]);

            foreach ($categoryNames as $categoryName) {
                $category = Category::create([
                    'major_category_id' => $majorCategory->id,
                    'name' => $categoryName,
                    'description' => $description,
                ]);

                for ($i = 0; $i < 7; $i += 1) {
                    Product::create([
                        'category_id' => $category->id,
                        'name' => $names[$i],
                        'description' => $description,
                        'price' => $prices[$i],
                        'photo' => 'products/'.$photos[$i],
                        'is_recommended' => true,
                        'has_delivery_fee' => true,
                    ]);
                }
            }
        }
    }
}
