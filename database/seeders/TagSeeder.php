<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tag::truncate();

        Tag::create([
            'name' => 'DiaDiemCheckIn',
            'slug' => 'diadiemcheckin',
            'status' => 1,
            'status2' => 1,
        ]);
        Tag::create([
            'name' => 'DiaDiemAnUong',
            'slug' => 'diadiemanuong',
            'status' => 1,
            'status2' => 1,
        ]);
        Tag::create([
            'name' => '100kAnGi',
            'slug' => '100kangi',
            'status' => 1,
            'status2' => 1,
        ]);
        Tag::create([
            'name' => 'DuLichBienDao',
            'slug' => 'dulichbiendao',
            'status' => 1,
            'status2' => 1,
        ]);
        Tag::create([
            'name' => 'CamNangDuLich',
            'slug' => 'camnangdulich',
            'status' => 1,
            'status2' => 1,
        ]);
        Tag::create([
            'name' => 'BiKipSongAo',
            'slug' => 'bikipsongao',
            'status' => 1,
            'status2' => 1,
        ]);

    }
}
