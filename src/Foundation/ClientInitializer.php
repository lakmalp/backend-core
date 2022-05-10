<?php

namespace Premialabs\Foundation;

use App\Src\Agent\gen\Agent;
use App\Src\Bank\BankRepo;
use App\Src\Country\CountryRepo;
use App\Src\ExchangeHouse\ExchangeHouseRepo;
use App\Src\Permission\PermissionRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientInitializer
{
  public function fetchInitData()
  {
    $navs = (new Security)->getNavigator();

    return [
      'navs' => $navs
    ];
  }
}
