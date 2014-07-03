<?php

class DatabaseSeeder extends Seeder {
    
    protected static $namespace = 'Rockit\\Database\\Seeders\\';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call(self::$namespace . 'InstrumentsTableSeeder');
        $this->command->info('Instruments table seeded!');
        $this->call(self::$namespace . 'GenresTableSeeder');
        $this->command->info('Genres table seeded!');
        $this->call(self::$namespace . 'MusiciansTableSeeder');
        $this->command->info('Musucians table seeded !');
        $this->call(self::$namespace . 'PlatformsTableSeeder');
        $this->command->info('Platforms table seeded !');
        $this->call(self::$namespace . 'TicketCategoriesTableSeeder');
        $this->command->info('Ticket Categories table seeded !');
        $this->call(self::$namespace . 'EquipmentsTableSeeder');
        $this->command->info('Equipments table seeded !');
        $this->call(self::$namespace . 'GiftsTableSeeder');
        $this->command->info('Gifts table seeded !');
        $this->call(self::$namespace . 'EventTypesTableSeeder');
        $this->command->info('Event Types table seeded !');
        $this->call(self::$namespace . 'PrintingsTypesTableSeeder');
        $this->command->info('Printing Types table seeded !');
        $this->call(self::$namespace . 'SkillsTableSeeder');
        $this->command->info('Skills table seeded !');
        $this->call(self::$namespace . 'RepresentersTableSeeder');
        $this->command->info('Representers table seeded !');
        $this->call(self::$namespace . 'ArtistsTableSeeder');
        $this->command->info('Artist table seeded !');
        $this->call(self::$namespace . 'ImagesTableSeeder');
        $this->command->info('Images table seeded !');
        $this->call(self::$namespace . 'EventsTableSeeder');
        $this->command->info('Events table seeded !');
        $this->call(self::$namespace . 'LinksTableSeeder');
        $this->command->info('Links table seeded !');
        $this->call(self::$namespace . 'MembersTableSeeder');
        $this->command->info('Members table seeded !');
        $this->call(self::$namespace . 'DescriptionTableSeeder');
        $this->command->info('Description table seeded !');
        $this->call(self::$namespace . 'SharingsTableSeeder');
        $this->command->info('Sharings table seeded !');
        $this->call(self::$namespace . 'TicketsTableSeeder');
        $this->command->info('Tickets table seeded !');
        $this->call(self::$namespace . 'AttributionsTableSeeder');
        $this->command->info('Attribution table seeded !');
        $this->call(self::$namespace . 'OffersTableSeeder');
        $this->command->info('Offer table seeded !');
        $this->call(self::$namespace . 'PrintingsTableSeeder');
        $this->command->info('Printings table seeded !');
        $this->call(self::$namespace . 'FulfillmentsTableSeeder');
        $this->command->info('Fulfillments table seeded !');
        $this->call(self::$namespace . 'NeedsTableSeeder');
        $this->command->info('Needs table seeded !');
        $this->call(self::$namespace . 'StaffsTableSeeder');
        $this->command->info('table seeded !');
        $this->call(self::$namespace . 'PerformersTableSeeder');
        $this->command->info('Performer table seeded !');
        $this->call(self::$namespace . 'LineupsTableSeeder');
        $this->command->info('Lineup table seeded !');
        $this->call(self::$namespace . 'ResourceTableSeeder');
        $this->command->info('Resource table seeded !');
        $this->call(self::$namespace . 'GroupTableSeeder');
        $this->command->info('Group table seeded !');
        $this->call(self::$namespace . 'LanguageTableSeeder');
        $this->command->info('Language table seeded !');
        $this->call(self::$namespace . 'UserTableSeeder');
        $this->command->info('User table seeded !');
        $this->call(self::$namespace . 'GroupResourceTableSeeder');
        $this->command->info('Group_Resource table seeded !');
    }

}
