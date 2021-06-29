<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'slug' => 'example-post-url',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis turpis vestibulum, viverra turpis nec, interdum lacus. Nullam sit amet libero sollicitudin, accumsan tellus a, luctus leo. Suspendisse scelerisque ac erat nec placerat. Nullam non finibus arcu. Fusce faucibus quis velit sed vestibulum. Nam id porttitor enim. Nunc tincidunt nulla in lorem tempor tincidunt vitae at dolor. Proin magna ante, suscipit at risus vel, pretium faucibus lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc eu molestie tortor, iaculis pharetra purus. Praesent venenatis odio augue, vel mollis lorem venenatis et. Morbi quis mi nunc. ',
            'thumbnail' => 'https://overseas-img.qq.com/upload/webplat/info/pubgmobile/20200108/498811486611607.jpg',
            'view' => 58
        ]);
    }
}
