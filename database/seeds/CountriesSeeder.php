<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = [];
        $arr_country = [
            'Не указана',
            'Абхазия', 'Австралия', 'Австрия', 'Азербайджан', 'Албания', 'Алжир', 'Ангола', 'Андорра',
            'Антигуа и Барбуда', 'Аргентина', 'Армения', 'Афганистан', 'Багамские Острова', 'Бангладеш', 'Барбадос',
            'Бахрейн', 'Белиз', 'Белоруссия', 'Бельгия', 'Бенин', 'Болгария', 'Боливия', 'Босния и Герцеговина',
            'Ботсвана', 'Бразилия', 'Бруней', 'Буркина-Фасо', 'Бурунди', 'Бутан', 'Вануату', 'Ватикан',
            'Великобритания', 'Венгрия', 'Венесуэла', 'Восточный Тимор', 'Вьетнам', 'Габон', 'Гаити', 'Гайана',
            'Гамбия', 'Гана', 'Гватемала', 'Гвинея', 'Гвинея-Бисау', 'Германия', 'Гондурас', 'Государство Палестина',
            'Гренада', 'Греция', 'Грузия', 'Дания', 'Джибути', 'Доминика', 'Доминиканская Республика', 'ДР Конго',
            'Египет', 'Замбия', 'Зимбабве', 'Израиль', 'Индия', 'Индонезия', 'Иордания', 'Ирак', 'Иран', 'Ирландия',
            'Исландия', 'Испания', 'Италия', 'Йемен', 'Кабо-Верде', 'Казахстан', 'Камбоджа', 'Камерун', 'Канада',
            'Катар', 'Кения', 'Кипр', 'Киргизия', 'Кирибати', 'Китай', 'КНДР', 'Колумбия', 'Коморские Острова',
            'Коста-Рика', 'Кот-д\'Ивуар', 'Куба', 'Кувейт', 'Лаос', 'Латвия', 'Лесото', 'Либерия', 'Ливан', 'Ливия',
            'Литва', 'Лихтенштейн', 'Люксембург', 'Маврикий', 'Мавритания', 'Мадагаскар', 'Малави', 'Малайзия', 'Мали',
            'Мальдивские Острова', 'Мальта', 'Марокко', 'Маршалловы Острова', 'Мексика', 'Мозамбик', 'Молдавия',
            'Монако', 'Монголия', 'Мьянма', 'Намибия', 'Науру', 'Непал', 'Нигер', 'Нигерия', 'Нидерланды', 'Никарагуа',
            'Новая Зеландия', 'Норвегия', 'ОАЭ', 'Оман', 'Пакистан', 'Палау', 'Панама', 'Папуа - Новая Гвинея',
            'Парагвай', 'Перу', 'Польша', 'Португалия', 'Республика Конго', 'Республика Корея', 'Россия', 'Руанда',
            'Румыния', 'Сальвадор', 'Самоа', 'Сан-Марино', 'Сан-Томе и Принсипи', 'Саудовская Аравия',
            'Северная Македония', 'Сейшельские Острова', 'Сенегал', 'Сент-Винсент и Гренадины', 'Сент-Китс и Невис',
            'Сент-Люсия', 'Сербия', 'Сингапур', 'Сирия', 'Словакия', 'Словения', 'Соломоновы Острова', 'Сомали',
            'Судан', 'Суринам', 'США', 'Сьерра-Леоне', 'Таджикистан', 'Таиланд', 'Танзания', 'Того', 'Тонга',
            'Тринидад и Тобаго', 'Тувалу', 'Тунис', 'Туркмения', 'Турция', 'Уганда', 'Узбекистан', 'Украина', 'Уругвай',
            'Федеративные Штаты Микронезии', 'Фиджи', 'Филиппины', 'Финляндия', 'Франция', 'Хорватия', 'ЦАР', 'Чад',
            'Черногория', 'Чехия', 'Чили', 'Швейцария', 'Швеция', 'Шри-Ланка', 'Эквадор', 'Экваториальная Гвинея',
            'Эритрея', 'Эсватини', 'Эстония', 'Эфиопия', 'ЮАР', 'Южная Осетия', 'Южный Судан', 'Ямайка', 'Япония',
        ];

        foreach ($arr_country as $key => $value) {
            $country[$key] = [
                'title' => $value,
            ];
        }

        DB::table('countries')->insert($country);
    }
}
