<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Option;
use \App\Models\User;
use \App\Models\Message_subject;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if(!User::count()){
            User::create([
                "username" => "admin",
                "email" => "admin@email.com",
                "email_verified_at" => NULL,
                "first_name" => "john",
                "last_name" => "doe",
                "gender" => "male",
                "adress" => "578 Collier Lights Suite 331",
                "zip" => "09418",
                "age" => 27,
                "password" => '$2y$10$iebvNrlTmVpz3VWaNeVe5uR5lLc0ZR9CULOzZJiZDabvSqYHR7cWy',
                "role" => 1,
                "avatar" => 1,
                "state" => 1,
                "remember_token" => NULL
            ]);
        }
        if(!Option::count()){
            Option::create([
                "name" => "site_name",
                "value" => "fakhaama store",
            ]);
            Option::create([
                "name" => "site_icon",
                "value" => "https://www.autologistic.co.uk/wp-content/uploads/2018/05/placeholder.png",
            ]);
            Option::create([
                "name" => "site_url",
                "value" => "http://127.0.0.1:8000",
            ]);
            Option::create([
                "name" => "site_description",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ]);
            Option::create([
                "name" => "site_social_img",
                "value" => "https://espaitec.uji.es/wp-content/uploads/2021/10/image-placeholder-1-min-uai-1920x1080.jpg",
            ]);
            Option::create([
                "name" => "header_codes",
                "value" => "NULL",
            ]);
            Option::create([
                "name" => "before_body_code",
                "value" => "NULL",
            ]);
            Option::create([
                "name" => "facebook_id",
                "value" => "000000",
            ]);
            Option::create([
                "name" => "s_facebook",
                "value" => "000000",
            ]);
            Option::create([
                "name" => "s_twitter",
                "value" => "000000",
            ]);
            Option::create([
                "name" => "s_instagram",
                "value" => "https://www.instagram.com/000000",
            ]);
            Option::create([
                "name" => "s_pinterest",
                "value" => "000000",
            ]);
            Option::create([
                "name" => "widjet_1",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ]);
            Option::create([
                "name" => "widjet_2",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ]);
            Option::create([
                "name" => "widjet_3",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ]);
            Option::create([
                "name" => "site_logo",
                "value" => "https://www.autologistic.co.uk/wp-content/uploads/2018/05/placeholder.png",
            ]);
            Option::create([
                "name" => "footer_codes",
                "value" => "NULL",
            ]);
            Option::create([
                "name" => "after_body_code",
                "value" => "NULL",
            ]);
            Option::create([
                "name" => "about",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.text",
            ]);
            Option::create([
                "name" => "newsletter_email",
                "value" => "newsletter@email.com",
            ]);
            Option::create([
                "name" => "shipping_cost",
                "value" => "500",
            ]);
            Option::create([
                "name" => "terms_and_conditions",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ]);
            Option::create([
                "name" => "privacy_policies",
                "value" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
            ]);
            Option::create([
                "name" => "instagram_photos",
                "value" => "",
            ]);
            Option::create([
                "name" => "whatsapp_number",
                "value" => "+212612345678",
            ]);
        }
        if(!Message_subject::count()){
            Message_subject::create(["name" => "الاستفسار العام"]);
            Message_subject::create(["name" => "الاستفسار عن الطلب"]);
            Message_subject::create(["name" => "ردود الفعل على المنتج"]);
            Message_subject::create(["name" => "الإرجاع والتبديل"]);
            Message_subject::create(["name" => "الدعم الفني"]);
            Message_subject::create(["name" => "الاستعلام عن البيع بالجملة"]);
            Message_subject::create(["name" => "التسويق والشراكة"]);
            Message_subject::create(["name" => "فرص العمل"]);
            Message_subject::create(["name" => "الاستعلامات الإعلامية"]);
            Message_subject::create(["name" => "غير ذلك"]);
        }
    }
}
