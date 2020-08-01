<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\{
    AccessorTrait,
    ReflectPropertyTrait
};
use BadMethodCallException;

/**
*   AccessorTraitで操作するクラス
*/
class AccessorTraitTarget
{
    use AccessorTrait;
    //ReflectPropertyTraitの影響は受けないのでprivate propertyもOK
    use ReflectPropertyTrait;

    public $public_property = 'publicProperty';
    protected $protected_property = 'protectedProperty';
    private $private_property = 'privateProperty';

    public $get_public_property = 'publicProperty';
    protected $get_protected_property = 'protectedProperty';
    private $get_private_property = 'privateProperty';

    public $set_public_property = 'publicProperty';
    protected $set_protected_property = 'protectedProperty';
    private $set_private_property = 'privateProperty';

    protected array $getters = [
        'get_public_property',
        'get_protected_property',
        'get_private_property',
    ];
    protected array $setters = [
        'set_public_property',
        'set_protected_property',
        'set_private_property',
    ];
}


////////////////////////////////////////////////////////////////////////////////

class AccessorTraitTest extends MovementTestCase
{
    /**
    *
    */
    public function methodNameToPropertyNameメソッドdataProvider()
    {
        return [
            ['studyCaseString', 'study_case_string'],
            ['CamelCaseString', 'camel_case_string'],
            ['LastCaseStrinG', 'last_case_strin_g'],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider methodNameToPropertyNameメソッドdataProvider
    */
    public function methodNameToPropertyNameメソッド(
        $data,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new AccessorTraitTarget();

        $this->assertEquals(
            $expect,
            $this->callPrivateMethod(
                $obj,
                'methodNameToPropertyName',
                [$data]
            )
        );
    }
    
    /**
    *
    */
    public function getメソッドdataProvider()
    {
        return [
            ['getGetPublicProperty', 'publicProperty'],
            ['getGetProtectedProperty', 'protectedProperty'],
            ['getGetPrivateProperty', 'privateProperty'],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider getメソッドdataProvider
    */
    public function getメソッド(
        $method_name,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new AccessorTraitTarget();

        $this->assertEquals(
            $expect,
            $obj->$method_name()
        );
    }
    
    /**
    *
    */
    public function setメソッドdataProvider()
    {
        return [
            [
                'setSetPublicProperty',
                'set_public_property',
                'newPublicProperty'
            ],
            [
                'setSetProtectedProperty',
                'set_protected_property',
                'newProtectedProperty'
            ],
            [
                'setSetPrivateProperty',
                'set_private_property',
                'newPrivateProperty'
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider setメソッドdataProvider
    */
    public function setメソッド(
        $method_name,
        $property_name,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new AccessorTraitTarget();
        $obj->$method_name($expect);

        $this->assertEquals(
            $expect,
            $this->getPrivateProperty(
                $obj,
                $property_name
            )
        );
    }
    
    /**
    *
    */
    public function getメソッド例外dataProvider()
    {
        return [
            ['getSetPublicProperty'],
            ['getSetProtectedProperty'],
            ['getSetPrivateProperty'],
            ['publicProperty'],
            ['protectedProperty'],
            ['privateProperty'],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider getメソッド例外dataProvider
    */
    public function getメソッド例外(
        $method_name
    ) {
      //$this->markTestIncomplete();
        
        $obj = new AccessorTraitTarget();
        
         try {
            $val = $obj->$method_name();
        } catch (BadMethodCallException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *
    */
    public function setメソッド例外dataProvider()
    {
        return [
            ['setGetPublicProperty'],
            ['setGetProtectedProperty'],
            ['setGetPrivateProperty'],
            ['publicProperty'],
            ['protectedProperty'],
            ['privateProperty'],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider setメソッド例外dataProvider
    */
    public function setメソッド例外(
        $method_name
    ) {
      //$this->markTestIncomplete();
        
        $obj = new AccessorTraitTarget();
        
         try {
            $obj->$method_name('DUMMY');
        } catch (BadMethodCallException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }    
}
