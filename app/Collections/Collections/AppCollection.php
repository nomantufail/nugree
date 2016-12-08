<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/31/2016
 * Time: 11:00 PM
 */

namespace App\Collections\Collections;

use Illuminate\Support\Collection;
abstract class AppCollection extends Collection {
    public $originalSize = 0;
    public function __construct(array $records = [])
    {
        parent::__construct($records);
        $this->originalSize = $this->count();
    }
} 