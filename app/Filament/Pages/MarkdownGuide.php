<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MarkdownGuide extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.markdown-guide';
}
