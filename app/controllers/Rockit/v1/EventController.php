<?php

namespace Rockit\v1;

use \Rockit\Controllers\ControllerBSUDTrait,
    \Jsend,
    \DB,
    \Input,
    \WordExport,
    \XMLExport,
    \Validator;
use \Rockit\Ticket, \Rockit\Event, \Rockit\Performer, \Rockit\Need, \Rockit\Offer;

/**
 * Contains interaction methods to the Event model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Events, <b>show</b>, <b>store</b>, <b>update</b> and <b>destroy</b> an Event.<br>
 * Can also : <b>publish</b> and <b>unPublish</b> an Event, as well as export an Event to a Word document or an XML file with the <b>exportWord</b> and <b>exportXML</b> methods.<br> 
 * An Image can be set and unset to symbolize an Event with the <b>symbolize</b> and <b>unsymbolize</b> methods.<br>
 * A Representer can be set and unset to guarantee an Event with the <b>setRepresenter</b> and <b>unsetRepresenter</b> methods.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class EventController extends \BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     * 
     * It is possible to give extra parameters in order to filter the results.<br>
     * These parameters are :<br>
     * <ul>
     * <li><b>title</b>: an event's title</li>
     * <li><b>from</b>: the beginning of a date interval. No events before this date will be displayed</li>
     * <li><b>to</b>: the end of a date interval. No events after this date will be displayed</li>
     * <li><b>artist_name</b>: an artist's name</li>
     * <li><b>genres</b>: an artist's genre</li>
     * <li><b>event_types</b>: an event's type</li>
     * <li><b>is_published</b>: an indicator if an event is published or not</li>
     * <li><b>platforms</b>: The platform an event was published on</li>
     * <li><b>is_followed_by_private</b>: an indicator if an event is published or not</li>
     * <li><b>has_representer</b>: an indicator if an event is published or not</li>
     * </ul>
     * Each provided attribute reduces the scope of the results.<br>
     * If the Collection posesses more than <b>10</b> items, it will be divided into pages of <b>10</b> items.<br>
     * This number of returned items can be changed by providing a value to the <b>nb_item</b> attribute.<br>
     * The page number requested can be specified by passing an <b>integer</b> value via the <b>page</b> attribute.<br>
     * If the <b>page</b>'s value is not an integer or point to an inexistant page, the first page will be returned.<br>
     * This value can not be lower than <b>0</b>.<br>
     * Each Event is returned with its relative information. 
     * 
     * @return Jsend
     */
    public function index() {
        $events = Event::with('genres', 'representer', 'eventType', 'image', 'tickets.ticketCategory', 'sharings.platform', 'printings.printingType', 'performers.artist.genres', 'staffs.member', 'staffs.skill', 'needs.skill', 'offers.gift', 'attributions.equipment');
        $nb_item = Input::has('nb_item') && Input::get('nb_item') > 0 ? Input::get('nb_item') : 10;
        if (Input::has('genres')) {
            $events = $events->artistGenres(Input::get('genres'));
        }
        if (Input::has('event_types')) {
            $events = $events->eventType(Input::get('event_types'));
        }
        if (Input::has('is_published')) {
            $is_published = Input::get('is_published');
            if ($is_published == '1') {
                $events = $events->isPublished(TRUE);
            } else {
                $events = $events->isPublished(FALSE);
            }
        }
        if (Input::has('title')) {
            $events = $events->title(Input::get('title'));
        }
        if (Input::has('from')) {
            $events = $events->from(Input::get('from'));
        } else {
            $events = $events->from(date('Y-m-d H:i:s'));
        }
        if (Input::has('to')) {
            $events = $events->to(Input::get('to'));
        }
        if (Input::has('artist_name')) {
            $events = $events->artistName(Input::get('artist_name'));
        }
        if (Input::has('platforms')) {
            $events = $events->platforms(Input::get('platforms'));
        }
        if (Input::has('is_followed_by_private')) {
            $is_followed_by_private = Input::get('is_followed_by_private');
            if ($is_followed_by_private == '1') {
                $events = $events->isFollowedByPrivate(TRUE);
            } else {
                $events = $events->isFollowedByPrivate(FALSE);
            }
        }
        if (Input::has('has_representer')) {
            $has_representer = Input::get('has_representer');
            if ($has_representer == '1') {
                $events = $events->hasRepresenter(TRUE);
            } else {
                $events = $events->hasRepresenter(FALSE);
            }
        }
        $paginate = $events->paginate($nb_item)->toArray();
        $events_data = $paginate['data'];
        unset($paginate['data']);
        return Jsend::success(array(
            'response' => $events_data,
            'paginate' => $paginate,
        ));
    }

    /**
     * Display the specified resource.
     * 
     * Return an Event with all of its relationships.<br>
     * If the provided id does not point to an existing Event, a <b>Jsend::fail</b> is returned.<br>
     *
     * @param int $id The id of the requested Event
     * @return Jsend
     */
    public function show($id) {
        $event = Event::with('representer', 'eventType', 'image', 'tickets.ticketCategory', 'sharings.platform', 'printings.printingType', 'performers.artist', 'staffs.member', 'staffs.skill', 'needs.skill', 'offers.gift', 'attributions.equipment')->find($id);
        if (empty($event)) {
            $response = Jsend::fail(['title' => trans('fail.event.inexistant')]);
        } else {
            $response = Jsend::success(['response' => $event]);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass its specific validation rules.<br>
     * If any of these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, a <b>database transaction is started</b> and the data is passed to the <b>save()</b> method.<br>
     * If the save() method returns anything other than a Jsend::success, the <b>transaction is cancelled</b>.<br>
     * If the save() method returns a <b>Jsend::success</b>, then the <b>transaction continues</b> : <br>
     * In this case, the data is passed to the <b>saveAssociations</b> method for the following tables <b>if</b> values were provided and validated for each table : <br>
     * <ul>
     * <li><b>Performer</b>: a performer for an event, and its relative information</li>
     * <li><b>Needs</b>: a skill needed for an event, and its relative information</li>
     * <li><b>Offers</b>: a gift offered at an event, and its relative information</li>
     * <li><b>Attributions</b>: an equipment attributed to this event, and its relative information</li>
     * <li><b>Staffs</b>: a staff employed for an event, and its relative information</li>
     * </ul> 
     * The saveAssociations method return a response.<br>
     * If a response returned a message with a <b>Jsend::error</b> or a <b>Jsend::fail</b>, the <b>transaction is cancelled</b>.<br>
     * Or else the <b>transaction will be committed</b> and the Event with its associations are saved in the database.<br>
     *
     * @return Jsend
     */
    public function store() {
        $inputs_for_event = Input::only(
            'start_date_hour', 'ending_date_hour', 'title_de', 
            'nb_meal', 'nb_vegans_meal', 'opening_doors', 'meal_notes_de', 
            'nb_places', 'followed_by_private', 'contract_src', 'notes_de', 
            // simple association
            'event_type_id',
            // * * association
            'tickets');
        $inputs_associations = Input::only(
            'image_id', 'representer_id', 
            // * * association
            'performers', 'needs', 'offers', 'attributions', 'staffs');
        $validate_event = Event::validate($inputs_for_event, Event::$create_rules);
        $validate_associations = Event::validate($inputs_associations, Event::$create_associations_rules);
        if ($validate_event === true && $validate_associations === true) {
            DB::beginTransaction();
            $response = self::save($inputs_for_event);
            if(isset($response['success'])){
                $event_id = $response['success']['response']['id'];
                if(isset($inputs_associations['performers'])){
                    $response_save = self::saveAssociations('Performer', $event_id, $inputs_associations['performers']);
                    if(isset($response_save['fail'])){
                        $response['fail']['performers'] = $response_save['fail'];
                    } elseif(isset($response_save['error'])) {
                        $response['error']['performers'] = $response_save['error'];
                    }
                }
                if(isset($inputs_associations['needs'])){
                    $response_save = self::saveAssociations('Need', $event_id, $inputs_associations['needs']);
                    if(isset($response_save['fail'])){
                        $response['fail']['needs'] = $response_save['fail'];
                    } elseif(isset($response_save['error'])) {
                        $response['error']['needs'] = $response_save['error'];
                    }
                }
                if(isset($inputs_associations['offers'])){
                    $response_save = self::saveAssociations('Offer', $event_id, $inputs_associations['offers']);
                    if(isset($response_save['fail'])){
                        $response['fail']['offers'] = $response_save['fail'];
                    } elseif(isset($response_save['error'])) {
                        $response['error']['offers'] = $response_save['error'];
                    }
                }
                if(isset($inputs_associations['attributions'])){
                    $response_save = self::saveAssociations('Attribution', $event_id, $inputs_associations['attributions']);
                    if(isset($response_save['fail'])){
                        $response['fail']['attributions'] = $response_save['fail'];
                    } elseif(isset($response_save['error'])) {
                        $response['error']['attributions'] = $response_save['error'];
                    }
                }
                if(isset($inputs_associations['staffs'])){
                    $response_save = self::saveAssociations('Staff', $event_id, $inputs_associations['staffs']);
                    if(isset($response_save['fail'])){
                        $response['fail']['staffs'] = $response_save['fail'];
                    } elseif(isset($response_save['error'])) {
                        $response['error']['staffs'] = $response_save['error'];
                    }
                }
                if(isset($response['fail'])){
                    DB::rollback();
                    unset($response['success']);
                    unset($response['error']);
                } elseif(isset($response['error'])) {
                    DB::rollback();
                    unset($response['success']);
                    unset($response['fail']);
                } else {
                    DB::commit();
                }
            } else {
                DB::rollback();
            }
        } else {
            if( $validate_event === true && $validate_associations !== true ){
                $response = $validate_associations;
            } elseif($validate_associations === true && $validate_event !== true ){
                $response = $validate_event;
            } else{
                $response = array_merge( $validate_event, $validate_associations );
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Event
     * @return Jsend
     */
    public function update($id) {
        $new_data = Input::only(
            'ending_date_hour', 'title_de', 'nb_meal', 'nb_vegans_meal', 'opening_doors', 'meal_notes_de', 
            'nb_places', 'followed_by_private', 'contract_src', 'notes_de', 'event_type_id', 
            'representer_id');
        $validate = Event::validate($new_data, Event::$update_rules);
        if ($validate === true) {
            $response = self::modify($id, $new_data);
        } else {
            $response = $validate;
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * Th provided id is passed to the <b>delete()</b> method that deletes the corresponding model.<br>
     * If the provided id does not point to an existing Event, a <b>Jsend::fail</b> is returned.<br>
     * 
     * @param int $id The id of the requested Event
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Event', $id));
    }

    /**
     * Publish the specified ressource.
     *
     * If the provided id does not point to an existing Event, a <b>Jsend::fail</b> is returned.<br>
     * If the Event does not exist, a <b>Jsend::fail</b> is returned.<br>
     * Or else, the Event is passed to the <b>sfPublish</b> method, which returns a response.<br> 
     * 
     *
     * @param  int  $id The id of the Event to publish
     * @return Jsend
     */
    public function publish($id) {
        $response = Event::exist($id);
        if (is_object($response)) {
            $response = self::sfPublish($response);
        } else {
            $response['fail'] = ['event' => [trans('fail.event.inexistant')]];
        }
        return Jsend::compile($response);
    }

    /**
     * Publish the specified ressource.
     *
     * If the provided id does not point to an existing Event, a <b>Jsend::fail</b> is returned.<br>
     * If the Event does not exist, a <b>Jsend::fail</b> is returned.<br>
     * Or else, the Event is passed to the <b>sfUnpublish</b> method, which returns a response.<br> 
     * 
     * @param  int  $id The id of the Event to unpublish
     * @return Jsend
     */
    public function unpublish($id) {
        $response = Event::exist($id);
        if (is_object($response)) {
            $response = self::sfUnpublish($response);
        } else {
            $response['fail'] = ['event' => [trans('fail.event.inexistant')]];
        }
        return Jsend::compile($response);
    }

    /**
     * Export the information related to Events that take place between the two dates provided to a well formatted word document.
     *
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @return Jsend 'fail' or a Word.docx
     */
    public function exportWord() {
        $from = Input::get('from');
        $to = Input::get('to');
        if (isset($from) && isset($to)) {
            $v = Validator::make(array('from' => $from, 'to' => $to), array('from' => 'date|required', 'to' => 'date|required'));
            if ($v->fails()) {
                $response['fail'] = $v->messages()->getMessages();
                return Jsend::compile($response);
            } elseif (Event::checkDatesChronological($from, $to) === true) {
                WordExport::events($from, $to) === true;
                // if a WordExport succeeds, there should no answer be returned. If there is a return,
                // the wordfile gets corrupt. So it's not possible to make $response['success'] = ['title' => trans('success.wordexport.create')];
            } else {
                $response['fail'] = ['title' => trans('fail.export.unchronological')];
                return Jsend::compile($response);
            }    
        } else {
            $response['fail'] = ['word' => [trans('fail.wordexport.noinput')]];
            return Jsend::compile($response);
        }
    }

    /**
     * Export events between the two dates (including them) to a XML document.
     *
     * @param
     * @return Response
     */
    public function exportXML() {
        $from = Input::get('from');
        $to = Input::get('to');
        if (isset($from) && isset($to)) {
            $v = Validator::make(array('from' => $from, 'to' => $to), array('from' => 'date|required', 'to' => 'date|required'));
            if ($v->fails()) {
                $response['fail'] = $v->messages()->getMessages();
                return Jsend::compile($response);
            } elseif (Event::checkDatesChronological($from, $to) === true) {
                XMLExport::events($from, $to) === true;
                // if a WordExport succeeds, there should no answer be returned. If there is a return,
                // the wordfile gets corrupt. So it's not possible to make $response['success'] = ['title' => trans('success.wordexport.create')];
            } else {
                $response['fail'] = ['title' => trans('fail.export.unchronological')];
                return Jsend::compile($response);
            }    
        } else {
            $response['fail'] = ['xml' => [trans('fail.xmlexport.noinput')]];
            return Jsend::compile($response);
        }
    }

    public function symbolize($id){
        $inputs = [
            'event_id' => $id,
            'image_id' => Input::get('image_id'),
        ];
        $v = Validator::make(
        $inputs, [
            'event_id' => 'required|exists:events,id',
            'image_id' => 'required|exists:images,id']
        );
        if ($v->passes()) {
            $response = SymbolizationController::save($inputs);
        } else {
            $response['fail'] = $v->messages()->getMessages();
        }
        return Jsend::compile($response);
    }

    public function desymbolize($id){
        $event = Event::exist($id);
        if (is_object($event)) {
            $response = SymbolizationController::delete($event);
        } else {
            $response['fail'] = [
                'title' => trans('fail.event.inexistant'),
            ];
        }
        return Jsend::compile($response);
    }

    public function setRepresenter($id){
        $inputs = [
            'event_id' => $id,
            'representer_id' => Input::get('representer_id'),
        ];
        $v = Validator::make(
        $inputs, [
            'representer_id' => 'required|exists:representers,id',
            'event_id' => 'required|exists:events,id']
        );
        if ($v->passes()) {
            $response = GuaranteeController::save($inputs);
        } else {
            $response['fail'] = $v->messages()->getMessages();
        }
        return Jsend::compile($response);
    }

    public function unsetRepresenter($id){
        $event = Event::exist($id);
        if (is_object($event)) {
            $response = GuaranteeController::delete($event);
        } else {
            $response['fail'] = [
                'event' => [trans('fail.event.inexistant')],
            ];
        }
        return Jsend::compile($response);
    }

    /**
     * 
     * @param type $event
     * @return type
     */
    public static function sfUnpublish($event) {
        $event->published_at = null;
        if ($event->save()) {
        $response = ['success' => ['title' => trans('success.event.unpublished')]];
        } else {
        $response = ['error' => trans('error.event.unpublished')];
        }
        return $response;
    }

    /**
     * 
     * @param type $event
     * @return type
     */

   public static function sfPublish($event) {
        $response = Event::atLeastOneMainPerformer($event);
        if ($response === true) {
            $response = Event::isSymbolized($event);
            if ($response === true) {
                $publishing = Event::updateOne(['published_at' => date('Y-m-d H:i:s')], $event);
                if (isset($publishing['success'])) {
                    $response = ['success' => ['title' => trans('success.event.published')]];
                } else {
                    $response = ['error' => trans('error.event.published')];
                }
            }
        }
        return $response;
    }

    public static function save($inputs) {
        if( Ticket::isTicketCategoryUnicity( $inputs['tickets'] ) ) {
            foreach ( $inputs['tickets'] as $key => $ticket) {
                $v = Ticket::validate($ticket, Ticket::$create_event_rules);
                if( $v !== true ){
                    $response['fail']['tickets'][$key] = $v['fail'];
                }
            }
            if( !isset( $response['fail'] ) ){
                if( isset($inputs['opening_doors']) && $inputs['opening_doors'] != NULL ){
                    $response = Event::checkOpeningDoorsHour( $inputs['start_date_hour'], $inputs['opening_doors'] );
                }
                if( !isset( $response ) || $response === true ){
                    $response = Event::checkDatesChronological( $inputs['start_date_hour'], $inputs['ending_date_hour'] );
                    if($response === true){
                        $response = Event::checkDatesDontOverlap( $inputs['start_date_hour'], $inputs['ending_date_hour'] );
                    }
                }
            }
        } else {
            $response['fail'] = [
                'tickets' => [trans('fail.ticket_category.not_unique')]
            ];
        }
        if ( !isset( $response['fail'] ) ) {
            $response = Event::createOne($inputs);
        }
        return $response;
    }

    public static function modify( $id, $new_data ) {
        $event = Event::exist($id);
        if( is_object( $event ) ){
            if(isset($new_data['opening_doors']) && $new_data['opening_doors'] != NULL ){
                $response = Event::checkOpeningDoorsHour( $event->start_date_hour, $new_data['opening_doors'] );
            }
            if( (!isset( $response ) || $response === true) && (isset($new_data['ending_date_hour']) && $new_data['ending_date_hour'] != NULL) ){
                $response = Event::checkDatesChronological( $event->start_date_hour, $new_data['ending_date_hour'] );
            }
        } else {
            $response['fail'] = [
                'fail' => [
                    'title' => trans('fail.event.inexistant'),
                ],
            ];
        }
        if ( !isset( $response['fail'] ) ) {
            $response = Event::updateOne($new_data, $event);
        }
        return $response;
    }

    public static function saveAssociations( $class, $event_id, array $data ){
        $classNamespaced = 'Rockit\\'.$class;
        $controller = 'Rockit\\v1\\'.$class.'Controller';
        $plural = snake_case( str_plural( $class ) );
        if( $classNamespaced::isUnique( $data ) ){
            foreach($data as $key => $array){
                $array['event_id'] = $event_id;
                $v = $classNamespaced::validate($array, $classNamespaced::$create_event_rules);
                if( $v !== true ){
                    $response['fail'][$key] = $v['fail'];
                } else {
                    $rep = $controller::saveAsAssociation($array);
                    if(isset($rep['fail'])){
                        $response['fail'][$key] = $rep['fail'];
                    } elseif(isset($rep['error'])) {
                        $response['error'][$key] = $rep['error'];
                    } else {
                        $response['success'] = [];
                    }
                }
            }
        } else {
            $response['fail'][] = trans('fail.'.strtolower($class).'.not_unique');
        }
        return $response;
    }

}
