<?php

namespace App;

enum UserProviderType: string
{
	case Internal = 'internal';
    case External = 'external';
}
