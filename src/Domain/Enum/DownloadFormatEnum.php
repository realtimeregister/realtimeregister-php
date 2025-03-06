<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

class DownloadFormatEnum extends AbstractEnum
{
    const CSR_FORMAT = 'CSR';
    const CRT_FORMAT = 'CRT';
    const ZIP_FORMAT = 'ZIP';
    const PKCS7_FORMAT = 'PKCS7';
    const CA_FORMAT = 'CA';
    const CA_BUNDLE_FORMAT = 'CA_BUNDLE';

    protected static array $values = [
        DownloadFormatEnum::CSR_FORMAT,
        DownloadFormatEnum::CRT_FORMAT,
        DownloadFormatEnum::ZIP_FORMAT,
        DownloadFormatEnum::PKCS7_FORMAT,
        DownloadFormatEnum::CA_FORMAT,
        DownloadFormatEnum::CA_BUNDLE_FORMAT,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DownloadFormatEnum::assertValueValid($value);
    }
}
