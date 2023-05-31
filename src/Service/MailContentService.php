<?php

namespace App\Service;
use App\Entity\Data;
use App\Entity\Mail;
use App\Entity\User;
use App\Entity\Banner;
use App\Service\MailService;
use App\Entity\MailContent\MailContent;
use App\Service\MailContentTemplateService;
use Doctrine\Common\Collections\Collection;
use App\Entity\MailContent\MailContentInterface;

class MailContentService
{
    public function __construct(
        private MailContentTemplateService $mailContentTemplateService,
        private MailService $mailService,
    )
    {
    }

    public function getMailContentByClassName(?string $className): ?MailContentInterface {
        switch ($className) {
            case Data::BLOG_ARTICLES:
                return $this->mailContentTemplateService->getBlogArticles();
            case Data::BOOK_SUGGESTION:
                return $this->mailContentTemplateService->getBookSuggestion();
            case Data::EVENT_PLAN:
                return $this->mailContentTemplateService->getEventPlan();
            case Data::EVENT_SUGGESTION:
                return $this->mailContentTemplateService->getEventSuggestion();
            case Data::FREE_GOODS:
                return $this->mailContentTemplateService->getFreeGoods();
            case Data::JOB_BOARD:
                return $this->mailContentTemplateService->getJobBoard();
            case Data::MONTH_STATS:
                return $this->mailContentTemplateService->getMonthStats();
            case Data::PLAYLIST_SUGGESTION:
                return $this->mailContentTemplateService->getPlaylistSuggestion();
            case Data::PRICING_TABLE:
                return $this->mailContentTemplateService->getPricingTable();
            case Data::USER_WELCOMING:
                return $this->mailContentTemplateService->getUserWelcoming();
            default:
                return null;
        }
    }

    public function getContextByMail(Mail $mail): ?array {
        $mailContent = $mail->getMailContent();

        if (!$mailContent) {
            return null;
        }

        $title = $mail->getTitle();

        return $this->getContextByMailContent($mailContent, $title ? $title : '');
    }

    public function getContextByMailContent(MailContent $mailContent, string $title = '', ?User $user = null): ?array {
        $mailContentClassName = get_class($mailContent);
        return $this->mailService->getMessageContext(
            title: $title ? $title : '',
            local: 'fr',
            banner: $this->getBannerByClassName($mailContentClassName),
            content: $mailContent,
            user: $user
        );
    }

    public function sendMessagesByMail(Mail $mail): bool {
        $mailContent = $mail->getMailContent();

        if (!$mailContent) {
            return true;
        }

        $messages = [];
        $title = $mail->getTitle();
        $recipients = $mail->getRecipients();
        foreach ($recipients as $recipient) {
            $messages[] = [
                'to' => $recipient->getMail(),
                'title' => $title,
                'context' => $this->getContextByMailContent($mailContent, $title, $recipient),
                'template' => $this->getTemplateByClassName(get_class($mailContent))
            ];
        }

        return $this->mailService->sendMessages($messages);
    }

    public function getBannerByClassName(?string $className): ?string {
        switch ($className) {
            case Data::BLOG_ARTICLES:
                return Banner::BANNER_BLOG_ARTICLES;
            case Data::BOOK_SUGGESTION:
                return Banner::BANNER_BOOK_SUGGESTION;
            case Data::EVENT_PLAN:
                return Banner::BANNER_EVENT_PLAN;
            case Data::EVENT_SUGGESTION:
                return Banner::BANNER_EVENT_SUGGESTION;
            case Data::FREE_GOODS:
                return Banner::BANNER_FREE_GOODS;
            case Data::JOB_BOARD:
                return Banner::BANNER_JOB_BOARD;
            case Data::MONTH_STATS:
                return Banner::BANNER_MONTH_STATS;
            case Data::PLAYLIST_SUGGESTION:
                return Banner::BANNER_PLAYLIST_SUGGESTION;
            case Data::PRICING_TABLE:
                return Banner::BANNER_PRICING_TABLE;
            case Data::USER_WELCOMING:
                return Banner::BANNER_USER_WELCOMING;
            default:
                return null;
        }
    }

    public function getTemplateByClassName(?string $className): ?string {
        switch ($className) {
            case Data::BLOG_ARTICLES:
                return 'emails/content/blog-articles.html.twig';
            case Data::BOOK_SUGGESTION:
                return 'emails/content/book-suggestion.html.twig';
            case Data::EVENT_PLAN:
                return 'emails/content/event-plan.html.twig';
            case Data::EVENT_SUGGESTION:
                return 'emails/content/event-suggestion.html.twig';
            case Data::FREE_GOODS:
                return 'emails/content/free-goods.html.twig';
            case Data::JOB_BOARD:
                return 'emails/content/job-board.html.twig';
            case Data::MONTH_STATS:
                return 'emails/content/month-stats.html.twig';
            case Data::PLAYLIST_SUGGESTION:
                return 'emails/content/playlist-suggestion.html.twig';
            case Data::PRICING_TABLE:
                return 'emails/content/pricing-table.html.twig';
            case Data::USER_WELCOMING:
                return 'emails/content/user-welcoming.html.twig';
            default:
                return null;
        }
    }

    public function getGroupedBy(Collection $array, int $number = 2): array {
        $arrayGroupedBy = [];

        $j = 0;
        $i = 0;
        foreach ($array as $item) {
            if ($i % $number == 0) {
                $j++;
            }
            $arrayGroupedBy['GROUPE' . $j][] = $item;
            $i++;
        }
        return $arrayGroupedBy;
    }
}
