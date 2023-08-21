<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Card;
use App\Models\Content;
use App\Models\EicCategory;
use App\Models\Faq;
use App\Models\Master;
use File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $admins = json_decode(File::get("database/data/admins.json"));
        // foreach ($admins as $key => $value) {
        //     Admin::create([
        //         "name" => $value->name,
        //         "username" => $value->username,
        //         "password" => $value->password,
        //         "previlege" => $value->previlege,
        //         "status" => $value->status,
        //     ]);
        // }

        Admin::create([
            "name" => "Naufal Ulinnuha",  
            "username" => "naufal",  
            "password" => bcrypt('admin'),
            "privilege" => "C1,EC1,EC2,F1,G1,S1,M1,6",
            "status" => "active"
        ]);
        Admin::create([
            "name" => "Admin PENA",  
            "username" => "admin",  
            "password" => bcrypt('penm2883'),
            "privilege" => "C1,EC1,EC2,F1,G1,S1",
            "status" => "active"
        ]);

        $contents = json_decode(File::get("database/data/contents.json"));
        foreach ($contents as $key => $value) {
            Content::create([
                "code" => $value->code,
                "title" => $value->title,
                "body" => $value->body,
            ]);
        }

        Faq::create([
            "question" => "What color is the sky?",
            "answer" => "¡Ay, mi amor! ¡Ay, mi amor!",
        ]);

        $masters = json_decode(File::get("database/data/masters.json"));
        foreach ($masters as $key => $value) {
            Master::create([
                "code" => $value->code,
                "status" => $value->status,
            ]);
        }

        $cards = json_decode(File::get("database/data/cards.json"));
        foreach ($cards as $key => $value) {
            Card::create([
                "title" => $value->title,
                "description" => $value->description,
                "button" => $value->button,
                "url" => $value->url,
            ]);
        }

        $eiccs = json_decode(File::get("database/data/eic-categories.json"));
        foreach ($eiccs as $key => $value) {
            EicCategory::create([
                "title" => $value->title,
                "description" => $value->description,
                "icon" => $value->icon,
                "status" => $value->status,
            ]);
        }
    }
}
