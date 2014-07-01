<?php

namespace Rockit;

use Auth,
    App,
    Config,
    \Session,
    \Rockit\Event,
    \RockitHelper,
    \WordExport;

/**
 * Contains the attributes and methods of a Sharing model in the database.<br>
 * A Sharing is the relationship between a Platform and an Event that is published on that Platform.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Sharing extends \Eloquent {

    use Models\ModelBCUDTrait;


	protected $table = 'sharings';
	protected $hidden = ['external_id', 'external_infos', 'platform_id', 'event_id', 'updated_at'];

    protected static $response_field = 'id';

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Validations rules for creating a new Sharing.
     * @var array 
     */
    public static $create_rules = [
        'external_id' => 'required',
        'platform_id' => 'required|exists:platforms',
        'event_id' => 'required|exists:events'
    ];

    /**
     * Get the Platform to which the Sharing is related.
     * @return \Illuminate\Database\Eloquent\Collection The Platform element which belongs to the Sharing.
     * @author Christian Heimann <christian.heimann@heig-vd.ch>
     */
    public function platform() {
        return $this->belongsTo('Rockit\Platform');
    }

    /**
     * Get the Event to which the Sharing is related.
     * @return \Illuminate\Database\Eloquent\Collection The Event element which belongs to the Sharing.
     * @author Christian Heimann <christian.heimann@heig-vd.ch>
     */
    public function event() {
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
        if (!is_null($additionalText)) {
            $message = $additionalText . "\r\n \r\n";
        } else {
            $message = "";
        }
        $inXDays = RockitHelper::countDaysUntil(strtotime($event->start_date_hour));

        if ($inXDays > 1) {
            $inXDaysText = "In " . $inXDays . " Tagen ist es soweit! " . $date;
        } elseif ($inXDays == 1) {
            $inXDaysText = "Morgen ist es soweit! ";
        } elseif ($inXDays == 0) {
            $inXDaysText = "Nicht verpassen: Heute ist es soweit! ";
        } else {
            $inXDaysText = "Schön war's! ";
        }
        $performerString = "";
        $artists = $event->artists;
        $indexArtist = 0;
        $nbArtists = count($artists);
        foreach ($artists as $artist) {
            if ($indexArtist > 0 && $indexArtist < $nbArtists - 1) {
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
