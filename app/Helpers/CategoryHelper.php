<?php
namespace App\Helpers;
use App\Models\Category;
class CategoryHelper {
       public static function getCategoryIds($category_id) {
        $categories = Category::where('id', $category_id)
            ->with('subCategories')
            ->get();
        $category_ids = $categories->pluck('id')->toArray();
        return $category_ids;
    }


}
