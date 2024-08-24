<?php

namespace DotcodeIo\Wallet\Requests;

use DotcodeIo\Wallet\Models\User;
use DotcodeIo\Wallet\Facades\WalletFacade as Wallet;
use DotcodeIo\Wallet\Rules\SufficientBalance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WalletTransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function getUserToWallet(): Wallet
    {
        $toUser = User::query()->where('uuid', $this->to_user)->firstOrFail();
        return Wallet::where('user_id', $toUser->id)->firstOrFail();
    }

    public function getCurrentUserWallet(): Wallet
    {
        return Wallet::where('user_id', $this->user()->id)->firstOrFail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'to_user' => ['required','string', 'exists:users,uuid'],
            'amount' => ['required', 'numeric', 'min:1', 'regex:/^\d+(\.\d{1,2})?$/', Rule::notIn([0]), new SufficientBalance($this->user()->id)],
        ];
    }
}
