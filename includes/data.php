<?php
/**
 * Content data. Shaped like database rows so the backend can swap these
 * arrays for queries (countries, hospitals, doctors, services, faqs).
 */

declare(strict_types=1);

const COUNTRIES = [
    'india' => [
        'name' => 'India', 'code' => 'IN', 'city' => 'New Delhi', 'lat' => 28.61, 'lon' => 77.21,
        'flight' => '≈ 2 h 30 m from Dhaka',
        'headline' => 'The shortest flight and the widest choice of specialists.',
        'summary' => 'The shortest flight, the widest choice of specialists and the option to be seen within days. Strongest for cardiac surgery, cancer care, liver and kidney transplant, and orthopaedics.',
        'best_for' => ['Cardiac surgery', 'Oncology', 'Liver & kidney transplant', 'Orthopaedics', 'Neurosurgery'],
        'why' => [
            ['Closest to home', 'The shortest flight from Dhaka, so family can travel back and forth easily.'],
            ['Seen within days', 'Appointments with senior consultants can usually be booked within days, not months.'],
            ['Widest choice', 'More specialists and sub-specialities than any other destination we work with.'],
            ['Visa handled for you', 'We arrange the Indian medical visa from start to finish, including the invitation letter.'],
        ],
        'visa' => true,
    ],
    'thailand' => [
        'name' => 'Thailand', 'code' => 'TH', 'city' => 'Bangkok', 'lat' => 13.76, 'lon' => 100.50,
        'flight' => '≈ 2 h 30 m from Dhaka',
        'headline' => 'Hospitals built around international patients.',
        'summary' => 'Hospitals built around international patients, with English-speaking staff and short waiting times. Popular for cardiology, paediatrics, fertility and complex diagnostics.',
        'best_for' => ['Cardiology', 'Paediatrics', 'Fertility', 'Health screening', 'Complex diagnostics'],
        'why' => [
            ['Built for overseas patients', 'International patient centres, English-speaking staff and short waiting times.'],
            ['Meet them in Dhaka first', 'Specialists from our Thai partner hospitals also run clinics in Dhaka through us.'],
            ['Diagnostics in one visit', 'Complex work-ups and full health screenings completed quickly.'],
            ['Visa support', 'Invitation letter, document checklist and appointment booking handled by us.'],
        ],
        'visa' => true,
    ],
    'malaysia' => [
        'name' => 'Malaysia', 'code' => 'MY', 'city' => 'Kuala Lumpur', 'lat' => 3.14, 'lon' => 101.69,
        'flight' => '≈ 3 h 40 m from Dhaka',
        'headline' => 'The best balance of cost and quality.',
        'summary' => 'Often the best balance of cost and quality, and an easy place for a family to stay for a few weeks. Strong in paediatric surgery, cardiology and cancer treatment.',
        'best_for' => ['Paediatric surgery', 'Cardiology', 'Oncology', 'Breast surgery', 'Fertility & IVF'],
        'why' => [
            ['JCI & MSQH-accredited hospitals', 'Including Gleneagles, Prince Court, Sunway, Pantai and the KPJ network.'],
            ['English widely spoken', 'No language barrier with doctors or hospital staff.'],
            ['Direct flights from Dhaka', 'And a straightforward medical visa for the patient and one companion.'],
            ['Halal-friendly and multicultural', 'Familiar and comfortable for Bangladeshi families staying several weeks.'],
        ],
        'visa' => true,
    ],
    'singapore' => [
        'name' => 'Singapore', 'code' => 'SG', 'city' => 'Singapore', 'lat' => 1.35, 'lon' => 103.82,
        'flight' => '≈ 4 h from Dhaka',
        'headline' => 'Where we send the hardest cases.',
        'summary' => 'Where we send the hardest cases — rare cancers, second opinions after a failed treatment, neurosurgery. Costs more, so we will say plainly when it is worth it and when it is not.',
        'best_for' => ['Complex oncology', 'Neurosurgery', 'Second opinions', 'Rare conditions'],
        'why' => [
            ['For complex cases', 'Rare cancers, failed earlier treatment and difficult neurosurgery.'],
            ['Second opinions', 'A fresh, specialist review when you are not sure about the plan you were given.'],
            ['Honest about cost', 'Singapore costs more. We tell you plainly whether your case needs it.'],
            ['Visa support', 'Document checklist and appointment booking handled by us.'],
        ],
        'visa' => true,
    ],
    'turkiye' => [
        'name' => 'Türkiye', 'code' => 'TR', 'city' => 'Istanbul', 'lat' => 41.01, 'lon' => 28.98,
        'flight' => 'Connecting flight from Dhaka',
        'headline' => 'Transparent packages for transplants and surgery.',
        'summary' => 'A growing option for transplants, eye surgery, hair restoration and reconstructive work, with package pricing that is easy to compare before you commit.',
        'best_for' => ['Transplant', 'Eye surgery', 'Hair restoration', 'Reconstructive surgery'],
        'why' => [
            ['Package pricing', 'All-inclusive packages that are easy to compare before you commit.'],
            ['Transplant programmes', 'A growing destination for organ transplants.'],
            ['Eye & aesthetic surgery', 'Eye surgery, hair restoration and reconstructive work.'],
            ['Visa support', 'Document checklist and appointment booking handled by us.'],
        ],
        'visa' => true,
    ],
    'china' => [
        'name' => 'China', 'code' => 'CN', 'city' => 'Beijing', 'lat' => 39.90, 'lon' => 116.40,
        'flight' => 'Flights via Guangzhou or Kunming',
        'headline' => 'Large specialist hospitals for selected cases.',
        // DRAFT copy — the live site repeated India's text here. Confirm with the team.
        'summary' => 'Large, high-volume specialist hospitals with advanced cancer and transplant programmes. A good fit for selected cases — ask us whether it suits yours.',
        'best_for' => ['Oncology', 'Transplant', 'Advanced diagnostics'],
        'why' => [
            ['High-volume centres', 'Large specialist hospitals that see a high number of complex cases.'],
            ['Advanced technology', 'Modern oncology and diagnostic equipment.'],
            ['Case-by-case advice', 'We will tell you honestly whether China is the right choice for your diagnosis.'],
            ['Travel arranged', 'Flights, accommodation and interpreter support coordinated by us.'],
        ],
        'visa' => false,
    ],
];

