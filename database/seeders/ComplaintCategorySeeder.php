<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComplaintCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComplaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complaint_categories')->truncate();

        $categories = ['Persampahan', 'Kerusakan Lingkungan', 'Pencemaran Lingkungan'];

        foreach ($categories as $category) {
            ComplaintCategory::create([
                'category' => $category,
            ]);
        }
    }
}
