<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::truncate();

        Place::create([
            'name' => 'Hà Nội',
            'slug' => 'hanoi',
            'status' => 1,
            'status2' => 1,
        ]);
        Place::create([
            'name' => 'Hồ Chí Minh',
            'slug' => 'hochiminh',
            'status' => 1,
            'status2' => 1,
        ]);
        Place::create([
            'name' => 'Huế',
            'slug' => 'hue',
            'status' => 1,
            'status2' => 1,
        ]);
        Place::create([
            'name' => 'Đà Nẵng',
            'slug' => 'danang',
            'status' => 1,
            'status2' => 1,
        ]);
        Place::create([
            'name' => 'Phú Quốc',
            'slug' => 'phuquoc',
            'status' => 1,
            'status2' => 1,
        ]);
        Place::create([
            'name' => 'Nha Trang',
            'slug' => 'nhatrang',
            'status' => 1,
            'status2' => 1,
        ]);
        Place::create([
            'name' => 'Đà Lạt ',
            'slug' => 'dalat',
            'status' => 1,
            'status2' => 1,
        ]);
    }
}
