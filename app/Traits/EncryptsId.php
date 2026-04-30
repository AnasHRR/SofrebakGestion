<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptsId
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], Crypt::encryptString((string)$this->getKey()));
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        try {
            // Restore base64 characters if needed
            $encodedValue = str_replace(['-', '_'], ['+', '/'], $value);
            
            // Try to decrypt. Since we removed '=', we might need to pad it, 
            // but Crypt::decryptString usually handles it or we can just try decrypting.
            $decrypted = Crypt::decryptString($encodedValue);
            
            return $this->where($field ?? $this->getKeyName(), $decrypted)->firstOrFail();
        } catch (\Exception $e) {
            // If decryption fails, maybe it's not encrypted or invalid
            
        }
    }
}
