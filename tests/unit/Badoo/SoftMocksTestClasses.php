<?php
/**
 * @author Kirill Abrosimov <k.abrosimov@corp.badoo.com>
 * @author Rinat Akhmadeev <r.akhmadeev@corp.badoo.com>
 */
namespace Badoo\SoftMock\Tests;

class DefaultTestClass
{
    const VALUE = 1;

    public static function getValue()
    {
        return self::VALUE;
    }

    public function doSomething($a, $b = [])
    {
        return true;
    }
}

class ConstructTestClass
{
    private $constructor_params;

    public function __construct()
    {
        throw new \RuntimeException("Constructor not intercepted!");
    }

    public function doSomething()
    {
        return 42;
    }

    public function getConstructorParams()
    {
        return $this->constructor_params;
    }
}

class BaseInheritanceTestClass
{
    const INHERITED_VALUE = 1;

    public function doSomething()
    {
        return 42;
    }

    public static function getSelfInheritedConstant()
    {
        return self::INHERITED_VALUE;
    }

    public static function getStaticInheritedConstant()
    {
        return static::INHERITED_VALUE;
    }
}

class InheritanceTestClass extends BaseInheritanceTestClass
{
    const INHERITED_VALUE = 2;

    public function otherFunction()
    {
        return 88;
    }

    public static function getParentInheritedConstant()
    {
        return parent::INHERITED_VALUE;
    }

    public static function getChildSelfInheritedConstant()
    {
        return self::INHERITED_VALUE;
    }

    public static function getChildStaticInheritedConstant()
    {
        return static::INHERITED_VALUE;
    }
}

class ParentMismatchBaseTestClass
{
    public static function f($c)
    {
        return 10;
    }
}

class ParentMismatchChildTestClass extends ParentMismatchBaseTestClass
{
    public static function f($c)
    {
        if ($c === true) {
            return 1;
        }

        return parent::f($c);
    }
}

class GeneratorsTestClass
{
    public function yieldAb($num)
    {
        yield "a";
        yield "b";
    }

    public function &yieldRef($num)
    {
        $a = "a";
        yield $a;
    }
}

class BaseTestClass
{
    public function getter()
    {
        return 10;
    }
}

class EmptyTestClass extends BaseTestClass {}

class EmptyEmptyTestClass extends EmptyTestClass {}

class ParentTestClass extends BaseTestClass
{
    public function getter()
    {
        return parent::getter() * 2;
    }
}

class ReplacingParentTestClass extends BaseTestClass
{
    public function getter()
    {
        return 20;
    }
}

class EmptyParentTestClass extends ParentTestClass {}

class BaseStaticTestClass
{
    public static function getString()
    {
        return 'A';
    }
}

class ChildStaticTestClass extends BaseStaticTestClass {}

class GrandChildStaticTestClass extends ChildStaticTestClass
{
    public static function getString()
    {
        return 'C' . parent::getString();
    }
}

class WithExitTestClass
{
    const RESULT = 42;
    public static $exit_called = false;
    public static $exit_code = true;

    public static function doWithExit()
    {
        $a = self::RESULT;
        $b = $a * 10;
        exit($b);
        return $a;
    }
}

abstract class WithoutConstantsTestClass
{
    //const A = 1;

    public function getA()
    {
        return static::A;
    }
}
