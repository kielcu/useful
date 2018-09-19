<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2018-09-19
 * Time: 19:23
 */

namespace App\Modules\ProgramTv\WP;


use App\Modules\ProgramTv\IParser;
use App\Modules\ProgramTv\Video;
use Carbon\Carbon;
use DiDom\Document;

class ParserStation implements IParser
{
    /**
     * @var Document
     */
    private $document;

    /**
     * @var Video []
     */
    private $videos = [];

    /**
     * Parser constructor.
     *
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->parse();
    }

    /**
     * @return Video []
     */
    public function get(): array
    {
        return $this->videos;
    }

    /**
     * @param Carbon $dateTimeFrom
     * @param Carbon $dateTimeTo
     *
     * @return Video []
     */
    public function getDateTimeBetween(Carbon $dateTimeFrom, Carbon $dateTimeTo): array
    {
        $videos = [];

        foreach ($this->videos as $video) {
            if ($video->getDateTime()->gte($dateTimeFrom) && $video->getDateTime()->lte($dateTimeTo)) {
                $videos[] = $video;
            }
        }

        return $videos;
    }

    protected function parse(): void
    {
        $date = $this->setDateForDay();
        $hours = $this->document->find('.hrsOut .hour');

        foreach ($hours as $days) {
            foreach ($days->children() as $day => $item) {
                foreach ($item->children() as $child) {
                    $this->videos[] = (new ParseVideo($child, $date[$day]))->getVideo();
                }
            };
        }
    }

    /**
     * @return Carbon []
     */
    private function setDateForDay(): array
    {
        $today = $this->getToday();
        $date = [];

        foreach ($this->document->find('.lsDay li') as $key => $item) {
            $date[$key] = Carbon::today()->copy()->addDay($key - $today);
        }

        return $date;
    }

    /**
     * @return int
     */
    private function getToday(): int
    {
        $days = $this->document->find('.lsDay li');

        foreach ($days as $key => $day) {
            if ($day->getAttribute('class') == 'today')
                return $key;
        }

        return null;
    }
}