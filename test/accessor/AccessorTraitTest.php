<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\AccessorTrait;

/**
*   AccessorTraitで操作するクラス
*/
class AccessorTraitTarget
{
    use AccessorTrait;
    
    public $public_property = 'publicProperty';
    protected $protected_property = 'protectedProperty';
    private $private_property = 'privateProperty';
    
    public $get_public_property = 'publicProperty';
    protected $get_protected_property = 'protectedProperty';
    private $get_private_property = 'privateProperty';
    
    public $set_public_property = 'publicProperty';
    protected $set_protected_property = 'protectedProperty';
    private $set_private_property = 'privateProperty';
    
    private array $getters = [
        'get_public_property',
        'get_protected_property',
        'get_private_property',
    ];
    private array $setters = [
        'set_public_property',
        'set_public_property',
        'set_public_property',
    ];
}


////////////////////////////////////////////////////////////////////////////////

class AccessorTraitTest extends MovementTestCase
{
    /**
    *   @test
    */
    public function hasAccessorメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new AccessorTraitTarget();
        
        $this->assertFalse(
            $this->callPrivateMethod(
                $obj,
                'hasAccessor',
                ['DUMMY', 'get']
            )
        );
        
        
        
    }
}
