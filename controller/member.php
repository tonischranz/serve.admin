<?php
namespace tsd\serve\admin;

use tsd\serve\admin\AdminControllerBase;
use tsd\serve\admin\MemberAdmin;
use tsd\serve\SecurityGroup;
use tsd\serve\MenuItem;


class MemberController extends AdminControllerBase
{
    private MemberAdmin $member;

    #[SecurityGroup('developer')]
    #[MenuItem('member')]
    function showIndex()
    {
        $members = [];
        $mem = $this->member->getMembers();

        foreach ($mem as $n=>$m) $members[]=['name'=>$n, 'groups' =>$m['groups']];

        return $this->view(['users'=>$members]);
    }
}