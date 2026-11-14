<?php
$page_title = 'Privacy policy';
$page_desc  = 'How Health Expert collects, uses, stores, protects and shares your personal and medical information.';
$active     = '';
require __DIR__ . '/partials/header.php';

// Content copied from the current healthexpertbd.com privacy policy.
// Format: heading => list of blocks. A string is a paragraph, an array is a bullet list, ['h3' => '...'] is a sub-heading.
$sections = [
    'Information we collect' => [
        'We may collect information that you voluntarily provide to us, including:',
        ['h3' => 'Personal information'],
        ['Full name', 'Phone number', 'WhatsApp number', 'Email address', 'Address or location', 'Age or date of birth', 'Passport or identification information when required for medical travel assistance', 'Information provided through inquiry or consultation forms'],
        ['h3' => 'Medical information'],
        'If you choose to request medical assistance, you may provide information such as:',
        ['Medical reports', 'Diagnosis and medical history', 'Symptoms and treatment information', 'Prescriptions', 'Test results and imaging reports', 'Information about previous or ongoing treatment', 'Other health-related information necessary for treatment assessment'],
        'You are not required to provide medical information unless it is necessary for the service you are requesting.',
        ['h3' => 'Technical information'],
        'When you visit our website, we may automatically collect certain technical information, such as:',
        ['IP address', 'Browser type', 'Device type', 'Operating system', 'Pages visited', 'Website interaction information', 'Referral/source information', 'Date and time of website visits', 'Cookies and similar technologies'],
        'We may use analytics and advertising technologies to understand website usage and improve our marketing and services.',
    ],
    'How we use your information' => [
        'We may use the information we collect to:',
        ['Respond to your inquiries and requests', 'Contact you regarding your requested services', 'Review medical information that you voluntarily provide', 'Help identify suitable hospitals, doctors, or treatment options', 'Coordinate consultations with doctors or hospitals', 'Provide medical tourism assistance', 'Assist with medical visa processing', 'Arrange appointments and medical invitations', 'Provide travel, accommodation, airport pickup, interpreter, and related assistance', 'Provide estimated treatment costs or treatment plans where applicable', 'Improve our website, services, and customer experience', 'Send service-related communications', 'Send marketing communications where permitted and where you have provided appropriate consent', 'Measure and improve advertising and marketing performance', 'Prevent fraud, misuse, or unauthorized activity', 'Comply with applicable laws and legal requirements'],
    ],
    'Medical and health information' => [
        'We understand that medical information is sensitive.',
        'If you voluntarily send us medical reports, prescriptions, test results, diagnostic information, or other health-related information, we may use that information only as reasonably necessary to provide the services you have requested.',
        'For example, with your permission, we may share relevant medical information with:',
        ['Hospitals', 'Doctors', 'Medical specialists', 'Diagnostic or healthcare providers', 'Medical coordinators', 'Other service providers involved in arranging your requested treatment'],
        'We will try to limit shared information to what is reasonably relevant to the requested service.',
        'Health Expert is a medical tourism and healthcare assistance service provider. We do not replace or substitute for a licensed doctor, hospital, or other healthcare professional.',
    ],
    'Information sharing' => [
        'We may share your information with trusted third parties when reasonably necessary to provide the services you request. These parties may include:',
        ['Hospitals and healthcare providers', 'Doctors and medical specialists', 'Visa and travel-related service providers', 'Accommodation providers', 'Transportation or airport assistance providers', 'Interpreters', 'Technology and hosting service providers', 'Communication and customer-support providers', 'Analytics and advertising service providers'],
        'We may also disclose information where required by applicable law, regulation, court order, or lawful governmental request.',
        'We do not sell your personal information as a product to third parties.',
    ],
    'Marketing and advertising' => [
        'We may use certain information to understand how visitors interact with our website and marketing campaigns. This may include the use of technologies such as:',
        ['Cookies', 'Meta Pixel or related Meta technologies', 'Google Analytics or related Google technologies', 'Google Tag Manager', 'Other analytics, advertising, or conversion-tracking technologies'],
        'These technologies may help us measure advertising performance, understand website traffic, and improve our services.',
        'Where applicable, you may be able to manage cookies or advertising preferences through your browser, device, or the relevant platform.',
    ],
    'Cookies' => [
        'Our website may use cookies and similar technologies. Cookies may help us:',
        ['Keep the website functioning properly', 'Remember preferences', 'Understand website traffic', 'Measure marketing campaigns', 'Improve website performance', 'Understand how visitors use our website'],
        'You can usually control or disable cookies through your browser settings. However, disabling certain cookies may affect some website functionality.',
    ],
    'Third-party websites and services' => [
        'Our website or communications may contain links to third-party websites, hospitals, healthcare providers, social media platforms, payment providers, or other services.',
        'Health Expert is not responsible for the privacy practices, security, or content of third-party websites.',
        'We recommend reviewing the privacy policies of any third-party service before providing them with your information.',
    ],
    'Data security' => [
        'We take reasonable administrative, technical, and organizational measures to protect the personal information entrusted to us.',
        'However, no method of transmitting or storing information electronically can be guaranteed to be completely secure. Therefore, while we take reasonable steps to protect your information, we cannot guarantee absolute security.',
    ],
    'Data retention' => [
        'We retain personal information only for as long as reasonably necessary for the purposes described in this Privacy Policy, including providing services, maintaining business records, resolving disputes, preventing fraud, and complying with legal obligations.',
        'The period for which information is retained may vary depending on the type of information and the purpose for which it was collected.',
    ],
    'Your choices and rights' => [
        'Depending on applicable law, you may have the right to:',
        ['Ask what personal information we hold about you', 'Request correction of inaccurate information', 'Request deletion of information where legally applicable', 'Withdraw consent where processing is based on consent', 'Request information about how your information is used', 'Opt out of certain marketing communications'],
        'To exercise any applicable privacy rights, please contact us using the contact information provided below.',
    ],
    'Communications' => [
        'If you provide your phone number, WhatsApp number, email address, or other contact information, we may contact you regarding:',
        ['Your inquiry', 'Medical consultation', 'Treatment assessment', 'Hospital or doctor coordination', 'Visa processing', 'Travel arrangements', 'Appointment information', 'Other services you have requested'],
        'Where permitted by applicable law, we may also send promotional or marketing communications. You may request that we stop sending promotional communications at any time.',
    ],
    'Children’s privacy' => [
        'Our services are primarily intended for adults and their authorized family members or guardians.',
        'We do not knowingly collect personal information from children without appropriate parental or guardian involvement where required by applicable law.',
        'If you believe that a child has provided personal information to us without appropriate authorization, please contact us so that we can review the matter.',
    ],
    'International data transfers' => [
        'Because Health Expert assists patients with medical treatment in countries outside Bangladesh, certain information may need to be shared with healthcare providers, hospitals, doctors, or service providers located outside Bangladesh.',
        'Where such sharing is necessary for the service you request, we will take reasonable steps to handle the information appropriately and securely.',
    ],
    'Changes to this privacy policy' => [
        'We may update this Privacy Policy from time to time to reflect changes in our services, technology, legal requirements, or business practices.',
        'When we make changes, we may update the “Last updated” date at the top of this page. We encourage you to review this page periodically.',
    ],
];
?>

