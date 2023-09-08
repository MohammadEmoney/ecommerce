<?php

namespace App\Enums;

enum ProductStatus:string
{
    case CREATED = 'created';
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case DELETED = 'deleted';
}
