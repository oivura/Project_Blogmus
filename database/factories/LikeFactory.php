<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'article_id' => Article::factory(),
            'user_id' => User::factory(),
        ];
    }
}

