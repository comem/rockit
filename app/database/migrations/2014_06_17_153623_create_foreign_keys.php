<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('groups', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('group_ressource', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('group_ressource', function(Blueprint $table) {
			$table->foreign('ressource_id')->references('id')->on('ressources')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('language_id')->references('id')->on('languages')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('events_needs', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skills')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('events_needs', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('member_skill', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skills')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('member_skill', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skills')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('members', function(Blueprint $table) {
			$table->foreign('addresse_id')->references('id')->on('addresses')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('printings', function(Blueprint $table) {
			$table->foreign('printing_type_id')->references('id')->on('printing_types')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('printings', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('gift_id')->references('id')->on('gifts')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('attributions', function(Blueprint $table) {
			$table->foreign('equipment_id')->references('id')->on('equipments')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('attributions', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('tickets', function(Blueprint $table) {
			$table->foreign('ticket_category_id')->references('id')->on('ticket_categories')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('tickets', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('publications', function(Blueprint $table) {
			$table->foreign('platform_id')->references('id')->on('platforms')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('publications', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('events', function(Blueprint $table) {
			$table->foreign('event_type_id')->references('id')->on('event_types')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('events', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('images')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('events', function(Blueprint $table) {
			$table->foreign('representer_id')->references('id')->on('representers')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('artists_musicians', function(Blueprint $table) {
			$table->foreign('musician_id')->references('id')->on('musicians')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('artists_musicians', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('artists_musicians', function(Blueprint $table) {
			$table->foreign('instrument_id')->references('id')->on('instruments')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('artists_genres', function(Blueprint $table) {
			$table->foreign('genre_id')->references('id')->on('genres')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('artists_genres', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('links', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('performers', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('performers', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('groups', function(Blueprint $table) {
			$table->dropForeign('groups_group_id_foreign');
		});
		Schema::table('group_ressource', function(Blueprint $table) {
			$table->dropForeign('group_ressource_group_id_foreign');
		});
		Schema::table('group_ressource', function(Blueprint $table) {
			$table->dropForeign('group_ressource_ressource_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_language_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_group_id_foreign');
		});
		Schema::table('events_needs', function(Blueprint $table) {
			$table->dropForeign('events_needs_skill_id_foreign');
		});
		Schema::table('events_needs', function(Blueprint $table) {
			$table->dropForeign('events_needs_event_id_foreign');
		});
		Schema::table('member_skill', function(Blueprint $table) {
			$table->dropForeign('member_skill_skill_id_foreign');
		});
		Schema::table('member_skill', function(Blueprint $table) {
			$table->dropForeign('member_skill_member_id_foreign');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->dropForeign('staffs_member_id_foreign');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->dropForeign('staffs_event_id_foreign');
		});
		Schema::table('staffs', function(Blueprint $table) {
			$table->dropForeign('staffs_skill_id_foreign');
		});
		Schema::table('members', function(Blueprint $table) {
			$table->dropForeign('members_addresse_id_foreign');
		});
		Schema::table('printings', function(Blueprint $table) {
			$table->dropForeign('printings_printing_type_id_foreign');
		});
		Schema::table('printings', function(Blueprint $table) {
			$table->dropForeign('printings_event_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_gift_id_foreign');
		});
		Schema::table('offers', function(Blueprint $table) {
			$table->dropForeign('offers_event_id_foreign');
		});
		Schema::table('attributions', function(Blueprint $table) {
			$table->dropForeign('attributions_equipment_id_foreign');
		});
		Schema::table('attributions', function(Blueprint $table) {
			$table->dropForeign('attributions_event_id_foreign');
		});
		Schema::table('tickets', function(Blueprint $table) {
			$table->dropForeign('tickets_ticket_category_id_foreign');
		});
		Schema::table('tickets', function(Blueprint $table) {
			$table->dropForeign('tickets_event_id_foreign');
		});
		Schema::table('publications', function(Blueprint $table) {
			$table->dropForeign('publications_platform_id_foreign');
		});
		Schema::table('publications', function(Blueprint $table) {
			$table->dropForeign('publications_event_id_foreign');
		});
		Schema::table('events', function(Blueprint $table) {
			$table->dropForeign('events_event_type_id_foreign');
		});
		Schema::table('events', function(Blueprint $table) {
			$table->dropForeign('events_image_id_foreign');
		});
		Schema::table('events', function(Blueprint $table) {
			$table->dropForeign('events_representer_id_foreign');
		});
		Schema::table('artists_musicians', function(Blueprint $table) {
			$table->dropForeign('artists_musicians_musician_id_foreign');
		});
		Schema::table('artists_musicians', function(Blueprint $table) {
			$table->dropForeign('artists_musicians_artist_id_foreign');
		});
		Schema::table('artists_musicians', function(Blueprint $table) {
			$table->dropForeign('artists_musicians_instrument_id_foreign');
		});
		Schema::table('artists_genres', function(Blueprint $table) {
			$table->dropForeign('artists_genres_genre_id_foreign');
		});
		Schema::table('artists_genres', function(Blueprint $table) {
			$table->dropForeign('artists_genres_artist_id_foreign');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_artist_id_foreign');
		});
		Schema::table('links', function(Blueprint $table) {
			$table->dropForeign('links_artist_id_foreign');
		});
		Schema::table('performers', function(Blueprint $table) {
			$table->dropForeign('performers_artist_id_foreign');
		});
		Schema::table('performers', function(Blueprint $table) {
			$table->dropForeign('performers_event_id_foreign');
		});
	}
}