<?php


namespace IgApi\Utils;


use IgApi\Constants;

class UserAgent
{

    /**
     * @param $onlyString
     * @return string
     *  * Here's an example string:
     * "Instagram 10.9.0 Android (23/6.0.1; 480dpi; 1080x1776; LENOVO/Lenovo; Lenovo P2a42; P2a42; qcom; fr_FR)".
     *
     * The format is made via the android.os.Build library:
     * "Instagram %s Android (%s/%s; %s; %s; %s/%s; %s; %s; %s)
     **** 1. Instagram VERSION.
     **** 2. Android API VERSION (Build$VERSION.SDK_INT)
     * 3. Android VERSION (Build$VERSION.RELEASE)
     * 4. DPI.
     * 5. Display Resolution.
     * 6. MANUFACTURER.
     * 7 (optional). BRAND (this "/"-portion with a brand doesn't always exist).
     * 8. MODEL.
     * 9. DEVICE.
     * 10. CPU (Build.HARDWARE)
     * 11. Language (Build.LOCALE).
     */
    public static function randomUA($onlyString = false): ?string
    {

        $randomPhone         = self::randomPhoneName();
        $igVERSION           = Constants::IG_VERSION;
        $androidSDKINT       = self::androidVersion();
        $androidAPILEVEL     = self::apiLevel($androidSDKINT);
        $buildDPI            = self::buildDPI();
        $deviceBRAND         = strtolower($randomPhone['phone_brand']);
        $deviceMDELNO        = $randomPhone['model_number'];
        $buildLang           = 'en_US';
        $cpuHARDWARE         = self::cpuHardware();


        if ($onlyString)
        {
            return sprintf('%s/%s; %s; %s; %s; %s; %s; %s',
                $androidAPILEVEL,
                $androidSDKINT,
                $buildDPI['dpi'],
                $buildDPI['wh'],
                $deviceBRAND,
                $deviceMDELNO,
                strtolower($deviceMDELNO),
                $cpuHARDWARE
            );
        }

        return sprintf('Instagram %s Android (%s/%s; %s; %s; %s; %s; %s; %s; %s)',
            $igVERSION,
            $androidAPILEVEL,
            $androidSDKINT,
            $buildDPI['dpi'],
            $buildDPI['wh'],
            $deviceBRAND,
            $deviceMDELNO,
            $cpuHARDWARE,
            $buildLang,
            Constants::IG_BUILD_NUM
        );

    }



    public static function buildString(): void
    {

    }

    public static function cpuHardware(): string
    {
        $hardware = ['exynos9610','samsungexynos8890','qcom','hi3660','hi6250'];
        return $hardware[array_rand($hardware)];
    }



    public static function androidVersion(): string
    {
        $versions = ['6.0', '7.0', '7.1', '8.0', '8.1', '9'];
        return $versions[array_rand($versions)];
    }

    public static function buildDPI(): array
    {
        $dpi = [
            [
                'dpi' => '380dpi',
                'wh'  => '1080x1920'
            ],
            [
                'dpi' => '640dpi',
                'wh'  => '1440x2392',
            ],
            [
                'dpi' => '640dpi',
                'wh'  => '1440x2560'
            ],
            [
                'dpi' => '431dpi',
                'wh'  => '1080x2280'
            ]
        ];
        return $dpi[array_rand($dpi)];
    }

    public static function apiLevel($android): int
    {
        switch ($android) {
            case '5.1':
                return 22;
            case '6.0':
                return 23;
            case '7.0':
                return 24;
            case '7.1':
                return 25;
            case '8.0':
                return 26;
            case '8.1':
                return 27;
            case '9':
                return 28;
        }
        return 28;
    }

    public static function randomPhoneName(): array
    {
        $phones = self::phones();

        $selectPhone = array_rand($phones);
        $selectModel = array_rand($phones[$selectPhone]);
        $selectModelNumber = $phones[$selectPhone][$selectModel][array_rand($phones[$selectPhone][$selectModel])];

        return [
            'phone_brand' => $selectPhone,
            'phone_model' => $selectModel,
            'model_number' => $selectModelNumber
        ];
    }

