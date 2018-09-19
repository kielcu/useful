<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2018-09-19
 * Time: 19:16
 */

namespace App\Modules\ProgramTv;


use Carbon\Carbon;

interface IParser
{
    /**
     * @return Video []
     */
    public function get() : array;

    /**
     * @param Carbon $dateTimeFrom
     * @param Carbon $dateTimeTo
     *
     * @return Video []
     */
    public function getDateTimeBetween(Carbon $dateTimeFrom, Carbon $dateTimeTo) : array;
}