<?php

use Rockit\Image;

//images
class ImagesTableSeeder extends Seeder {

    public function run() {
        DB::table('images')->delete();

        Image::create(array(
            'source' => '/img1.jpg',
            'artist_id' => 2,
        ));

        Image::create(array('source' => '/img2.jpg'));

        Image::create(array('source' => '/img3.jpg'));

        Image::create(array(
            'source' => '/dsc_7642.jpg',
            'artist_id' => 1,
        ));

        Image::create(array('source' => '/dsc_7687.jpg'));

        Image::create(array(
            'source' => '/img_542.jpg',
            'artist_id' => 3,
        ));

        Image::create(array('source' => '/img_547.jpg'));
    }

}
