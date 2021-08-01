<?php
namespace App\Traits\Security;

/**
 * User grant access based on grant_all_yn
 *
 * Trait HasGrantAccess
 * @package App\Traits\Security
 */
trait HasGrantAccess
{

    public function hasGrantAll() {
        return $this->hasGrantAccess();
    }

    /**
     * Has grant access
     *
     * @return bool
     */
    private function hasGrantAccess() {
        $roles = $this->getRoles();
        $slugs = $roles->pluck('has_grand_access','role_id');
        $arr = is_null($roles)
            ? []
            : $slugs->all();
       // dd($arr);

        return in_array('1', $arr);
    }
}
