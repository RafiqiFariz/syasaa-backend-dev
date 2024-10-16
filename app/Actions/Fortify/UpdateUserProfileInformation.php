<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param array<string, string> $input
     */
    public function update(User $user, array $input): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'nullable', 'string', 'min:10',
                Rule::unique('users', 'phone')->ignore($user->id)
            ],
        ];

        if ($user->role_id === 3) {
            $rules['address'] = ['nullable', 'string'];
        }

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
            return;
        }

        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
        ])->save();

        if ($user->role_id === 3) {
            $user->lecturer()->update([
                'address' => $input['address'],
            ]);
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param array<string, string> $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
