<?php

namespace App\Entity;

use App\Entity\MailContent\JobBoard;
use App\Entity\MailContent\EventPlan;
use App\Entity\MailContent\FreeGoods;
use App\Entity\MailContent\MonthStats;
use App\Entity\MailContent\BlogArticles;
use App\Entity\MailContent\PricingTable;
use App\Entity\MailContent\UserWelcoming;
use App\Entity\MailContent\BookSuggestion;
use App\Entity\MailContent\EventSuggestion;
use App\Entity\MailContent\PlaylistSuggestion;


class Data
{
    public const PAGINATION_ITEMS_PER_PAGE = 8;
    public const PAGINATION_ITEMS_PER_PAGE_LASTS = 5;

    public const MAIL_CONTENT = [
        'Blog articles' => Data::BLOG_ARTICLES,
        'Book suggestion' => Data::BOOK_SUGGESTION,
        'Event plan' => Data::EVENT_PLAN,
        'Event suggestion' => Data::EVENT_SUGGESTION,
        'Free goods' => Data::FREE_GOODS,
        'Job board' => Data::JOB_BOARD,
        'Month stats' => Data::MONTH_STATS,
        'Playlist suggestion' => Data::PLAYLIST_SUGGESTION,
        'Pricing table' => Data::PRICING_TABLE,
        'User welcoming' => Data::USER_WELCOMING,
    ];

    public const BLOG_ARTICLES = BlogArticles::class;
    public const BOOK_SUGGESTION = BookSuggestion::class;
    public const EVENT_PLAN = EventPlan::class;
    public const EVENT_SUGGESTION = EventSuggestion::class;
    public const FREE_GOODS = FreeGoods::class;
    public const JOB_BOARD = JobBoard::class;
    public const MONTH_STATS = MonthStats::class;
    public const PLAYLIST_SUGGESTION = PlaylistSuggestion::class;
    public const PRICING_TABLE = PricingTable::class;
    public const USER_WELCOMING = UserWelcoming::class;
}
