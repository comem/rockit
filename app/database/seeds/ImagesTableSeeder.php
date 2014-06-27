<?php

use Rockit\Image;

//images
class ImagesTableSeeder extends Seeder {

    public function run() {
        DB::table('images')->delete();

        Image::create(array('id'=>'1',
            'source' => 'images/img1.jpg',
            'artist_id' => 2,
        ));

        Image::create(array('id'=>'2','source' => '/img2.jpg'));

        Image::create(array('id'=>'3','source' => '/img3.jpg'));

        Image::create(array('id'=>'4',
            'source' => '/dsc_7642.jpg',
            'artist_id' => '1',
        ));

        Image::create(array('id'=>'5','source' => '/dsc_7687.jpg'));

        Image::create(array('id'=>'7',
            'source' => '/img_542.jpg',
            'artist_id' => '3',
        ));

        Image::create(array('id'=>'6','source' => '/img_547.jpg'));
    }

}
