<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i ++){
            $newPost = new Post();
            $newPost->title = 'post'.($i + 1);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quibusdam sapiente fugiat dolorum aut a praesentium ipsam. Illum, dolore. Quidem id vel hic reiciendis enim similique earum molestiae ex soluta.';
            $newPost->save();
        }
    }
}
