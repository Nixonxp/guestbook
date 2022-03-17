<?php

namespace App\Observers;

use App\Models\Guestbook;
use App\Services\TextFilterService;
use InvalidArgumentException;

class GusetbookObserver
{
    private TextFilterService $filterService;

    public function __construct(TextFilterService $filterService)
    {
        $this->filterService = $filterService;
    }
    /**
     * Handle the Guestbook "created" event.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return void
     */
    public function creating(Guestbook $guestbook)
    {
        $this->checkWords($guestbook->comment);
    }

    /**
     * Handle the Guestbook "updated" event.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return void
     */
    public function updating(Guestbook $guestbook)
    {
        if ($guestbook->isDirty('comment')) {
            $this->checkWords($guestbook->comment);
        }
    }

    private function checkWords($string)
    {
        $result = $this->filterService->search($string);

        if (!empty($result)) {
            throw new InvalidArgumentException(
                __('main.filter_stop_message',
                    ['words' => implode(', ', $result)])
            );
        }
    }
}
