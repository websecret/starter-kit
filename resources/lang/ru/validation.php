<?php

return [
	"accepted" => "Вы должны согласиться с :attribute.",
	"active_url" => "Поле :attribute должно быть полным URL.",
	"after" => "Поле :attribute должно быть датой после :date.",
	"alpha" => "Поле :attribute может содержать только буквы.",
	"alpha_dash" => "Поле :attribute может содержать только буквы, цифры и тире.",
	"alpha_num" => "Поле :attribute может содержать только буквы и цифры.",
	"before" => "Поле :attribute должно быть датой перед :date.",
	"between" => [
		"numeric" => "Поле :attribute должно быть между :min и :max.",
		"file" => "Поле :attribute должно быть от :min до :max Килобайт.",
		"string" => "Поле :attribute должно быть от :min до :max символов.",
	],
	"confirmed" => "Пароль не совпадает с подтверждением",
	"different" => "Поля :attribute и :other должны различаться.",
	"digits" => "Поле :attribute должно содержать :digits цифр.",
	"digits_between" => "Поле :attribute должно содержать от :min до :max цифр.",
	"email" => "Поле :attribute имеет неверный формат",
	"exists" => "Выбранное значение для :attribute не существует.",
	"image" => "Поле :attribute должно быть картинкой.",
	"in" => "Выбранное значение для :attribute не верно.",
	"integer" => "Поле :attribute должно быть целым числом.",
	"ip" => "Поле :attribute должно быть полным IP-адресом.",
	"match" => "Поле :attribute имеет неверный формат.",
	"max" => [
		"numeric" => "Поле :attribute должно быть меньше :max.",
		"file" => "Поле :attribute должно быть меньше :max Килобайт.",
		"string" => "Поле :attribute должно быть короче :max символов.",
	],
	"mimes" => "Поле :attribute должно быть файлом одного из типов: :values.",
	"min" => [
		"numeric" => "Поле :attribute должно быть не менее :min.",
		"file" => "Поле :attribute должно быть не менее :min Килобайт.",
		"string" => "Поле :attribute должно быть не короче :min символов.",
	],
	"not_in" => "Выбранное значение для :attribute не верно.",
	"numeric" => "Поле :attribute должно быть числом.",
	"regex" => "Поле :attribute имеет неверный формат.",
	"required" => 'Укажите :attribute',
	'required_with' => 'Укажите :attribute',
	"same" => "Значение :attribute должно совпадать со значенеим :other.",
	"size" => [
		"numeric" => "Поле :attribute должно быть :size.",
		"file" => "Поле :attribute должно быть :size Килобайт.",
		"string" => "Поле :attribute должно быть длиной :size символов.",
	],
	"unique" => "Такое значение поля :attribute уже существует.",
	"url" => "Поле :attribute имеет неверный формат.",

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

	'attributes' => [
		'title' => 'Заголовок',
		'slug' => 'Ссылка',
		'email' => 'Email',
		'password' => 'Пароль',
	],
];