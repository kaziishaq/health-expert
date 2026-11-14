<?php
/**
 * Health Expert — site configuration.
 * Every contact detail lives here so the backend/admin can later replace
 * this array with values from the database without touching templates.
 */

declare(strict_types=1);

const SITE = [
    'name'        => 'Health Expert',
    'domain'      => 'healthexpertbd.com',
    'tagline'     => 'Trusted medical assistance from Bangladesh',
    'description' => 'Health Expert helps patients from Bangladesh get treated abroad — hospital and doctor selection, video consultations, medical visas, travel, accommodation and a Bangla-speaking coordinator from first message to follow-up.',
    'since'       => 2022,

    'whatsapp'      => '8801998005972',          // digits only, used for wa.me links
    'whatsapp_label'=> '+880 1998-005972',
    'hotline'       => '+880 9647-005979',
    'hotline_tel'   => '+8809647005979',
    'email'         => 'care@healthexpertbd.com',
    'hours'         => 'Sun – Thu, 10 AM – 6 PM',

    'offices' => [
        [
            'label'   => 'Bangladesh office',
            'city'    => 'Dhaka',
            'address' => 'Flat 1A, Plot #9, Road #35, Gulshan-2, Dhaka',
            'map'     => 'https://maps.google.com/?q=Road+35+Gulshan-2+Dhaka',
        ],
        [
            'label'   => 'Malaysia office',
            'city'    => 'Kuala Lumpur',
            'address' => 'Level 35, Mercu Aspire, Jalan Bangsar, 59200 Kuala Lumpur',
            'map'     => 'https://maps.google.com/?q=Mercu+Aspire+Jalan+Bangsar+Kuala+Lumpur',
        ],
    ],

    'stats' => [
        ['value' => 1200, 'suffix' => '+', 'label' => 'patients supported since 2022'],
        ['value' => 75,   'suffix' => '+', 'label' => 'partner hospitals abroad'],
        ['value' => 1000, 'suffix' => '+', 'label' => 'doctors we can reach directly'],
        ['value' => 6,    'suffix' => '',  'label' => 'countries, one coordinator each'],
    ],
];

/** Escape for HTML output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** WhatsApp deep link with an optional pre-filled message. */
function wa(string $message = ''): string
{
    $url = 'https://wa.me/' . SITE['whatsapp'];
    return $message !== '' ? $url . '?text=' . rawurlencode($message) : $url;
}

/**
 * Internal URL builder. Keeps links relative so the site works from any folder.
 * When the backend adds pretty URLs, only this function changes.
 */
function url(string $page = '', array $query = []): string
{
    $path = $page === '' || $page === 'home' ? './' : $page . '.php';
    return $query ? $path . '?' . http_build_query($query) : $path;
}

function asset(string $path): string
{
    $file = __DIR__ . '/../assets/' . $path;
    $v = is_file($file) ? filemtime($file) : 1;
    return 'assets/' . $path . '?v=' . $v;
}

/** Initials for doctor monograms, e.g. "Dr. Naresh Trehan" -> "NT". */
function initials(string $name): string
{
    $name = preg_replace('/^(dr\.?|prof\.?)\s+/i', '', trim($name));
    $parts = preg_split('/\s+/', (string) $name) ?: [];
    $first = $parts[0] ?? '';
    $last  = count($parts) > 1 ? end($parts) : '';
    return strtoupper(mb_substr($first, 0, 1) . mb_substr((string) $last, 0, 1));
}
