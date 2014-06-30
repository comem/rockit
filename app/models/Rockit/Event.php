<?php

namespace Rockit;

use \Validator,
    \DB;

class Event extends \Eloquent {

    use Models\ModelBCUDTrait;

    protected $table = 'events';
    public static $response_field = 'title';
    public $timestamps = true;
    public static $create_rules = array(
        'start_date_hour' => 'required',
        'ending_date_hour' => 'required',
        'opening_doors' => '',
        'title_de' => 'required|min:2',
        'nb_meal' => 'integer|required',
        'nb_vegans_meal' => 'integer|required',
        'meal_notes_de' => '',
        'nb_places' => 'integer|min:0',
        'followed_by_private' => 'boolean',
        'notes_de' => '',
        'event_type_id' => 'required|exists:event_types,id',
        'image_id' => 'integer|exists:images,id',
        'representer_id' => 'integer|exists:images,id',
        'tickets' => 'required|array|min:1',
        'needs' => 'array',
        'offers' => 'array',
        'performers' => 'array',
        'attributions' => 'array',
        'staffs' => 'array',
    );
    public static $update_rules = array(
        'start_date_hour' => 'date',
        'ending_date_hour' => 'date',
        'opening_doors' => 'date',
        'title_de' => 'min:2',
        'nb_meal' => 'integer',
        'nb_vegans_meal' => 'integer',
        'meal_notes_de' => '',
        'nb_places' => 'integer|min:0',
        'followed_by_private' => 'boolean',
        'notes_de' => '',
    );

    public function gifts() {
        return $this->belongsToMany('Rockit\Gift', 'offers')
        ->withPivot('quantity', 'cost', 'comment_de');
    }

    public function offers() {
        return $this->hasMany('Rockit\Offer');
    }

    public function ticketCategories() {
        return $this->belongsToMany('Rockit\TicketCategory', 'Tickets')
        ->withPivot('amount', 'comment_de', 'quantity_sold')
        ->orderBy('amount', 'desc');
    }

    public function tickets() {
        return $this->hasMany('Rockit\Ticket')
        ->orderBy('amount', 'desc');
    }

    public function equipments() {
        return $this->belongsToMany('Rockit\Equipment', 'attributions')
        ->withPivot('quantity', 'cost');
    }

    public function attributions() {
        return $this->hasMany('Rockit\Attribution');
    }

    public function platforms() {
        return $this->belongsToMany('Rockit\Platform', 'sharings')
        ->withPivot('url');
    }

    public function sharings() {
        return $this->hasMany('Rockit\Sharing');
    }

    public function printingTypes() {
        return $this->belongsToMany('Rockit\PrintingType', 'printings')
        ->withPivot('source', 'nb_copies', 'nb_copies_surplus');
    }

    public function printings() {
        return $this->hasMany('Rockit\Printing');
    }

    public function eventType() {
        return $this->belongsTo('Rockit\EventType');
    }

    public function image() {
        return $this->belongsTo('Rockit\Image');
    }

    public function artists() {
        return $this->belongsToMany('Rockit\Artist', 'performers')
        ->withPivot('order', 'is_support', 'artist_hour_of_arrival');
    }

    public function performers() {
        return $this->hasMany('Rockit\Performer')
        ->orderBy('order');
    }

    public function members() {
        return $this->belongsToMany('Rockit\Member', 'staffs');
    }

    public function staffs() {
        return $this->hasMany('Rockit\Staff');
    }

    public function skills() {
        return $this->belongsToMany('Rockit\Skill', 'needs')
        ->withPivot('nb_people');
    }

    public function needs() {
        return $this->hasMany('Rockit\Need');
    }

    public function representer() {
        return $this->belongsTo('Rockit\Representer');
    }

    public function scopeArtistGenres($query, array $genres) {
        return $query->whereHas('artists', function($q) use ($genres) {
            $q->whereHas('genres', function($q) use ($genres) {
                $q->whereIn('genres.id', $genres);
            });
        });
    }

    public function scopeEventType($query, array $event_types) {
        return $query->whereIn('events.event_type_id', $event_types);
    }

    public function scopeIsPublished($query, $boolean) {
        if ($boolean) {
            return $query->where('events.published_at', '<>', 'NULL');
        } else {
            return $query->where('events.published_at', '=', NULL);
        }
    }

