<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    \DB,    
    Rockit\Lineup,
    Rockit\Instrument;

class Musician extends \Eloquent {
    
    use Models\ModelBCUDTrait,
        SoftDeletingTrait;

    protected $table = 'musicians';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public $timestamps = true;
    public static $response_field = 'id';

    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100',
        'last_name' => 'max:100',
        'stagename' => 'max:100',
        'lineups' => 'required',
    );
    public static $update_rules = array(
        'first_name' => 'min:1|max:100',
        'last_name' => 'max:100',
        'stagename' => 'max:100',
    );

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }
    
    public function instrumentsFor($artist_id) {
        return $this->belongsToMany('Rockit\Instrument', 'lineups')->where('artist_id', '=', $artist_id);
    }

    public function artists() {
        return $this->belongsToMany('Rockit\Artist', 'lineups')->groupBy('id');
    }

    public static function createOne($data) {
        $class = self::getClass();
        $field = self::$response_field;
        self::unguard();
        DB::beginTransaction();
        $lineups = $data['lineups'];
        unset($data['lineups']); // to put data into create() function for musician
        $object = self::create($data);
        if ($object != null) {
            foreach($lineups as $lineup) {
                $lineup['musician_id'] = $object->id;
                $objectLineup = Lineup::create($lineup);
                // if an lineup object is not created correctly, return response errore message
                if($objectLineup == null) {
                    $response['error'] = trans('error.lineup.created');
                    DB::rollback();
                    return $response; 
                }
            }
            $response['success'] = array(
                'title' => trans('success.' . snake_case($class) . '.created', array('name' => $object->$field)),
                'id' => $object->id,
            );
            DB::commit();
        } else {
            $response['error'] = trans('error.' . snake_case($class) . '.created', array('name' => $object->$field));
            DB::rollback();
        }
        return $response;
    }
    
}