<?php page_hero('Legal', 'Privacy <em>policy</em>', 'Health Expert respects your privacy and is committed to protecting the personal and medical information you share with us.', ['Privacy policy']); ?>

<section class="section">
  <div class="container legal-layout">
    <nav class="toc" aria-label="On this page">
      <?php $n = 1; foreach ($sections as $h => $_): ?>
        <a href="#s<?= $n ?>"><?= $n ?>. <?= e($h) ?></a>
      <?php $n++; endforeach; ?>
      <a href="#s<?= $n ?>"><?= $n ?>. Contact us</a>
    </nav>

    <article class="legal">
      <p>This Privacy Policy explains how we collect, use, store, protect, and disclose information when you visit <?= e(SITE['domain']) ?>, contact us, submit an inquiry or lead form, communicate with us through WhatsApp or other channels, or use our medical tourism and healthcare assistance services.</p>
      <p>By using our website or providing your information to us, you acknowledge the practices described in this Privacy Policy.</p>

      <?php $n = 1; foreach ($sections as $h => $blocks): ?>
        <h2 id="s<?= $n ?>"><?= $n ?>. <?= e($h) ?></h2>
        <?php foreach ($blocks as $b): ?>
          <?php if (is_string($b)): ?>
            <p><?= e($b) ?></p>
          <?php elseif (isset($b['h3'])): ?>
            <h3><?= e($b['h3']) ?></h3>
          <?php else: ?>
            <ul><?php foreach ($b as $li): ?><li><?= e($li) ?></li><?php endforeach; ?></ul>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php $n++; endforeach; ?>

      <h2 id="s<?= $n ?>"><?= $n ?>. Contact us</h2>
      <p>If you have questions about this Privacy Policy or how Health Expert handles your information, please contact us:</p>
      <ul>
        <li><?= e(SITE['offices'][0]['address']) ?></li>
        <li>Phone: <a href="tel:<?= e(SITE['hotline_tel']) ?>"><?= e(SITE['hotline']) ?></a></li>
        <li>Email: <a href="mailto:<?= e(SITE['email']) ?>"><?= e(SITE['email']) ?></a></li>
      </ul>
      <p>If you have submitted a medical report or personal information and have questions about its use, please mention this when contacting us so that our team can assist you appropriately.</p>
    </article>
  </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
