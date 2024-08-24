<?php

namespace DotcodeIo\Wallet\Rules;

use DotcodeIo\Wallet\Facades\WalletFacade as Wallet;
use DotcodeIo\Wallet\ValueObjects\Cents;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SufficientBalance implements ValidationRule
{

    public function __construct(private readonly int $userId)
    {
        
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userWallet = Wallet::where('user_id', $this->userId)->firstOrFail();

        try {

            $value = (float) $value;
            $value = Cents::from($value)->getValue();
        } catch (\Exception $e) {
            $fail("Invalid amount");
        }
        if ($userWallet->balance <  $value ) {
            $fail("Insufficient balance from ".$userWallet->balance." to ".$value);
        }
    }
}
