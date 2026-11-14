# Health Expert — website (frontend)

New PHP frontend for healthexpertbd.com. It uses the brand colours (navy `#061C3F`, mint `#19F6C5`), the brand fonts (Fraunces + Archivo) and the existing logo.

## Run locally

```bash
php -S 127.0.0.1:8080 -t .
```

Then open http://127.0.0.1:8080. You need PHP 8.1+ with `mbstring`.

## Structure

```
index.php            Home
destination.php?c=   One template for all 6 countries (india, thailand, malaysia, singapore, turkiye, china)
hospitals.php        Partner hospitals with country filter + search
doctors.php          Doctors with country filter + search
medical-visa.php     Visa guide with an interactive checklist (Malaysia)
about.php · contact.php · career.php · privacy.php · 404.php

includes/config.php  Contact details, offices, stats, helpers (e(), wa(), url(), asset())
includes/data.php    Countries, hospitals, doctors, services, steps, FAQs, visa checklists
includes/icons.php   Inline SVG icons + the HE brand mark
partials/            header, footer, reusable components (lead form, doctor card, FAQ, journey…)
assets/css/style.css Design system
assets/js/main.js    Motion and interactions (GSAP + ScrollTrigger + Lenis, with fallbacks)
assets/js/globe.js   Animated canvas globe with routes from Dhaka
```

All content lives in `includes/config.php` and `includes/data.php` as arrays shaped like database rows. The backend can replace them with queries without touching the templates.

## Motion

- Brand preloader and page transitions
- Animated 3D dot globe in the hero
- Split-text headline reveals
- Scroll-scrubbed statement text
- Stacking "how it works" cards
- Magnetic buttons, spotlight cards, tilt cards, custom cursor
- Draggable doctor rail and tabbed destinations

Everything respects `prefers-reduced-motion`, and content stays visible if a script fails to load.

## Waiting on backend (after confirmation)

- `submit.php`: the lead form currently validates and shows a success state in **preview mode**. Nothing is sent or stored yet.
- Admin for doctors, hospitals, countries, FAQs and job posts.
- Doctor photos (cards use monogram avatars until real portraits are uploaded).
- Pretty URLs (`/destinations/india`) — change `url()` in `includes/config.php` plus `.htaccess`.

## Content to confirm with the team

- **China** copy is a draft. The old site repeated India's text there.
- **Bangladesh office address**: uses Gulshan-2 (from the doctor posters and privacy policy). The old Malaysia page said Dhanmondi.
- **Flight times** on destination cards are approximate.
- **Dr. Kanika Batra Modi**: hospital set to Max Healthcare, taken from the photo filename.
- **Country counter** now says 6, matching the six destinations shown. The old site said 5.
- **Visa checklists**: only Malaysia has a confirmed list. The other countries send people to WhatsApp for their checklist.
