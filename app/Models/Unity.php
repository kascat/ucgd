<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unity
 * @package App\Models
 */
class Unity extends Model
{
    protected $connection = 'sqlite';

    /** PROPERTIES
        code:               text
        distributor_name:   text
        owner:              text
        project_class:      text
        sub_group:          text
        modality:           text
        credit_receivers:   integer
        city:               text
        state:              text
        postal_code:        text
        connection_date:    text
        project_type:       text
        source:             text
        power:              real
     */

    /** @var array */
    protected $casts = [
        'power' => 'float'
    ];

    /**
     * @param $date
     * @return bool|\DateTime
     */
    public function getConnectionDateAttribute ($date)
    {
        return \DateTime::createFromFormat('d/m/Y', $date);
    }
}
