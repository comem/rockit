<?php

namespace Rockit;

class Event extends \Eloquent {

	protected $table = 'events';
	public $timestamps = true;

	public function gifts()
	{
		return $this->belongsToMany('Rockit\Gift')->withPivot('quantity','cost','comment_de');
	}

	public function ticketCategories()
	{
		return $this->belongsToMany('Rockit\TicketCategory')->withPivot('ammount','comment_de','quantity_sold');
	}

	public function equipments()
	{
		return $this->belongsToMany('Rockit\Equipment')->withPivot('quantity','cost');
	}

	public function platforms()
	{
		return $this->belongsToMany('Rockit\Platform')->withPivot('url');
	}

	public function printingTypes()
	{
		return $this->belongsToMany('Rockit\PrintingType')->withPivot('source','nb_copies','nb_copies_surplus');
	}

	public function eventTypes()
	{
		return $this->belongsToMany('Rockit\EventType');
	}

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist')->withPivot('order','is_support','artist_hour_of_arrival');
	}

	public function members()
	{
		return $this->belongsToMany('Rockit\Member');
	}

	public function skills()
	{
		return $this->belongsToMany('Rockit\Skill')->withPivot('nb_people');
	}

	public function representer()
	{
		return $this->belongsTo('Rockit\Representer');
	}

}