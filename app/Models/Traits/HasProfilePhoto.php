<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasProfilePhoto
{
    /**
     * Update the user's profile photo.
     *
     * @param UploadedFile $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo): void
    {
        tap($this->attributes['image'], function ($previous) use ($photo) {
            $photoName = $photo->getClientOriginalName();
            $fileName = uniqid() . '-' . Str::kebab(Str::lower($photoName));

            $this->forceFill([
                'image' => $photo->storePubliclyAs(
                    'profile_photos',
                    $fileName,
                    ['disk' => $this->profilePhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto(): void
    {
        // if (! Features::managesProfilePhotos()) {
        //     return;
        // }

        if (is_null($this->attributes['image'])) {
            return;
        }

        $cleaned = str_replace('storage/', '', $this->attributes['image']);
        Storage::disk($this->profilePhotoDisk())->delete($cleaned);

        $this->forceFill([
            'image' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getImageAttribute(): string
    {
        return isset($this->attributes['image'])
            ? Storage::disk($this->profilePhotoDisk())->url($this->attributes['image'])
            : $this->defaultImage();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultImage(): string
    {
        $name = trim(collect(explode(' ', $this->attributes['name']))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('fortify.profile_photo_disk', 'public');
    }
}
