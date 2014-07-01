<?php

namespace Rockit;

use Auth,
    App,
    Config,
    \Session,
    \Rockit\Event,
    \RockitHelper,
    \WordExport;

class Sharing extends \Eloquent {
    
    use Models\ModelBCUDTrait;

	public $timestamps = true;
	protected $table = 'sharings';
	protected $hidden = ['external_id', 'external_infos', 'platform_id', 'event_id'];
        protected static $response_field = 'id';
        public static $create_rules = [
            'external_id' => '',
            'platform_id' => 'required|integer|exists:platforms,id',
            'event_id' => 'required|integer|exists:events,id'
        ];

        /**
         * Returns the platform to which the sharing belongs to.
         * @return Platform the platform element which belongs to the sharing.
         * @author Christian Heimann <christian.heimann@heig-vd.ch>
         */
	public function platform()
	{
		return $this->belongsTo('Rockit\Platform');
	}
        /**
         * Returns the event to which the sharing belongs to.
         * @return Event the event element which belongs to the sharing.
         * @author Christian Heimann <christian.heimann@heig-vd.ch>
         */
	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}
        
        /**
         * Function creates a message for sharing with the Date and the Artists playing
         * on the given event. The message is different 
         * @param Event $event complete Event object
         * @param string $additionalText a supplementary text which is added at the start of the message.
         * @return string a message for sharings
         * @author Christian Heimann <christian.heimann@heig-vd.ch>
         */
        public static function message($event, $additionalText) {
            setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge'); // $locale = Config::get('app.locale');
            $date = strftime("Am %A, %e. %B %Y um %H.%M Uhr: ", strtotime($event->start_date_hour));
            $date = RockitHelper::deleteDoubleWhitspace($date);
            if(!is_null($additionalText)) {
                $message = $additionalText . "\r\n \r\n";
            } else {
                $message = "";
            }
            $inXDays = RockitHelper::countDaysUntil(strtotime($event->start_date_hour));
            if($inXDays > 1) {
                $inXDaysText = "In " . $inXDays . " Tagen ist es soweit! " . $date; 
            } elseif($inXDays == 1) {
                $inXDaysText = "Morgen ist es soweit! ";
            } elseif($inXDays == 0) {
                $inXDaysText = "Nicht verpassen: Heute ist es soweit! ";
            } else {
                $inXDaysText = "Schön war's! ";
            }
            $performerString = "";
            $artists = $event->artists;
            $indexArtist = 0;
            $nbArtists = count($artists);
            foreach($artists as $artist) {
                if($indexArtist > 0 && $indexArtist < $nbArtists - 1) {
                    $performerString = $performerString . ", ";
                } elseif ($indexArtist > 0) {
                    $performerString = $performerString . " und ";
                }
                $performerString = $performerString . $artist->name;
                $indexArtist++;
            }
            
            $message = $message . $inXDaysText . $performerString;
            return $message;
        }
        

}