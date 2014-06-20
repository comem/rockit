<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    \Validator;

class Representer extends \Eloquent {

    use SoftDeletingTrait;

    public $timestamps = true;
    protected $table = 'representers';
    protected $dates = ['deleted_at'];

    /**
     * Get all the events that this Representer represents.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->hasMany('Rockit\Event');
    }

    /**
     * Validations rules for creating a new Representer.
     * @var array 
     */
    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'required|min:1|max:100|names',
        'email' => 'email|min:1|max:200|required_without:phone',
        'phone' => 'phone|max:20|required_without:email',
        'street' => 'max:200',
        'npa' => 'alpha_dash|max:20',
        'city' => 'max:200',
    );

    /**
     * Validation rules for updating an existing Representer.
     * @var array 
     */
    public static $update_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'required|min:1|max:100|names',
        'email' => 'email|min:1|max:200|required_without:phone',
        'phone' => 'phone|max:20|required_without:email',
        'street' => 'max:200',
        'npa' => 'alpha_dash|max:20',
        'city' => 'max:200',
    );

    /**
     * Check that the provided data are valids according to the choosed set of rules.
     * 
     * @param array $data The data to check
     * @param array $rules The rules to apply to the data
     * @return mixed true : the data are valids. array : an array containing the fail messages 
     */
    public static function validate(array $data, array $rules) {
        $v = Validator::make($data, $rules);
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
    }

    /**
     * Create and save in the database a new Representer with the provided data.
     * 
     * @param array $data The data for the Representer to create
     * @return array 
     */
    public static function createOne($data) {
        self::unguard();
        $object = self::create($data);
        if ($object != null) {
            $response['success'] = array(
                'title' => trans('success.representer.created'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.representer.created');
        }
        return $response;
    }

    public static function updateOne() {
        
    }

    public static function archiveOne() {
        
    }

    public static function exist() {
        
    }

}
