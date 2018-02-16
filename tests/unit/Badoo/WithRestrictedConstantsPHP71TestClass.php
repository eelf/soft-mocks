<?php
/**
 * @author Oleg Efimov <o.efimov@corp.badoo.com>
 * @author Kirill Abrosimov <k.abrosimov@corp.badoo.com>
 */
namespace Badoo\SoftMock\Tests;

class WithRestrictedConstantsPHP71TestClass
{
    private const PRIVATE_VALUE = 1;
    protected const PROTECTED_VALUE = 11;
    protected const PROTECTED_INHERITED_VALUE = 111;

    public static function getPrivateValue() : int
    {
        return self::PRIVATE_VALUE;
    }

    public static function getSelfProtectedValue() : int
    {
        return self::PROTECTED_VALUE;
    }

    public static function getStaticProtectedValue() : int
    {
        return static::PROTECTED_VALUE;
    }

    public function getThisObjectProtectedValue() : int
    {
        return $this::PROTECTED_VALUE;
    }

    public static function getSelfInheritedConstant() : int
    {
        return self::PROTECTED_INHERITED_VALUE;
    }

    public static function getStaticInheritedConstant() : int
    {
        return static::PROTECTED_INHERITED_VALUE;
    }
}

class WithWrongPrivateConstantAccessPHP71TestClass
{
    public static function getPrivateValue() : int
    {
        return WithRestrictedConstantsPHP71TestClass::PRIVATE_VALUE;
    }
}

class WithWrongProtectedConstantAccessPHP71TestClass
{
    public static function getProtectedValue() : int
    {
        return WithRestrictedConstantsPHP71TestClass::PROTECTED_VALUE;
    }
}

class WithRestrictedConstantsChildPHP71TestClass extends WithRestrictedConstantsPHP71TestClass
{
    protected const PROTECTED_INHERITED_VALUE = 222;

    public static function getParentPrivateValue() : int
    {
        return parent::PRIVATE_VALUE;
    }

    public static function getParentProtectedValue() : int
    {
        return parent::PROTECTED_VALUE;
    }

    public static function getParentInheritedConstant() : int
    {
        return parent::PROTECTED_INHERITED_VALUE;
    }

    public static function getChildSelfInheritedConstant() : int
    {
        return self::PROTECTED_INHERITED_VALUE;
    }

    public static function getChildStaticInheritedConstant() : int
    {
        return static::PROTECTED_INHERITED_VALUE;
    }
}

function getPrivateValue() : int
{
    return WithRestrictedConstantsPHP71TestClass::PRIVATE_VALUE;
}

function getProtectedValue() : int
{
    return WithRestrictedConstantsPHP71TestClass::PROTECTED_VALUE;
}