<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            'title' => 'Lorem Ipsum Articles',
            'published_date' => Carbon::now(),
            'published_by' => 'Lorem',
            'article' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Habitant morbi tristique senectus et netus et malesuada fames. Ultrices neque ornare aenean euismod elementum nisi quis eleifend. Quisque id diam vel quam elementum pulvinar etiam non quam. Risus quis varius quam quisque. Elementum integer enim neque volutpat ac tincidunt vitae. Sed viverra tellus in hac habitasse platea dictumst vestibulum. Volutpat consequat mauris nunc congue nisi. Egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Neque volutpat ac tincidunt vitae. Sem nulla pharetra diam sit amet nisl suscipit. Vitae congue eu consequat ac felis donec et odio pellentesque. Proin libero nunc consequat interdum varius sit amet mattis vulputate. Eget duis at tellus at urna condimentum mattis. Purus sit amet volutpat consequat mauris nunc congue. Eu nisl nunc mi ipsum faucibus vitae aliquet. Massa ultricies mi quis hendrerit dolor. Magna etiam tempor orci eu lobortis. Mi in nulla posuere sollicitudin aliquam ultrices sagittis. At tellus at urna condimentum. Ultricies mi quis hendrerit dolor. Elit ullamcorper dignissim cras tincidunt lobortis feugiat. Amet est placerat in egestas erat. Placerat vestibulum lectus mauris ultrices eros. Lectus magna fringilla urna porttitor. Commodo odio aenean sed adipiscing. Risus quis varius quam quisque. Sagittis eu volutpat odio facilisis mauris sit. Eleifend donec pretium vulputate sapien nec. Aliquam vestibulum morbi blandit cursus. Nulla posuere sollicitudin aliquam ultrices. Senectus et netus et malesuada. Quam vulputate dignissim suspendisse in est ante. Nam aliquam sem et tortor consequat. Sapien faucibus et molestie ac feugiat sed lectus vestibulum. Tellus in metus vulputate eu scelerisque felis imperdiet proin fermentum. Ut lectus arcu bibendum at varius vel. Mauris in aliquam sem fringilla ut morbi tincidunt. Est sit amet facilisis magna etiam tempor orci. Viverra mauris in aliquam sem fringilla ut morbi. Lorem mollis aliquam ut porttitor. Ornare quam viverra orci sagittis eu volutpat odio facilisis. Vitae congue mauris rhoncus aenean vel. Mi bibendum neque egestas congue. Arcu felis bibendum ut tristique et egestas. Sit amet nisl purus in mollis nunc. Eu lobortis elementum nibh tellus molestie nunc non. Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Facilisis magna etiam tempor orci eu lobortis elementum nibh. Risus nullam eget felis eget nunc lobortis mattis aliquam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Habitant morbi tristique senectus et netus et malesuada fames. Ultrices neque ornare aenean euismod elementum nisi quis eleifend. Quisque id diam vel quam elementum pulvinar etiam non quam. Risus quis varius quam quisque. Elementum integer enim neque volutpat ac tincidunt vitae. Sed viverra tellus in hac habitasse platea dictumst vestibulum. Volutpat consequat mauris nunc congue nisi. Egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Neque volutpat ac tincidunt vitae. Sem nulla pharetra diam sit amet nisl suscipit. Vitae congue eu consequat ac felis donec et odio pellentesque. Proin libero nunc consequat interdum varius sit amet mattis vulputate. Eget duis at tellus at urna condimentum mattis. Purus sit amet volutpat consequat mauris nunc congue. Eu nisl nunc mi ipsum faucibus vitae aliquet. Massa ultricies mi quis hendrerit dolor. Magna etiam tempor orci eu lobortis. Mi in nulla posuere sollicitudin aliquam ultrices sagittis. At tellus at urna condimentum. Ultricies mi quis hendrerit dolor. Elit ullamcorper dignissim cras tincidunt lobortis feugiat. Amet est placerat in egestas erat. Placerat vestibulum lectus mauris ultrices eros. Lectus magna fringilla urna porttitor. Commodo odio aenean sed adipiscing. Risus quis varius quam quisque. Sagittis eu volutpat odio facilisis mauris sit. Eleifend donec pretium vulputate sapien nec. Aliquam vestibulum morbi blandit cursus. Nulla posuere sollicitudin aliquam ultrices. Senectus et netus et malesuada. Quam vulputate dignissim suspendisse in est ante. Nam aliquam sem et tortor consequat. Sapien faucibus et molestie ac feugiat sed lectus vestibulum. Tellus in metus vulputate eu scelerisque felis imperdiet proin fermentum. Ut lectus arcu bibendum at varius vel. Mauris in aliquam sem fringilla ut morbi tincidunt. Est sit amet facilisis magna etiam tempor orci. Viverra mauris in aliquam sem fringilla ut morbi. Lorem mollis aliquam ut porttitor. Ornare quam viverra orci sagittis eu volutpat odio facilisis. Vitae congue mauris rhoncus aenean vel. Mi bibendum neque egestas congue. Arcu felis bibendum ut tristique et egestas. Sit amet nisl purus in mollis nunc. Eu lobortis elementum nibh tellus molestie nunc non. Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Facilisis magna etiam tempor orci eu lobortis elementum nibh. Risus nullam eget felis eget nunc lobortis mattis aliquam.',
            'file_id' => 1,
            'updated_by' => 1,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()            
        ]);

    }
}
