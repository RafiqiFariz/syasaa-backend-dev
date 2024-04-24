<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Contracts\UpdatesUserPhoto;
use Illuminate\Support\Facades\Validator;

class UpdateProfilePhoto implements UpdatesUserPhoto
{
    /**
     * Validate and update the given user's photo.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'image' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        ])->validate();

        if (isset($input['image'])) {
            $user->updateProfilePhoto($input['image']);
        }
    }
}
