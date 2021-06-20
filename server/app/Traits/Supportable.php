<?php

namespace App\Traits;

trait Supportable
{
    /**
     * Check if model is supported
     * @return bool
     */
    public function isSupported()
    {
        return (bool) $this->supported;
    }

    /**
     * Change support status
     */
    public function toggleSupport()
    {
        $this->update(['supported' => ! $this->supported]);
    }
}