    public static function totalPhones(): int
    {
        $all = self::phones();
        $model = 0;
        foreach ($all['SAMSUNG'] as $key => $value)
        {
            echo $key . ': ' . count($value)."\n";
            $model += count($value);
        }
        return $model;
    }

    public static function phones(): array
    {
        return [
            'SAMSUNG' => [
                'GALAXY A9' => [
                    'SM-A9000',
                    'SM-A9100',
                    'SM-A910F',
                ],
                'GALAXY A8' => [
                    'SM-A810S',
                    'SM-A8000',
                    'SM-A800F',
                    'SM-A800I',
                    'SM-A800J',
                    'SM-A800S',
                    'SM-A800YZ'
                ],
                'GALAXY A7' => [
                    'SM-A7000',
                    'SM-A7009',
                    'SM-A700F',
                    'SM-A700FD',
                    'SM-A700H',
                    'SM-A700K',
                    'SM-A700L',
                    'SM-A700S',
                    'SM-A700YD',
                    'SM-A7100',
                    'SM-A710F',
                    'SM-A710K',
                    'SM-A710L',
                    'SM-A710M',
                    'SM-A710S'
                ],
                'GALAXY A5' => [
                    'SM-A5000',
                    'SM-A5009W',
                    'SM-A500F',
                    'SM-A500F1',
                    'SM-A500F1',
                    'SM-A500FU',
                    'SM-A500H',
                    'SM-A500K',
                    'SM-A500L',
                    'SM-A500M',
                    'SM-A500S',
                    'SM-A500XZ',
                    'SM-A500Y',
                    'SM-A5100',
                    'SM-A510F',
                    'SM-A510FD',
                    'SM-A510K',
                    'SM-A510L',
                    'SM-A510M',
                    'SM-A510S'
                ],
                'GALAXY A3' => [
                    'SM-A3000',
                    'SM-A3009',
                    'SM-A300F',
                    'SM-A300FU',
                    'SM-A300H',
                    'SM-A300M',
                    'SM-A300XZ',
                    'SM-A300Y',
                    'SM-A300YZ'
                ],
                'Galaxy Core Prime' => [
                    'SM-G360BT',
                    'SM-G360F',
                    'SM-G360FY',
                    'SM-G360G',
                    'SM-G360GY',
                    'SM-G360M'
                ],
                'Galaxy Grand Prime' => [
                    'SM-G5306W',
                    'SM-G5308W',
                    'SM-G5309W',
                    'SM-G530F',
                    'SM-G530FZ',
                    'SM-G530H',
                    'SM-G530P',
                    'SM-G530R4',
                    'SM-G530R7',
                    'SM-G530T',
                    'SM-G530T1',
                    'SM-G530W',
                    'SM-G530Y'
                ],
                'Galaxy J7' => [
                    'SM-G6100',
                    'SM-G610F',
                    'SM-J7008',
                    'SM-J700F',
                    'SM-J700H',
                    'SM-J700K',
                    'SM-J700M',
                    'SM-J700P',
                    'SM-J700T',
                    'SM-J700T1',
                    'SM-J7108',
                    'SM-J7109',
                    'SM-J710FN',
                    'SM-J710GN',
                    'SM-J710K',
                    'SM-J710MN',
                ],
                'Galaxy J5' => [
                    'SM-J5008',
                    'SM-J500F',
                    'SM-J500FN',
                    'SM-J500H',
                    'SM-J500M',
                    'SM-J500N0',
                    'SM-J500Y',
                    'SM-J5108',
                    'SM-J510FN',
                    'SM-J510GN',
                    'SM-J510H',
                    'SM-J510K',
                    'SM-J510L',
                    'SM-J510MN',
                    'SM-J510S',
                    'SM-J510UN'
                ],
                'Galaxy J3' => [
                    'SM-J3110',
                    'SM-J3119',
                    'SM-J3109',
                    'SM-J320P2',
                    'SM-J320Y',
                    'SM-J320YZ',
                    'SM-J320ZN',
                    'SM-J320A',
                    'SM-J320AZ',
                    'SM-J320N0',
                    'SM-J320R4',
                    'SM-J320V',
                    'SM-J320VPP',
                    'SM-J321AZ',
                    'SM-S320VL'
                ],
                'Galaxy J2' => [
                    'SM-J200BT',
                    'SM-J200F',
                    'SM-J200G',
                    'SM-J200GU',
                    'SM-J200M'
                ],
                'Galaxy Note 5' => [
                    'SM-N9200',
                    'SM-N9208',
                    'SM-N920A',
                    'SM-N920C',
                    'SM-N920K',
                    'SM-N920L',
                    'SM-N920P',
                    'SM-N920R4',
                    'SM-N920S',
                    'SM-N920T',
                    'SM-N920V'
                ],
                'Galaxy Note 4' => [
                    'SM-N910A',
                    'SM-N910C',
                    'SM-N910CQ',
                    'SM-N910F',
                    'SM-N910G',
                    'SM-N910H',
                    'SM-N910K',
                    'SM-N910L',
                    'SM-N910P',
                    'SM-N910R4',
                    'SM-N910S',
                    'SM-N910T',
                    'SM-N910T2',
                    'SM-N910T3',
                    'SM-N910U',
                    'SM-N910V',
                    'SM-N910W8'
                ],
                'Galaxy S7' => [
                    'SM-G9300',
                    'SM-G930A',
                    'SM-G930F',
                    'SM-G930K',
                    'SM-G930L',
                    'SM-G930P',
                    'SM-G930R4',
                    'SM-G930S',
                    'SM-G930T',
                    'SM-G930U',
                    'SM-G930V',
                    'SM-G930W8'
                ],
                'Galaxy S7 Edge' => [
                    'SM-G891A',
                    'SM-G9350',
                    'SM-G935A',
                    'SM-G935F',
                    'SM-G935K',
                    'SM-G935L',
                    'SM-G935P',
                    'SM-G935R4',
                    'SM-G935S',
                    'SM-G935T',
                    'SM-G935U',
                    'SM-G935V',
                    'SM-G935W8'
                ],
                'Galaxy S6' => [
                    'SM-G9200',
                    'SM-G9208',
                    'SM-G9209',
                    'SM-G920A',
                    'SM-G920F',
                    'SM-G920FD',
                    'SM-G920I',
                    'SM-G920K',
                    'SM-G920L',
                    'SM-G920P',
                    'SM-G920R4',
                    'SM-G920S',
                    'SM-G920T',
                    'SM-G920T1',
                    'SM-G920V',
                    'SM-G920W8',
                    'SM-S906L'
                ],
                'Galaxy S6 Edge' => [
                    'SM-G9250',
                    'SM-G925A',
                    'SM-G925F',
                    'SM-G925K',
                    'SM-G925L',
                    'SM-G925P',
                    'SM-G925R4',
                    'SM-G925S',
                    'SM-G925T',
                    'SM-G925V',
                    'SM-G925W8'
                ],
                'Galaxy S4' => [
                    'GT-I9500',
                    'GT-I9505',
                    'GT-I9506',
                    'GT-I9507',
                    'GT-I9508',
                    'GT-I9508V',
                    'SCH-I545',
                    'SCH-I545L',
                    'SCH-I545PP',
                    'SCH-R970',
                    'SCH-R970C',
                    'SCH-R970X',
                    'SGH-I337',
                    'SGH-I337M',
                    'SGH-I337Z',
                    'SGH-M919',
                    'SGH-M919N',
                    'SGH-M919V',
                    'SHV-E300K',
                    'SHV-E300L',
                    'SHV-E300S',
                    'SPH-L720',
                    'SPH-L720T'
                ]
            ],
        ];
    }


}