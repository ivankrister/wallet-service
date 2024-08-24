<?php

namespace DotcodeIo\Wallet\DataTransferObjects;

use DotcodeIo\Wallet\Requests\WalletTransferRequest;
use DotcodeIo\Wallet\Models\User;
use DotcodeIo\Wallet\Models\Wallet;
use DotcodeIo\Wallet\ValueObjects\Cents;

class WalletTransferData
{
    public function __construct(
    public readonly Wallet $fromWallet,
    public readonly Wallet $toWallet,
    public readonly int $amount,
    ) {}

    public static function fromRequest(WalletTransferRequest $request): self
    {
        return new self(
            fromWallet: $request->getCurrentUserWallet(),
            toWallet: $request->getUserToWallet(),
            amount: Cents::from($request->amount)->getValue(),
        );
    }
}