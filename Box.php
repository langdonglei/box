<?php

class Box
{
    public static $zj;
    public $box = [];

    public static function zj()
    {
        if (is_null(static::$zj)) {
            static::$zj = new static;
        }
        return static::$zj;
    }

    public function mk($class, $arr = [])
    {
        if (!isset($this->box[$class])) {
            try {
                $rc = new ReflectionClass($class);
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
            $args = [];
            $rm = $rc->getConstructor();
            if ($rm && 0 != $rm->getNumberOfParameters()) {
                // todo 补充带构造参数的类的注入
                foreach ($rm->getParameters() as $v) {
                    $val = array_shift($arr);
                    if ($v->getClass()) {
                        $rp = $v->getClass()->getName();
                        if ($val instanceof $rp) {
                            $args[] = $val;
                        } else {
                            $args[] = self::mk($rp);
                        }
                    } else {
                        $args[] = $val;
                    }
                }
            }
            $this->box[$class] = $rc->newInstanceArgs($args);
        }
        return $this->box[$class];
    }
}