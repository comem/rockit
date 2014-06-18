<?php

namespace Rockit;

class Event extends \Eloquent {

	protected $table = 'events';
	public $timestamps = true;

	public function gifts()
	{
		return $this->belongsToMany('Gift')->withPivot('quantity','cost','comment_de');
	}

	public function ticketCategories()
	{
		return $this->belongsToMany('TicketCategory')->withPivot('ammount','comment_de','quantity_sold');
	}

	public function equipments()
	{
		return $this->belongsToMany('Equipment')->withPivot('quantity','cost');
	}

	public function platforms()
	{
		return $this->belongsToMany('Platform')->withPivot('url');
	}

	public function printingTypes()
	{
		return $this->belongsToMany('PrintingType')->withPivot('source','nb_copies','nb_copies_surplus');
	}

	public function eventTypes()
	{
		return $this->belongsToMany('EventType');
	}

	public function artists()
	{
		return $this->belongsToMany('Artist')->withPivot('order','is_support','artist_hour_of_arrival');
	}

	public function members()
	{
		return $this->belongsToMany('Member');
	}

	public function skills()
	{
		return $this->belongsToMany('Skill')->withPivot('nb_people');
	}

	public function representer()
	{
		return $this->belongsTo('Representer');
	}

}