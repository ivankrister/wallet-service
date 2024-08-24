<?php

namespace DotcodeIo\Wallet\Actions;

use DotcodeIo\Wallet\DataTransferObjects\WalletTransferData;
use DotcodeIo\Wallet\Services\WalletService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WalletTransferAction
{


    public function execute(WalletTransferData $data): void
    {
        $from = $data->fromWallet;

        if ($from->balance < $data->amount) {
            throw ValidationException::withMessages(['amount' => 'Insufficient balance']);
        }

        try{
            DB::beginTransaction();
            WalletService::updateWallet($from, -$data->amount);
            WalletService::updateWallet($data->toWallet, $data->amount);
            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            abort(409, $e->getMessage());
        }
        
       
    }
   

}