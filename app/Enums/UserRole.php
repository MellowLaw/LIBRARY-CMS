<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case LIBRARIAN = 'librarian';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrator',
            self::LIBRARIAN => 'Librarian',
            self::VIEWER => 'Viewer',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

