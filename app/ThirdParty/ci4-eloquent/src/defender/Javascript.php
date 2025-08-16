<?php

namespace Artesaos\Defender;

use Artesaos\Defender\Contracts\Javascript as JavascriptContract;
use Artesaos\Defender\Traits\HasDefender;

/**
 * Class Javascript.
 */
class Javascript implements JavascriptContract
{
    /**
     * @var Defender
     */
    protected $defender;

    /**
     * @see Defender
     */
    public function __construct(Defender $defender)
    {
        $this->defender = $defender;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();

        return render('partials.javascript', [
            'roles' => $roles ? $roles->pluck('name')->toJson() : '[]',
            'permissions' => $permissions ? $permissions->pluck('name')->toJson() : '[]',
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getRoles()
    {
        $user = $this->defender->getUser();

        return $user ? $user->roles()->get()->toBase() : null;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getPermissions()
    {
        /** @var HasDefender $user */
        $user = $this->defender->getUser();

        return $user ? $user->getAllPermissions() : null;
    }
}
