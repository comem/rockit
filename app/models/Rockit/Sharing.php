<?php

namespace Rockit;

use Auth,
    App,
    Config,
    \Rockit\Event,
    \WordExport;

class Sharing extends \Eloquent {
    
    use Models\ModelBCUDTrait;

	public $timestamps = true;
	protected $table = 'sharings';
	protected $hidden = ['external_id', 'external_infos', 'platform_id', 'event_id'];
        protected static $response_field = 'id';
        public static $create_rules = [
            'external_id' => 'required',
            'platform_id' => 'required|exists:platforms',
            'event_id' => 'required|exists:events'
        ];

        
	public function platform()
	{
		return $this->belongsTo('Rockit\Platform');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}
        
        public static function message($event) {
            setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge'); // $locale = Config::get('app.locale');
            $date = strftime("%A, %e. %B %Y  |  %H.%M Uhr", strtotime($event->start_date_hour));
            $date = WordExport::deleteDoubleWhitspace($date);
            $additionalText = Session::get('additional_text');
            if(isset($additionalText)) {
                $message = $additionalText . "\r\n";
            } else {
                $message = "";
            }
            $inXDays = self::countDaysUntil(strtotime($event->start_date_hour));
            $performerString = "";
            $artists = $event->artists;
            foreach($artists as $artist) {
                $performerString = $performerString . $artist->name . "\r\n";
            }
            $message = $message . $inXDays . "Nicht verpassen: " . $date . "\r\n". $performerString . "in der Mahogany Hall.";
            return $message;
        }
        
        public static function countDaysUntil($time) {
            $today = time();
            $difference = $time - $today;
            $daysUntil = floor($difference/60/60/24);
            return $daysUntil;
        }

}