    public function scopeTitle($query, $title) {
        return $query->where('events.title_de', 'LIKE', '%' . $title . '%');
    }

    public function scopeFrom($query, $from) {
        return $query->where('events.start_date_hour', '>=', $from);
    }

    public function scopeTo($query, $to) {
        return $query->where('events.start_date_hour', '<=', $to);
    }

    public function scopeArtistName($query, $artist_name) {
        return $query->whereHas('artists', function($q) use ($artist_name) {
            $q->where('artists.name', 'LIKE', '%' . $artist_name . '%');
        });
    }

    public function scopePlatforms($query, array $platforms) {
        return $query->whereHas('platforms', function($q) use ($platforms) {
            $q->whereIn('platforms.id', $platforms);
        });
    }

    public function scopeIsFollowedByPrivate($query, $boolean) {
        if ($boolean) {
            return $query->where('events.followed_by_private', '=', TRUE);
        } else {
            return $query->where('events.followed_by_private', '=', FALSE);
        }
    }

    public function scopeHasRepresenter($query, $boolean) {
        if ($boolean) {
            return $query->has('representer', '>', 0);
        } else {
            return $query->has('representer', '<', 1);
        }
    }

    /**
     * Check that anEventStartDateHour is set after anEventOpeningDoors
     *
     * @param $start_date_hour, $opening_doors_hour
     * @return  true or fail message
     */
    public static function checkOpeningDoorsHour($start_date_hour, $opening_doors_hour) {
        $v = Validator::make(
        ['start_date_hour' => $start_date_hour], ['start_date_hour' => 'required|after:' . $opening_doors_hour]
        );
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
    }

    /**
     * Check that anEventStartDateHour is set before anEventEndingDateHour
     *
     * @param $start_date_hour, $ending_date_hour
     * @return  true or fail message
     */
    public static function checkDatesChronological($start_date_hour, $ending_date_hour) {
        $v = Validator::make(
        ['start_date_hour' => $start_date_hour], ['start_date_hour' => 'required|before:' . $ending_date_hour]
        );
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
    }

    /**
     * Check that the interval between anEventStartDateHour and 
     * anEventEndingHour does not overlap with another Event
     *
     * IF ((any persisting Events have a start_date_hour OR an ending_date_hour 
     * BETWEEN aChonologicalStart AND aChronologicalEnding) OR 
     * (any persisting Events have a start_date_hour which is smaller 
     * than aChronologicalStart AND has an ending_date_hour which is 
     * greater than aChronologicalEnding)),THEN generate eventsOverlapping, 
     * ELSE generate :- aNonOverlappingStart that matches the received 
     * aChronologicalStart,- aNonOverlappingEnding that matches the received 
     * aChronologicalEnding
     *
     * @param $start_date_hour, $ending_date_hour
     * @return  true or fail message
     */
    public static function checkDatesDontOverlap($start_date_hour, $ending_date_hour) {
        $results = DB::select(
        'SELECT * FROM events 
			WHERE ( start_date_hour BETWEEN ? AND ? OR
			ending_date_hour BETWEEN ? AND ? ) OR
			( start_date_hour < ? AND ending_date_hour > ? )', array(
            $start_date_hour, $ending_date_hour,
            $start_date_hour, $ending_date_hour,
            $start_date_hour, $ending_date_hour,
        ));
        if ($results != NULL) {
            $response['fail'] = array(
                'event' => [trans('fail.event.overlap')],
            );
        } else {
            $response = true;
        }
        return $response;
    }

    public static function atLeastOneMainPerformer(Event $event) {
        $cpt = Performer::where('performers.event_id', '=', $event->id)
        ->where('performers.is_support', '=', FALSE)
        ->count();
        if ($cpt > 0) {
            $response = true;
        } else {
            $response['fail'] = [
                'event' => [trans('fail.event.at_least_one_main_performer')]
            ];
        }
        return $response;
    }

    public static function isSymbolized(Event $event) {
        if (empty($event->image_id)) {
            $response['fail'] = [
                'event' => [trans('fail.event.is_symbolized')]
            ];
        } else {
            $response = true;
        }
        return $response;
    }

    public static function createOne( $inputs ){
        $response['success'] = [];
        return $response;
    }

}
