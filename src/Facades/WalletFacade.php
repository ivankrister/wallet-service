<?php

namespace DotcodeIo\Wallet\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @property int $id
 * @property string $name
 * @property string $version
 * @property string $balance
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */

class WalletFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wallet.model';
    }
}
