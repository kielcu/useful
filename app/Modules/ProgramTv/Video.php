<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2018-09-19
 * Time: 18:34
 */

namespace App\Modules\ProgramTv;


use Carbon\Carbon;

class Video
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $dateTime;

    /**
     * Video constructor.
     *
     * @param string $title
     * @param Carbon $dateTime
     */
    public function __construct(string $title, Carbon $dateTime)
    {
        $this->title = $title;
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Carbon
     */
    public function getDateTime(): Carbon
    {
        return $this->dateTime;
    }


}