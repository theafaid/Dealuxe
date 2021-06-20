<?php

namespace Tests\Setup;

use App\Models\Admin;

class AdminFactory
{
    /**
     * @param null $count
     * @param array $data
     * @return mixed
     */
    public function create($count = null, $data = [])
    {
        // create an admin
        return factory(Admin::class, $count && $count != 1 ? $count : null)->create($data);

    }
}