const HOSPITALS = [
    ['name' => 'Medanta – The Medicity', 'city' => 'Gurugram', 'country' => 'india', 'tags' => ['Cardiac surgery', 'Oncology', 'Transplant']],
    ['name' => 'Apollo Cancer Centre', 'city' => 'Chennai', 'country' => 'india', 'tags' => ['Oncology', 'Radiation therapy']],
    ['name' => 'Max Healthcare', 'city' => 'New Delhi', 'country' => 'india', 'tags' => ['Neurosurgery', 'Liver transplant', 'Oncology']],
    ['name' => 'Fortis Healthcare', 'city' => 'New Delhi', 'country' => 'india', 'tags' => ['Multispecialty']],
    ['name' => 'Medpark Hospital', 'city' => 'Bangkok', 'country' => 'thailand', 'tags' => ['Cardiology', 'Paediatrics', 'Diagnostics']],
    ['name' => 'Samitivej Hospital', 'city' => 'Bangkok', 'country' => 'thailand', 'tags' => ['Paediatrics', 'Fertility', 'Health screening']],
    ['name' => 'Pantai Hospital', 'city' => 'Kuala Lumpur', 'country' => 'malaysia', 'tags' => ['Paediatric surgery', 'Breast surgery', 'Cardiology']],
    ['name' => 'Gleneagles Hospital', 'city' => 'Kuala Lumpur', 'country' => 'malaysia', 'tags' => ['Breast & endocrine', 'Oncology']],
    ['name' => 'Prince Court Medical Centre', 'city' => 'Kuala Lumpur', 'country' => 'malaysia', 'tags' => ['Oncoplastic surgery', 'Multispecialty']],
    ['name' => 'Sunway Medical Centre', 'city' => 'Selangor', 'country' => 'malaysia', 'tags' => ['Multispecialty']],
    ['name' => 'KPJ Healthcare network', 'city' => 'Malaysia-wide', 'country' => 'malaysia', 'tags' => ['Multispecialty']],
];

