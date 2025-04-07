<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

final class TemplatePreview implements DomainObjectInterface
{
    public ?string $subject;

    public ?string $text;

    public ?string $html;

    private function __construct(
        ?string $subject = null,
        ?string $text = null,
        ?string $html = null
    ) {
        $this->subject = $subject;
        $this->text = $text;
        $this->html = $html;
    }

    public static function fromArray(array $json): TemplatePreview
    {
        return new TemplatePreview(
            $json['subject'] ?? null,
            $json['text'] ?? null,
            $json['html'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'subject' => $this->subject,
            'text' => $this->text,
            'html' => $this->html,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
