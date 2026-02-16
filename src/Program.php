<?php

namespace JscPhp\Authorization;

use JscPhp\Authorization\Attr\Access;
use ReflectionClass;

class Program {
    private string $class;
    private string $method;
    private bool   $protected = false;
    private string $program_name;
    private int    $required_access;

    public function __construct(string $class, string $method) {
        if (!class_exists($class)) {
            throw new \Exception("Class $class does not exist");
        }
        $this->class = $class;
        if (!method_exists($class, $method)) {
            throw new \Exception("Method $method does not exist");
        }
        $this->method = $method;

        $r_class = new ReflectionClass($class);
        $r_method = $r_class->getMethod($method);
        $attributes = $r_method->getAttributes(Access::class);
        if (!empty($attributes)) {
            $attr = $attributes[0]->newInstance();
            $this->protected = true;
            $this->required_access = $attr->getRequiredAccess();
            $this->program_name = $attr->getProgram();
        }
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getRequiredAccess(): int {
        return $this->required_access;
    }

    public function isProtected(): bool {
        return $this->protected;
    }

    public function getClass(): string {
        return $this->class;
    }

    public function getProgramName(): string {
        return $this->program_name;
    }
}