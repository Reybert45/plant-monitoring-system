<?php

namespace App\Http\Controllers;

use App\Traits\TraitReport;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    use TraitReport;

    public function type()
    {
        return 0;
    }
}
