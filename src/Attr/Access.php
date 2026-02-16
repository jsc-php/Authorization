<?php

namespace JscPhp\Authorization\Attr;

class Access {
    private string $program;
    private int    $required_access;
    private string $function;
    private bool   $admin_only;

    public function __construct(string $program, string $function, int $required_access, bool $admin_only = false) {
        $this->program = $program;
        $this->required_access = $required_access;
        $this->function = $function;
        $this->admin_only = $admin_only;
    }

    public function getFunction(): string {
        return $this->function;
    }

    public function isAdminOnly(): bool {
        return $this->admin_only;
    }

    public function getProgram(): ?string {
        return $this->program;
    }

    public function getRequiredAccess(): ?int {
        return $this->required_access;
    }


}