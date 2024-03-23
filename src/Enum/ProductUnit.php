<?php

namespace App\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum ProductUnit: string implements TranslatableInterface
{
    case PIECE = 'piece';
    case KG = 'kg';
    case LITER = 'liter';
    case MILLILITER = 'milliliter';

    public function trans(TranslatorInterface $translator, ?string $locale = null): string
    {
        return match ($this) {
            self::PIECE => $translator->trans('unit.piece', domain: 'product'),
            self::KG => $translator->trans('unit.kg', domain: 'product'),
            self::LITER => $translator->trans('unit.liter', domain: 'product'),
            self::MILLILITER => $translator->trans('unit.milliliter', domain: 'product'),
        };
    }
}
