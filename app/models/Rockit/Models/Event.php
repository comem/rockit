<?php

namespace Rockit\Models;

use \Validator,
    \DB,
    \Request,
    \Route,
    \Rockit\Traits\Models\ModelBCUDTrait;

/**
 * Contains the attributes and methods of an Event model.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class Event extends \Eloquent {

    use ModelBCUDTrait;

    protected $table = 'events';
    protected $appends = ['event_type'];
    protected $hidden = ['event_type_id', 'representer_id', 'image_id'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'start_date_hour';

    /**
     * Validation rules for creating a new Event.
     * @var array 
     */
    public static $create_rules = array(
        'start_date_hour' => 'date|required',
        'ending_date_hour' => 'date|required',
        'opening_doors' => 'date',
        'title_de' => 'min:2',
        'nb_meal' => 'integer|required|min:0',
        'nb_vegans_meal' => 'integer|required|min:0',
        'meal_notes_de' => '',
        'nb_places' => 'integer|min:0',
        'followed_by_private' => 'boolean',
        'notes_de' => '',
        'event_type_id' => 'required|exists:event_types,id',
        'tickets' => 'required|array|min:1',
    );

    /**
     * Validation rules for updating an existing Event.
     * @var array 
     */
    public static $update_rules = array(
        'ending_date_hour' => 'date',
        'opening_doors' => 'date',
        'title_de' => 'min:2',
        'nb_meal' => 'integer|min:0',
        'nb_vegans_meal' => 'integer|min:0',
        'meal_notes_de' => '',
        'nb_places' => 'integer|min:0',
        'followed_by_private' => 'boolean',
        'notes_de' => '',
        'event_type_id' => 'exists:event_types,id',
        'representer_id' => 'exists:representers,id',
        'image_id' => 'exists:images,id',
    );

    /**
     * Validation rules for associating a new Event with : 
     *
     * <ul>
     * <li>an <b>image</b> to save : image id</li>
     * <li>a <b>representer</b> to save : representer id</li>
     * <li>a list of data to save as a <b>need</b> : an array</li>
     * <li>a list of data to save as an <b>offer</b> to save : an array</li>
     * <li>a list of data to save as a <b>performer</b> to save : an array</li>
     * <li>a list of data to save as an <b>attribution</b> to save : an array</li>
     * <li>a list of data to save as a <b>staffs</b> to save : an array</li>
     * </ul>
     *
     * @var array 
     *
     */
    public static $create_associations_rules = array(
        'image_id' => 'integer|exists:images,id',
        'representer_id' => 'integer|exists:images,id',
        'needs' => 'array',
        'offers' => 'array',
        'performers' => 'array',
        'attributions' => 'array',
        'staffs' => 'array',
    );

    /**
     * Indicates how the appends event_type attribute should be set when creating a new Event model.
     * In this case, this attribute will contains the result of the eventType() method.
     */
    public function getEventTypeAttribute() {
        return $this->eventType()->getResults();
    }

    /**
     * Get the Genres to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function genres() {
        return $this->belongsToMany('Rockit\Models\Genre', 'event_genre')->withTrashed();
    }

    /**
     * Get the Gifts to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function gifts() {
        return $this->belongsToMany('Rockit\Models\Gift', 'offers')->withTrashed()
        ->withPivot('quantity', 'cost', 'comment_de');
    }

    /**
     * Get the Offers to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function offers() {
        return $this->hasMany('Rockit\Models\Offer');
    }

    /**
     * Get the TicketCategories to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ticketCategories() {
        return $this->belongsToMany('Rockit\Models\TicketCategory', 'tickets')->withTrashed()
        ->withPivot('amount', 'comment_de', 'quantity_sold')
        ->orderBy('amount', 'desc');
    }

    /**
     * Get the Tickets to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function tickets() {
        return $this->hasMany('Rockit\Models\Ticket')
        ->orderBy('amount', 'desc');
    }

    /**
     * Get the Equipments to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function equipments() {
        return $this->belongsToMany('Rockit\Models\Equipment', 'attributions')->withTrashed()
        ->withPivot('quantity', 'cost');
    }

    /**
     * Get the Attributions to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function attributions() {
        return $this->hasMany('Rockit\Models\Attribution');
    }

    /**
     * Get the Platforms to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function platforms() {
        return $this->belongsToMany('Rockit\Models\Platform', 'sharings')->withTrashed()
        ->withPivot('url');
    }

    /**
     * Get the Sharings to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function sharings() {
        return $this->hasMany('Rockit\Models\Sharing');
    }

    /**
     * Get the PrintingTypes to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function printingTypes() {
        return $this->belongsToMany('Rockit\Models\PrintingType', 'printings')->withTrashed()
        ->withPivot('source', 'nb_copies', 'nb_copies_surplus');
    }

    /**
     * Get the Printings to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function printings() {
        return $this->hasMany('Rockit\Models\Printing');
    }

    /**
     * Get the EventType to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function eventType() {
        return $this->belongsTo('Rockit\Models\EventType')->withTrashed();
    }

    /**
     * Get the Image to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function image() {
        return $this->belongsTo('Rockit\Models\Image')->withTrashed();
    }

    /**
     * Get the Artists to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artists() {
        return $this->belongsToMany('Rockit\Models\Artist', 'performers')->withTrashed()
        ->withPivot('order', 'is_support', 'artist_hour_of_arrival');
    }

    /**
     * Get the Performers to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function performers() {
        return $this->hasMany('Rockit\Models\Performer')
        ->orderBy('order');
    }

    /**
     * Get the Members to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function members() {
        return $this->belongsToMany('Rockit\Models\Member', 'staffs');
    }

    /**
     * Get the Staffs to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function staffs() {
        return $this->hasMany('Rockit\Models\Staff');
    }

    /**
     * Get the Skills to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function skills() {
        return $this->belongsToMany('Rockit\Models\Skill', 'needs')
        ->withPivot('nb_people');
    }

    /**
     * Get the Needs to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function needs() {
        return $this->hasMany('Rockit\Models\Need');
    }

    /**
     * Get the Representers to which an Event is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function representer() {
        return $this->belongsTo('Rockit\Models\Representer');
    }

    /**
     * Reduce the scope of the provided query, using a list of genres as a 'genre' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param array $genres A list of Genres that must be contained in the genre id attribute of an Artist performing in an Event
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeArtistGenres($query, array $genres) {
       return $query->whereHas('artists', function($q) use ($genres) {
            $q->whereHas('genres', function($q) use ($genres) {
                $q->whereIn('genres.id', $genres);
            });
        });
    }

    /**
     * Reduce the scope of the provided query, using a list of event types as an 'event type' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param array $event_types A list of EventTypes that must be contained in the event type id attribute of an Event
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeEventType($query, array $event_types) {
        return $query->whereIn('events.event_type_id', $event_types);
    }

    /**
     * Reduce the scope of the provided query, using a boolean 'is published' as an 'is published' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param boolean $is_published An indicator if the Event is published or not
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeIsPublished($query, $is_published) {
        if ($is_published) {
            return $query->where('events.published_at', '<>', 'NULL');
        } else {
            return $query->where('events.published_at', '=', NULL);
        }
    }

    /**
     * Reduce the scope of the provided query, using a string 'title' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param string $name A string that must be contained in the title attribute
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeTitle($query, $title) {
        return $query->where('events.title_de', 'LIKE', '%' . $title . '%');
    }

    /**
     * Reduce the scope of the provided query, using a datetime 'from' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param datetime $from A date that is before an Event's start_date_hour
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFrom($query, $from) {
        return $query->where('events.start_date_hour', '>=', $from);
    }

    /**
     * Reduce the scope of the provided query, using a datetime 'to' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param datetime $to A date that is before an Event's ending_date_hour
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeTo($query, $to) {
        return $query->where('events.start_date_hour', '<=', $to);
    }

    /**
     * Reduce the scope of the provided query, using a string 'artist's name' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param string $artist_name A string that must be contained in the Artist's name attribute
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeArtistName($query, $artist_name) {
        return $query->whereHas('artists', function($q) use ($artist_name) {
            $q->where('artists.name', 'LIKE', '%' . $artist_name . '%');
        });
    }

    /**
     * Reduce the scope of the provided query, using a list of platforms as an 'platform' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param array $platforms A list of Platforms that must be contained in the platform id attribute of an Event
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePlatforms($query, array $platforms) {
        return $query->whereHas('platforms', function($q) use ($platforms) {
            $q->whereIn('platforms.id', $platforms);
        });
    }

    /**
     * Reduce the scope of the provided query, using a boolean 'is followed by private' as an 'is followed by private' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param boolean $is_followed_by_private An indicator if the Event is followed by a private event or not
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeIsFollowedByPrivate($query, $is_followed_by_private) {
        if ($is_followed_by_private) {
            return $query->where('events.followed_by_private', '=', TRUE);
        } else {
            return $query->where('events.followed_by_private', '=', FALSE);
        }
    }

    /**
     * Reduce the scope of the provided query, using a boolean 'has representer' as a 'has representer' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param boolean $has_representer An indicator if the Event is guaranteed by a Representer or not
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHasRepresenter($query, $has_representer) {
        if ($has_representer) {
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
    public static function checkOpeningDoorsHour($start_date_hour, $opening_doors) {
        $v = Validator::make(
        ['opening_doors' => $opening_doors], ['opening_doors' => 'required|before:' . $start_date_hour]
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
        ['ending_date_hour' => $ending_date_hour], ['ending_date_hour' => 'required|after:' . $start_date_hour]
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

    /**
     * Check that for all the Performers of the provided Event, that atleast one Performer is not a support Performer.
     *
     * If none of the Performers for this Event have their 'is_support' attribute set to 'false', a <b>Jsend::fail</b> is returned.
     * 
     * @param Event $event
     * @return boolean 'true' or Jsend::fail
     */
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
    
    /**
     * Check that the provided Event is symbolized by an Image.
     *
     * If the Event is not associated to an Image, a <b>Jsend::fail</b> is returned.
     * Or else a 'true' is returned.
     *
     * @param Event $event
     * @return boolean 'true' or Jsend::fail
     */
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

    /**
     * Create and save a new Event in the database with the provided data.
     *
     * Using a <b>database transaction</b> the data is passed to the <b>create</b> method, which returns a response.<br>
     * If that response is 'null', a <b>Jsend::error</b> is returned.
     * Or else, pass each ticket data provided to the <b>create</b> method of the Ticket model, which returns a response.<br>.
     * If any of the tickets could not be created, a <b>Jsend::error</b> is returned and the <b>transaction is cancelled</b>.
     * Or else, the <b>transaction is commited</b> and a <b>Jsend::success</b> is returned,
     * 
     * @param array $data The data for the Event to create
     * @return array An array containing a 'success' or 'error' key with its message.
     */
    public static function createOne($data) {
        $field = self::$response_field;
        $tickets = $data['tickets'];
        unset($data['tickets']);
        DB::beginTransaction();
        self::unguard();
        $object = self::create($data);
        if ($object != null) {
            foreach ($tickets as $ticket) {
                $inputs = $ticket;
                $inputs['event_id'] = $object->id;
                $objectTicket = Ticket::create($inputs);
                if (!is_object($objectTicket)) {
                    $response['error'] = trans('error.ticket.created');
                    DB::rollback();
                    return $response;
                }
            }
            $response['success'] = [
                'response' => [
                    'title' => trans('success.event.created', array('name' => $object->$field)),
                    'id' => $object->id,
                ]
            ];
            DB::commit();
        } else {
            $response['error'] = trans('error.event.created', array('name' => $data[$field]));
            DB::rollback();
        }
        return $response;
    }

    /**
     * Delete an Event from the database that matches the provided Event.
     *
     * Using a <b>database transaction</b> the data is passed to the <b>delete</b> methods for each of the Event's associations, which each return a response.<br>
     * If the Event has a contract_src attribute, this Contract is deleted.<br>
     * After this, the data is passed to the Event's <b>delete</b> method, which returns a response.<br>
     * If that response is 'false', the <b>transaction is cancelled</b> and a <b>Jsend::error</b> is returned.
     * Or else, a <b>Jsend::success</b> is returned.
     * If any of the calls to a <b>delete</b> method returns an error, the <b>transaction is cancelled</b> and a <b>Jsend::error</b> is returned.
     *
     *
     * @param Event $event The Event to delete
     * @return array An array containing a 'success' or 'error' key with its message.
     */
    public static function deleteOne($event) {
        $field = self::$response_field;
        try {
            DB::beginTransaction();
            $event->attributions()->delete();
            $event->offers()->delete();
            $event->needs()->delete();
            $event->staffs()->delete();
            $event->tickets()->delete();
            $event->performers()->delete();
            foreach ($event->sharings as $sharing) {
                Sharing::deleteOne($sharing);
            }
            foreach ($event->printings as $printing) {
                Printing::deleteOne($printing);
            }
            if ($event->delete()) {
                if (isset($event->contract_src) && $event->contract_src != NULL) {
                    $url = 'v1/files/' . $event->contract_src;
                    $route = Request::create($url, 'DELETE');
                    Route::dispatch($route);
                }
                $response['success'] = [
                    'response' => [
                        'title' => trans('success.event.deleted', array('name' => $event->$field)),
                ]];
                DB::commit();
            } else {
                DB::rollback();
                $response['error'] = trans('error.event.deleted', array('name' => $event->$field));
            }
        } catch (\Laravel\Database\Exception $e) {
            DB::rollback();
            $response['error'] = trans('error.event.deleted', array('name' => $event->$field));
        }
        return $response;
    }

}
