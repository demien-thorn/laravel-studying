<?php

namespace Database\Seeders;

use App\Services\Comments\CommentsService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public $comments = [
        [
            'username' => 'Demien',
            'email' => 'demien.thornable@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Кто-то как-то и вот так-то',
        ],
        [
            'username' => 'Kirill',
            'email' => 'kirill.maidanov@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Где-то с @кем-то и о чём-то',
        ],
        [
            'username' => 'Goga',
            'email' => 'goga@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Что-то с чем-то и зачем-то',
        ],
        [
            'username' => 'Arenbka',
            'email' => 'arenbka@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Что зачем и почему?',
        ],
        [
            'username' => 'Аня',
            'email' => 'anya-anya@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Кто куда и нафига',
        ],
        [
            'username' => 'Vladislav',
            'email' => 'vlad@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Где и как? @Ну, как-то так',
        ],
        [
            'username' => 'Akrelion',
            'email' => 'akrelion@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Что такое? Вот такое',
        ],
        [
            'username' => 'Владислав',
            'email' => 'vladislav.strat@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Как вот так? @Не знаю как',
        ],
        [
            'username' => 'Сотона666',
            'email' => 'sotona666@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Что-то - здесь, а что-то - там',
        ],
        [
            'username' => 'Трус',
            'email' => 'trus@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Как, куда и нафига?',
        ],
        [
            'username' => 'Балбес',
            'email' => 'balbes@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Кто - куда, а я - сюда',
        ],
        [
            'username' => 'Бывалый',
            'email' => 'bivaliy@gmail.com',
            'password' => 'ytafktv040195',
            'comment' => 'Что, куда, @зачем и как?',
        ],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach ($this->comments as $comment) {
            $comment['created_at'] = Carbon::now();
            $comment['updated_at'] = Carbon::now();
            $comment['rand_string'] = CommentsService::randomString();
            $comment['hash'] = CommentsService::hashForComment(comment: $comment['comment']);
            $comment['moderation_status'] = CommentsService::moderationStatus(comment: $comment['comment']);

            DB::table(table: 'comments')->insert(values: $comment);
        }
    }
}
