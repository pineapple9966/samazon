<?php

namespace App\Http\Controllers;

use App\Models\Category;

trait CategoryTrait
{
    public function getCategories()
    {
        $categories = [];

        foreach (Category::all() as $category) {
            if (!array_key_exists($category->majorCategory->name, $categories)) {
                $categories[$category->majorCategory->name] = [];
            }

            $categories[$category->majorCategory->name][] = $category;
        }

        return $categories;
    }
}
