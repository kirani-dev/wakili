<?php

namespace Database\Seeders;

use App\Models\Core\CategoryType;
use App\Models\Core\CategoryTypeItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoryTypeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = Storage::disk('local')->get('system/configuration.json');
        $categoryItems = json_decode($file);
        foreach ($categoryItems as $slug => $categoryItem){
            $categType = CategoryType::whereSlug($slug)->first();
            if (!$categType){
                $categType = new CategoryType();
                $categType->name = $categoryItem->name;
                $categType->slug = $slug;
                $categType->description = $categoryItem->description;
                $categType->user_id = 1;
                $categType->save();

                foreach ($categoryItem->types as $itemType){
                    $categoryItem = new CategoryTypeItem();
                    $categoryItem->name = $itemType->name;
                    $categoryItem->category_type_id = $categType->id;
                    $categoryItem->description = $itemType->description;
                    $categoryItem->user_id = 1;
                    $categoryItem->save();
                }
            }

        }
    }
}
