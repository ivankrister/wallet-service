<?php

namespace DotcodeIo\Wallet\Services;

use DotcodeIo\Wallet\Models\Wallet;

class WalletService
{
    
    public static  function updateWallet(Wallet $wallet, int $amount): void
    {
       $updated = Wallet::where('id', $wallet->id)
            ->where('version', $wallet->version)
            ->update([
                'balance' => $wallet->balance + $amount,
                'version' => $wallet->version + 1,
            ]);

        if (!$updated) {
            throw new \Exception("Wallet was updated by another request");
        }

    }

}