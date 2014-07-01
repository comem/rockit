<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('InstrumentsTableSeeder');
        $this->command->info('Instruments table seeded!');
        $this->call('GenresTableSeeder');
        $this->command->info('Genres table seeded!');
        $this->call('MusiciansTableSeeder');
        $this->command->info('Musucians table seeded !');
        $this->call('PlatformsTableSeeder');
        $this->command->info('Platforms table seeded !');
        $this->call('TicketCategoriesTableSeeder');
        $this->command->info('Ticket Categories table seeded !');
        $this->call('EquipmentsTableSeeder');
        $this->command->info('Equipments table seeded !');
        $this->call('GiftsTableSeeder');
        $this->command->info('Gifts table seeded !');
        $this->call('EventTypesTableSeeder');
        $this->command->info('Event Types table seeded !');
        $this->call('PrintingsTypesTableSeeder');
        $this->command->info('Printing Types table seeded !');
        $this->call('SkillsTableSeeder');
        $this->command->info('Skills table seeded !');
        $this->call('RepresentersTableSeeder');
        $this->command->info('Representers table seeded !');
        $this->call('ArtistsTableSeeder');
        $this->command->info('Artist table seeded !');
        $this->call('ImagesTableSeeder');
        $this->command->info('Images table seeded !');
        $this->call('EventsTableSeeder');
        $this->command->info('Events table seeded !');
        $this->call('LinksTableSeeder');
        $this->command->info('Links table seeded !');
        $this->call('MembersTableSeeder');
        $this->command->info('Members table seeded !');
        $this->call('DescriptionTableSeeder');
        $this->command->info('Description table seeded !');
        $this->call('SharingsTableSeeder');
        $this->command->info('Sharings table seeded !');
        $this->call('TicketsTableSeeder');
        $this->command->info('Tickets table seeded !');
        $this->call('AttributionsTableSeeder');
        $this->command->info('Attribution table seeded !');
        $this->call('OffersTableSeeder');
        $this->command->info('Offer table seeded !');
        $this->call('PrintingsTableSeeder');
        $this->command->info('Printings table seeded !');
        $this->call('FulfillmentsTableSeeder');
        $this->command->info('Fulfillments table seeded !');
        $this->call('NeedsTableSeeder');
        $this->command->info('Needs table seeded !');
        $this->call('StaffsTableSeeder');
        $this->command->info('table seeded !');
        $this->call('PerformersTableSeeder');
        $this->command->info('Performer table seeded !');
        $this->call('LineupsTableSeeder');
        $this->command->info('Lineup table seeded !');
        $this->call('ResourceTableSeeder');
        $this->command->info('Resource table seeded !');
        $this->call('GroupTableSeeder');
        $this->command->info('Group table seeded !');
        $this->call('LanguageTableSeeder');
        $this->command->info('Language table seeded !');
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded !');
        $this->call('GroupResourceTableSeeder');
        $this->command->info('Group_Resource table seeded !');
        
    }

}
