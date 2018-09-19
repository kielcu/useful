<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2018-09-19
 * Time: 21:13
 */

namespace App\Modules\ProgramTv\WP;


use App\Modules\ProgramTv\Video;
use Carbon\Carbon;
use DiDom\Element;

class ParseVideo
{
    /**
     * @var Element
     */
    private $element;
    /**
     * @var Carbon
     */
    private $date;

    /**
     * ParseProgram constructor.
     *
     * @param Element $element
     * @param Carbon $date
     */
    public function __construct(Element $element, Carbon $date)
    {
        $this->element = $element;

        $this->date = $date;
    }

    public function getVideo()
    {
        list($hour, $minute) = explode(":", $this->element->first('.tm')->text());

        $dateTime = $this->date->copy()->setTime($hour, $minute);

        if ($this->isNextDay(intval($hour))) {
            $dateTime->addDay();
        }

        return new Video(
            $this->element->first('h3 a')->text(),
            $dateTime
        );
    }

    /**
     * @param int $hour
     *
     * @return bool
     */
    private function isNextDay(int $hour): bool
    {
        if ($hour < 5) return true;

        return false;
    }
}