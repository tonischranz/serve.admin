<?php
namespace tsd\serve\admin;
use tsd\serve\admin\MemberAdmin;
use tsd\serve\DefaultMode;

#[DefaultMode]
class DefaultMemberAdmin implements MemberAdmin
{    
    private array $users;
    
    function getMembers() : array
    {
        return $this->users;
    }    
}