const DOCTORS = [
    ['name' => 'Dr. Naresh Trehan', 'specialty' => 'Cardiac Surgery', 'hospital' => 'Medanta – The Medicity', 'country' => 'india', 'years' => 40, 'featured' => true],
    ['name' => 'Dr. T. Raja', 'specialty' => 'Medical Oncology', 'hospital' => 'Apollo Cancer Centre', 'country' => 'india', 'years' => 30, 'featured' => true],
    ['name' => 'Dr. Shubhash Gupta', 'specialty' => 'Liver & Biliary Sciences', 'hospital' => 'Max Healthcare', 'country' => 'india', 'years' => 37, 'featured' => true],
    ['name' => 'Dr. Rajinder Kaur Saggu', 'specialty' => 'Surgical Oncology — Breast', 'hospital' => 'Max Healthcare', 'country' => 'india', 'years' => 24, 'featured' => true],
    ['name' => 'Dr. Arun Saroha', 'specialty' => 'Spine & Neurosurgery', 'hospital' => 'Max Super Speciality Hospital, Dwarka', 'country' => 'india', 'years' => null, 'featured' => false],
    ['name' => 'Dr. Gopal Sharma', 'specialty' => 'Medical Oncology', 'hospital' => 'Max Healthcare', 'country' => 'india', 'years' => null, 'featured' => false],
    ['name' => 'Dr. Kanika Batra Modi', 'specialty' => 'Gynaecologic Oncology', 'hospital' => 'Max Healthcare', 'country' => 'india', 'years' => null, 'featured' => false],
    ['name' => 'Dr. Chad Wanishsawad', 'specialty' => 'Cardiology & Vascular Disease', 'hospital' => 'Medpark Hospital', 'country' => 'thailand', 'years' => 48, 'featured' => true],
    ['name' => 'Dr. Daniel Mohanaprakash', 'specialty' => 'Paediatric Surgery', 'hospital' => 'Pantai Hospital', 'country' => 'malaysia', 'years' => null, 'featured' => true],
    ['name' => 'Dr. Suraya Binti Baharudin', 'specialty' => 'Breast & Endocrine Surgery', 'hospital' => 'Gleneagles Hospital', 'country' => 'malaysia', 'years' => null, 'featured' => false],
    ['name' => 'Dr. Melissa Tan Ley Hui', 'specialty' => 'Oncoplastic Breast Surgery', 'hospital' => 'Prince Court Medical Centre', 'country' => 'malaysia', 'years' => null, 'featured' => false],
    ['name' => 'Dr. Nur Aziah', 'specialty' => 'Breast & Endocrine Surgery', 'hospital' => 'Pantai Hospital', 'country' => 'malaysia', 'years' => null, 'featured' => false],
];

const SERVICES = [
    ['icon' => 'file',      'title' => 'Treatment assessment',     'text' => 'Your reports reviewed by the relevant department, with a written plan and a cost estimate you can compare against other quotes.', 'free' => true],
    ['icon' => 'video',     'title' => 'Video consultation',       'text' => 'A secure call with the specialist who would treat you, so you travel knowing the diagnosis and the plan.', 'free' => true],
    ['icon' => 'passport',  'title' => 'Medical visa assistance',  'text' => 'Invitation letters, document checklists and appointment booking for India, Thailand, Malaysia, Singapore and Türkiye.', 'free' => false],
    ['icon' => 'car',       'title' => 'Airport pickup & drop',    'text' => 'Someone meets you on arrival and takes you to the hospital or hotel. The same on the way back.', 'free' => false],
    ['icon' => 'plane',     'title' => 'Flights & scheduling',     'text' => 'Tickets booked around the appointment date, with the flexibility to move them if the doctor changes the schedule.', 'free' => false],
    ['icon' => 'bed',       'title' => 'Accommodation',            'text' => 'Rooms and serviced apartments walking distance from the hospital, chosen to fit your budget and length of stay.', 'free' => false],
    ['icon' => 'languages', 'title' => 'Interpreter support',      'text' => 'A Bangla-speaking interpreter with you in consultations, so nothing important gets lost.', 'free' => false],
    ['icon' => 'sim',       'title' => 'Global eSIM',              'text' => 'A working number the moment you land, so family at home can reach you without roaming bills.', 'free' => false],
    ['icon' => 'pulse',     'title' => 'Air ambulance',            'text' => 'Medically supervised transfer for emergencies, arranged at short notice when a patient cannot fly commercially.', 'free' => false],
];

const STEPS = [
    ['title' => 'Send your reports', 'text' => 'Share your reports on WhatsApp or through the form. One coordinator is assigned to your case from this first message.', 'icon' => 'upload'],
    ['title' => 'Get a written plan & estimate', 'text' => 'The relevant department reviews your case and sends a written treatment plan with a cost estimate, exactly as the hospital quoted it.', 'icon' => 'file'],
    ['title' => 'Talk to the doctor first', 'text' => 'A twenty-minute video consultation with the specialist who would treat you. Most of the big questions get settled here.', 'icon' => 'video'],
    ['title' => 'Visa, flights & stay', 'text' => 'Invitation letter, visa documents, tickets and accommodation near the hospital — arranged around your appointment.', 'icon' => 'plane'],
    ['title' => 'Treatment, never alone', 'text' => 'Airport pickup, a Bangla-speaking interpreter in consultations, and our team on WhatsApp day and night.', 'icon' => 'shield'],
    ['title' => 'Home & follow-up', 'text' => 'Your coordinator stays with the case after you are home, for follow-up consultations and reports.', 'icon' => 'home'],
];

