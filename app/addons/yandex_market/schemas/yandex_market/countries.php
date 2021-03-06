<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

//List of available countries according to http://partner.market.yandex.ru/pages/help/Countries.pdf
$schema = array(
    'Украина'                           => 'UA',
    'Беларусь'                          => 'BY',
    'Молдова'                           => 'MD',
    'Казахстан'                         => 'KZ',
    'Узбекистан'                        => 'UZ',
    'Киргизия'                          => 'KG',
    'Таджикистан'                       => 'TJ',
    'Туркмения'                         => 'TM',
    'Азербайджан'                       => 'AZ',
    'Армения'                           => 'AM',
    'Грузия'                            => 'GE',
    'Россия'                            => 'RU',
    'Австрия'                           => 'AT',
    'Албания'                           => 'AL',
    'Андорра'                           => 'AD',
    'Бельгия'                           => 'BE',
    'Болгария'                          => 'BG',
    'Босния и Герцеговина'              => 'BA',
    'Ватикан'                           => 'VA',
    'Великобритания'                    => 'GB',
    'Венгрия'                           => 'HU',
    'Германия'                          => 'DE',
    'Гибралтар'                         => 'GI',
    'Греция'                            => 'GR',
    'Дания'                             => 'DK',
    'Ирландия'                          => 'IE',
    'Исландия'                          => 'IS',
    'Испания'                           => 'ES',
    'Италия'                            => 'IT',
    'Кипр'                              => 'CY',
    'Лихтенштейн'                       => 'LI',
    'Люксембург'                        => 'LU',
    'Македония'                         => 'MK',
    'Мальта'                            => 'MT',
    'Монако'                            => 'MC',
    'Нидерланды'                        => 'NL',
    'Норвегия'                          => 'NO',
    'Польша'                            => 'PL',
    'Португалия'                        => 'PT',
    'Румыния'                           => 'RO',
    'Сан-Марино'                        => 'SM',
    'Сербия'                            => 'CS',
    'Словакия'                          => 'SK',
    'Словения'                          => 'SI',
    'Литва'                             => 'LT',
    'Эстония'                           => 'EE',
    'Латвия'                            => 'LV',
    'Финляндия'                         => 'FI',
    'Франция'                           => 'FR',
    'Хорватия'                          => 'HR',
    'Черногория'                        => 'ME',
    'Чехия'                             => 'CZ',
    'Швейцария'                         => 'CH',
    'Швеция'                            => 'SE',
    'Афганистан'                        => 'AF',
    'Бангладеш'                         => 'BD',
    'Израиль'                           => 'IL',
    'Объединенные Арабские Эмираты'     => 'AE',
    'Турция'                            => 'TR',
    'Египет'                            => 'EG',
    'Бахрейн'                           => 'BH',
    'Иордания'                          => 'JO',
    'Ирак'                              => 'IQ',
    'Иран'                              => 'IR',
    'Кувейт'                            => 'KW',
    'Ливан'                             => 'LB',
    'Саудовская Аравия'                 => 'SA',
    'Сирия'                             => 'SY',
    'Катар'                             => 'QA',
    'Йемен'                             => 'YE',
    'Оман'                              => 'OM',
    'Бруней'                            => 'BN',
    'Вьетнам'                           => 'VN',
    'Индия'                             => 'IN',
    'Индонезия'                         => 'ID',
    'Камбоджа'                          => 'KH',
    'Китай'                             => 'CN',
    'Лаос'                              => 'LA',
    'Малайзия'                          => 'MY',
    'Мальдивы'                          => 'MV',
    'Монголия'                          => 'MN',
    'Мьянма'                            => 'MM',
    'Непал'                             => 'NP',
    'Пакистан'                          => 'PK',
    'Северная Корея'                    => 'KP',
    'Сингапур (страна)'                 => 'SG',
    'Таиланд'                           => 'TH',
    'Филиппины'                         => 'PH',
    'Шри-Ланка'                         => 'LK',
    'Южная Корея'                       => 'KR',
    'Япония'                            => 'JP',
    'Бутан'                             => 'BT',
    'Восточный Тимор'                   => 'TL',
    'Алжир'                             => 'DZ',
    'Ангола'                            => 'AO',
    'Бенин'                             => 'BJ',
    'Ботсвана'                          => 'BW',
    'Буркина-Фасо'                      => 'BF',
    'Бурунди'                           => 'BI',
    'Габон'                             => 'GA',
    'Гамбия'                            => 'GM',
    'Гана'                              => 'GH',
    'Гвинея'                            => 'GN',
    'Гвинея-Бисау'                      => 'GW',
    'Демократическая Республика Конго'  => 'CD',
    'Замбия'                            => 'ZM',
    'Западная Сахара'                   => 'EH',
    'Зимбабве'                          => 'ZW',
    'Кабо-Верде'                        => 'CV',
    'Камерун'                           => 'CM',
    'Кения'                             => 'KE',
    'Коморские острова'                 => 'KM',
    'Республика Конго'                  => 'CG',
    'Кот-д\'Ивуар'                      => 'CI',
    'Лесото'                            => 'LS',
    'Либерия'                           => 'LR',
    'Ливия'                             => 'LY',
    'Маврикий'                          => 'MU',
    'Мавритания'                        => 'MR',
    'Мадагаскар'                        => 'MG',
    'Малави'                            => 'MW',
    'Мали'                              => 'ML',
    'Марокко'                           => 'MA',
    'Мозамбик'                          => 'MZ',
    'Намибия'                           => 'NA',
    'Нигер'                             => 'NE',
    'Нигерия'                           => 'NG',
    'Сан-Томе и Принсипи'               => 'ST',
    'Свазиленд'                         => 'SZ',
    'Сейшельские острова'               => 'SC',
    'Сомали'                            => 'SO',
    'Судан'                             => 'SD',
    'Сьерра-Леоне'                      => 'SL',
    'Танзания'                          => 'TZ',
    'Того'                              => 'TG',
    'Тунис'                             => 'TN',
    'Уганда'                            => 'UG',
    'Центрально-Африканская Республика' => 'CF',
    'Чад'                               => 'TD',
    'Экваториальная Гвинея'             => 'GQ',
    'Эритрея'                           => 'ER',
    'Эфиопия'                           => 'ET',
    'ЮАР'                               => 'ZA',
    'Руанда'                            => 'RW',
    'Сенегал'                           => 'SN',
    'Джибути'                           => 'DJ',
    'Майотта'                           => 'YT',
    'Реюньон'                           => 'RE',
    'США'                               => 'US',
    'Канада'                            => 'CA',
    'Мексика'                           => 'MX',
    'Бермудские Острова'                => 'BM',
    'Гренландия'                        => 'GL',
    'Антигуа и Барбуда'                 => 'AG',
    'Аргентина'                         => 'AR',
    'Багамские острова'                 => 'BS',
    'Барбадос'                          => 'BB',
    'Боливия'                           => 'BO',
    'Бразилия'                          => 'BR',
    'Венесуэла'                         => 'VE',
    'Гаити'                             => 'HT',
    'Гватемала'                         => 'GT',
    'Гондурас'                          => 'HN',
    'Гренада'                           => 'GD',
    'Доминика'                          => 'DM',
    'Доминиканская Республика'          => 'DO',
    'Колумбия'                          => 'CO',
    'Коста-Рика'                        => 'CR',
    'Куба'                              => 'CU',
    'Никарагуа'                         => 'NI',
    'Панама'                            => 'PA',
    'Парагвай'                          => 'PY',
    'Перу'                              => 'PE',
    'Сент-Винсент и Гренадины'          => 'VC',
    'Сент-Китс и Невис'                 => 'KN',
    'Сент-Люсия'                        => 'LC',
    'Суринам'                           => 'SR',
    'Тринидад и Тобаго'                 => 'TT',
    'Уругвай'                           => 'UY',
    'Чили'                              => 'CL',
    'Эквадор'                           => 'EC',
    'Ямайка'                            => 'JM',
    'Французская Гвиана'                => 'GF',
    'Гайана'                            => 'GY',
    'Ангилья'                           => 'AI',
    'Аруба'                             => 'AW',
    'Нидерландские Антильские острова'  => 'NL',
    'Белиз'                             => 'BZ',
    'Американские Виргинские острова'   => 'VI',
    'Британские Виргинские острова'     => 'VG',
    'Гваделупа'                         => 'GP',
    'Каймановы острова'                 => 'KY',
    'Тёркс и Кайкос'                    => 'TC',
    'Новая Зеландия'                    => 'NZ',
    'Австралия'                         => 'AU',
    'Фиджи'                             => 'FJ',
    'Папуа - Новая Гвинея'              => 'PG',
    'Самоа'                             => 'WS',
    'Французская Полинезия'             => 'PF',
    'Вануату'                           => 'VU',
    'Кирибати'                          => 'KI',
    'Острова Кука'                      => 'CK',
    'Маршалловы острова'                => 'MH',
    'Федеративные Штаты Микронезии'     => 'FM',
    'Науру'                             => 'NR',
    'Новая Каледония'                   => 'NC',
    'Палау'                             => 'PW',
    'Тонга'                             => 'TO',
    'Тувалу'                            => 'TV',
    'Южная Корея'                       => 'KR',
);

return $schema;
