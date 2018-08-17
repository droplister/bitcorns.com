<?php

namespace App\Listeners;

use App\Farm;
use Droplister\XcpCore\App\Events\CreditWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FarmListener
{
    /**
     * Handle the event.
     *
     * @param  CreditWasCreated  $event
     * @return void
     */
    public function handle(CreditWasCreated $event)
    {
        if($event->credit->asset === 'CROPS')
        {
            Farm::firstOrCreate([
                'xcp_core_address' => $event->credit->address,
                'xcp_core_credit_id' => $event->credit->id, 
            ],[
                'name' => $this->getName($event->credit),
                'address' => $event->credit->address,
                'image_url' => $this->getImageUrl(),
                'content' => $this->getContent(),
            ]);
        }
    }

    /**
     * Get Name
     *
     * @param  \App\Credit  $credit
     * @return string
     */
    private function getName($credit)
    {
        $rank = Farm::count();
        if($credit->action === 'issuance') return 'Genesis Farm';
        if($credit->action === 'dividend') $ties = Farm::where('xcp_core_credit_id', '=', $credit->id)->count();

        return isset($ties) ? "Bitcorn Farm #{$rank}-{$ties}" : "Bitcorn Farm #{$rank}";
    }

    /**
     * Get Image Url
     *
     * @return string
     */
    private function getImageUrl()
    {
        return '/image/default/' . rand(1, 12) . '.jpg';
    }

    /**
     * Get Content
     *
     * @return string
     */
    private function getContent()
    {
        $quotes = [
            'Torquato Tasso' => 'The day of fortune is like a harvest day, We must be busy when the corn is ripe.',
            'Anne Bronte' => 'A light wind swept over the corn, and all nature laughed in the sunshine.',
            'William Bernbach' => 'Today\'s smartest advertising style is tomorrow\'s corn.',
            'Michael Pollan' => 'Corn is a greedy crop, as farmers will tell you.',
            'Cato the Elder' => 'It is thus with farming: if you do one thing late, you will be late in all your work.',
            'Arthur Keith' => 'The discovery of agriculture was the first big step toward a civilized life.',
            'Samuel Johnson' => 'Agriculture not only gives riches to a nation, but the only riches she can call her own.',
            'Sam Farr' => 'To make agriculture sustainable, the grower has got to be able to make a profit.',
            'unknown' => 'You can make a small fortune in farming-provided you start with a large one.',
            'George Washington' => 'Agriculture is the most healthful, most useful, and most noble employment of man.',
            'Brian Brett' => 'Farming is a profession of hope.',
            'Douglas Jerrold' => 'If you tickle the earth with a hoe she laughs with a harvest.',
        ];

        $author = array_rand($quotes); // key
        $quote = $quotes[$author];     // value

        return "\"{$quote}\" &ndash; {$author}";
    }
}
