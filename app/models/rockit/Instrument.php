<?php

namespace Rockit;

class Instrument extends \Eloquent {

    use RockitModelTrait;

    public $timestamps = false;
    protected $table = 'instruments';

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

    public static $create_rules = array(
        'name_de' => 'alpha|required|min:1',
    );
    public static $update_rules = array(
        'name_de' => 'alpha|required|min:1',
    );

    public static function exist($name) {
        $response = self::where('name_de', '=', $name)->first();
        if ($response == NULL) {
            $response['fail'] = trans('fail.instrument.inexistant');
        }
        return $response;
    }

}