const PROMISES = [
    ['One coordinator, start to finish', 'The same person stays with your case from the first message to the follow-up after you get home.'],
    ['No margin on your treatment', 'Hospital prices come to you the way the hospital quoted them. We do not add a margin on your treatment.'],
    ['Honest about Dhaka', 'If the treatment is available in Dhaka at a similar standard, we say so.'],
    ['Awake when you need us', 'Our team is on WhatsApp while you are in hospital abroad — including at night, Bangladesh time.'],
];

const TREATMENTS = [
    ['icon' => 'heart',   'title' => 'Cardiology & Heart Surgery', 'text' => 'Bypass, angioplasty and valve repair with experienced cardiac teams.'],
    ['icon' => 'target',  'title' => 'Cancer Treatment', 'text' => 'Chemotherapy, radiotherapy and oncology surgery at dedicated cancer centres with multidisciplinary teams.'],
    ['icon' => 'brain',   'title' => 'Neuro & Spine Surgery', 'text' => 'Brain and spine procedures by senior neurosurgeons, with second opinions on complex cases.'],
    ['icon' => 'link',    'title' => 'Liver & Kidney Transplant', 'text' => 'Transplant programmes with full donor evaluation and long-term follow-up.'],
    ['icon' => 'bone',    'title' => 'Orthopaedic Surgery', 'text' => 'Joint replacement and spine surgery using minimally invasive techniques and faster recovery protocols.'],
    ['icon' => 'sparkle', 'title' => 'Fertility & IVF', 'text' => 'Advanced reproductive treatment with counselling for couples at every step.'],
    ['icon' => 'baby',    'title' => 'Paediatric Surgery', 'text' => 'Child-focused surgical teams and family-friendly hospital stays.'],
    ['icon' => 'scan',    'title' => 'Full Body Health Screening', 'text' => 'Comprehensive executive check-ups completed in a single day, with same-day consultation.'],
];

const FAQS = [
    ['Is the first consultation really free?', 'Yes. Reviewing your reports, the written treatment plan, the cost estimate and the video consultation with the specialist are free, whether or not you book treatment through us.'],
    ['Do you add a commission to the hospital bill?', 'No. Hospital prices come to you exactly as the hospital quoted them. We do not add a margin on your treatment.'],
    ['Which country should I choose?', 'It depends on the diagnosis, the budget and how quickly you need to be seen. We compare options honestly — and if the treatment is available in Dhaka at a similar standard, we will tell you.'],
    ['How quickly will someone contact me?', 'Your coordinator replies within 24 hours, usually much sooner on WhatsApp.'],
    ['Will there be a language barrier?', 'No. A Bangla-speaking interpreter joins your consultations, and your coordinator is on WhatsApp throughout your stay — including at night, Bangladesh time.'],
    ['How long does treatment usually take?', 'It depends on the procedure — from a single-day health check-up to a few weeks for surgery, recovery and follow-up. Your plan will include an expected length of stay.'],
];

/** Medical visa document checklists. Only countries with confirmed lists are included. */
const VISA_CHECKLISTS = [
    'malaysia' => [
        'note' => 'Funds to show: Single 2.5 lakh BDT · Family 3.5 lakh BDT',
        'groups' => [
            ['Passport & identity', ['Passport valid 6+ months with 2 blank pages', 'Scan of all used pages', 'Old passports, if any', 'Copy of NID']],
            ['Photographs', ['Two recent passport-size photos', '3.5 cm × 5 cm', 'White background, matte finish']],
            ['Medical documents', ['Local doctor or hospital reports with diagnosis', 'Last 3 months of reports', 'Images or CD']],
            ['Financial proof', ['Bank statement, 3–6 months, signed and stamped', 'Bank solvency certificate', 'Hospital cost estimate, when required', 'TIN registration, TIN and income tax certificates']],
            ['Employment or occupation', ['Employed: NOC mentioning medical leave, office ID, visiting card, workstation photo', 'Business: trade licence copy', 'Student: letter from institution']],
        ],
    ],
];

function doctors_for(?string $country = null, bool $featuredOnly = false): array
{
    return array_values(array_filter(DOCTORS, static function (array $d) use ($country, $featuredOnly): bool {
        if ($featuredOnly && !$d['featured']) return false;
        return $country === null || $d['country'] === $country;
    }));
}

function hospitals_for(?string $country = null): array
{
    return array_values(array_filter(HOSPITALS, static fn(array $h): bool => $country === null || $h['country'] === $country));
}
