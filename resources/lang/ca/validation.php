<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El camp :attribute ha de ser acceptat.',
    'active_url'           => 'El camp :attribute no és un URL vàlid.',
    'after'                => 'El camp :attribute ha de ser una data posterior a :date.',
    'after_or_equal'       => 'El camp :attribute ha de ser una data posterior o igual a :date.',
    'alpha'                => 'El camp :attribute només pot contenir lletres.',
    'alpha_dash'           => 'El camp :attribute només pot contenir lletres, nombres, guions i guions baixos.',
    'alpha_num'            => 'El camp :attribute només pot contenir lletres i números.',
    'array'                => 'El camp :attribute ha de ser una matriu.',
    'before'               => 'El camp :attribute ha de ser una data anterior a :date.',
    'before_or_equal'      => 'El camp :attribute ha de ser una data anterior o igual a :date.',
    'between'              => [
        'numeric' => 'El camp :attribute ha de ser un valor entre :min i :max.',
        'file'    => 'L\'arxiu :attribute ha de pesar entre :min i :max kilobytes.',
        'string'  => 'El camp :attribute ha de contenir entre :min i :max caràcters.',
        'array'   => 'El camp :attribute ha de contenir entre :min i :max elements.',
    ],
    'boolean'              => 'El camp :attribute ha de ser cert o fals.',
    'confirmed'            => 'El camp confirmació de :attribute no coincideix.',
    'date'                 => 'El camp :attribute no correspon amb una data vàlida.',
    'date_equals'          => 'El camp :attribute ha de ser una data igual a :date.',
    'date_format'          => 'El camp :attribute no correspon amb el format de data :format.',
    'different'            => 'Els camps :attribute i :other han de ser diferents.',
    'digits'               => 'El camp :attribute ha de ser un número de :digits dígits.',
    'digits_between'       => 'El camp :attribute ha de contenir entre :min i :max dígits.',
    'dimensions'           => 'El camp :attribute té dimensions d\'imatge invàlides.',
    'distinct'             => 'El camp :attribute té un valor duplicat.',
    'email'                => 'El camp :attribute ha de ser una adreça de correu vàlida.',
    'phone'                => 'El camp :attribute ha de ser un número de telèfon vàlid.',
    'ends_with'            => 'El camp :attribute ha de finalitzar amb algun dels següents valors: :values',
    'exists'               => 'El camp :attribute seleccionat no existeix.',
    'file'                 => 'El camp :attribute ha de ser un arxiu.',
    'filled'               => 'El camp :attribute ha de tenir un valor.',
    'gt'                   => [
        'numeric' => 'El camp :attribute ha de ser major a :value.',
        'file'    => 'L\'arxiu :attribute ha de pesar més de :value kilobytes.',
        'string'  => 'El camp :attribute ha de contenir més de :value caràcters.',
        'array'   => 'El camp :attribute ha de contenir més de :value elements.',
    ],
    'gte'                  => [
        'numeric' => 'El camp :attribute ha de ser major a :value.',
        'file'    => 'L\'arxiu :attribute ha de pesar més de :value kilobytes.',
        'string'  => 'El camp :attribute ha de contenir més de :value caràcters.',
        'array'   => 'El camp :attribute ha de contenir més de :value elements.',
    ],
    'image'                => 'El camp :attribute ha de ser una imatge.',
    'in'                   => 'El camp :attribute no és vàlid.',
    'in_array'             => 'El camp :attribute no existeix en :other.',
    'integer'              => 'El camp :attribute ha de ser un nombre enter.',
    'ip'                   => 'El camp :attribute ha de ser una adreça IP vàlida.',
    'ipv4'                 => 'El camp :attribute ha de ser una adreça IPv4 vàlida.',
    'ipv6'                 => 'El camp :attribute ha de ser una adreça IPv6 vàlida.',
    'json'                 => 'El camp :attribute ha de ser una cadena de text JSON vàlida.',
    'lt'                   => [
        'numeric' => 'El camp :attribute ha de ser menor a :value.',
        'file'    => 'L\'arxiu :attribute ha de pesar menys de :value kilobytes.',
        'string'  => 'El camp :attribute ha de contenir menys de :value caràcters.',
        'array'   => 'El camp :attribute ha de contenir menys de :value elements.',
    ],
    'lte'                  => [
        'numeric' => 'El camp :attribute ha de ser menor a :value.',
        'file'    => 'L\'arxiu :attribute ha de pesar menys de :value kilobytes.',
        'string'  => 'El camp :attribute ha de contenir menys de :value caràcters.',
        'array'   => 'El camp :attribute ha de contenir menys de :value elements.',
    ],
    'max'                  => [
        'numeric' => 'El camp :attribute no ha de ser major a :max.',
        'file'    => 'L\'arxiu :attribute no ha de pesar més de :max kilobytes.',
        'string'  => 'El camp :attribute no ha de contenir més de :max caràcters.',
        'array'   => 'El camp :attribute no ha de contenir més de :max elements.',
    ],
    'mimes'                => 'El camp :attribute ha de ser un arxiu de tipus: :values.',
    'mimetypes'            => 'El camp :attribute ha de ser un arxiu de tipus: :values.',
    'min'                  => [
        'numeric' => 'El camp :attribute ha de ser al menys :min.',
        'file'    => 'L\'arxiu :attribute ha de pesar al menys :min kilobytes.',
        'string'  => 'El camp :attribute ha de contenir al menys :min caràcters.',
        'array'   => 'El camp :attribute ha de contenir al menys :min elements.',
    ],
    'not_in'               => 'El camp :attribute seleccionat no és vàlid.',
    'not_regex'            => 'El format de camp :attribute no és vàlid.',
	'numeric'              => 'El camp :attribute ha de ser un nombre.',
    'present'              => 'El camp :attribute ha d\'estar present.',
    'regex'                => 'El format de camp :attribute no és vàlid.',
    'required'             => 'El camp :attribute és obligatori.',
    'required_if'          => 'El camp :attribute és obligatori quan el camp: other és :value.',
    'required_unless'      => 'El camp :attribute és requerit llevat que: other es trobi en: values.',
    'required_with'        => 'El camp :attribute és obligatori quan: values és present.',
    'required_with_all'    => 'El camp :attribute és obligatori quan: values són presents.',
    'required_without'     => 'El camp :attribute és obligatori quan: values no està present.',
    'required_without_all' => 'El camp :attribute és obligatori quan cap dels camps: values són presents.',
    'same'                 => 'Els camps :attribute i: other han de coincidir.',
    'size'                 => [
        'numeric' => 'El camp :attribute ha de ser :size.',
        'file'    => 'L\arxiu :attribute ha de pesar :size kilobytes.',
        'string'  => 'El camp :attribute ha de contenir :size caràcters.',
        'array'   => 'El camp :attribute ha de contenir :size elements.',
    ],
    'starts_with'          => 'El camp :attribute ha de començar amb un dels següents valors: :values',
    'string'               => 'El camp :attribute ha de ser una cadena de caràcters.',
    'timezone'             => 'El camp :attribute ha de ser una zona horària vàlida.',
    'unique'               => 'El valor de camp :attribute ja està en ús.',
    'uploaded'             => 'El camp :attribute no es va poder pujar.',
    'url'                  => 'El format de camp :attribute no és vàlid.',
    'uuid'                 => 'El camp :attribute ha de ser un UUID vàlid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'nom',
        'email'=> 'correu electrònic',
        'avatar' => 'imatge d\'usuari',
        'phone' => 'telèfon',
        'postalcode' => 'codi postal',
        'city' => 'ciutat',
    ],

];
