<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $contacts_array = array();
        for($i=1; $i < 10; $i++) {
            $contacts_array[$i]['first_name'] = 'Contact';
            $contacts_array[$i]['last_name'] = '00'. $i;
            $contacts_array[$i]['number'] = rand(1, 10) . rand(1, 10) . rand(1, 10);
            $contacts_array[$i]['created_at'] = new DateTime();
            $contacts_array[$i]['updated_at'] = new DateTime();
        }

        Contact::truncate();
        Contact::insert($contacts_array);
    }
}
