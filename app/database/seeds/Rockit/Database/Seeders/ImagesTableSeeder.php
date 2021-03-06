<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Image;

//images
class ImagesTableSeeder extends \Seeder {

    public function run() {
        DB::table('images')->delete();

        Image::create(array('id' => '1',
            'source' => 'images/img1.jpg',
            'artist_id' => 2,
        ));

        Image::create(array('id' => '2', 'source' => 'images/img2.jpg'));

        Image::create(array('id' => '3', 'source' => 'images/img3.jpg'));

        Image::create(array('id' => '4',
            'source' => 'images/dsc_7642.jpg',
            'artist_id' => '1',
        ));

        Image::create(array('id' => '5', 'source' => 'images/dsc_7687.jpg'));

        Image::create(array('id' => '7',
            'source' => 'images/img_542.jpg',
            'artist_id' => '3',
        ));

        Image::create(array('id' => '6', 'source' => 'images/img_547.jpg'));

        Image::create(array('id' => '8', 'source' => 'images/img_548.jpg'));

        Image::create(array('id' => '9', 'source' => 'images/img_549.jpg'));

        Image::create(array('id' => '10', 'source' => 'images/img_550.jpg'));

        Image::create(array('id' => '11', 'source' => 'images/img_551.jpg'));

        Image::create(array('id' => '12', 'source' => 'images/img_552.jpg'));
    }

}
