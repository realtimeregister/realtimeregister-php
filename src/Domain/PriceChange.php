<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain;

class PriceChange extends Price
{
    public \DateTime $fromDate;

    private function __construct(string $product, string $action, string $currency, int $price, \DateTime $fromDate)
    {
        parent::__construct($product, $action, $currency, $price);
        $this->fromDate = $fromDate;
    }

    public function toArray(): array
    {
        $result = parent::toArray();
        $result['fromDate'] = $this->fromDate->format('Y-m-d\TH:i:s\Z');
        return $result;
    }

    public static function fromArray(array $json): PriceChange
    {
        return new PriceChange(
            $json['product'],
            $json['action'],
            $json['currency'],
            $json['price'],
            new \DateTime($json['fromDate'])
        );
    }
}
