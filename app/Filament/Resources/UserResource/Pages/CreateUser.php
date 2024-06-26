<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use PhpParser\Node\Expr\Cast\String_;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getRedirectUrl(): String
    {
        return $this->getResource()::getUrl('index');
    }
}