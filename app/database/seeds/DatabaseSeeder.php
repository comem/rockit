<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('Rockit\Database\Seeders\InstrumentsTableSeeder');
        $this->command->info('Instruments table seeded!');
        $this->call('Rockit\Database\Seeders\GenresTableSeeder');
        $this->command->info('Genres table seeded!');
        $this->call('Rockit\Database\Seeders\MusiciansTableSeeder');
        $this->command->info('Musucians table seeded !');
        $this->call('Rockit\Database\Seeders\PlatformsTableSeeder');
        $this->command->info('Platforms table seeded !');
        $this->call('Rockit\Database\Seeders\TicketCategoriesTableSeeder');
        $this->command->info('Ticket Categories table seeded !');
        $this->call('Rockit\Database\Seeders\EquipmentsTableSeeder');
        $this->command->info('Equipments table seeded !');
        $this->call('Rockit\Database\Seeders\GiftsTableSeeder');
        $this->command->info('Gifts table seeded !');
        $this->call('Rockit\Database\Seeders\EventTypesTableSeeder');
        $this->command->info('Event Types table seeded !');
        $this->call('Rockit\Database\Seeders\PrintingsTypesTableSeeder');
        $this->command->info('Printing Types table seeded !');
        $this->call('Rockit\Database\Seeders\SkillsTableSeeder');
        $this->command->info('Skills table seeded !');
        $this->call('Rockit\Database\Seeders\RepresentersTableSeeder');
        $this->command->info('Representers table seeded !');
        $this->call('Rockit\Database\Seeders\ArtistsTableSeeder');
        $this->command->info('Artist table seeded !');
        $this->call('Rockit\Database\Seeders\ImagesTableSeeder');
        $this->command->info('Images table seeded !');
        $this->call('Rockit\Database\Seeders\EventsTableSeeder');
        $this->command->info('Events table seeded !');
        $this->call('Rockit\Database\Seeders\LinksTableSeeder');
        $this->command->info('Links table seeded !');
        $this->call('Rockit\Database\Seeders\MembersTableSeeder');
        $this->command->info('Members table seeded !');
        $this->call('Rockit\Database\Seeders\DescriptionTableSeeder');
        $this->command->info('Description table seeded !');
        $this->call('Rockit\Database\Seeders\SharingsTableSeeder');
        $this->command->info('Sharings table seeded !');
        $this->call('Rockit\Database\Seeders\TicketsTableSeeder');
        $this->command->info('Tickets table seeded !');
        $this->call('Rockit\Database\Seeders\AttributionsTableSeeder');
        $this->command->info('Attribution table seeded !');
        $this->call('Rockit\Database\Seeders\OffersTableSeeder');
        $this->command->info('Offer table seeded !');
        $this->call('Rockit\Database\Seeders\PrintingsTableSeeder');
        $this->command->info('Printings table seeded !');
        $this->call('Rockit\Database\Seeders\FulfillmentsTableSeeder');
        $this->command->info('Fulfillments table seeded !');
        $this->call('Rockit\Database\Seeders\NeedsTableSeeder');
        $this->command->info('Needs table seeded !');
        $this->call('Rockit\Database\Seeders\StaffsTableSeeder');
        $this->command->info('table seeded !');
        $this->call('Rockit\Database\Seeders\PerformersTableSeeder');
        $this->command->info('Performer table seeded !');
        $this->call('Rockit\Database\Seeders\LineupsTableSeeder');
        $this->command->info('Lineup table seeded !');
        $this->call('Rockit\Database\Seeders\ResourceTableSeeder');
        $this->command->info('Resource table seeded !');
        $this->call('Rockit\Database\Seeders\GroupTableSeeder');
        $this->command->info('Group table seeded !');
        $this->call('Rockit\Database\Seeders\LanguageTableSeeder');
        $this->command->info('Language table seeded !');
        $this->call('Rockit\Database\Seeders\UserTableSeeder');
        $this->command->info('User table seeded !');
        $this->call('Rockit\Database\Seeders\GroupResourceTableSeeder');
        $this->command->info('Group_Resource table seeded !');
    }

}
