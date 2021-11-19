<?php

namespace App\Entity\StaticStorage;

class UserStaticStorage
{
  public const USER_ROLE_USER = 'ROLE_USER';
  public const USER_ROLE_ADMIN = 'ROLE_ADMIN';

  public static function getUserRolesOptions(): array
  {
    return [
      self::USER_ROLE_USER => 'User',
      self::USER_ROLE_ADMIN => 'Admin'
    ];
  }
}