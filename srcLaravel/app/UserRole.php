<?php

namespace App;

enum UserRole: string
{
    case Admin = 'admin';
    case Provider = 'provider';
    case Client = 'client';
}