<?php

namespace App\Http\Controllers;

use App\Traits\TraitReport;
use Illuminate\Http\Request;

class ReportController extends AdminBaseController
{
    use TraitReport;
    
    public function type()
    {
        return 1;
    }
}