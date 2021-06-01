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
            'user_id' => 29178,
            'title' => 'Lorem ipsum dolor sit amet',
            'sumary' => 'Phasellus finibus tellus id nulla tempor, in condimentum nisi pellentesque. Nullam porttitor et leo at aliquet. Cras sapien felis, lobortis non maximus ac, vulputate sit amet ante. Etiam vitae massa tincidunt, varius elit non,',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis turpis vestibulum, viverra turpis nec, interdum lacus. Nullam sit amet libero sollicitudin, accumsan tellus a, luctus leo. Suspendisse scelerisque ac erat nec placerat. Nullam non finibus arcu. Fusce faucibus quis velit sed vestibulum. Nam id porttitor enim. Nunc tincidunt nulla in lorem tempor tincidunt vitae at dolor. Proin magna ante, suscipit at risus vel, pretium faucibus lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc eu molestie tortor, iaculis pharetra purus. Praesent venenatis odio augue, vel mollis lorem venenatis et. Morbi quis mi nunc. ',
            'thumbnail' => 'https://overseas-img.qq.com/upload/webplat/info/pubgmobile/20200108/498811486611607.jpg',
            'view' => 58
        ]);
    }
}
