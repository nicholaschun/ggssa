<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
trait HasProfilePhoto
{
    public function getProfilePhotoUrlAttribute(): string
    {
      dd($this->profile_photo);
        return $this->profile_photo
            ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo)
            : $this->defaultProfilePhotoUrl();
    }
 
    public function updateProfilePhoto(null|string $photo): void
    {
        tap($this->profile_photo, function ($previous) use ($photo) {
            $this->forceFill([
                'profile_photo' => $photo,
            ])->save();
 
            if ($previous && ! $photo) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }
 
    protected function defaultProfilePhotoUrl(): string
    {
        // $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
        //     return mb_substr($segment, 0, 1);
        // })->join(' '));
 
        return 'https://ggssa-public.s3.amazonaws.com/image-placeholder.jpg';
    }
 
    public function profilePhotoDisk(): string
    {
      return 's3';
        // return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('your-config.profile_photo_disk', 'public');
    }
 
    public function profilePhotoDirectory(): string
    {
        return 'profile-photos';
    }
}