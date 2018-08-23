<?php

use App\Quote;
use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quotes = $this->getQuotes();

        foreach($quotes as $quote)
        {
            Quote::create($quote);
        }
    }

    /**
     * Get Harvests
     * 
     * @return array
     */
    private function getHarvests()
    {
        return [
            [
                'author' => 'Torquato Tasso',
                'quote' => 'The day of fortune is like a harvest day, We must be busy when the corn is ripe.',
            ],[
                'author' => 'Anne Bronte',
                'quote' => 'A light wind swept over the corn, and all nature laughed in the sunshine.',
            ],[
                'author' => 'William Bernbach',
                'quote' => 'Today\'s smartest advertising style is tomorrow\'s corn.',
            ],[
                'author' => 'Michael Pollan',
                'quote' => 'Corn is a greedy crop, as farmers will tell you.',
            ],[
                'author' => 'Cato the Elder',
                'quote' => 'It is thus with farming: if you do one thing late, you will be late in all your work.',
            ],[
                'author' => 'Arthur Keith',
                'quote' => 'The discovery of agriculture was the first big step toward a civilized life.',
            ],[
                'author' => 'Samuel Johnson',
                'quote' => 'Agriculture not only gives riches to a nation, but the only riches she can call her own.',
            ],[
                'author' => 'Sam Farr',
                'quote' => 'To make agriculture sustainable, the grower has got to be able to make a profit.',
            ],[
                'author' => 'unknown',
                'quote' => 'You can make a small fortune in farming-provided you start with a large one.',
            ],[
                'author' => 'George Washington',
                'quote' => 'Agriculture is the most healthful, most useful, and most noble employment of man.',
            ],[
                'author' => 'Brian Brett',
                'quote' => 'Farming is a profession of hope.',
            ],[
                'author' => 'Douglas Jerrold',
                'quote' => 'If you tickle the earth with a hoe she laughs with a harvest.',
            ]
        ];
    }
}