<?php

namespace App\Contracts;

use App\Models\Projects;
use App\User;

interface ProjectsContract
{
    /**
     * @return Projects
     */
    public function added();

    /**
     * @return User
     */
    public function getAuthor();

}