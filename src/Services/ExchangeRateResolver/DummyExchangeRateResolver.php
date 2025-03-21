<?php

namespace SteelArcher\CommissionsCalculation\Services\ExchangeRateResolver;

class DummyExchangeRateResolver implements ExchangeRateResolverInterface
{
    public function getExchangeRates(): array
    {
        return [
            'AED' => 3.975141,
            'AFN' => 76.43082,
            'ALL' => 98.531699,
            'AMD' => 424.831536,
            'ANG' => 1.95028,
            'AOA' => 987.023606,
            'ARS' => 1155.954766,
            'AUD' => 1.727089,
            'AWG' => 1.948073,
            'AZN' => 1.835893,
            'BAM' => 1.950498,
            'BBD' => 2.18496,
            'BDT' => 131.482581,
            'BGN' => 1.954443,
            'BHD' => 0.407907,
            'BIF' => 3207.181674,
            'BMD' => 1.082263,
            'BND' => 1.443277,
            'BOB' => 7.477638,
            'BRL' => 6.193032,
            'BSD' => 1.082158,
            'BTC' => 0.000012939252,
            'BTN' => 93.36862,
            'BWP' => 14.753825,
            'BYN' => 3.541473,
            'BYR' => 21212.354839,
            'BZD' => 2.173691,
            'CAD' => 1.553178,
            'CDF' => 3107.177375,
            'CHF' => 0.955438,
            'CLF' => 0.026219,
            'CLP' => 1006.190802,
            'CNY' => 7.844462,
            'CNH' => 7.855709,
            'COP' => 4520.222945,
            'CRC' => 541.029279,
            'CUC' => 1.082263,
            'CUP' => 28.67997,
            'CVE' => 109.966071,
            'CZK' => 24.978956,
            'DJF' => 192.706152,
            'DKK' => 7.459476,
            'DOP' => 68.173419,
            'DZD' => 145.109535,
            'EGP' => 54.736795,
            'ERN' => 16.233945,
            'ETB' => 142.712853,
            'EUR' => 1,
            'FJD' => 2.487474,
            'FKP' => 0.834292,
            'GBP' => 0.837298,
            'GEL' => 2.998033,
            'GGP' => 0.834292,
            'GHS' => 16.773326,
            'GIP' => 0.834292,
            'GMD' => 76.840995,
            'GNF' => 9357.562624,
            'GTQ' => 8.338256,
            'GYD' => 227.072731,
            'HKD' => 8.412484,
            'HNL' => 27.684232,
            'HRK' => 7.534066,
            'HTG' => 141.821854,
            'HUF' => 398.911225,
            'IDR' => 17886.777086,
            'ILS' => 4.020624,
            'IMP' => 0.834292,
            'INR' => 93.10222,
            'IQD' => 1417.620178,
            'IRR' => 45563.272338,
            'ISK' => 144.092797,
            'JEP' => 0.834292,
            'JMD' => 169.36959,
            'JOD' => 0.767371,
            'JPY' => 161.033097,
            'KES' => 139.990677,
            'KGS' => 92.971914,
            'KHR' => 4334.197995,
            'KMF' => 491.887345,
            'KPW' => 974.094992,
            'KRW' => 1587.214625,
            'KWD' => 0.333434,
            'KYD' => 0.901844,
            'KZT' => 544.472435,
            'LAK' => 23429.31032,
            'LBP' => 96964.865044,
            'LKR' => 320.698222,
            'LRD' => 216.43066,
            'LSL' => 19.682015,
            'LTL' => 3.195642,
            'LVL' => 0.654651,
            'LYD' => 5.206846,
            'MAD' => 10.391053,
            'MDL' => 19.521842,
            'MGA' => 5059.247063,
            'MKD' => 61.467584,
            'MMK' => 2271.655148,
            'MNT' => 3759.994456,
            'MOP' => 8.664008,
            'MRU' => 42.904576,
            'MUR' => 49.022748,
            'MVR' => 16.677755,
            'MWK' => 1876.399241,
            'MXN' => 21.843585,
            'MYR' => 4.784716,
            'MZN' => 69.167437,
            'NAD' => 19.681834,
            'NGN' => 1659.03343,
            'NIO' => 39.82175,
            'NOK' => 11.41057,
            'NPR' => 149.388905,
            'NZD' => 1.887499,
            'OMR' => 0.416593,
            'PAB' => 1.082158,
            'PEN' => 3.922238,
            'PGK' => 4.45489,
            'PHP' => 62.047229,
            'PKR' => 303.217241,
            'PLN' => 4.199997,
            'PYG' => 8652.319846,
            'QAR' => 3.944641,
            'RON' => 4.976787,
            'RSD' => 117.196107,
            'RUB' => 91.458371,
            'RWF' => 1557.060131,
            'SAR' => 4.059693,
            'SBD' => 9.107133,
            'SCR' => 15.527241,
            'SDG' => 650.439899,
            'SEK' => 10.962382,
            'SGD' => 1.445833,
            'SHP' => 0.850489,
            'SLE' => 24.686343,
            'SLL' => 22694.515192,
            'SOS' => 618.416055,
            'SRD' => 39.337552,
            'STD' => 22400.659061,
            'SVC' => 9.469259,
            'SYP' => 14071.375847,
            'SZL' => 19.665542,
            'THB' => 36.732116,
            'TJS' => 11.822462,
            'TMT' => 3.798743,
            'TND' => 3.356015,
            'TOP' => 2.534768,
            'TRY' => 40.883779,
            'TTD' => 7.353012,
            'TWD' => 35.729843,
            'TZS' => 2867.997351,
            'UAH' => 44.944723,
            'UGX' => 3967.215615,
            'USD' => 1.082263,
            'UYU' => 45.72549,
            'UZS' => 14003.867522,
            'VES' => 73.347616,
            'VND' => 27711.344166,
            'VUV' => 132.549828,
            'WST' => 3.038433,
            'XAF' => 654.175682,
            'XAG' => 0.032884,
            'XAU' => 0.000359,
            'XCD' => 2.92487,
            'XDR' => 0.813558,
            'XOF' => 654.16664,
            'XPF' => 119.331742,
            'YER' => 266.339189,
            'ZAR' => 19.705585,
            'ZMK' => 9741.67208,
            'ZMW' => 31.251901,
            'ZWL' => 348.488245,
        ];
    }
}
